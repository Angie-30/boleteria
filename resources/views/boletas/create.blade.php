<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Boleta</title>
    @vite(['resources/css/app.css'])
</head>
<body>
    <h1>Crear Boleta</h1>
    <form method="POST" action="{{ route('boletas.store') }}">
        @csrf
        <label>Evento:</label>
        <select name="evento_id">
            @foreach ($eventos as $evento)
                <option value="{{ $evento->id }}">{{ $evento->nombre }}</option>
            @endforeach
        </select><br>

        <label>Localidad:</label>
        <select name="localidad_id">
            @foreach ($localidades as $localidad)
                <option value="{{ $localidad->id }}">{{ $localidad->nombre }}</option>
            @endforeach
        </select><br>

        <label>Precio:</label>
        <input type="number" name="precio" required><br>
        <label>Cantidad:</label>
        <input type="number" name="cantidad_total" required><br>

        <button type="submit">Guardar</button>
    </form>
</body>
</html>
