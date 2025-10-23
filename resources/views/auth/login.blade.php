<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inicio de Sesión</title>
    @vite(['resources/css/index.css'])
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white min-h-screen flex flex-col items-center justify-center relative">
    <div class="overlay absolute inset-0 bg-gradient-to-br from-purple-900/50 to-blue-900/50"></div>
    <div class="glow absolute inset-0 bg-purple-500/20 blur-3xl"></div>
    <div class="glow cyan absolute inset-0 bg-cyan-500/20 blur-3xl"></div>

    <a href="{{ route('index.inicio') }}" class="back-btn absolute top-4 left-4 text-sm bg-gray-600 hover:bg-gray-700 text-white py-2 px-4 rounded-lg transition">Volver</a>
    
    <header class="text-center mb-8 z-10">
        <h1 class="text-4xl font-bold text-purple-300">🎶 Panel de Boletería</h1>
        <p class="text-gray-300 mt-2">Inicia sesión para gestionar artistas, eventos y boletas</p>
    </header>

    <main class="menu z-10 w-full max-w-md">
        <div class="card bg-gray-800 rounded-xl shadow-lg p-6">
            <h2 class="text-2xl font-semibold text-center text-purple-200 mb-6">Iniciar sesión</h2>
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-300 mb-1">Correo Electrónico:</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" 
                           class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition" 
                           placeholder="Ingresa tu correo" required>
                </div>

                <div class="mb-4 relative">
                    <label for="password" class="block text-sm font-medium text-gray-300 mb-1">Contraseña:</label>
                    <input type="password" name="password" id="password" 
                           class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition" 
                           placeholder="Ingresa tu contraseña" required>
                    <button type="button" onclick="togglePassword()" class="absolute right-3 top-9 text-gray-400 hover:text-gray-200">
                        <svg id="eye-icon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                </div>

                @if ($errors->any())
                    <div class="error-messages bg-red-500/20 border border-red-500 text-red-200 p-3 rounded-lg mb-4">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <button type="submit" class="w-full bg-purple-600 hover:bg-purple-700 text-white py-2 rounded-lg font-medium transition">Iniciar sesión</button>
            </form>
        </div>
    </main>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.98 9.98 0 012.126-3.175m3.292-2.65A10.05 10.05 0 0112 5c4.477 0 8.268 2.943 9.542 7a9.98 9.98 0 01-2.126 3.175m-3.292 2.65M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3l18 18" />`;
            } else {
                passwordInput.type = 'password';
                eyeIcon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />`;
            }
        }
    </script>
</body>
</html>