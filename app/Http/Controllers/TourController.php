<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use App\Models\Tontine;
use Illuminate\Http\Request;
use App\Http\Requests\TourRequest;
use Illuminate\Support\Facades\DB;

class TourController extends Controller
{
    /**
     * Affiche la liste des tours pour une tontine.
     */
    public function index(Tontine $tontine)
    {
        $tours = $tontine->tours()
                        ->with(['beneficiaire', 'cotisations'])
                        ->orderBy('date_tour', 'desc')
                        ->paginate(10);

        return view('tours.index', compact('tontine', 'tours'));
    }
    public function create(Tontine $tontine)
{
    try {
        // Vérifier si la tontine existe
        if (!$tontine) {
            throw new \Exception("Tontine non trouvée.");
        }

        // Vérifier si la méthode 'eligibleParticipants' existe dans le modèle Tontine
        if (!method_exists($tontine, 'eligibleParticipants')) {
            throw new \Exception("Méthode eligibleParticipants() inexistante dans le modèle Tontine.");
        }

        // Récupérer les participants éligibles
        $participants = $tontine->eligibleParticipants();

        // Vérifier si la liste des participants est vide
        if ($participants->isEmpty()) {
            throw new \Exception("Aucun participant éligible trouvé.");
        }

        // Vérifier si la vue 'tours.create' existe
        if (!view()->exists('tours.create')) {
            throw new \Exception("Vue 'tours.create' introuvable.");
        }

        // Retourner la vue avec les données nécessaires
        return view('tours.create', compact('tontine', 'participants'));

    } catch (\Exception $e) {
        // En cas d'erreur, rediriger vers la page des tontines avec un message d'erreur
        return redirect()->route('tontines.index')
                         ->with('error', 'Erreur : ' . $e->getMessage());
    }
}



    /**
     * Affiche le formulaire de création d'un tour.
     */
    public function store(Request $request, Tontine $tontine)
    {
        // Validation des données du formulaire
        $validated = $request->validate([
            'date_tour' => 'required|date',
            'montant' => 'required|numeric',
            'beneficiaire_id' => 'required|exists:participants,id',
        ]);

        // Création du tour dans la base de données
        $tour = Tour::create([
            'tontine_id' => $tontine->id,
            'beneficiaire_id' => $request->beneficiaire_id,
            'date_debut' => $request->date_tour, // On suppose que 'date_tour' est la date de début
            'date_fin' => now(), // Assurez-vous que vous avez une logique pour déterminer la fin (ici on met la date actuelle)
            'montant' => $request->montant,
            'termine' => false, // Exemple: par défaut, le tour n'est pas terminé
            'status' => 'en cours', // Exemple: le statut par défaut peut être 'en cours'
        ]);

        // Redirection avec un message de succès
        return redirect()->route('tontines.show', $tontine->slug)
                         ->with('success', 'Tour créé avec succès!');
    }


    public function historique($tontineSlug)
    {
        // Trouver la tontine par son slug
        $tontine = Tontine::where('slug', $tontineSlug)->first();

        if (!$tontine) {
            return redirect()->route('tontines.index')->with('error', 'Tontine introuvable.');
        }

        // Récupérer tous les tours associés à cette tontine
        $tours = $tontine->tours;

        return view('tours.historique', compact('tontine', 'tours'));
    }

    /**
     * Vérifie si le tour appartient bien à la tontine.
     */
    private function verifyTourConsistency(Tontine $tontine, Tour $tour): void
    {
        if ($tour->tontine_id !== $tontine->id) {
            abort(404, 'Tour ne correspond pas à la tontine');
        }
    }
}
