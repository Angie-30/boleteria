<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Eventos</title>
    <!-- Usa el mismo estilo del formulario -->
    @vite(['resources/css/registro_artis.css'])
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <!-- Fondo con brillo -->
    <div class="glow"></div>

    <!-- Contenedor principal -->
    <div class="form-container">
        <h1>📋 Lista de Eventos</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Botón crear nuevo evento -->
        <a href="{{ route('eventos.create') }}" class="submit-button" style="margin-bottom: 20px; display: inline-block;">
            ➕ Crear Nuevo Evento
        </a>

        <!-- Tabla de eventos -->
        <div class="table-wrapper">
            <table class="styled-table">
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
                                <a href="{{ route('eventos.show', $evento) }}" class="btn-action info">Detalles</a>
                                <a href="{{ route('eventos.edit', $evento) }}" class="btn-action warning">Editar</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align:center;">No hay eventos creados aún.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- SweetAlert2 mensajes -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const swalConfig = {
                confirmButtonText: 'Aceptar',
                customClass: {
                    popup: 'swal2-custom-popup',
                    title: 'swal2-custom-title',
                    content: 'swal2-custom-content',
                    confirmButton: 'swal2-custom-button'
                }
            };

            @if(session('success'))
                Swal.fire({
                    ...swalConfig,
                    icon: 'success',
                    title: 'Éxito',
                    text: '{{ session('success') }}'
                });
            @endif

            @if(session('error'))
                Swal.fire({
                    ...swalConfig,
                    icon: 'error',
                    title: 'Error',
                    text: '{{ session('error') }}'
                });
            @endif
        });
    </script>
</body>
</html>