<?php

session_start();

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
    <link rel="stylesheet" href="paginaPrincipal.css">

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
                    <li><a href="menuTrastienda.php">Menu Trastienda</a> </li>
                    <li><p>Usuario: <?php echo htmlspecialchars($_SESSION['usuario']); ?></p></li>
                    <li><a href="../Controlador/controlSesion.php">Cerrar Sesión</a></li>
                <?php else: ?>
                    <li><a href="inicioSesion.php">Iniciar sesión</a></li>
                <?php endif; ?>
                <li class="iconCa"><a href="#"><img src="shopping-cart-2-line (1).png"></a></li>
            </ul>
        </nav>
    </header>
</head>
<body>
    <form action="../Controlador/procesarAdd.php" method="post">
        <label for="nombre"></label>
        <input type="text" name="nombre" id="nombre">

        <label for="descripcion"></label>
        <input type="text" name="descripcion" id="descripcion">

        <label for="precio"></label>
        <input type="text" name="precio" id="precio">

        <input type="submit">
    </form>

</body>
</html>