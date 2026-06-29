@extends('layouts.app')

@section('titulo', 'Dashboard')

@section('contenido')
    <h2 class="mb-2">Dashboard Rápido en Laravel</h2>
    <p>Esta vista usa datos enviados desde el controlador.</p>

    <div class="row mb-4">
        <div class="col-md-4 mb-3">
            <div class="card card-stats shadow-sm">
                <div class="card-body">
                    <h5 class="card-title text-primary">Total de usuarios</h5>
                    <h2>{{ $totalUsuarios }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card card-stats shadow-sm">
                <div class="card-body">
                    <h5 class="card-title text-success">Usuarios nuevos hoy</h5>
                    <h2>{{ $usuariosHoy }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card card-stats shadow-sm">
                <div class="card-body">
                    <h5 class="card-title text-warning">Usuarios del mes pasado</h5>
                    <h2>{{ $usuariosMesPasado }}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-header">
            <h5 class="mb-0">Usuarios registrados por día</h5>
        </div>

        <div class="card-body" style="height: 280px;">
            <canvas id="usuariosChart"></canvas>
        </div>
    </div>

    <h3 class="mb-3">Últimos usuarios registrados</h3>

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Correo electrónico</th>
                        <th>Fecha de registro</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($ultimosUsuarios as $usuario)
                        <tr>
                            <td>{{ $usuario->name }}</td>
                            <td>{{ $usuario->email }}</td>
                            <td>{{ $usuario->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('usuariosChart');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($fechas),
                datasets: [{
                    label: 'Usuarios registrados',
                    data: @json($totales),
                    backgroundColor: 'rgba(13, 110, 253, 0.6)',
                    borderColor: 'rgba(13, 110, 253, 1)',
                    borderWidth: 1,
                    maxBarThickness: 80
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });
    </script>
@endsection