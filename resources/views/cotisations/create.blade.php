@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Ajouter une Cotisation</h1>

        <form action="{{ route('cotisations.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nom">Nom de la Cotisation</label>
                <input type="text" name="nom" id="nom" class="form-control @error('nom') is-invalid @enderror" value="{{ old('nom') }}">
                @error('nom') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label for="montant">Montant (FCFA)</label>
                <input type="number" name="montant" id="montant" class="form-control @error('montant') is-invalid @enderror" value="{{ old('montant') }}">
                @error('montant') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label for="date_limite">Date Limite</label>
                <input type="date" name="date_limite" id="date_limite" class="form-control @error('date_limite') is-invalid @enderror" value="{{ old('date_limite') }}">
                @error('date_limite') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <button type="submit" class="btn btn-success">Créer Cotisation</button>
        </form>
    </div>
@endsection
