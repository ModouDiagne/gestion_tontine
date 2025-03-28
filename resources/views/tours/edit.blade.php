@extends('layouts.app')

@section('contenu')
<div class="container">
    <div class="card shadow mb-4">
        <div class="card-header bg-primary text-white py-3">
            <h4 class="m-0 font-weight-bold">
                <i class="fas fa-edit mr-2"></i>Modifier le tour du {{ $tour->date_debut->format('d/m/Y') }}
            </h4>
        </div>

        <div class="card-body">
            <form action="{{ route('tours.update', [$tontine->slug, $tour->id]) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <!-- Date du tour -->
                    <div class="col-md-6 form-group">
                        <label for="date_debut">Date du tour</label>
                        <input type="datetime-local"
                               class="form-control @error('date_debut') is-invalid @enderror"
                               id="date_debut"
                               name="date_debut"
                               value="{{ old('date_debut', $tour->date_debut->format('Y-m-d\TH:i')) }}"
                               required>
                        @error('date_debut')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Montant -->
                    <div class="col-md-6 form-group">
                        <label for="montant">Montant (FCFA)</label>
                        <input type="number"
                               class="form-control @error('montant') is-invalid @enderror"
                               id="montant"
                               name="montant"
                               min="1000"
                               step="500"
                               value="{{ old('montant', $tour->montant) }}"
                               required>
                        @error('montant')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Bénéficiaire -->
                <div class="form-group">
                    <label for="beneficiaire_id">Bénéficiaire</label>
                    <select class="form-control @error('beneficiaire_id') is-invalid @enderror"
                            id="beneficiaire_id"
                            name="beneficiaire_id"
                            required>
                        <option value="">Sélectionnez un bénéficiaire</option>
                        @foreach($participants as $participant)
                        <option value="{{ $participant->id }}"
                            {{ old('beneficiaire_id', $tour->beneficiaire_id) == $participant->id ? 'selected' : '' }}>
                            {{ $participant->user->name }} - {{ $participant->cycle_vie }} cycles
                        </option>
                        @endforeach
                    </select>
                    @error('beneficiaire_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Boutons -->
                <div class="mt-4 d-flex justify-content-between">
                    <a href="{{ route('tours.index', $tontine->slug) }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left mr-2"></i>Annuler
                    </a>
                    @can('update', $tour)
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save mr-2"></i>Enregistrer
                    </button>
                    @endcan
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
