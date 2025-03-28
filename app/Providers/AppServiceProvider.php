<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use App\Models\Tontine;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View as IlluminateView;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Blade::component('textarea', \App\View\Components\Textarea::class);

        // Partage global à toutes les vues
        View::composer('*', function (IlluminateView $view) {
            DB::disableQueryLog();

            try {
                // 1. Tontines actives pour le menu déroulant
                $tontinesActives = Tontine::active()
                    ->select('id', 'libelle', 'created_at')
                    ->latest()
                    ->take(5)
                    ->get();

                // 2. Récupération sécurisée de la tontine courante
                $currentTontine = null;
                $sessionTontineId = session('currentTontine');

                if($sessionTontineId) {
                    $currentTontine = Tontine::withTrashed()
                        ->find($sessionTontineId);

                    // Nettoyage de session si la tontine n'existe plus
                    if(!$currentTontine) {
                        session()->forget('currentTontine');
                    }
                }

                // 3. Journalisation de débogage
                Log::debug('Tontine courante', [
                    'session_id' => $sessionTontineId,
                    'exists' => (bool)$currentTontine,
                    'deleted' => $currentTontine?->trashed()
                ]);

                $view->with([
                    'tontinesActives' => $tontinesActives,
                    'currentTontine' => $currentTontine
                ]);

            } catch (\Exception $e) {
                Log::error('Erreur dans AppServiceProvider', [
                    'error' => $e->getMessage()
                ]);
            }
        });
    }
}
