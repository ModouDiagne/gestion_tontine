@extends('layouts.app')

@section('contenu')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tableau de Bord</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Bienvenue</h6>
                </div>
                <div class="card-body">
                    <p>Vous êtes connecté en tant que
                       <strong>{{ \Illuminate\Support\Facades\Auth::user()->email }}</strong>
                    </p>

                    <!-- Affichage de la tontine active -->
                    @isset($currentTontine)
                        <div class="alert alert-info">
                            <strong>Tontine active:</strong> {{ $currentTontine->libelle }}
                        </div>
                    @else
                        <div class="alert alert-warning">
                            Aucune tontine active n'a été trouvée.
                        </div>
                    @endisset

                    <!-- Partie avec l'application layout -->
                    <x-app-layout>
                        <x-slot name="header">
                            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                                {{ __('Dashboard') }}
                            </h2>
                        </x-slot>

                        <div class="py-12">
                            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                                    <div class="p-6 text-gray-900 dark:text-gray-100">
                                        {{ __("You're logged in!") }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </x-app-layout>

                </div>
            </div>
        </div>
    </div>
@endsection
