<?php
namespace App\Http\Controllers; // Ajoutez cette ligne

use App\Http\Controllers\Controller;
use App\Models\Participant;
use App\Models\Tontine;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Notifications\ParticipantNotification;
use Illuminate\Support\Facades\Notification;

class ParticipantController extends Controller
{
    public function index()
    {
        $participants = Participant::latest()->paginate(4);
        $tontine = Tontine::first();

        return view('admin.participants.index', [
            'participants' => $participants,
            'montantParPersonne' => $tontine->montant_par_personne ?? 0,
            'cycleVie' => $tontine->cycle_vie ?? 'Non défini',
            'datesMaj' => Participant::pluck('updated_at'),
            'notifications' => true,
            'modifications' => false
        ]);
    }
// ParticipantController.php
public function edit(Participant $participant)
{
    // Récupérer la tontine active
    $tontine = Tontine::where('active', true)->first();

    // Gérer le cas où aucune tontine n'existe
    if (!$tontine) {
        return redirect()->route('admin.tontines.index')
            ->withErrors('Aucune tontine active trouvée !');
    }

    return view('admin.participants.edit', [
        'participant' => $participant,
        'montantParPersonne' => $tontine->montant_par_personne,
        'cycleVie' => $tontine->cycle_vie
    ]);
}

public function update(Request $request, Participant $participant)
{
    // 1. Validation des données
    $validated = $request->validate([
        'nom' => 'required|max:50',
        'prenoms' => 'required|max:100',
        'sexe' => 'required|in:M,F',
        'telephone' => [
            'required',
            'regex:/^7[0-9]{8}$/',
            Rule::unique('participants')->ignore($participant->id)
        ],
        'email' => [
            'required',
            'email',
            Rule::unique('participants')->ignore($participant->id)
        ],
        'password' => 'nullable|min:8|confirmed',
        'amount' => 'required|numeric|min:0',
        'cycle' => 'required|string'
    ]);

    // 2. Préparation des données de mise à jour
    $updateData = [
        'nom' => $validated['nom'],
        'prenoms' => $validated['prenoms'],
        'sexe' => $validated['sexe'],
        'telephone' => $validated['telephone'],
        'email' => $validated['email'],
        'montant_personne' => $validated['amount'],
        'cycle_vie' => $validated['cycle']
    ];

    // 3. Mise à jour du mot de passe si fourni
    if (!empty($validated['password'])) {
        $updateData['password'] = Hash::make($validated['password']);
    }

    // 4. Exécution de la mise à jour
    $participant->update($updateData);

    // 5. Redirection avec message de succès
    return redirect()->route('admin.participants.index')
         ->with('success', 'Participant modifié avec succès!');
}

public function create()
{
    $tontines = Tontine::all(); // Récupérer toutes les tontines
    $users = User::all(); // Récupérer tous les utilisateurs
    $selectedTontine = Tontine::latest()->first(); // Dernière tontine créée

    return view('admin.participants.create', compact('tontines', 'users', 'selectedTontine'));
}


public function store(Request $request)
{
    // Valider les données
    $request->validate([
        'nom' => 'required|string|max:255',
        'prenoms' => 'required|string|max:255',
        'sexe' => 'required|in:M,F',
        'telephone' => 'required|string|max:20',
        'email' => 'required|email|unique:participants,email',
        'password' => 'required|string|min:8|confirmed',
        'montant_personne' => 'required|numeric',
        'tontine_id' => 'required|exists:tontines,id',
        'cycle_vie' => 'required|in:mensuel,hebdomadaire,journalier',
        'user_id' => 'required|exists:users,id',
    ]);

    // Créer le participant
    $participant = new Participant();
    $participant->nom = $request->nom;
    $participant->prenoms = $request->prenoms;
    $participant->sexe = $request->sexe;
    $participant->telephone = $request->telephone;
    $participant->email = $request->email;
    $participant->password = bcrypt($request->password);
    $participant->montant_personne = $request->montant_personne;
    $participant->tontine_id = $request->tontine_id;
    $participant->cycle_vie = $request->cycle_vie;
    $participant->user_id = $request->user_id;

    // Enregistrer dans la base de données
    $participant->save();

    // Rediriger vers la liste des participants avec un message de succès
    return redirect()->route('admin.participants.index')->with('success', 'Participant ajouté avec succès.');
}
    public function destroy(Participant $participant)
    {
        $participant->delete();
        return redirect()->route('admin.participants.index')
            ->with('success', 'Participant supprimé avec succès!');
    }

    public function notify($id)
{
    $participant = Participant::findOrFail($id);

    // Vérifier si l'email est défini
    if (!$participant->email) {
        return back()->with('error', 'Ce participant n\'a pas d\'email enregistré.');
    }

    // Envoyer la notification
    $participant->notify(new ParticipantNotification("Votre tontine a été mise à jour !"));

    return back()->with('success', 'Notification envoyée avec succès.');
}
}
