@extends('layouts.app')

@section('contenu')
<div class="container">
    <h1>Créer un Nouveau Tour</h1>

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('tours.store', $tontine->slug) }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="date_tour" class="form-label">Date du Tour</label>
            <input type="date" name="date_tour" id="date_tour" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="montant" class="form-label">Montant</label>
            <input type="number" name="montant" id="montant" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="beneficiaire_id" class="form-label">Bénéficiaire</label>
            <select name="beneficiaire_id" id="beneficiaire_id" class="form-control" required>
                @foreach($participants as $participant)
                    <option value="{{ $participant->id }}">{{ $participant->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Créer</button>
    </form>
</div>
@endsection
