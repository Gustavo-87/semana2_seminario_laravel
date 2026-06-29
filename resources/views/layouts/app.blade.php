<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo', 'Dashboard') - Seminario Laravel</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body {
            background-color: #f8f9fc;
        }

        .sidebar {
            min-height: 100vh;
            background-color: #4e73df;
            color: white;
        }

        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.85);
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            color: white;
            font-weight: bold;
        }

        .card-stats {
            border-left: 4px solid #4e73df;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">

            <!-- Barra lateral -->
            <nav class="col-md-2 d-none d-md-block sidebar p-0">
                <div class="position-sticky pt-3">
                    <h5 class="text-center py-3 border-bottom border-light">
                        Seminario
                    </h5>

                    <ul class="nav flex-column px-2">
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ url('/dashboard') }}">
                                <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-users me-2"></i> Usuarios
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-cog me-2"></i> Configuración
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Contenido principal -->
            <main class="col-md-10 ms-sm-auto px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">@yield('titulo_pagina', 'Panel de Control')</h1>

                    <div class="btn-toolbar mb-2 mb-md-0">
                        <span class="badge bg-primary">
                            Bienvenido, {{ 'Estudiante' }}
                        </span>
                    </div>
                </div>

                @yield('contenido')
            </main>

        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')
</body>
</html>
