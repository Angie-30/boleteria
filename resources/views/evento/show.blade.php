<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalles de {{ $evento->nombre }}</title>
    @vite(['resources/css/eventos_dispo.css'])
    <!-- Include SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="overlay"></div>

    <div class="form-container">
        <h1>🎭 Detalles de {{ $evento->nombre }}</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <p><strong>Descripción:</strong> {{ $evento->descripcion }}</p>
        <p><strong>Fecha de inicio:</strong>
            @if ($evento->fecha_inicio instanceof \Carbon\Carbon)
                {{ $evento->fecha_inicio->format('d/m/Y H:i') }}
            @elseif ($evento->fecha_inicio)
                {{ \Carbon\Carbon::parse($evento->fecha_inicio)->format('d/m/Y H:i') }}
            @else
                N/A
            @endif
        </p>
        <p><strong>Fecha de fin:</strong>
            @if ($evento->fecha_fin instanceof \Carbon\Carbon)
                {{ $evento->fecha_fin->format('d/m/Y H:i') }}
            @elseif ($evento->fecha_fin)
                {{ \Carbon\Carbon::parse($evento->fecha_fin)->format('d/m/Y H:i') }}
            @else
                N/A
            @endif
        </p>
        <p><strong>Artista:</strong> {{ $evento->artistas->first()->nombre ?? 'N/A' }}</p>

        <div class="row">
            <div class="col">
                <a href="{{ route('eventos.edit', $evento) }}" class="btn btn-primary">Editar</a>
            </div>
            <div class="col">
                <a href="{{ route('eventos.index') }}" class="btn btn-secondary">Volver</a>
            </div>
        </div>

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