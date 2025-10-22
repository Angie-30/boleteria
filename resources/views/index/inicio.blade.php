<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
</head>
<body>
    <body>
    <div class="overlay"></div>
    <div class="glow"></div>
    <div class="glow cyan"></div>

    <a href="{{ route('logout') }}" class="logout-btn">Cerrar sesión</a>

    <header>
        <h1>🎶 Panel de Boletería</h1>
        <p>Gestiona artistas, eventos y boletas desde un solo lugar</p>
    </header>

    <main class="menu">
        <div class="card">
            <h2>🎤 Registrar Artista</h2>
            <p>Agrega nuevos artistas a la base de datos con su género musical y ciudad.</p>
            <a href="{{ route('artistas.create') }}">Ir al formulario</a>
        </div>

        <div class="card">
            <h2>🎫 Crear Boleta</h2>
            <p>Configura boletas con precios, localidades y cantidad disponible.</p>
            <a href="{{ route('boletas.create') }}">Ir al formulario</a>
        </div>

        <div class="card">
            <h2>🎵 Crear Evento</h2>
            <p>Registra nuevos eventos, fechas y horarios de tus artistas favoritos.</p>
            <a href="{{ route('eventos.create') }}">Ir al formulario</a>
        </div>

        <div class="card">
            <h2>🌟 Ver Eventos Disponibles</h2>
            <p>Consulta los eventos activos y la disponibilidad de boletas.</p>
            <a href="{{ route('eventos.index') }}">Ver eventos</a>
        </div>
    </main>
</body>
</body>
</html>