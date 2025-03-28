@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Tirages de la Cotisation "{{ $cotisation->nom }}"</h1>
        <a href="{{ route('tirages.create', $cotisation) }}" class="btn btn-primary mb-3">Ajouter un Tirage</a>

        @if($cotisation->tirages->isEmpty())
            <div class="alert alert-info">Aucun tirage enregistré pour cette cotisation.</div>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Date du Tirage</th>
                        <th>Montant Distribué</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cotisation->tirages as $tirage)
                        <tr>
                            <td>{{ $tirage->id }}</td>
                            <td>{{ $tirage->date_tirage }}</td>
                            <td>{{ $tirage->montant_distribue }} FCFA</td>
                            <td>
                                <a href="{{ route('tirages.show', [$cotisation, $tirage]) }}" class="btn btn-info">Voir</a>
                                <a href="{{ route('tirages.edit', [$cotisation, $tirage]) }}" class="btn btn-warning">Modifier</a>
                                <form action="{{ route('tirages.destroy', [$cotisation, $tirage]) }}" method="POST" style="display:inline;">
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
