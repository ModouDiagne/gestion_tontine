<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Gestion Tontines - Inscription</title>

    <!-- Custom fonts -->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles -->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
</head>

<body class="bg-gradient-primary">
    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-register-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Créez un compte !</h1>
                                    </div>

                                    <form method="POST" action="{{ route('register') }}" class="user">
                                        @csrf

                                        <!-- Name -->
                                        <div class="form-group">
                                            <x-text-input
                                                id="name"
                                                class="form-control form-control-user"
                                                type="text"
                                                name="name"
                                                :value="old('name')"
                                                placeholder="Nom complet"
                                                required
                                                autofocus
                                            />
                                            <x-input-error :messages="$errors->get('name')" class="mt-2 text-danger" />
                                        </div>

                                        <!-- Email Address -->
                                        <div class="form-group">
                                            <x-text-input
                                                id="email"
                                                class="form-control form-control-user"
                                                type="email"
                                                name="email"
                                                :value="old('email')"
                                                placeholder="Adresse email"
                                                required
                                            />
                                            <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />
                                        </div>

                                        <!-- Password -->
                                        <div class="form-group">
                                            <x-text-input
                                                id="password"
                                                class="form-control form-control-user"
                                                type="password"
                                                name="password"
                                                placeholder="Mot de passe"
                                                required
                                            />
                                            <x-input-error :messages="$errors->get('password')" class="mt-2 text-danger" />
                                        </div>

                                        <!-- Confirm Password -->
                                        <div class="form-group">
                                            <x-text-input
                                                id="password_confirmation"
                                                class="form-control form-control-user"
                                                type="password"
                                                name="password_confirmation"
                                                placeholder="Confirmez le mot de passe"
                                                required
                                            />
                                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-danger" />
                                        </div>

                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            S'inscrire
                                        </button>
                                    </form>

                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="{{ route('password.request') }}">
                                            Mot de passe oublié?
                                        </a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="{{ route('login') }}">
                                            Déjà inscrit? Connectez-vous!
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
</body>
</html>
