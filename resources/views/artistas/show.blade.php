<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalles del Artista</title>
    @vite(['resources/css/registro_artis.css'])
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <!-- Fondo brillante -->
    <div class="glow"></div>

    <div class="form-container">
        <h1>🎤 Detalles del Artista</h1>

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

        <!-- Detalles visuales del artista -->
        <div class="form-group">
            <label><strong>Nombre:</strong></label>
            <p>{{ $artista->nombre }}</p>
        </div>

        <div class="form-group">
            <label><strong>Género Musical:</strong></label>
            <p>{{ $artista->genero_musical }}</p>
        </div>

        <div class="form-group">
            <label><strong>Ciudad de Origen:</strong></label>
            <p>{{ $artista->ciudad_origen }}</p>
        </div>

        <div class="form-group">
            <label><strong>Eventos:</strong></label>
            <p>
                @if ($artista->eventos->isNotEmpty())
                    <ul>
                        @foreach ($artista->eventos as $evento)
                            <li>{{ $evento->nombre }} ({{ $evento->fecha_inicio ? $evento->fecha_inicio->format('d/m/Y H:i') : 'N/A' }})</li>
                        @endforeach
                    </ul>
                @else
                    No hay eventos asociados.
                @endif
            </p>
        </div>

        <div class="button-group">
            <a href="{{ route('artistas.edit', $artista->id) }}" class="submit-button">Editar</a>
            <a href="{{ route('artistas.index') }}" class="submit-button" style="background: #555;">Volver</a>
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