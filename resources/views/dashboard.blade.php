<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard Task Manager
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="container">
            <div class="mb-4">
                <h3 class="h4">Resumen general</h3>
                <p class="text-muted">
                    Desde este panel puedes acceder al módulo de tareas, crear nuevas tareas y consultar los posts obtenidos desde la API externa.
                </p>
            </div>

            <div class="row mb-4">
                <div class="col-md-3 mb-3">
                    <div class="card shadow border-start border-primary border-4">
                        <div class="card-body">
                            <h6 class="text-primary">Total de tareas</h6>
                            <h3>{{ $totalTareas }}</h3>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 mb-3">
                    <div class="card shadow border-start border-warning border-4">
                        <div class="card-body">
                            <h6 class="text-warning">Pendientes</h6>
                            <h3>{{ $tareasPendientes }}</h3>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 mb-3">
                    <div class="card shadow border-start border-info border-4">
                        <div class="card-body">
                            <h6 class="text-info">En progreso</h6>
                            <h3>{{ $tareasEnProgreso }}</h3>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 mb-3">
                    <div class="card shadow border-start border-success border-4">
                        <div class="card-body">
                            <h6 class="text-success">Completadas</h6>
                            <h3>{{ $tareasCompletadas }}</h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Accesos rápidos</h5>
                </div>

                <div class="card-body">
                    <a href="{{ route('tareas.index') }}" class="btn btn-primary me-2 mb-2">
                        Ver tareas
                    </a>

                    @if (auth()->user()->rol === 'admin')
                        <a href="{{ route('tareas.create') }}" class="btn btn-success me-2 mb-2">
                            Crear tarea
                        </a>
                    @endif

                    <a href="{{ route('posts.index') }}" class="btn btn-outline-secondary mb-2">
                        Ver posts externos
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
