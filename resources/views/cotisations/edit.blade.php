@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Modifier la Cotisation</h1>

        <form action="{{ route('cotisations.update', $cotisation) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nom">Nom de la Cotisation</label>
                <input type="text" name="nom" id="nom" class="form-control @error('nom') is-invalid @enderror" value="{{ old('nom', $cotisation->nom) }}">
                @error('nom') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label for="montant">Montant (FCFA)</label>
                <input type="number" name="montant" id="montant" class="form-control @error('montant') is-invalid @enderror" value="{{ old('montant', $cotisation->montant) }}">
                @error('montant') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label for="date_limite">Date Limite</label>
                <input type="date" name="date_limite" id="date_limite" class="form-control @error('date_limite') is-invalid @enderror" value="{{ old('date_limite', $cotisation->date_limite) }}">
                @error('date_limite') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <button type="submit" class="btn btn-success">Mettre à jour</button>
        </form>
    </div>
@endsection
