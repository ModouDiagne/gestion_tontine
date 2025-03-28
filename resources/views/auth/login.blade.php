<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Gestion Tontines - Connexion</title>

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
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Connectez-vous !</h1>
                                        <!-- Session Status -->
                                        <x-auth-session-status class="mb-4" :status="session('status')" />
                                    </div>

                                    <form method="POST" action="{{ route('login') }}" class="user">
                                        @csrf

                                        <!-- Email Address -->
                                        <div class="form-group">
                                            <x-text-input
                                                id="email"
                                                class="form-control form-control-user"
                                                type="email"
                                                name="email"
                                                :value="old('email')"
                                                placeholder="Entrez votre adresse email"
                                                required
                                                autofocus
                                            />
                                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                        </div>

                                        <!-- Password -->
                                        <div class="form-group">
                                            <x-text-input
                                                id="password"
                                                class="form-control form-control-user"
                                                type="password"
                                                name="password"
                                                placeholder="Votre mot de passe"
                                                required
                                                autocomplete="current-password"
                                            />
                                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                        </div>

                                        <!-- Remember Me -->
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input
                                                    id="remember_me"
                                                    type="checkbox"
                                                    class="custom-control-input"
                                                    name="remember"
                                                >
                                                <label class="custom-control-label" for="remember_me">
                                                    {{ __('Remember me') }}
                                                </label>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            {{ __('Log in') }}
                                        </button>
                                    </form>

                                    <hr>

                                    <div class="text-center">
                                        @if (\Illuminate\Support\Facades\Route::has('password.request'))
                                            <a class="small" href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        @endif
                                    </div>

                                    <div class="text-center">
                                        <a class="small" href="{{ route('register') }}">
                                            Créer un compte
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
