@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Détails de la Cotisation</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $cotisation->nom }}</h5>
                <p class="card-text">Montant: {{ $cotisation->montant }} FCFA</p>
                <p class="card-text">Date Limite: {{ $cotisation->date_limite }}</p>
            </div>
        </div>
        <a href="{{ route('cotisations.index') }}" class="btn btn-primary mt-3">Retour à la Liste</a>
    </div>
@endsection
