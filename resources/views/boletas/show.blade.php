<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>🎟️ Detalles de Boleta</title>
    @vite(['resources/css/eventos_dispo.css'])
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="overlay"></div>

    <div class="form-container">
        <h1>🎟️ Detalles de la Boleta</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <p><strong>Evento:</strong> {{ $boleta->evento->nombre ?? 'N/A' }}</p>
        <p><strong>Localidad:</strong> {{ $boleta->localidad->nombre ?? 'N/A' }}</p>
        <p><strong>Precio:</strong> ${{ number_format($boleta->precio, 0, ',', '.') }}</p>
        <p><strong>Cantidad total:</strong> {{ $boleta->cantidad_total }}</p>
        <p><strong>Disponibles:</strong> {{ $boleta->cantidad_disponible ?? 'N/A' }}</p>

        <div class="row">
            <div class="col">
                <a href="{{ route('boletas.edit', $boleta) }}" class="btn btn-primary">Editar</a>
            </div>
            <div class="col">
                <a href="{{ route('boletas.index') }}" class="btn btn-secondary">Volver</a>
            </div>
        </div>
    </div>

    <!-- Script de alertas SweetAlert2 -->
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

            // Mensaje de éxito
            @if(session('success'))
                Swal.fire({
                    ...swalConfig,
                    icon: 'success',
                    title: 'Éxito',
                    text: '{{ session('success') }}'
                });
            @endif

            // Mensaje de error general
            @if(session('error'))
                Swal.fire({
                    ...swalConfig,
                    icon: 'error',
                    title: 'Error',
                    text: '{{ session('error') }}'
                });
            @endif

            // Errores de validación
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