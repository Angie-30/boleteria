<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Localidad</title>
    @vite(['resources/css/localidad.css'])
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="overlay"></div>

    <div class="form-container">
        <h1>🏟️ Crear Localidad</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('localidades.store') }}" id="localidadForm">
            @csrf

            <label>Nombre de la localidad:</label>
            <input type="text" name="nombre" required placeholder="Ej: VIP, General, Palco">

            <button type="submit">Guardar</button>
        </form>
    </div>

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