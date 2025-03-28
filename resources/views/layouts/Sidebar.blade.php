<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Logo -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
        <div class="sidebar-brand-icon">
            <i class="fas fa-hand-holding-water"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Tontines Sénégal</div>
    </a>

    <!-- Séparateur -->
    <hr class="sidebar-divider my-0">

    <!-- Tableau de bord -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Tableau de bord</span>
        </a>
    </li>

    <!-- Séparateur -->
    <hr class="sidebar-divider">

    <!-- Gestion Principale -->
    <div class="sidebar-heading">
        Gestion Principale
    </div>

    <!-- Participants -->
    <li class="nav-item">
        <a class="nav-link collapsed"
           href="#"
           data-bs-toggle="collapse"
           data-bs-target="#participantsMenu">
            <i class="fas fa-users-cog"></i>
            <span>Gestion Participants</span>
            <i class="fas fa-angle-right float-right"></i> <!-- Icône ">" -->
        </a>
        <div id="participantsMenu" class="collapse" data-bs-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Actions participants :</h6>
                <a class="collapse-item" href="{{ route('admin.participants.create') }}">
                    <i class="fas fa-user-plus mr-2 text-success"></i>Ajouter Participant
                </a>
                <a class="collapse-item" href="{{ route('admin.participants.index') }}">
                    <i class="fas fa-list-ol mr-2 text-primary"></i>Lister Participants
                </a>
            </div>
        </div>
    </li>


    <!-- Tontines -->
<li class="nav-item">
    <a class="nav-link collapsed"
       href="#"
       data-bs-toggle="collapse"
       data-bs-target="#collapseTontines">
        <i class="fas fa-coins"></i>
        <span>Tontines</span>
        <i class="fas fa-angle-right float-end"></i> <!-- Icône ">" -->
    </a>
    <div id="collapseTontines"
         class="collapse"
         data-bs-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Actions :</h6>
            <a class="collapse-item" href="{{ route('tontines.create') }}">
                <i class="fas fa-plus-circle mr-2 text-success"></i>Créer
            </a>
            <a class="collapse-item" href="{{ route('tontines.index') }}">
                <i class="fas fa-stream mr-2 text-primary"></i>Liste
            </a>
        </div>
    </div>
</li>


<!-- Section Tours -->
<li class="nav-item">
    <a class="nav-link collapsed"
       href="#"
       data-bs-toggle="collapse"
       data-bs-target="#collapseTours">
        <i class="fas fa-calendar-alt"></i>
        <span>Gestion des Tours</span>
        <i class="fas fa-angle-right float-end"></i>
    </a>

    <div class="collapse" id="collapseTours">
        <ul class="nav flex-column ms-3">
            @isset($tontine)
                <li class="nav-item">
                    <a class="nav-link"
                       href="{{ route('tours.create', $tontine->slug) }}">
                        <i class="fas fa-plus-circle me-1"></i>
                        Planifier un Tour
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"
                       href="{{ route('tours.historique', $tontine->slug) }}">
                        <i class="fas fa-history me-1"></i>
                        Historique des Tours
                    </a>
                </li>
            @else
                <li class="nav-item">
                    <span class="nav-link text-muted">
                        <i class="fas fa-info-circle me-1"></i>
                        Aucune tontine sélectionnée
                    </span>
                </li>
            @endisset
        </ul>
    </div>
</li>


    <!-- Séparateur -->
    <hr class="sidebar-divider">

    <!-- Administration -->
    <div class="sidebar-heading">
        Administration
    </div>

    <!-- Paramètres -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.settings') }}">
            <i class="fas fa-cogs"></i>
            <span>Paramètres</span>
        </a>
    </li>

    <!-- Profils -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('profile.edit') }}">
            <i class="fas fa-id-card"></i>
            <span>Profils Utilisateurs</span>
        </a>
    </li>

    <!-- Séparateur -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Déconnexion -->
    <div class="sidebar-card bg-transparent">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="btn btn-danger btn-block" type="submit">
                <i class="fas fa-sign-out-alt fa-fw"></i> Déconnexion
            </button>
        </form>
    </div>

</ul>
