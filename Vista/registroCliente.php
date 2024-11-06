<?php
session_name("misProyectos");
session_start();

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
    <link rel="stylesheet" href="hojaEstilo2.css">
</head>
<body>
<div class="contenedor">
    <form action="procesarRegistro.php" method="post">

        <p class="titulo">Iniciar Sesion</p>
        <label for="nombre"></label>
        <input type="text" name="nombre" id="nombre" placeholder="Nombre">

        <br></br>

        <label for="apellido"></label>
        <input type="text" name="apellido" id="apellido" placeholder="Apellido">

        <br></br>

        <label for="domicilio"></label>
        <input type="text" name="domicilio" id="domicilio" placeholder="Domicilio" >

        <br></br>

        <label for="telefono"></label>
        <input type="text" name="telefono" id="telefono" placeholder="Telefono">

        <br></br>

        <label for="contraseña"></label>
        <input type="password" name="contraseña" id="contraseña" placeholder="Contraseña" >

        <br></br>

        <label for="usuario"></label>
        <input type="text" name="usuario" id="usuario" placeholder="Usuario">

        <br></br>

        <input class="boton" type="submit" id="boton" value="Resgistrar">
    </form>
</div>
</body>
</html>