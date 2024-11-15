<?php

session_start();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Actualizar producto</title>
    <link rel="stylesheet" href="paginaPrincipal.css">
    <link rel="stylesheet" href="updateCSS.css">

</head>
<body>

<header>
    <div class="logo">
        <a href="paginaPrincipal.php">TiendaOnline</a>
    </div>
    <nav>
        <ul class="nav-links">
            <li>
                <form action="../Controlador/procesarSelect.php" method="post" class="search-container">
                    <input type="text" name="nombreP" id="nombreP" class="search-input" placeholder="Buscar">
                    <button type="submit" class="search-icon">
                        <i class="ri-search-line"></i>
                    </button>
                </form>
            </li>
            <?php if (isset($_SESSION['usuario']) && !empty($_SESSION['usuario'])): ?>
                <li><a href="menuTrastienda.php">Menu Trastienda</a></li>
                <li><p>Usuario: <?php echo htmlspecialchars($_SESSION['usuario']); ?></p></li>
                <li><a href="../Controlador/controlSesion.php">Cerrar Sesión</a></li>
            <?php else: ?>
                <li><a href="inicioSesion.php">Iniciar sesión</a></li>
            <?php endif; ?>
            <li class="iconCa"><a href="vistaCarrito.php"><img src="Recursos/shopping-cart-2-line%20(1).png"></a></li>
        </ul>
    </nav>
</header>

<br></br>
<br></br>

<form action="../Controlador/procesarUpdate.php" method="POST" class="custom-form">
    <label>ID del producto:</label>
    <input type="text" name="id" required>
    <br>
    <label>Nombre:</label>
    <input type="text" name="nombre" required>
    <br>
    <label>Descripción:</label>
    <textarea name="descripcion" required></textarea>
    <br>
    <label>Precio:</label>
    <input type="number" name="precio" step="0.01" required>
    <br>
    <input type="submit" value="Actualizar producto">
</form>


</body>
</html>


