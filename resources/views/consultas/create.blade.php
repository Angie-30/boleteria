<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Consulta de Eventos</title>
    @vite(['resources/css/app.css'])
</head>
<body>
    <h1>Eventos Disponibles</h1>
    @foreach ($eventos as $evento)
        <div style="border:1px solid gray; padding:10px; margin-bottom:10px;">
            <h2>{{ $evento->nombre }}</h2>
            <p>{{ $evento->descripcion }}</p>
            <p><strong>Inicio:</strong> {{ $evento->fecha_inicio }}</p>
            <p><strong>Fin:</strong> {{ $evento->fecha_fin }}</p>

            <h4>Boletas disponibles:</h4>
            @foreach ($evento->boletas as $boleta)
                <p>{{ $boleta->localidad->nombre }}: {{ $boleta->cantidad_disponible }} disponibles a ${{ $boleta->precio }}</p>
            @endforeach
        </div>
    @endforeach
</body>
</html>
