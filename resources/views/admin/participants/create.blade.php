@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4>Ajouter un Participant</h4>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.participants.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Colonne 1 -->
                    <div class="row">
                    <div class="form-group">
                        <label for="nom" class="text-sm font-semibold text-gray-700">Nom</label>
                        <input type="text" name="nom" id="nom" class="w-full p-3 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>

                    <div class="form-group">
                        <label for="prenoms" class="text-sm font-semibold text-gray-700">Prénoms</label>
                        <input type="text" name="prenoms" id="prenoms" class="w-full p-3 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    </div>
                    <!-- Colonne 2 -->
                    <div class="row">
                    <div class="form-group">
                        <label for="sexe" class="text-sm font-semibold text-gray-700">Sexe</label>
                        <select name="sexe" id="sexe" class="w-full p-3 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            <option value="">-CHOIX-</option>
                            <option value="M">Masculin</option>
                            <option value="F">Féminin</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="telephone" class="text-sm font-semibold text-gray-700">Téléphone</label>
                        <input type="tel" name="telephone" id="telephone" class="w-full p-3 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    </div>
                    <!-- Colonne 3 -->
                    <div class="row">
                    <div class="form-group">
                        <label for="email" class="text-sm font-semibold text-gray-700">Adresse Email</label>
                        <input type="email" name="email" id="email" class="w-full p-3 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>

                    <div class="form-group">
                        <label for="password" class="text-sm font-semibold text-gray-700">Mot de passe</label>
                        <input type="password" name="password" id="password" class="w-full p-3 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    </div>
                    <!-- Colonne 4 -->
                    <div class="row">
                    <div class="form-group">
                        <label for="password_confirmation" class="text-sm font-semibold text-gray-700">Confirmer Mot de passe</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="w-full p-3 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>

                    <div class="form-group">
                        <label for="montant_personne" class="text-sm font-semibold text-gray-700">Montant/Personne</label>
                        <input type="number" name="montant_personne" id="montant_personne" class="w-full p-3 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    </div>
                    <!-- Colonne 5 -->
                    <div class="row">
                    <div class="form-group">
                        <label for="tontine_select" class="text-sm font-semibold text-gray-700">Tontine</label>
                        <select name="tontine_id" id="tontine_select" onchange="updateCycleVie()" class="w-full p-3 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            <option value="">Sélectionnez une tontine</option>
                            @foreach($tontines as $tontine)
                                <option value="{{ $tontine->id }}" data-cycle-vie="{{ $tontine->cycle_vie }}">
                                    {{ $tontine->libelle }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="cycle_vie" class="text-sm font-semibold text-gray-700">Cycle de Vie</label>
                        <select name="cycle_vie" id="cycle_vie" class="w-full p-3 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            <option value="mensuel">Mensuel</option>
                            <option value="hebdomadaire">Hebdomadaire</option>
                            <option value="journalier">Journalier</option>
                        </select>
                    </div>
                    </div>
                    <!-- Colonne 6 -->
                    <div class="row">
                    <div class="form-group">
                        <label for="user_id" class="text-sm font-semibold text-gray-700">Utilisateur</label>
                        <select name="user_id" id="user_id" class="w-full p-3 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            <option value="">Sélectionnez un utilisateur</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    </div>
                    <!-- Boutons de soumission -->
                    <div class="form-group text-end mt-4 col-span-2">
                        <button type="submit" class="btn btn-success px-6 py-3 bg-green-600 text-white rounded-lg shadow-md hover:bg-green-700">
                            <i class="bi bi-check-circle"></i> Enregistrer
                        </button>
                        <a href="{{ route('admin.participants.index') }}" class="btn btn-secondary px-6 py-3 bg-gray-500 text-white rounded-lg shadow-md hover:bg-gray-600">
                            <i class="bi bi-arrow-left"></i> Annuler
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function updateCycleVie() {
        var tontineSelect = document.getElementById('tontine_select');
        var cycleVieSelect = document.getElementById('cycle_vie');
        var selectedOption = tontineSelect.options[tontineSelect.selectedIndex];
        var cycleVie = selectedOption.getAttribute('data-cycle-vie');

        if (cycleVie) {
            cycleVieSelect.innerHTML = '';
            var option = document.createElement('option');
            option.value = cycleVie.toLowerCase();
            option.textContent = cycleVie;
            cycleVieSelect.appendChild(option);
        }
    }
</script>

@endsection
