<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>🎟️ Lista de Boletas</title>
    @vite(['resources/css/app.css'])
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="glow"></div>

    <div class="form-container">
        <h1>🎟️ Lista de Boletas</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('boletas.create') }}" class="btn btn-primary mb-3">Crear Nueva Boleta</a>

        <table class="table">
            <thead>
                <tr>
                    <th>Evento</th>
                    <th>Localidad</th>
                    <th>Precio</th>
                    <th>Cantidad Total</th>
                    <th>Disponibles</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($boletas as $boleta)
                    <tr>
                        <td>{{ $boleta->evento->nombre ?? 'N/A' }}</td>
                        <td>{{ $boleta->localidad->nombre ?? 'N/A' }}</td>
                        <td>${{ number_format($boleta->precio, 0, ',', '.') }}</td>
                        <td>{{ $boleta->cantidad_total }}</td>
                        <td>{{ $boleta->cantidad_disponible ?? 'N/A' }}</td>
                        <td>
                            <a href="{{ route('boletas.show', $boleta) }}" class="btn btn-info btn-sm">Detalles</a>
                            <a href="{{ route('boletas.edit', $boleta) }}" class="btn btn-warning btn-sm">Editar</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No hay boletas registradas aún.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Script de alertas -->
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

            // Éxito
            @if(session('success'))
                Swal.fire({
                    ...swalConfig,
                    icon: 'success',
                    title: 'Éxito',
                    text: '{{ session('success') }}'
                });
            @endif

            // Error general
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