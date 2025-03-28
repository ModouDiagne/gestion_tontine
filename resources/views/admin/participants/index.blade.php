@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Liste des Participants</h1>

    <!-- Message de succès -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Bouton pour ajouter un participant -->
    <a href="{{ route('admin.participants.create') }}" class="btn btn-primary mb-3">Ajouter un Participant</a>

    <!-- Tableau des participants -->
    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>Nom</th>
                <th>Prénoms</th>
                <th>Sexe</th>
                <th>Téléphone</th>
                <th>Email</th>
                <th>Tontine</th>
                <th>Utilisateur</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($participants as $participant)
                <tr>
                    <td>{{ $participant->nom }}</td>
                    <td>{{ $participant->prenoms }}</td>
                    <td>{{ $participant->sexe }}</td>
                    <td>{{ $participant->telephone }}</td>
                    <td>{{ $participant->email }}</td>
                    <td>{{ $participant->tontine->libelle ?? 'Non spécifié' }}</td>
                    <td>{{ $participant->utilisateur->name ?? 'Non spécifié' }}</td>
                    <td>
                        <!-- Bouton Modifier -->
                        <a href="{{ route('admin.participants.edit', $participant->id) }}" class="btn btn-sm btn-warning">
                            <i class="fas fa-edit"></i> Modifier
                        </a>

                        <!-- Formulaire de suppression -->
                        <form action="{{ route('admin.participants.destroy', $participant->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Confirmer la suppression ?')">
                                <i class="fas fa-trash"></i> Supprimer
                            </button>
                        </form>
                    </td>
                </tr>
                <tr>
                    <td colspan="8">
                        <strong>Montant/Personne :</strong> {{ number_format($participant->tontine->montant_base ?? 0, 0, ',', ' ') }} FCFA <br>
                        <strong>Cycle de vie :</strong> {{ $participant->tontine->cycle_vie ?? 'Non défini' }} <br>
                        <strong>Notification :</strong>
                        <a href="{{ route('admin.participants.notify', $participant->id) }}" class="btn btn-sm btn-info">Envoyer</a>
                        <a href="{{ route('admin.participants.edit', $participant->id) }}" class="btn btn-sm btn-secondary">Modifier Les Infos</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">Aucun participant enregistré.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Affichage des entrées et pagination -->
    <div class="d-flex justify-content-between">
        <span>Affichage de {{ $participants->firstItem() }} à {{ $participants->lastItem() }} sur {{ $participants->total() }} entrées</span>
        {{ $participants->links() }}
    </div>

    <!-- Date et heure -->
    <div class="mt-3">
        <strong>{{ now()->format('Y-m-d H:i:s') }}</strong>
    </div>
</div>
@endsection
