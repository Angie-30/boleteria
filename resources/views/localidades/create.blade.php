<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Localidad</title>
    @vite(['resources/css/app.css'])
</head>
<body>
    <h1>Crear Localidad</h1>
    <form method="POST" action="{{ route('localidades.store') }}">
        @csrf
        <label>Nombre de la localidad:</label>
        <input type="text" name="nombre" required><br>
        <button type="submit">Guardar</button>
    </form>
</body>
</html>
