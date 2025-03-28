<?php

namespace App\Http\Controllers;

use App\Models\Cotisation;
use App\Models\Participant;
use App\Models\Tontine;
use Illuminate\Http\Request;

class CotisationController extends Controller
{
    // Affiche la liste des cotisations
    public function index()
    {
        $cotisations = Cotisation::with(['participant', 'tontine'])->get();
        return view('cotisations.index', compact('cotisations'));
    }

    // Affiche le formulaire pour ajouter une nouvelle cotisation
    public function create()
    {
        $participants = Participant::all();
        $tontines = Tontine::all();
        return view('cotisations.create', compact('participants', 'tontines'));
    }

    // Enregistre une nouvelle cotisation
    public function store(Request $request)
    {
        $request->validate([
            'participant_id' => 'required|exists:participants,id',
            'tontine_id' => 'required|exists:tontines,id',
            'montant' => 'required|numeric',
            'date_paiement' => 'required|date',
        ]);

        Cotisation::create($request->all());

        return redirect()->route('cotisations.index')->with('success', 'Cotisation ajoutée avec succès');
    }

    // Affiche les détails d'une cotisation
    public function show(Cotisation $cotisation)
    {
        return view('cotisations.show', compact('cotisation'));
    }

    // Affiche le formulaire pour modifier une cotisation
    public function edit(Cotisation $cotisation)
    {
        $participants = Participant::all();
        $tontines = Tontine::all();
        return view('cotisations.edit', compact('cotisation', 'participants', 'tontines'));
    }

    // Met à jour une cotisation existante
    public function update(Request $request, Cotisation $cotisation)
    {
        $request->validate([
            'participant_id' => 'required|exists:participants,id',
            'tontine_id' => 'required|exists:tontines,id',
            'montant' => 'required|numeric',
            'date_paiement' => 'required|date',
        ]);

        $cotisation->update($request->all());

        return redirect()->route('cotisations.index')->with('success', 'Cotisation mise à jour avec succès');
    }

    // Supprime une cotisation
    public function destroy(Cotisation $cotisation)
    {
        $cotisation->delete();
        return redirect()->route('cotisations.index')->with('success', 'Cotisation supprimée avec succès');
    }
}
