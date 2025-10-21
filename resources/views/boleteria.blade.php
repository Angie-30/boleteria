<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
     <form action="/guardar-evento" method="post" class="form">
        <label for="nombre">Nombre del evento:</label>
        <input type="text" id="nombre" name="nombre">
        <br>
        <label for="descripcion">descripcion</label>
        <input type="decripcion" id="descripcion" name="decripcion" class="eje">
        <br>
        <label for="fecha">Fecha del evento:</label>
        <input type="date" id="fecha" name="fecha">
        <br>
        <label for="hora">Hora de inicio del evento:</label>
        <input type="time" id="hora" name="hora">
        <br>
        <label for="fecha_fin">Fecha de fin del evento:</label>
        <input type="date" id="fecha_fin" name="fecha_fin">
        <br>
        <label for="hora_fin">Hora final del evento:</label>
        <input type="time" id="hora_fin" name="hora_fin">
        <br>
        <button type="submit">Enviar</button>
    </form>
</body>
</html>