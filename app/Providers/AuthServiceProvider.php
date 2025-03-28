<?php

namespace App\Providers;

use App\Models\Tour;
use App\Models\Tontine;
use App\Models\User; // Ajoute l'importation de la classe User
use App\Policies\TourPolicy;
use App\Policies\TontinePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Tour::class => TourPolicy::class,
    ];

    /**
     * Register any application authentication/authorization services.
     */
    public function boot()
    {
        $this->registerPolicies();

        // Définir les autorisations pour les tours
        Gate::define('manage-tour', function (User $user, Tour $tour) {
            return $user->id === $tour->tontine->user_id;
        });

        Gate::define('create-tour', function (User $user, Tontine $tontine) {
            return $user->id === $tontine->user_id &&
                   $tontine->participants()->count() >= $tontine->nbreParticipant;
        });

        Gate::define('terminate-tour', function (User $user, Tour $tour) {
            return $user->id === $tour->tontine->user_id &&
                   $tour->cotisations()->unpaid()->doesntExist();
        });
    }
}
