@extends('layouts.app')

@section('contenu')
<div class="container-fluid">
    <!-- En-tête -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Gestion des Tours - {{ $tontine->nom }}</h1>
        @can('create-tour', $tontine)
        <a href="{{ route('tours.create', $tontine) }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus-circle fa-sm text-white-50"></i> Nouveau Tour
        </a>
        @endcan
    </div>

    <!-- Choix de la vue -->
    <div class="mb-4">
        <button class="btn btn-sm btn-outline-secondary view-toggle active" data-view="table">
            <i class="fas fa-table"></i> Tableau
        </button>
        <button class="btn btn-sm btn-outline-secondary view-toggle" data-view="grid">
            <i class="fas fa-th-large"></i> Grille
        </button>
    </div>

    <!-- Version Tableau -->
    <div id="tableView" class="view-content">
        <div class="card shadow mb-4">
            <!-- ... (même en-tête de tableau que précédemment) ... -->
            <tbody>
                @forelse($tours as $tour)
                    @include('tours.partials._tour_item')
                @empty
                    <tr><td colspan="6">Aucun tour</td></tr>
                @endforelse
            </tbody>
            </table>
            </div>
        </div>
    </div>

    <!-- Version Grille -->
    <div id="gridView" class="view-content d-none">
        <div class="row">
            @forelse($tours as $tour)
                @include('tours.partials._tour_card')
            @empty
                <div class="col-12 text-center">Aucun tour créé</div>
            @endforelse
        </div>
    </div>
</div>

@section('scripts')
<script>
// Script de bascule entre les vues
document.querySelectorAll('.view-toggle').forEach(button => {
    button.addEventListener('click', () => {
        document.querySelectorAll('.view-content').forEach(view => {
            view.classList.add('d-none');
        });
        document.getElementById(button.dataset.view + 'View').classList.remove('d-none');
        document.querySelectorAll('.view-toggle').forEach(btn => btn.classList.remove('active'));
        button.classList.add('active');
    });
});
</script>
@endsection
@endsection
