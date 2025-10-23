<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inicio de Sesión</title>
    @vite(['resources/css/index.css'])
</head>
<body>
    <div class="overlay"></div>
    <div class="glow"></div>
    <div class="glow cyan"></div>

    <a href="{{ route('logout') }}" class="logout-btn">Cerrar sesión</a>

    <header>
        <h1>🎶 Panel de Boletería</h1>
        <p>Inicia sesión para gestionar artistas, eventos y boletas</p>
    </header>

    <main class="menu">
        <!-- Formulario de Login -->
        <div class="card">
            <h2>Iniciar sesión</h2>
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div>
                    <label for="email">Correo Electrónico:</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required>
                </div>

                <div>
                    <label for="password">Contraseña:</label>
                    <input type="password" name="password" id="password" required>
                </div>

                @if ($errors->any())
                    <div class="error-messages">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <button type="submit">Iniciar sesión</button>
            </form>
        </div>
    </main>
</body>
</html>
