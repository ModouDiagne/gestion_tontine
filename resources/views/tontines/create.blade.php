@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4>Créer une Nouvelle Tontine</h4>
        </div>

        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('tontines.store') }}">
                @csrf

                <div class="row">
                    <!-- Nom de la tontine -->
                    <div class="col-md-6 mb-3">
                        <label for="libelle" class="form-label">Nom de la tontine</label>
                        <input type="text" class="form-control @error('libelle') is-invalid @enderror"
                               id="libelle" name="libelle" value="{{ old('libelle') }}" required>
                        @error('libelle')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Nombre maximum de membres -->
                    <div class="col-md-6 mb-3">
                        <label for="nbreParticipant" class="form-label">Nombre maximum de membres</label>
                        <input type="number" class="form-control @error('nbreParticipant') is-invalid @enderror"
                               id="nbreParticipant" name="nbreParticipant" value="{{ old('nbreParticipant') }}" min="1" required>
                        @error('nbreParticipant')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <!-- Montant Maximum -->
                    <div class="col-md-6 mb-3">
                        <label for="montant_base" class="form-label">Montant Maximum</label>
                        <input type="number" class="form-control @error('montant_base') is-invalid @enderror"
                               id="montant_base" name="montant_base" value="{{ old('montant_base') }}" min="1000" required>
                        @error('montant_base')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Fréquence -->
                    <div class="col-md-6 mb-3">
                        <label for="frequence" class="form-label">Fréquence</label>
                        <select class="form-control @error('frequence') is-invalid @enderror"
                                id="frequence" name="frequence" required>
                            <option value="">Sélectionnez une fréquence</option>
                            <option value="JOURNALIERE" {{ old('frequence') == 'JOURNALIERE' ? 'selected' : '' }}>Journalière</option>
                            <option value="HEBDOMADAIRE" {{ old('frequence') == 'HEBDOMADAIRE' ? 'selected' : '' }}>Hebdomadaire</option>
                            <option value="MENSUEL" {{ old('frequence') == 'MENSUEL' ? 'selected' : '' }}>Mensuelle</option>
                        </select>
                        @error('frequence')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <!-- Date de début -->
                    <div class="col-md-6 mb-3">
                        <label for="dateDebut" class="form-label">Date de début</label>
                        <input type="date" class="form-control @error('dateDebut') is-invalid @enderror"
                               id="dateDebut" name="dateDebut" value="{{ old('dateDebut') }}" required>
                        @error('dateDebut')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Date de fin -->
                    <div class="col-md-6 mb-3">
                        <label for="dateFin" class="form-label">Date de fin</label>
                        <input type="date" class="form-control @error('dateFin') is-invalid @enderror"
                               id="dateFin" name="dateFin" value="{{ old('dateFin') }}" required>
                        @error('dateFin')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Description -->
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror"
                              id="description" name="description" rows="3" required>{{ old('description') }}</textarea>
                    @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Boutons -->
                <div class="d-flex justify-content-between">
                    <button type="reset" class="btn btn-danger">Annuler</button>
                    <button type="submit" class="btn btn-success">Créer</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
