<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Artista</title>
    @vite(['resources/css/app.css'])
</head>
<body>
    <h1>Registrar Artista</h1>
    <form method="POST" action="{{ route('artistas.store') }}">
        @csrf
        <label>Nombre:</label>
        <input type="text" name="nombre" required><br>
        <label>Género musical:</label>
        <input type="text" name="genero_musical" required><br>
        <label>Ciudad de origen:</label>
        <input type="text" name="ciudad_origen" required><br>
        <button type="submit">Registrar</button>
    </form>
</body>
</html>
