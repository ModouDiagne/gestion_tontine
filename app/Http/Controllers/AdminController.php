<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard'); // Assurez-vous que la vue existe dans resources/views/admin/dashboard.blade.php
    }
}
