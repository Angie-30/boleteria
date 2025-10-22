<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Eventos</title>
    @vite(['resources/css/eventos_dispo.css'])
    <!-- Include SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="overlay"></div>

    <div class="form-container">
        <h1>📋 Lista de Eventos</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('eventos.create') }}" class="btn btn-primary mb-3">Crear Nuevo Evento</a>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Artista</th>
                    <th>Fecha de Inicio</th>
                    <th>Hora de Inicio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($eventos as $evento)
                    <tr>
                        <td>{{ $evento->nombre }}</td>
                        <td>{{ $evento->artistas->first()->nombre ?? 'N/A' }}</td>
                        <td>
                            @if ($evento->fecha_inicio instanceof \Carbon\Carbon)
                                {{ $evento->fecha_inicio->format('d/m/Y') }}
                            @elseif ($evento->fecha_inicio)
                                {{ \Carbon\Carbon::parse($evento->fecha_inicio)->format('d/m/Y') }}
                            @else
                                N/A
                            @endif
                        </td>
                        <td>
                            @if ($evento->fecha_inicio instanceof \Carbon\Carbon)
                                {{ $evento->fecha_inicio->format('H:i') }}
                            @elseif ($evento->fecha_inicio)
                                {{ \Carbon\Carbon::parse($evento->fecha_inicio)->format('H:i') }}
                            @else
                                N/A
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('eventos.show', $evento) }}" class="btn btn-info btn-sm">Mostrar Detalles</a>
                            <a href="{{ route('eventos.edit', $evento) }}" class="btn btn-warning btn-sm">Editar</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No hay eventos creados aún.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Script para manejar alertas con SweetAlert2 -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Configuración común para SweetAlert2
            const swalConfig = {
                confirmButtonText: 'Aceptar',
                customClass: {
                    popup: 'swal2-custom-popup',
                    title: 'swal2-custom-title',
                    content: 'swal2-custom-content',
                    confirmButton: 'swal2-custom-button'
                }
            };

            // Mostrar mensaje de éxito
            @if(session('success'))
                Swal.fire({
                    ...swalConfig,
                    icon: 'success',
                    title: 'Éxito',
                    text: '{{ session('success') }}'
                });
            @endif

            // Mostrar mensaje de error general
            @if(session('error'))
                Swal.fire({
                    ...swalConfig,
                    icon: 'error',
                    title: 'Error',
                    text: '{{ session('error') }}'
                });
            @endif

            // Mostrar errores de validación del formulario
            @if($errors->any())
                let errorMessages = '';
                @foreach($errors->all() as $error)
                    errorMessages += '{{ $error }}<br>';
                @endforeach
                Swal.fire({
                    ...swalConfig,
                    icon: 'error',
                    title: 'Errores en el formulario',
                    html: errorMessages
                });
            @endif
        });
    </script>
</body>
</html>