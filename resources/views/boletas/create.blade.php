<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Boleta</title>
    @vite(['resources/css/app.css'])
</head>
<body>
    <div class="glow"></div>

    <div class="form-container">
        <h1>Crear Boleta</h1>
        <form method="POST" action="{{ route('boletas.store') }}">
            @csrf

            <label>Evento:</label>
            <select name="evento_id" required>
                @foreach ($eventos as $evento)
                    <option value="{{ $evento->id }}">{{ $evento->nombre }}</option>
                @endforeach
            </select>

            <label>Localidad:</label>
            <select name="localidad_id" required>
                @foreach ($localidades as $localidad)
                    <option value="{{ $localidad->id }}">{{ $localidad->nombre }}</option>
                @endforeach
            </select>

            <label>Precio:</label>
            <input type="number" name="precio" placeholder="Ej: 120000" required>

            <label>Cantidad:</label>
            <input type="number" name="cantidad_total" placeholder="Ej: 500" required>

            <button type="submit">Guardar</button>
        </form>
    </div>
</body>
</html>
