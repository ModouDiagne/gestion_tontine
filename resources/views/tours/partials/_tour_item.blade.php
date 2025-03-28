{{-- resources/views/tours/_tour_item.blade.php --}}

<tr>
    {{-- Dates du tour --}}
    <td class="align-middle">{{ $tour->date_debut->format('d/m/Y H:i') }}</td>
    <td class="align-middle">{{ $tour->date_fin->format('d/m/Y H:i') }}</td>

    {{-- Bénéficiaire --}}
    <td class="align-middle">
        <div class="d-flex align-items-center">
            <img src="{{ $tour->beneficiaire->avatar_url }}"
                 class="rounded-circle mr-2"
                 width="30"
                 alt="{{ $tour->beneficiaire->name }}">
            {{ $tour->beneficiaire->name }}
        </div>
    </td>

    {{-- Montant --}}
    <td class="align-middle font-weight-bold">
        {{ number_format($tour->montant, 0, ',', ' ') }} FCFA
    </td>

    {{-- Statut --}}
    <td class="align-middle">
        @if($tour->termine)
            <span class="badge badge-success">
                <i class="fas fa-check-circle"></i> Terminé
            </span>
        @else
            <span class="badge badge-warning">
                <i class="fas fa-spinner fa-pulse"></i> En cours
            </span>
        @endif
    </td>

    {{-- Actions --}}
    <td class="align-middle">
        <div class="d-flex justify-content-around">
            {{-- Modification --}}
            @can('update-tour', $tour)
            <a href="{{ route('tours.edit', [$tontine, $tour]) }}"
               class="btn btn-sm btn-outline-primary"
               title="Modifier les détails">
                <i class="fas fa-edit"></i>
            </a>
            @endcan

            {{-- Suppression --}}
            @can('delete-tour', $tour)
            <form method="POST"
                  action="{{ route('tours.destroy', [$tontine, $tour]) }}">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="btn btn-sm btn-outline-danger"
                        onclick="return confirm('Supprimer définitivement ce tour ?')"
                        title="Supprimer le tour">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </form>
            @endcan

            {{-- Marquage comme terminé --}}
            @can('terminate-tour', $tour)
            <form method="POST"
                  action="{{ route('tours.terminer', [$tontine->slug, $tour->id]) }}">
                @csrf
                <button type="submit"
                        class="btn btn-sm btn-outline-success"
                        @if($tour->termine) disabled @endif
                        title="Marquer comme terminé">
                    <i class="fas fa-flag-checkered"></i>
                </button>
            </form>
            @endcan

            {{-- Détails --}}
            <a href="{{ route('tours.show', [$tontine, $tour]) }}"
               class="btn btn-sm btn-outline-info"
               title="Voir les détails">
                <i class="fas fa-eye"></i>
            </a>
        </div>
    </td>
</tr>
