<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use App\Models\Tontine;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;
class TontineController extends Controller
{
    /**
     * Affiche la liste des tontines
     */
    // Dans TontineController::index
    public function index() {
        $tontines = Tontine::paginate(10); // 10 éléments par page
        return view('tontines.index', compact('tontines'));
    }

    /**
     * Affiche le formulaire de création
     */
    public function create()
    {
        return view('tontines.create');
    }

    /**
     * Enregistre une nouvelle tontine
     */
    public function store(Request $request)
    {
        try {
            $validated = $this->validateTontine($request);
            $validated['montant_total'] = $validated['montant_base'] * $validated['nbreParticipant'];
            $validated['user_id'] = auth()->id();

            Tontine::create($validated);

            return redirect()->route('tontines.index')
                ->with('success', 'Tontine créée avec succès');

        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Erreur lors de la création: '.$e->getMessage()]);
        }
    }

    /**
     * Affiche les détails d'une tontine avec relations chargées
     */
    public function show(Tontine $tontine)
{
    // Stockage de l'OBJET complet en session (pas seulement l'ID)
    session()->put('currentTontine', $tontine);

    // Chargement optimisé
    $tontine->load(['participants.cotisations', 'tours.beneficiaire']);

    return view('tontines.show', compact('tontine'));
}

    public function select(Tontine $tontine)
    {
        abort_unless($tontine->exists, 404, "Tontine introuvable");
        session(['current_tontine_id' => $tontine->id]);
        return redirect()->route('tontines.show', $tontine);
    }

    /**
     * Affiche le formulaire d'édition
     */
    public function edit(Tontine $tontine)
    {
        return view('tontines.edit', compact('tontine'));
    }

    /**
     * Met à jour la tontine
     */
    public function update(Request $request, Tontine $tontine)
    {
        $validated = $this->validateTontine($request, $tontine);
        $validated['montant_total'] = $validated['montant_base'] * $validated['nbreParticipant'];

        $tontine->update($validated);

        return redirect()->route('tontines.index')
            ->with('success', 'Tontine mise à jour avec succès');
    }

    /**
     * Supprime la tontine
     */
    public function destroy(Tontine $tontine)
    {
        $tontine->delete();
        return redirect()->route('tontines.index')
            ->with('success', 'Tontine supprimée avec succès');
    }

    /**
     * Validation centralisée des données
     */
    private function validateTontine(Request $request, $tontine = null)
    {
        $rules = [
            'libelle' => 'required|string|max:255',
            'nbreParticipant' => 'required|integer|min:1',
            'montant_base' => 'required|integer|min:500',
            'frequence' => ['required', Rule::in(['JOURNALIERE', 'HEBDOMADAIRE', 'MENSUEL'])],
            'dateDebut' => 'required|date',
            'dateFin' => 'required|date|after:dateDebut',
            'description' => 'required|string',
            'active' => 'sometimes|boolean'
        ];

        return $request->validate($rules);
    }
}
