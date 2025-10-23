<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Artista</title>
    <link rel="stylesheet" href="{{ asset('css/registro_artis.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

    <div class="overlay"></div>

    <div class="form-container">
        <h1>✏️ Editar Artista</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('artistas.update', $artista) }}" method="POST" id="artistForm">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input 
                    type="text" 
                    id="nombre" 
                    name="nombre" 
                    placeholder="Ej: Karol G"
                    value="{{ old('nombre', $artista->nombre) }}"
                    required>
                @error('nombre')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="genero_musical">Género musical:</label>
                <input 
                    type="text" 
                    id="genero_musical" 
                    name="genero_musical" 
                    placeholder="Ej: Reggaetón"
                    value="{{ old('genero_musical', $artista->genero_musical) }}"
                    required>
                @error('genero_musical')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="ciudad_origen">Ciudad de origen:</label>
                <input 
                    type="text" 
                    id="ciudad_origen" 
                    name="ciudad_origen" 
                    placeholder="Ej: Medellín"
                    value="{{ old('ciudad_origen', $artista->ciudad_origen) }}"
                    required>
                @error('ciudad_origen')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit">Actualizar Artista</button>
        </form>

        <div class="row">
            <div class="col">
                <a href="{{ route('artistas.index') }}" class="btn btn-secondary">Volver</a>
            </div>
        </div>
    </div>

    <!-- Script para manejar alertas con SweetAlert2 -->
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