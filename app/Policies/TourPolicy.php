<?php

namespace App\Policies;

use App\Models\Tour;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Tontine;

class TourPolicy
{
    use HandlesAuthorization;

    /**
     * Vérifie si l'utilisateur peut voir la liste des tours.
     */
    public function viewAny(User $user)
    {
        return true; // On peut restreindre selon le besoin
    }

    /**
     * Vérifie si l'utilisateur peut créer un tour pour une tontine.
     */
    public function create(User $user, Tontine $tontine)
    {
        if (!$tontine instanceof Tontine) {
            abort(404, "Tontine introuvable");
        }

        return $user->id === $tontine->user_id;
    }

    /**
     * Vérifie si l'utilisateur peut modifier un tour.
     */
    public function update(User $user, Tour $tour)
    {
        return $user->id === $tour->tontine->user_id && !$tour->termine;
    }

    /**
     * Vérifie si l'utilisateur peut supprimer un tour.
     */
    public function delete(User $user, Tour $tour)
    {
        return $user->id === $tour->tontine->user_id
            && !$tour->termine
            && $tour->created_at->diffInDays(now()) < 2;
    }

    /**
     * Vérifie si l'utilisateur peut marquer un tour comme terminé.
     */
    public function terminer(User $user, Tour $tour)
    {
        return $user->id === $tour->tontine->user_id
            && !$tour->termine
            && $tour->cotisations()->unpaid()->doesntExist();
    }
}
