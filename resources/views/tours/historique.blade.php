@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-4">Historique des Tours</h1>

        {{-- Affichage des messages de succès --}}
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- Vérification si des tours existent --}}
        @if ($tours->isEmpty())
            <p>Aucun tour enregistré pour le moment.</p>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nom du Tour</th>
                        <th>Description</th>
                        <th>Date</th>
                        <th>Lieu</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tours as $index => $tour)
                        <tr>
                            <td>{{ $loop->iteration }}</td> {{-- Utilisation de $loop->iteration à la place de $index + 1 --}}
                            <td>{{ $tour->nom }}</td>
                            <td>{{ $tour->description ?? 'Aucune description' }}</td>
                            <td>{{ \Carbon\Carbon::parse($tour->date)->format('d/m/Y') }}</td>
                            <td>{{ $tour->lieu }}</td>
                            <td>
                                <a href="{{ route('tours.show', ['tontine' => $tontine->slug, 'tour' => $tour->slug]) }}" class="btn btn-info btn-sm">Voir</a>
                                <a href="{{ route('tours.edit', ['tontine' => $tontine->slug, 'tour' => $tour->slug]) }}" class="btn btn-warning btn-sm">Modifier</a>
                                <form action="{{ route('tours.destroy', ['tontine' => $tontine->slug, 'tour' => $tour->slug]) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce tour ?')">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- Pagination --}}
            <div class="d-flex justify-content-center">
                {{ $tours->links() }}
            </div>
        @endif

        {{-- Bouton pour ajouter un nouveau tour (avec passage de la tontine) --}}
        <a href="{{ route('tours.create', ['tontine' => $tontine->slug]) }}" class="btn btn-primary">Ajouter un nouveau tour</a>

        {{-- Bouton retour --}}
        <a href="{{ route('tontines.index') }}" class="btn btn-secondary">Retour à la liste des tontines</a>
    </div>
@endsection
