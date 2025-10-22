<!DOCTYPE html>
<html>
<head>
    <<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear evento</title>
    @vite(['resources/css/eventos_dispo.css'])
</head>
<body>
    <div class="overlay"></div>

    <div class="form-container">
        <h1>🎤 Crear Nuevo Evento</h1>

        {{-- Mostrar mensajes --}}
        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        <form action="#" method="POST">
            @csrf

            <label>Nombre</label>
            <input type="text" name="nombre" placeholder="Ej: Tour Karol G" value="{{ old('nombre') }}" required>

            <label>Descripción</label>
            <textarea name="descripcion" placeholder="Detalles del evento..." required>{{ old('descripcion') }}</textarea>

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
</body>
</html>