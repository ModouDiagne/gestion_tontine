@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">Modifier Participant</h1>

    <div class="bg-white rounded-lg shadow-md p-6">
        <form method="POST" action="{{ route('admin.participants.update', $participant) }}">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div class="space-y-2">
                    <label class="block text-sm font-medium">Nom</label>
                    <input type="text" name="nom" value="{{ old('nom', $participant->nom) }}"
                           class="w-full p-2 border rounded @error('nom') border-red-500 @enderror">
                </div>

                <div class="space-y-2">
                    <label class="block text-sm font-medium">Prénoms</label>
                    <input type="text" name="prenoms" value="{{ old('prenoms', $participant->prenoms) }}"
                           class="w-full p-2 border rounded @error('prenoms') border-red-500 @enderror">
                </div>

                <div class="space-y-2">
                    <label class="block text-sm font-medium">Sexe</label>
                    <select name="sexe" class="w-full p-2 border rounded">
                        <option value="M" {{ $participant->sexe == 'M' ? 'selected' : '' }}>Masculin</option>
                        <option value="F" {{ $participant->sexe == 'F' ? 'selected' : '' }}>Féminin</option>
                    </select>
                </div>

                <div class="space-y-2">
                    <label class="block text-sm font-medium">Téléphone</label>
                    <input type="tel" name="telephone" value="{{ old('telephone', $participant->telephone) }}"
                           class="w-full p-2 border rounded @error('telephone') border-red-500 @enderror">
                </div>

                <div class="space-y-2">
                    <label class="block text-sm font-medium">Email</label>
                    <input type="email" name="email" value="{{ old('email', $participant->email) }}"
                           class="w-full p-2 border rounded @error('email') border-red-500 @enderror">
                </div>

                <div class="space-y-2">
                    <label class="block text-sm font-medium">Nouveau mot de passe</label>
                    <input type="password" name="password"
                           class="w-full p-2 border rounded @error('password') border-red-500 @enderror">
                </div>

                <div class="space-y-2">
                    <label class="block text-sm font-medium">Confirmer mot de passe</label>
                    <input type="password" name="password_confirmation"
                           class="w-full p-2 border rounded">
                </div>

                <div class="space-y-2">
                    <label class="block text-sm font-medium">Montant/Personne</label>
                    <input type="number" name="amount" value="{{ old('amount', $participant->montant_personne) }}"
                           class="w-full p-2 border rounded @error('amount') border-red-500 @enderror">
                </div>

                <div class="space-y-2">
                    <label class="block text-sm font-medium">Cycle vie</label>
                    <input type="text" name="cycle" value="{{ old('cycle', $participant->cycle_vie) }}"
                           class="w-full p-2 border rounded @error('cycle') border-red-500 @enderror">
                </div>
            </div>

            <div class="flex gap-4">
                <a href="{{ route('admin.participants.index') }}"
                   class="px-4 py-2 bg-gray-200 rounded">Annuler</a>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Mettre à jour</button>
            </div>
        </form>
    </div>
</div>
@endsection
