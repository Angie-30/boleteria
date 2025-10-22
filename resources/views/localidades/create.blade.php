<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Localidad</title>
    @vite(['resources/css/localidad.css'])
</head>
<body>
    <div class="glow"></div>

    <header>
        <h2>🎟️ Boletería de Eventos</h2>
        <nav class="nav-links">
            <a href="{{ route('inicio') }}">Inicio</a>
            <a href="#">Artistas</a>
            <a href="#">Eventos</a>
            <a href="#">Boletas</a>
        </nav>
    </header>

    <div class="form-container">
        <h1>Crear Localidad</h1>

        <form method="POST" action="{{ route('localidades.store') }}">
            @csrf

            <label>Nombre de la localidad:</label>
            <input type="text" name="nombre" required placeholder="Ej: VIP, General, Palco">

            <button type="submit">Guardar</button>
        </form>
    </div>

    <footer>
        © 2025 Boletería de Eventos | Creado con 💜 
    </footer>
</body>
</html>
