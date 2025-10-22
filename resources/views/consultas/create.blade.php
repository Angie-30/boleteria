<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Consulta de Eventos</title>
    @vite(['resources/css/crear_boleta.css'])
</head>
<body>
    <div class="glow"></div>

    <h1>Eventos Disponibles</h1>

    <div class="eventos-container">
        @foreach ($eventos as $evento)
            <div class="evento-card">
                <h2>{{ $evento->nombre }}</h2>
                <p>{{ $evento->descripcion }}</p>
                <p><strong>Inicio:</strong> {{ $evento->fecha_inicio }}</p>
                <p><strong>Fin:</strong> {{ $evento->fecha_fin }}</p>

                <div class="boletas">
                    <h4>Boletas disponibles:</h4>
                    @foreach ($evento->boletas as $boleta)
                        <p class="boleta-item">
                            🎟️ <strong>{{ $boleta->localidad->nombre }}</strong>: 
                            {{ $boleta->cantidad_disponible }} disponibles a 
                            <strong>${{ number_format($boleta->precio, 0, ',', '.') }}</strong>
                        </p>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</body>
</html>
