<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Panel de Boletería</title>
    @vite(['resources/css/index.css'])
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Arial, sans-serif;
        }
        body {
            background: linear-gradient(135deg, #2a2a72, #009ffd);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 30px;
            color: #fff;
        }
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.4);
            z-index: -1;
        }
        .login-btn {
            position: absolute;
            top: 20px;
            right: 20px;
            padding: 12px 24px;
            background: #009ffd;
            color: #fff;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 500;
            transition: background 0.3s ease, transform 0.2s;
        }
        .login-btn:hover {
            background: #0077cc;
            transform: translateY(-2px);
        }
        header {
            text-align: center;
            margin-bottom: 40px;
        }
        header h1 {
            font-size: 2.8rem;
            font-weight: 700;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }
        header p {
            font-size: 1.2rem;
            opacity: 0.9;
        }
        .search-container {
            width: 100%;
            max-width: 700px;
            margin-bottom: 40px;
        }
        .search-container input {
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.95);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            font-size: 1rem;
            transition: box-shadow 0.3s;
        }
        .search-container input:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(0, 159, 253, 0.3);
        }
        .search-results {
            background: rgba(255, 255, 255, 0.95);
            padding: 20px;
            border-radius: 8px;
            margin-top: 10px;
            max-width: 700px;
            width: 100%;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            display: none;
        }
        .search-results.active {
            display: block;
        }
        .search-results p {
            color: #333;
            margin: 5px 0;
            font-size: 0.95rem;
        }
        .menu {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 25px;
            width: 100%;
            max-width: 1200px;
        }
        .card {
            background: rgba(255, 255, 255, 0.95);
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.2);
        }
        .card h2 {
            font-size: 1.8rem;
            color: #2a2a72;
            margin-bottom: 10px;
            font-weight: 600;
        }
        .card p {
            color: #4a4a4a;
            margin-bottom: 20px;
            font-size: 1rem;
        }
        .card a {
            display: inline-block;
            padding: 12px 24px;
            background: #009ffd;
            color: #fff;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 500;
            transition: background 0.3s ease, transform 0.2s;
        }
        .card a:hover {
            background: #0077cc;
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
    <div class="overlay"></div>

    <a href="{{ route('login') }}" class="login-btn">Iniciar sesión</a>

    <header>
        <h1>🎶 Panel de Boletería</h1>
        <p>Gestiona artistas, eventos y boletas desde un solo lugar</p>
    </header>

    <div class="search-container">
        <input type="text" id="searchInput" placeholder="Buscar eventos, artistas o boletas...">
        <div class="search-results" id="searchResults"></div>
    </div>

    <main class="menu">
        <div class="card">
            <h2>🎤 Registrar Artista</h2>
            <p>Agrega nuevos artistas a la base de datos con su género musical y ciudad.</p>
            <a href="{{ route('artistas.index') }}">Ver artistas</a>
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

    <script>
        document.getElementById('searchInput').addEventListener('input', function(e) {
            const query = e.target.value;
            if (query.length > 2) {
                fetch(`/search?q=${encodeURIComponent(query)}`)
                    .then(response => response.json())
                    .then(data => {
                        const resultsDiv = document.getElementById('searchResults');
                        resultsDiv.innerHTML = '';
                        if (data.results.length > 0) {
                            resultsDiv.classList.add('active');
                            data.results.forEach(result => {
                                const p = document.createElement('p');
                                p.textContent = result.name;
                                resultsDiv.appendChild(p);
                            });
                        } else {
                            resultsDiv.classList.remove('active');
                        }
                    })
                    .catch(error => console.error('Error:', error));
            } else {
                document.getElementById('searchResults').classList.remove('active');
            }
        });
    </script>
</body>
</html>