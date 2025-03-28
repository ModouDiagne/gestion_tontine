<?php

namespace App\Http\Controllers;

use App\Models\Tirage;
use App\Models\Tour;
use App\Models\Participant;
use App\Models\Tontine;
use Illuminate\Http\Request;

class TirageController extends Controller
{
    // Affiche la liste des tirages
    public function index()
    {
        $tirages = Tirage::with(['tontine', 'tour', 'beneficiaire'])->get();
        return view('tirages.index', compact('tirages'));
    }

    // Affiche le formulaire pour ajouter un nouveau tirage
    public function create()
    {
        $tontines = Tontine::all();
        $tours = Tour::all();
        $participants = Participant::all();
        return view('tirages.create', compact('tontines', 'tours', 'participants'));
    }

    // Enregistre un nouveau tirage
    public function store(Request $request)
    {
        $request->validate([
            'tontine_id' => 'required|exists:tontines,id',
            'tour_id' => 'required|exists:tours,id',
            'beneficiaire_id' => 'required|exists:participants,id',
            'date_tirage' => 'required|date',
        ]);

        Tirage::create($request->all());

        return redirect()->route('tirages.index')->with('success', 'Tirage effectué avec succès');
    }

    // Affiche les détails d'un tirage
    public function show(Tirage $tirage)
    {
        return view('tirages.show', compact('tirage'));
    }

    // Affiche le formulaire pour modifier un tirage
    public function edit(Tirage $tirage)
    {
        $tontines = Tontine::all();
        $tours = Tour::all();
        $participants = Participant::all();
        return view('tirages.edit', compact('tirage', 'tontines', 'tours', 'participants'));
    }

    // Met à jour un tirage existant
    public function update(Request $request, Tirage $tirage)
    {
        $request->validate([
            'tontine_id' => 'required|exists:tontines,id',
            'tour_id' => 'required|exists:tours,id',
            'beneficiaire_id' => 'required|exists:participants,id',
            'date_tirage' => 'required|date',
        ]);

        $tirage->update($request->all());

        return redirect()->route('tirages.index')->with('success', 'Tirage mis à jour avec succès');
    }

    // Supprime un tirage
    public function destroy(Tirage $tirage)
    {
        $tirage->delete();
        return redirect()->route('tirages.index')->with('success', 'Tirage supprimé avec succès');
    }
}

