<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Artista</title>
    <!-- Include Vite CSS -->
    @vite(['resources/css/registro_artis.css'])
    <!-- Include SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <!-- Background glow effect -->
    <div class="glow"></div>

    <!-- Form container -->
    <div class="form-container">
        <h1>Registrar Artista</h1>
        
        <!-- Artist registration form -->
        <form method="POST" action="{{ route('artistas.index') }}">
            @csrf

            <!-- Nombre field -->
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input 
                    type="text" 
                    id="nombre" 
                    name="nombre" 
                    placeholder="Ej: Karol G" 
                    required 
                    aria-describedby="nombre-help"
                >
                @error('nombre')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <!-- Género musical field -->
            <div class="form-group">
                <label for="genero_musical">Género musical:</label>
                <input 
                    type="text" 
                    id="genero_musical" 
                    name="genero_musical" 
                    placeholder="Ej: Reggaetón" 
                    required 
                    aria-describedby="genero-help"
                >
                @error('genero_musical')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <!-- Ciudad de origen field -->
            <div class="form-group">
                <label for="ciudad_origen">Ciudad de origen:</label>
                <input 
                    type="text" 
                    id="ciudad_origen" 
                    name="ciudad_origen" 
                    placeholder="Ej: Medellín" 
                    required 
                    aria-describedby="ciudad-help"
                >
                @error('ciudad_origen')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <!-- Submit button -->
            <button type="submit" class="submit-button">Registrar</button>
            <a href="{{ route('index.inicio') }}"><button type="submit" class="submit-button">Volver</button></a>
        </form>
    </div>

    <!-- SweetAlert2 for success message -->
    @if(session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    icon: 'success',
                    title: 'Éxito',
                    text: '{{ session('success') }}',
                    confirmButtonText: 'Aceptar',
                    customClass: {
                        popup: 'swal2-custom-popup',
                        title: 'swal2-custom-title',
                        content: 'swal2-custom-content',
                        confirmButton: 'swal2-custom-button'
                    }
                });
            });
        </script>
    @endif

    <!-- SweetAlert2 for error message -->
    @if(session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: '{{ session('error') }}',
                    confirmButtonText: 'Aceptar',
                    customClass: {
                        popup: 'swal2-custom-popup',
                        title: 'swal2-custom-title',
                        content: 'swal2-custom-content',
                        confirmButton: 'swal2-custom-button'
                    }
                });
            });
        </script>
    @endif
</body>
</html>