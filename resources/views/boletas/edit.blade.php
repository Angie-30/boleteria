<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>🎟️ Crear Boleta</title>
    @vite(['resources/css/eventos_dispo.css'])
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="overlay"></div>

    <div class="form-container">
        <h1>🎟️ Crear Boleta</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('boletas.store') }}" method="POST" id="boletaForm">
            @csrf

            <label>Evento:</label>
            <select name="evento_id" required>
                <option value="" disabled selected>Seleccione un evento</option>
                @foreach ($eventos as $evento)
                    <option value="{{ $evento->id }}">{{ $evento->nombre }}</option>
                @endforeach
            </select>

            <label>Localidad:</label>
            <select name="localidad_id" required>
                <option value="" disabled selected>Seleccione una localidad</option>
                @foreach ($localidades as $localidad)
                    <option value="{{ $localidad->id }}">{{ $localidad->nombre }}</option>
                @endforeach
            </select>

            <div class="row">
                <div class="col">
                    <label>Precio</label>
                    <input type="number" name="precio" placeholder="Ej: 120000" required>
                </div>
                <div class="col">
                    <label>Cantidad Total</label>
                    <input type="number" name="cantidad_total" placeholder="Ej: 500" required>
                </div>
            </div>

            <button type="submit">Guardar Boleta</button>
        </form>

        <div class="row">
            <div class="col">
                <a href="{{ route('boletas.index') }}" class="btn btn-secondary">Volver</a>
            </div>
        </div>
    </div>

    <!-- Script SweetAlert2 -->
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

            // Éxito al guardar
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