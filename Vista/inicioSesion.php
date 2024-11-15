<?php
session_start();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="Recursos/hojaEstilo.css">
</head>
<body>
<div class="logo-container">
    <a href="paginaPrincipal.php">
        <img src="Recursos/logo.png" alt="Página Principal">
    </a>
</div>

<div class="contenedor">
    <form action="../Controlador/procesarInicio.php" method="post">
        <p class="titulo">Iniciar Sesión</p>
        <label for="cliente"></label>
        <input type="text" name="cliente" id="cliente" placeholder="Usuario">
        <br><br>
        <label for="contraseña"></label>
        <input type="password" name="contraseña" id="contraseña" placeholder="Contraseña">
        <br><br>
        <input class="boton" type="submit" id="boton" value="Comenzar">
    </form>
    <br><br>
    <form action="registroCliente.php">
        <br><br>
        <input class="botonRegistro" type="submit" id="botonRegistro" value="Registro">
    </form>
</div>
</body>
</html>
