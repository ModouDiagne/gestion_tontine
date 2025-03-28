@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Liste des Cotisations</h1>
        <a href="{{ route('cotisations.create') }}" class="btn btn-primary mb-3">Ajouter une Cotisation</a>

        @if($cotisations->isEmpty())
            <div class="alert alert-info">Aucune cotisation enregistrée.</div>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nom</th>
                        <th>Montant</th>
                        <th>Date Limite</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cotisations as $cotisation)
                        <tr>
                            <td>{{ $cotisation->id }}</td>
                            <td>{{ $cotisation->nom }}</td>
                            <td>{{ $cotisation->montant }} FCFA</td>
                            <td>{{ $cotisation->date_limite }}</td>
                            <td>
                                <a href="{{ route('cotisations.show', $cotisation) }}" class="btn btn-info">Voir</a>
                                <a href="{{ route('cotisations.edit', $cotisation) }}" class="btn btn-warning">Modifier</a>
                                <form action="{{ route('cotisations.destroy', $cotisation) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
