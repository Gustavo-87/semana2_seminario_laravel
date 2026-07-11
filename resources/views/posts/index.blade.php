@extends('layouts.app')

@section('titulo', 'Posts externos')
@section('titulo_pagina', 'Posts obtenidos desde API externa')

@section('contenido')
    <div class="card shadow">
        <div class="card-body">
            @if ($error)
                <div class="alert alert-danger">
                    {{ $error }}
                </div>
            @else
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Título</th>
                            <th>Cuerpo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post)
                            <tr>
                                <td>{{ $post['id'] }}</td>
                                <td>{{ $post['title'] }}</td>
                                <td>{{ $post['body'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection
