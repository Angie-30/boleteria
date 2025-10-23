<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Localidades</title>
    @vite(['resources/css/localidad.css'])
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="overlay"></div>

    <div class="form-container">
        <h1>📍 Lista de Localidades</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('localidades.create') }}" class="btn btn-primary mb-3">Crear Nueva Localidad</a>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($localidades as $localidad)
                    <tr>
                        <td>{{ $localidad->nombre }}</td>
                        <td>
                            <a href="{{ route('localidades.show', $localidad) }}" class="btn btn-info btn-sm">Ver Detalles</a>
                            <a href="{{ route('localidades.edit', $localidad) }}" class="btn btn-warning btn-sm">Editar</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="text-center">No hay localidades creadas aún.</td>
