<?php
session_start();

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
    <link rel="stylesheet" href="Recursos/hojaEstilo2.css">
</head>
<body>

<div class="logo-container">
    <a href="paginaPrincipal.php">
        <img src="Recursos/logo.png" alt="Página Principal">
    </a>
</div>

<div class="contenedor">
    <form action="../Controlador/procesarRegistro.php" method="post">

        <p class="titulo">Iniciar Sesion</p>
        <label for="nombre"></label>
        <input type="text" name="nombre" id="nombre" placeholder="Nombre">

        <br></br>

        <label for="apellido"></label>
        <input type="text" name="apellido" id="apellido" placeholder="Apellido">

        <br></br>

        <label for="nickname"></label>
        <input type="text" name="nickname" id="nickname" placeholder="Nickname" >

        <br></br>

        <label for="password"></label>
        <input type="password" name="password" id="password" placeholder="Contraseña">

        <br></br>

        <label for="telefono"></label>
        <input type="text" name="telefono" id="telefono" placeholder="Telefono" >

        <br></br>

        <label for="domicilio"></label>
        <input type="text" name="domicilio" id="domicilio" placeholder="Domicilio">

        <br></br>

        <input class="boton" type="submit" id="boton" value="Resgistrar">
    </form>
</div>
</body>
</html>
