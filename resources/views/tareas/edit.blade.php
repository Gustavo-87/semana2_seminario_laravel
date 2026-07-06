@extends('layouts.app')

@section('titulo', 'Editar tarea')

@section('contenido')
    <h2>Editar tarea</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Revisa los siguientes errores:</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('tareas.update', $tarea) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="titulo" class="form-label">Título</label>
            <input
                type="text"
                name="titulo"
                id="titulo"
                class="form-control"
                value="{{ old('titulo', $tarea->titulo) }}"
                required
            >
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea
                name="descripcion"
                id="descripcion"
                class="form-control"
            >{{ old('descripcion', $tarea->descripcion) }}</textarea>
        </div>

        <div class="mb-3">
    <label for="fecha_limite" class="form-label">Fecha límite</label>
    <input
        type="date"
        name="fecha_limite"
        id="fecha_limite"
        class="form-control"
        value="{{ old('fecha_limite', $tarea->fecha_limite ? \Carbon\Carbon::parse($tarea->fecha_limite)->format('Y-m-d') : '') }}"
    >
        </div>

        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <select name="estado" id="estado" class="form-control" required>
                <option value="pendiente" @selected(old('estado', $tarea->estado) == 'pendiente')>
                    Pendiente
                </option>
                <option value="en_progreso" @selected(old('estado', $tarea->estado) == 'en_progreso')>
                    En progreso
                </option>
                <option value="completada" @selected(old('estado', $tarea->estado) == 'completada')>
                    Completada
                </option>
            </select>
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label">Categoría</label>
            <select name="category_id" id="category_id" class="form-control" required>
                <option value="">Seleccione una categoría</option>

                @foreach ($categorias as $categoria)
                    <option
                        value="{{ $categoria->id }}"
                        @selected(old('category_id', $tarea->category_id) == $categoria->id)
                    >
                        {{ $categoria->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar tarea</button>
        <a href="{{ route('tareas.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection