@extends('layouts.app')

@section('titulo', 'Dashboard')

@section('contenido')
    <h2>Dashboard Rápido en Laravel</h2>
    <p>Esta vista usa datos enviados desde el controlador.</p>

    <div class="card shadow-sm mt-4">
    <div class="card-header">
        <h5 class="mb-0">Usuarios registrados por día</h5>
    </div>

    <div class="card-body">
        <canvas id="usuariosChart"></canvas>
    </div>
</div>

        <div class="col-md-6 mb-3">
            <div class="card card-stats shadow-sm">
                <div class="card-body">
                    <h5 class="card-title text-success">Usuarios nuevos hoy</h5>
                    <h2>{{ $usuariosHoy }}</h2>
                </div>
            </div>
        </div>
    </div>

    <h3 class="mb-3">Últimos usuarios registrados</h3>

    <div class="card shadow-sm">
        <div class="card-body">

            <table class="table table-striped table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Correo electrónico</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($ultimosUsuarios as $usuario)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $usuario->name }}</td>
                        <td>{{ $usuario->email }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
@endsection
