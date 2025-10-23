<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear usuario</title>
    @vite(['resources/css/eventos_dispo.css'])
    <!-- Include SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="overlay"></div>

    <div class="form-container">
        <h1>👤 Crear Nuevo Usuario</h1>

        <form action="{{ route('usuarios.store') }}" method="POST" id="userForm">
            @csrf

            <label>Nombre</label>
            <input type="text" name="nombre" placeholder="Ej: Juan Pérez" value="{{ old('nombre') }}" required>

            <label>Correo</label>
            <input type="email" name="correo" placeholder="Ej: juan@ejemplo.com" value="{{ old('correo') }}" required>

            <label>Contraseña</label>
            <input type="password" name="contrasena" placeholder="Ingresa una contraseña" required>

            <label>Tipo de usuario</label>
            <select name="tipo" required>
                <option value="" disabled selected>Seleccione un tipo</option>
                <option value="ADMIN" {{ old('tipo') == 'ADMIN' ? 'selected' : '' }}>Administrador</option>
                <option value="COMPRADOR" {{ old('tipo') == 'COMPRADOR' ? 'selected' : '' }}>Comprador</option>
            </select>

            <button type="submit">Crear Usuario</button>
        </form>
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