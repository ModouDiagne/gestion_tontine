<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Logo + Lien Dashboard -->
    <a class="navbar-brand ml-3" href="{{ route('dashboard') }}">
        <img src="{{ asset('img/logo-tontine.png') }}" alt="Logo" height="40">
        <span class="h4 ml-2 text-primary d-none d-md-inline">Espace Admin</span>
    </a>

    <!-- Menu droit -->
    <ul class="navbar-nav ms-auto">

        <!-- Boutons Responsive -->
        <li class="nav-item d-sm-none">
            <button class="nav-link" id="sidebarToggle">
                <i class="fas fa-bars"></i>
            </button>
        </li>

        <!-- Création rapide -->
        <li class="nav-item dropdown mx-2">
            <a class="nav-link" href="{{ route('tontines.create') }}" title="Nouvelle Tontine">
                <i class="fas fa-hand-holding-water fa-lg text-success"></i>
                <span class="d-none d-lg-inline"> Nouvelle Tontine</span>
            </a>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link" href="{{ route('admin.participants.create') }}" title="Ajouter Participant">
                <i class="fas fa-user-plus fa-lg text-info ml-2"></i>
            </a>
        </li>

        <!-- Profil utilisateur -->
        @auth
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
               data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="d-flex align-items-center">
                    <span class="me-2 text-gray-600 small">
                        {{ auth()->user()->name }} <!-- Modification ici -->
                    </span>

                    <img class="img-profile rounded-circle"
                         src="{{ auth()->user()->avatar ? Storage::url(auth()->user()->avatar) : asset('img/default-user.png') }}"
                         width="40" alt="Photo de profil">
                </div>
            </a>

            <!-- Menu déroulant -->
            <div class="dropdown-menu dropdown-menu-end shadow animated--grow-in"
                 aria-labelledby="userDropdown">
                <a class="dropdown-item" href="{{ route('profile.edit') }}">
                    <i class="fas fa-user-cog fa-fw me-2 text-gray-400"></i>
                    Profil
                </a>
                <div class="dropdown-divider"></div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="dropdown-item">
                        <i class="fas fa-sign-out-alt fa-fw me-2 text-gray-400"></i>
                        Déconnexion
                    </button>
                </form>
            </div>
        </li>
        @endauth

    </ul>
</nav>
