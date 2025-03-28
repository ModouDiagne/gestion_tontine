<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Tontine; // Importez le modèle Tontine

class DashboardController extends Controller
{
    public function index()
    {
        // Récupérer le nombre total d'utilisateurs
        $userCount = User::count();

        // Récupérer la première tontine active
        $currentTontine = Tontine::where('active', true)->first(); // Vous pouvez ajuster selon votre logique

        // Passer les données à la vue
        return view('dashboard', compact('userCount', 'currentTontine'));
    }
}

