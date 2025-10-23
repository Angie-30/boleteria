<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalles de {{ $evento->nombre }}</title>
    @vite(['resources/css/registro_artis.css'])
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <!-- Fondo brillante -->
    <div class="glow"></div>

    <div class="form-container">
        <h1>🎭 Detalles del Evento</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Detalles visuales del evento -->
        <div class="form-group">
            <label><strong>Nombre del evento:</strong></label>
            <p>{{ $evento->nombre }}</p>
        </div>

        <div class="form-group">
            <label><strong>Descripción:</strong></label>
            <p>{{ $evento->descripcion }}</p>
        </div>

        <div class="form-group">
            <label><strong>Fecha de inicio:</strong></label>
            <p>
                @if ($evento->fecha_inicio instanceof \Carbon\Carbon)
                    {{ $evento->fecha_inicio->format('d/m/Y H:i') }}
                @elseif ($evento->fecha_inicio)
                    {{ \Carbon\Carbon::parse($evento->fecha_inicio)->format('d/m/Y H:i') }}
                @else
                    N/A
                @endif
            </p>
        </div>

        <div class="form-group">
            <label><strong>Fecha de fin:</strong></label>
            <p>
                @if ($evento->fecha_fin instanceof \Carbon\Carbon)
                    {{ $evento->fecha_fin->format('d/m/Y H:i') }}
                @elseif ($evento->fecha_fin)
                    {{ \Carbon\Carbon::parse($evento->fecha_fin)->format('d/m/Y H:i') }}
                @else
                    N/A
                @endif
            </p>
        </div>

        <div class="form-group">
            <label><strong>Artista:</strong></label>
            <p>{{ $evento->artistas->first()->nombre ?? 'N/A' }}</p>
        </div>

        <div class="button-group">
            <a href="{{ route('eventos.edit', $evento) }}" class="submit-button">Editar</a>
            <a href="{{ route('eventos.index') }}" class="submit-button" style="background: #555;">Volver</a>
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