@extends('layouts.app')

@section('contenu')
<div class="container-fluid">
    <!-- En-tête -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Détails de la Tontine</h1>
        <a href="{{ route('tontines.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Retour à la liste
        </a>
    </div>

    <!-- Carte Principale -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 bg-primary">
            <h6 class="m-0 font-weight-bold text-white">{{ $tontine->libelle }}</h6>
        </div>

        <div class="card-body">
            <!-- Section Informations de Base -->
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="card border-left-primary h-100">
                        <div class="card-header">
                            <h5 class="m-0 font-weight-bold text-primary">
                                <i class="fas fa-info-circle mr-2"></i>Informations Générales
                            </h5>
                        </div>
                        <div class="card-body">
                            <dl class="row">
                                <dt class="col-sm-6">Montant de la cotisation:</dt>
                                <dd class="col-sm-6">{{ number_format($tontine->montant_base, 0, ',', ' ') }} FCFA</dd>

                                <dt class="col-sm-6">Fréquence:</dt>
                                <dd class="col-sm-6 text-capitalize">{{ $tontine->frequence }}</dd>

                                <dt class="col-sm-6">Date de début:</dt>
                                <dd class="col-sm-6">{{ $tontine->date_debut->format('d/m/Y') }}</dd>

                                <dt class="col-sm-6">Statut:</dt>
                                <dd class="col-sm-6">
                                    @if($tontine->active)
                                        <span class="badge badge-success p-2">Active</span>
                                    @else
                                        <span class="badge badge-secondary p-2">Archivée</span>
                                    @endif
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>

                <!-- Section Participants -->
                <div class="col-md-6 mb-4">
                    <div class="card border-left-success h-100">
                        <div class="card-header">
                            <h5 class="m-0 font-weight-bold text-success">
                                <i class="fas fa-users mr-2"></i>Participants ({{ $tontine->participants->count() }})
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="list-group">
                                @forelse($tontine->participants as $participant)
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong>{{ $participant->nom_complet }}</strong>
                                        <div class="text-muted small">{{ $participant->telephone }}</div>
                                    </div>
                                    <span class="badge badge-primary badge-pill">
                                        {{ $participant->cotisations_valides->count() }}x
                                    </span>
                                </div>
                                @empty
                                <div class="list-group-item text-center text-muted py-4">
                                    <i class="fas fa-exclamation-circle fa-2x mb-2"></i><br>
                                    Aucun participant enregistré
                                </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section Gestion des Tours -->
            <div class="row">
                <div class="col-12">
                    <div class="card border-left-info">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="m-0 font-weight-bold text-info">
                                <i class="fas fa-calendar-alt mr-2"></i>Gestion des Tours
                            </h5>
                            <div>
                                <a href="{{ route('tours.create', $tontine->slug) }}"
                                   class="btn btn-sm btn-info">
                                    <i class="fas fa-plus-circle mr-2"></i>Nouveau Tour
                                </a>
                                <a href="{{ route('tours.historique', $tontine->slug) }}"
                                   class="btn btn-sm btn-secondary">
                                    <i class="fas fa-history mr-2"></i>Historique
                                </a>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead class="bg-info text-white">
                                        <tr>
                                            <th>Date</th>
                                            <th>Bénéficiaire</th>
                                            <th>Montant</th>
                                            <th>Statut</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($tontine->tours as $tour)
                                        <tr>
                                            <td>{{ $tour->date_tour->format('d/m/Y') }}</td>
                                            <td>{{ $tour->beneficiaire->nom_complet ?? 'Non attribué' }}</td>
                                            <td>{{ number_format($tour->montant, 0, ',', ' ') }} FCFA</td>
                                            <td>
                                                @if($tour->termine)
                                                    <span class="badge badge-success">Terminé</span>
                                                @else
                                                    <span class="badge badge-warning">En cours</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-circle btn-primary">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="5" class="text-center text-muted py-4">
                                                <i class="fas fa-calendar-times fa-2x mb-2"></i><br>
                                                Aucun tour planifié
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
