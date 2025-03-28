<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\TontineController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\CotisationController;
use App\Http\Controllers\TirageController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Password
    Route::put('/password', [PasswordController::class, 'update'])->name('password.update');

    // Delete Account
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    // Routes principales des tontines
    Route::resource('tontines', \App\Http\Controllers\TontineController::class);

    // Routes imbriquées pour les tours
    Route::resource('tontines.tours', \App\Http\Controllers\TourController::class)->except(['show']);

    // Route de sélection (avec le slug comme clé)
    Route::post('/tontines/{tontine:slug}/select', [TontineController::class, 'select'])
         ->name('tontines.select');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('participants', ParticipantController::class);
});
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    // ... autres routes admin

    Route::get('/parametres', [SettingsController::class, 'index'])
         ->name('settings'); // Nom de route: admin.settings
});




Route::middleware(['auth', 'verified'])->group(function () {
    // Route standard pour les opérations CRUD sauf show
    Route::resource('tontines', TontineController::class)->except(['show']);
    Route::get('tontines/{tontine:slug}/tours/create', [TourController::class, 'create'])->name('tours.create');
    Route::get('/tontines/{slug}/tours/historique', [TourController::class, 'historique'])->name('tours.historique');
    Route::post('/tontines/{slug}/tours', [TourController::class, 'store'])->name('tours.store');

    Route::get('/tontines/{tontine:slug}/tours', [TourController::class, 'index'])->name('tours.index');
    Route::post('/tontines/{tontine:slug}/tours', [TourController::class, 'store'])->name('tours.store');
    Route::get('tontines/{tontine}/tours/create', [TourController::class, 'create'])->name('tours.create');



});


Route::get('/participants/{id}/notify', function($id) {
    return back()->with('success', 'La notification sera bientôt disponible.');
})->name('admin.participants.notify');

// Routes sécurisées avec authentification
Route::middleware(['auth'])->group(function () {

    // Routes pour les cotisations
    Route::resource('cotisations', CotisationController::class);

    // Routes imbriquées pour les tirages
    Route::prefix('cotisations/{cotisation}')->group(function () {
        Route::resource('tirages', TirageController::class)->names([
            'index' => 'tirages.index',
            'create' => 'tirages.create',
            'store' => 'tirages.store',
            'edit' => 'tirages.edit',
            'update' => 'tirages.update',
            'destroy' => 'tirages.destroy',
        ]);
    });

});

require __DIR__.'/auth.php';
