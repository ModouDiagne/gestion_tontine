<!DOCTYPE html>
<html lang="fr">

<head>
    <!-- En-tête du layout -->
<script src="//unpkg.com/alpinejs" defer></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
<!-- Bootstrap 5 CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Icons Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<!-- SB Admin 2 CSS (version compatible Bootstrap 5) -->
<link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body id="page-top" class="sidebar-toggled">
    <div id="wrapper">

        <!-- Sidebar -->
        @include('layouts.sidebar') <!-- Vérifier la casse du nom de fichier -->
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                @include('layouts.navbar') <!-- Inclure la navbar externe -->
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid mt-4">
                    @yield('content') <!-- Unifier le nom de section -->
                </div>

            </div>

            <!-- Footer -->
            @include('layouts.footer')

        </div>
    </div>

 <!-- Bootstrap 5 JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- SB Admin 2 JS (version compatible Bootstrap 5) -->
<script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

</body>
</html>
