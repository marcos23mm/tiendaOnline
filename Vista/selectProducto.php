<?php

session_start();

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
    <link rel="stylesheet" href="hojaEstiloBusqueda.css">
</head>
<body>
<form action="../Controlador/procesarSelect.php" method="post" class="search-container">
    <input type="text" name="nombreP" id="nombreP" class="search-input" placeholder="Buscar">
    <button type="submit" class="search-icon">
        🔍
    </button>
</form>

<?php
if (isset($_SESSION['resultadosBusqueda'])) {
    $productos = $_SESSION['resultadosBusqueda'];
    if (!empty($productos)) {
        foreach ($productos as $producto) {
            echo "<div>";
            echo "Nombre: " . htmlspecialchars($producto['nombre']) . "<br>";
            echo "Descripción: " . htmlspecialchars($producto['descripcion']) . "<br>";
            echo "Precio: " . htmlspecialchars($producto['precio']) . " €<br>";
            echo "</div>";
        }
    } else {
        echo "No se encontraron productos que coincidan con la búsqueda.";
    }

    // Limpiar la sesión después de mostrar los resultados
    unset($_SESSION['resultadosBusqueda']);
}
?>

</body>
</html>