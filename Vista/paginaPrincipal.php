<?php
session_start();
require_once '../Modelo/DAOProducto.php';

try {
    $daoProducto = new DAOProducto();
    if (!isset($_SESSION['resultadosBusqueda'])) {
        $productos = $daoProducto->getTodosProductos();
    } else {
        $productos = $_SESSION['resultadosBusqueda'];
        unset($_SESSION['resultadosBusqueda']);
    }
} catch (PDOException $e) {
    echo "Error al obtener productos: " . $e->getMessage();
    $productos = [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="paginaPrincipal.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
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
                <li><a href="menuTrastienda.php">Menu Trastienda</a> </li>
                <li><p>Usuario: <?php echo htmlspecialchars($_SESSION['usuario']); ?></p></li>
                <li><a href="../Controlador/controlSesion.php">Cerrar Sesión</a></li>
            <?php else: ?>
                <li><a href="inicioSesion.php">Iniciar sesión</a></li>
            <?php endif; ?>
            <li class="iconCa"><a href="vistaCarrito.php"><img src="shopping-cart-2-line (1).png"></a></li>
        </ul>
    </nav>
</header>

<div class="productos-container">
    <?php
    if (!empty($productos)) {
        foreach ($productos as $producto) {
            $mostrarBoton = $daoProducto->esClienteIdNull($producto->getId());
            echo "<div class='producto'>";
            echo "<h3> " . htmlspecialchars($producto->getNombre()) . "</h3>";
            echo "<p>Descripción: " . htmlspecialchars($producto->getDescripcion()) . "</p>";
            echo "<p>Precio: " . number_format($producto->getPrecio(), 2) . " €</p>";
            if ($mostrarBoton) {
                echo '<p>
                <form method="POST" action="../Controlador/procesarCarrito.php">
                    <input type="hidden" name="id" value="' . htmlspecialchars($producto->getId()) . '">
                    <button type="submit" name="accion" value="añadir">Añadir</button>
                </form>
            </p>';
            }
            echo "</div>";
        }
    } else {
        echo "<p>No se encontraron productos que coincidan con la búsqueda.</p>";
    }
    ?>
</div>
</body>
<br></br>
<footer class="footer">
    <div class="footer-container">
        <p>&copy; 2024 InformáticaTech. Todos los derechos reservados.</p>
        <ul class="footer-links">
            <li><a href="#about">Sobre Nosotros</a></li>
            <li><a href="#privacy">Política de Privacidad</a></li>
            <li><a href="#contact">Contacto</a></li>
        </ul>
    </div>
</footer>
</html>
