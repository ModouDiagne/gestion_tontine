@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">Modifier Tontine</h1>

    <div class="bg-white rounded-lg shadow-md p-6">
        <form method="POST" action="{{ route('tontines.update', $tontine) }}">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div class="space-y-2">
                    <label class="block text-sm font-medium">Libellé</label>
                    <input type="text" name="libelle" value="{{ old('libelle', $tontine->libelle) }}"
                           class="w-full p-2 border rounded @error('libelle') border-red-500 @enderror">
                </div>

                <div class="space-y-2">
                    <label class="block text-sm font-medium">Nombre de participants</label>
                    <input type="number" name="nbreParticipant"
                           value="{{ old('nbreParticipant', $tontine->nbreParticipant) }}"
                           class="w-full p-2 border rounded @error('nbreParticipant') border-red-500 @enderror">
                </div>

                <div class="space-y-2">
                    <label class="block text-sm font-medium">Montant de base</label>
                    <input type="number" name="montant_base"
                           value="{{ old('montant_base', $tontine->montant_base) }}"
                           class="w-full p-2 border rounded @error('montant_base') border-red-500 @enderror">
                </div>

                <div class="space-y-2">
                    <label class="block text-sm font-medium">Fréquence</label>
                    <select name="frequence" class="w-full p-2 border rounded">
                        <option value="JOURNALIERE" {{ $tontine->frequence == 'JOURNALIERE' ? 'selected' : '' }}>Journalière</option>
                        <option value="HEBDOMADAIRE" {{ $tontine->frequence == 'HEBDOMADAIRE' ? 'selected' : '' }}>Hebdomadaire</option>
                        <option value="MENSUEL" {{ $tontine->frequence == 'MENSUEL' ? 'selected' : '' }}>Mensuel</option>
                    </select>
                </div>

                <div class="space-y-2">
                    <label class="block text-sm font-medium">Date de début</label>
                    <input type="date" name="dateDebut"
                           value="{{ old('dateDebut', $tontine->dateDebut->format('Y-m-d')) }}"
                           class="w-full p-2 border rounded @error('dateDebut') border-red-500 @enderror">
                </div>

                <div class="space-y-2">
                    <label class="block text-sm font-medium">Date de fin</label>
                    <input type="date" name="dateFin"
                           value="{{ old('dateFin', $tontine->dateFin->format('Y-m-d')) }}"
                           class="w-full p-2 border rounded @error('dateFin') border-red-500 @enderror">
                </div>

                <div class="col-span-2 space-y-2">
                    <label class="block text-sm font-medium">Description</label>
                    <textarea name="description"
                              class="w-full p-2 border rounded @error('description') border-red-500 @enderror"
                              rows="3">{{ old('description', $tontine->description) }}</textarea>
                </div>
            </div>

            <div class="flex gap-4">
                <a href="{{ route('tontines.index') }}"
                   class="px-4 py-2 bg-gray-200 rounded">Annuler</a>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Mettre à jour</button>
            </div>
        </form>
    </div>
</div>
@endsection
