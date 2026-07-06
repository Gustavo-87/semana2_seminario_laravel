@extends('layouts.app')

@section('titulo', 'Crear Tarea')
@section('titulo_pagina', 'Crear Nueva Tarea')

@section('contenido')

    <div class="card shadow">
        <div class="card-body">
            <form method="POST" action="{{ route('tareas.store') }}">
                @csrf

                <div class="mb-3">
                    <label for="titulo" class="form-label">Título</label>
                    <input
                        type="text"
                        name="titulo"
                        id="titulo"
                        class="form-control @error('titulo') is-invalid @enderror"
                        value="{{ old('titulo') }}"
                        required
                    >

                    @error('titulo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <textarea
                        name="descripcion"
                        id="descripcion"
                        rows="4"
                        class="form-control @error('descripcion') is-invalid @enderror"
                    >{{ old('descripcion') }}</textarea>

                    @error('descripcion')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="fecha_limite" class="form-label">Fecha límite</label>
                    <input
                        type="date"
                        name="fecha_limite"
                        id="fecha_limite"
                        class="form-control @error('fecha_limite') is-invalid @enderror"
                        value="{{ old('fecha_limite') }}"
                    >

                    @error('fecha_limite')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="estado" class="form-label">Estado</label>
                    <select
                        name="estado"
                        id="estado"
                        class="form-select @error('estado') is-invalid @enderror"
                    >
                        <option value="pendiente" {{ old('estado') == 'pendiente' ? 'selected' : '' }}>
                            Pendiente
                        </option>
                        <option value="en_progreso" {{ old('estado') == 'en_progreso' ? 'selected' : '' }}>
                            En progreso
                        </option>
                        <option value="completada" {{ old('estado') == 'completada' ? 'selected' : '' }}>
                            Completada
                        </option>
                    </select>

                    @error('estado')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="category_id" class="form-label">Categoría</label>
                    <select
                        name="category_id"
                        id="category_id"
                        class="form-select @error('category_id') is-invalid @enderror"
                        required
                    >
                        <option value="">Seleccione una categoría</option>

                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}" {{ old('category_id') == $categoria->id ? 'selected' : '' }}>
                                {{ $categoria->name }}
                            </option>
                        @endforeach
                    </select>

                    @error('category_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">
                    Guardar tarea
                </button>

                <a href="{{ route('tareas.index') }}" class="btn btn-secondary">
                    Cancelar
                </a>
            </form>
        </div>
    </div>

@endsection