<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>GOOFY - Realizar Solicitud</title>
    <link href="style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
</head>
<body>
<h2>Formulario de Solicitud</h2>
<form action="procesar_solicitud.php" method="POST">
    <label for="titulo">Título:</label>
    <input type="text" id="titulo" name="titulo" required>

    <label for="descripcion">Descripción:</label>
    <textarea id="descripcion" name="descripcion" rows="4" required></textarea>

    <label for="precio">Precio:</label>
    <input type="number" id="precio" name="precio" required>

    <input type="submit" value="Enviar solicitud">
</form>
</body>
</html>


