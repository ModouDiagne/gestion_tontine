@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Liste des Tontines</h1>

    <!-- Message de succès -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Bouton pour créer une nouvelle tontine -->
    <a href="{{ route('tontines.create') }}" class="btn btn-primary mb-3">Créer une Tontine</a>

    <!-- Tableau des tontines -->
    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Libellé</th>
                <th>Participants</th>
                <th>Montant Base</th>
                <th>Montant Total</th>
                <th>Fréquence</th>
                <th>Date Début</th>
                <th>Date Fin</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tontines as $index => $tontine)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $tontine->libelle }}</td>
                    <td>{{ $tontine->nbreParticipant }}</td>
                    <td>{{ number_format($tontine->montant_base, 0, ',', ' ') }} FCFA</td>
                    <td>{{ number_format($tontine->montant_total, 0, ',', ' ') }} FCFA</td>
                    <td>{{ ucfirst(strtolower($tontine->frequence)) }}</td>
                    <td>{{ $tontine->dateDebut->format('d/m/Y') }}</td>
                    <td>{{ $tontine->dateFin->format('d/m/Y') }}</td>
                    <td>
                        <!-- Formulaire de sélection -->
                        <form method="POST" action="{{ route('tontines.select', $tontine->slug) }}" class="mb-2">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-info btn-block">
                                <i class="fas fa-check"></i> Sélectionner
                            </button>
                        </form>

                        <!-- Actions standard -->
                        <a href="{{ route('tontines.show', $tontine->slug) }}" class="btn btn-sm btn-primary btn-block">
                            <i class="fas fa-eye"></i> Voir
                        </a>

                        <a href="{{ route('tontines.edit', $tontine->slug) }}" class="btn btn-sm btn-warning btn-block">
                            <i class="fas fa-edit"></i> Modifier
                        </a>

                        <form action="{{ route('tontines.destroy', $tontine->slug) }}" method="POST" class="mt-2">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger btn-block" onclick="return confirm('Confirmer la suppression ?')">
                                <i class="fas fa-trash"></i> Supprimer
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center">Aucune tontine enregistrée.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="d-flex justify-content-center">
        {{ $tontines->links() }}
    </div>
</div>
@endsection
