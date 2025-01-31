<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Contacto</title>
</head>
<body>
    <form action="gmail.php" method="post">
        <input type="text" placeholder="Nombre" name="name" required>
        <input type="email" placeholder="Correo" name="email" required>
        <input type="text" placeholder="Asunto" name="asunto" required>
        <textarea placeholder="Mensaje" name="msg" required></textarea>
        <input type="submit" name="enviar" value="Enviar">
    </form>

    <?php
    include("gmail.php");
    ?>
</body>
</html>
