{{-- resources/views/tours/partials/_tour_card.blade.php --}}

<div class="col-md-4 mb-4">
    <div class="card shadow h-100">
        <div class="card-header bg-{{ $tour->termine ? 'success' : 'warning' }} text-white">
            <h5 class="mb-0">
                Tour du {{ $tour->date_debut->format('d/m/Y') }}
                @if($tour->termine)
                    <span class="float-right"><i class="fas fa-check-circle"></i></span>
                @endif
            </h5>
        </div>

        <div class="card-body">
            <div class="d-flex align-items-center mb-3">
                <img src="{{ $tour->beneficiaire->avatar_url }}"
                     class="rounded-circle mr-3"
                     width="50"
                     alt="{{ $tour->beneficiaire->name }}">
                <div>
                    <h6 class="mb-0">{{ $tour->beneficiaire->name }}</h6>
                    <small class="text-muted">Bénéficiaire</small>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-6">
                    <div class="text-small">Montant</div>
                    <div class="h5 text-primary">
                        {{ number_format($tour->montant, 0, ',', ' ') }} FCFA
                    </div>
                </div>
                <div class="col-6">
                    <div class="text-small">Statut</div>
                    <div class="h5">
                        @if($tour->termine)
                            <span class="text-success">Terminé</span>
                        @else
                            <span class="text-warning">En cours</span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="border-top pt-3">
                <div class="d-flex justify-content-between">
                    @can('update-tour', $tour)
                    <a href="{{ route('tours.edit', [$tontine, $tour]) }}"
                       class="btn btn-sm btn-outline-primary"
                       title="Modifier">
                        <i class="fas fa-edit"></i>
                    </a>
                    @endcan

                    @can('delete-tour', $tour)
                    <form method="POST" action="{{ route('tours.destroy', [$tontine, $tour]) }}">
                        @csrf @method('DELETE')
                        <button type="submit"
                                class="btn btn-sm btn-outline-danger"
                                onclick="return confirm('Confirmer la suppression ?')">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </form>
                    @endcan

                    @can('terminate-tour', $tour)
                    <form method="POST" action="{{ route('tours.terminer', [$tontine->slug, $tour->id]) }}">
                        @csrf
                        <button type="submit"
                                class="btn btn-sm btn-{{ $tour->termine ? 'secondary' : 'success' }}"
                                {{ $tour->termine ? 'disabled' : '' }}>
                            <i class="fas fa-flag-checkered"></i>
                        </button>
                    </form>
                    @endcan
                </div>
            </div>
        </div>

        <div class="card-footer bg-white">
            <small class="text-muted">
                Créé le {{ $tour->created_at->format('d/m/Y à H:i') }}
            </small>
        </div>
    </div>
</div>
