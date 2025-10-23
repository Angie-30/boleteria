<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Artistas</title>
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
        <h1>🎤 Lista de Artistas</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        @endif

        <!-- Botón crear nuevo artista -->
        <a href="{{ route('artistas.create') }}" class="submit-button" style="margin-bottom: 20px; display: inline-block;">
            ➕ Crear Nuevo Artista
        </a>

        <!-- Tabla de artistas -->
        <div class="table-wrapper">
            <table class="styled-table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Género Musical</th>
                        <th>Ciudad de Origen</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($artistas as $artista)
                        <tr>
                            <td>{{ $artista->nombre }}</td>
                            <td>{{ $artista->genero_musical }}</td>
                            <td>{{ $artista->ciudad_origen }}</td>
                            <td>
                                <a href="{{ route('artistas.show', $artista->id) }}" class="btn-action info">Detalles</a>
                                <a href="{{ route('artistas.edit', $artista->id) }}" class="btn-action warning">Editar</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" style="text-align:center;">No hay artistas creados aún.</td>
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