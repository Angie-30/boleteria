<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Evento</title>
    @vite(['resources/css/eventos_dispo.css'])
    <!-- Include SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="overlay"></div>

    <div class="form-container">
        <h1>✏️ Editar Evento</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('eventos.update', $evento) }}" method="POST" id="eventForm">
            @csrf
            @method('PUT')

            <label>Nombre</label>
            <input type="text" name="nombre" placeholder="Ej: Tour Karol G" value="{{ old('nombre', $evento->nombre) }}" required>

            <label>Descripción</label>
            <textarea name="descripcion" placeholder="Detalles del evento..." required>{{ old('descripcion', $evento->descripcion) }}</textarea>

            <label>Artista:</label>
            <select name="artista_id" required>
                <option value="" disabled {{ old('artista_id') ? '' : 'selected' }}>Seleccione un artista</option>
                @foreach ($artistas as $artista)
                    <option value="{{ $artista->id }}" {{ old('artista_id', $evento->artistas->first()->id ?? '') == $artista->id ? 'selected' : '' }}>
                        {{ $artista->nombre }}
                    </option>
                @endforeach
            </select>

            <div class="row">
                <div class="col">
                    <label>Fecha Inicio</label>
                    <input type="date" name="fecha_inicio" value="{{ old('fecha_inicio', $evento->fecha_inicio instanceof \Carbon\Carbon ? $evento->fecha_inicio->format('Y-m-d') : ($evento->fecha_inicio ? \Carbon\Carbon::parse($evento->fecha_inicio)->format('Y-m-d') : '')) }}" required>
                </div>
                <div class="col">
                    <label>Hora Inicio</label>
                    <input type="time" name="hora_inicio" value="{{ old('hora_inicio', $evento->fecha_inicio instanceof \Carbon\Carbon ? $evento->fecha_inicio->format('H:i') : ($evento->fecha_inicio ? \Carbon\Carbon::parse($evento->fecha_inicio)->format('H:i') : '')) }}" required>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label>Fecha Fin</label>
                    <input type="date" name="fecha_fin" value="{{ old('fecha_fin', $evento->fecha_fin instanceof \Carbon\Carbon ? $evento->fecha_fin->format('Y-m-d') : ($evento->fecha_fin ? \Carbon\Carbon::parse($evento->fecha_fin)->format('Y-m-d') : '')) }}" required>
                </div>
                <div class="col">
                    <label>Hora Fin</label>
                    <input type="time" name="hora_fin" value="{{ old('hora_fin', $evento->fecha_fin instanceof \Carbon\Carbon ? $evento->fecha_fin->format('H:i') : ($evento->fecha_fin ? \Carbon\Carbon::parse($evento->fecha_fin)->format('H:i') : '')) }}" required>
                </div>
            </div>

            <button type="submit">Actualizar Evento</button>
        </form>

        <div class="row">
            <div class="col">
                <a href="{{ route('eventos.show', $evento) }}" class="btn btn-secondary">Volver</a>
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