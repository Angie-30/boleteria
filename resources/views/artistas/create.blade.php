<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Artista</title>
    @vite(['resources/css/registro_artis.css'])
</head>
<body>
    <div class="glow"></div>

    <div class="form-container">
        <h1>Registrar Artista</h1>
        <form method="POST" action="{{ route('artistas.store') }}">
            @csrf
            <label>Nombre:</label>
            <input type="text" name="nombre" placeholder="Ej: Karol G" required>

            <label>Género musical:</label>
            <input type="text" name="genero_musical" placeholder="Ej: Reggaetón" required>

            <label>Ciudad de origen:</label>
            <input type="text" name="ciudad_origen" placeholder="Ej: Medellín" required>

            <button type="submit">Registrar</button>
        </form>
    </div>
</body>
</html>
