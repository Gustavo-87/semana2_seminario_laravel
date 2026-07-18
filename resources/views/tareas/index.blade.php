@extends('layouts.app')

@section('titulo', 'Listado de Tareas')
@section('titulo_pagina', 'Mis Tareas')

@section('contenido')

<div class="card shadow mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('tareas.index') }}" class="row g-3 align-items-end">
            <div class="col-md-3">
                <label for="buscar" class="form-label">Buscar por título</label>
                <input type="text"
                       name="buscar"
                       id="buscar"
                       class="form-control"
                       value="{{ request('buscar') }}"
                       placeholder="Ej: reunión, entrega">
            </div>

            <div class="col-md-2">
                <label for="estado" class="form-label">Estado</label>
                <select name="estado" id="estado" class="form-select">
                    <option value="">Todos</option>
                    <option value="pendiente" {{ request('estado') == 'pendiente' ? 'selected' : '' }}>
                        Pendiente
                    </option>
                    <option value="en_progreso" {{ request('estado') == 'en_progreso' ? 'selected' : '' }}>
                        En progreso
                    </option>
                    <option value="completada" {{ request('estado') == 'completada' ? 'selected' : '' }}>
                        Completada
                    </option>
                </select>
            </div>

            <div class="col-md-2">
                <label for="categoria" class="form-label">Categoría</label>
                <select name="categoria" id="categoria" class="form-select">
                    <option value="">Todas</option>

                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id }}"
                            {{ request('categoria') == $categoria->id ? 'selected' : '' }}>
                            {{ $categoria->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2">
                <label for="fecha_inicio" class="form-label">Desde</label>
                <input type="date"
                       name="fecha_inicio"
                       id="fecha_inicio"
                       class="form-control"
                       value="{{ request('fecha_inicio') }}">
            </div>

            <div class="col-md-2">
                <label for="fecha_fin" class="form-label">Hasta</label>
                <input type="date"
                       name="fecha_fin"
                       id="fecha_fin"
                       class="form-control"
                       value="{{ request('fecha_fin') }}">
            </div>

            <div class="col-md-1">
                <button type="submit" class="btn btn-primary w-100">
                    Filtrar
                </button>
            </div>

            <div class="col-12">
                <a href="{{ route('tareas.index') }}" class="btn btn-secondary btn-sm">
                    Limpiar filtros
                </a>
            </div>
        </form>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-4 mb-3">
        <div class="card shadow border-start border-primary border-4">
            <div class="card-body">
                <h6 class="text-primary">Total de tareas</h6>
                <h3>{{ $tareas->count() }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <div class="card shadow border-start border-success border-4">
            <div class="card-body">
                <h6 class="text-success">Completadas</h6>
                <h3>{{ $tareas->where('estado', 'completada')->count() }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <div class="card shadow border-start border-warning border-4">
            <div class="card-body">
                <h6 class="text-warning">Pendientes</h6>
                <h3>{{ $tareas->where('estado', '!=', 'completada')->count() }}</h3>
            </div>
        </div>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Listado de tareas</h5>

        @can('create', App\Models\Task::class)
            <a href="{{ route('tareas.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Nueva tarea
            </a>
        @endcan
    </div>

    <div class="card-body">
        <table class="table table-striped table-hover align-middle">
            <thead class="table-primary">
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Estado</th>
                    <th>Categoría</th>
                    <th>Usuario</th>
                    <th>Fecha límite</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($tareas as $tarea)
                    <tr>
                        <td>{{ $tarea->id }}</td>
                        <td>{{ $tarea->titulo }}</td>
                        <td>
                            @php
                                $color = $tarea->estado == 'completada'
                                    ? 'success'
                                    : ($tarea->estado == 'en_progreso' ? 'warning' : 'secondary');
                            @endphp

                            <span class="badge bg-{{ $color }}">
                                {{ $tarea->estado }}
                            </span>
                        </td>
                        <td>{{ $tarea->category?->name ?? 'Sin categoría' }}</td>
                        <td>{{ $tarea->user?->name ?? 'Sin usuario' }}</td>
                        <td>
                            {{ $tarea->fecha_limite
                                ? \Carbon\Carbon::parse($tarea->fecha_limite)->format('d/m/Y')
                                : 'No definida' }}
                        </td>
                        <td>
                            @can('update', $tarea)
                                <a href="{{ route('tareas.edit', $tarea) }}" class="btn btn-warning btn-sm">
                                    Editar
                                </a>
                            @endcan

                            @can('delete', $tarea)
                                <form action="{{ route('tareas.destroy', $tarea) }}"
                                      method="POST"
                                      class="d-inline">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger btn-sm">
                                        Eliminar
                                    </button>
                                </form>
                            @endcan
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">
                            No hay tareas registradas.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4 d-flex justify-content-center">
            {{ $tareas->links() }}
        </div>
    </div>
</div>

@endsection
