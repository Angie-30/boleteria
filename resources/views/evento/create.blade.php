<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear evento</title>
    @vite(['resources/css/eventos_dispo.css'])
    <!-- Include SweetAlert2 cdn -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="overlay"></div>

    <div class="form-container">
        <h1>🎤 Crear Nuevo Evento</h1>

        <form action="{{ route('eventos.store') }}" method="POST" id="eventForm">
            @csrf

            <label>Nombre</label>
            <input type="text" name="nombre" placeholder="Ej: Tour Karol G" value="{{ old('nombre') }}" required>

            <label>Descripción</label>
            <textarea name="descripcion" placeholder="Detalles del evento..." required>{{ old('descripcion') }}</textarea>

            <label>Artista:</label>
            <select name="artista_id" required>
                <option value="" disabled selected>Seleccione un artista</option>
                @foreach ($artistas as $artista)
                    <option value="{{ $artista->id }}" {{ old('artista_id') == $artista->id ? 'selected' : '' }}>
                        {{ $artista->nombre }}
                    </option>
                @endforeach
            </select>

            <div class="row">
                <div class="col">
                    <label>Fecha Inicio</label>
                    <input type="date" name="fecha_inicio" value="{{ old('fecha_inicio') }}" required>
                </div>
                <div class="col">
                    <label>Hora Inicio</label>
                    <input type="time" name="hora_inicio" value="{{ old('hora_inicio') }}" required>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label>Fecha Fin</label>
                    <input type="date" name="fecha_fin" value="{{ old('fecha_fin') }}" required>
                </div>
                <div class="col">
                    <label>Hora Fin</label>
                    <input type="time" name="hora_fin" value="{{ old('hora_fin') }}" required>
                </div>
            </div>

            <button type="submit">Crear Evento</button>
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