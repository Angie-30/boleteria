<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href='resources/css/evento.css'>
    <style>
        .body{
            font-family: Arial, sans-serif;
            background-color: #ac2525;
            margin: 0;
            padding: 0;

        }
        .form{
            background-color: rgb(24, 119, 106);
            padding: 20px;
            border-radius: 5px;
            font-family: Arial, Helvetica, sans-serif;
            color: rgb(196, 216, 223);
            grid-auto-flow: column;
            gap: 10px;
            right: 20px;
        }
    </style>
    {{-- @vite(['resources/css/evento.css']) --}}
    <title>Document</title>
</head>
<body>
     <form action="#" method="post" class="form">
        <label for="nombre">Nombre del evento:</label>
        <input type="text" id="nombre" name="nombre" required>
        <br>
        <label for="descripcion">descripcion</label>
        <input type="decripcion" id="descripcion" name="decripcion" class="eje" required>
        <br>
        <label for="fecha">Fecha del evento:</label>
        <input type="date" id="fecha" name="fecha" required>
        <br>
        <label for="hora">Hora de inicio del evento:</label>
        <input type="time" id="hora" name="hora" required>
        <br>
        <label for="fecha_fin">Fecha de fin del evento:</label>
        <input type="date" id="fecha_fin" name="fecha_fin" required>
        <br>
        <label for="hora_fin">Hora final del evento:</label>
        <input type="time" id="hora_fin" name="hora_fin" required>
        <br>      
    </form>

    <a href="\alerta"><button type="submit">Enviar</button></a>
</body>
</html>