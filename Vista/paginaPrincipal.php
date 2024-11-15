<?php
session_start();
require_once '../Modelo/db.php';
require_once '../Modelo/DAOProducto.php';

try {
    $conn = DB::getConnection();
    if (!isset($_SESSION['resultadosBusqueda'])) {
        $stmt = $conn->prepare("SELECT * FROM Producto");
        $stmt->execute();
        $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        $productos = $_SESSION['resultadosBusqueda'];
        unset($_SESSION['resultadosBusqueda']);
    }
} catch (PDOException $e) {
    echo "Error al conectarse a la base de datos: " . $e->getMessage();
    $productos = [];
}
$daoProducto = new DAOProducto();
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
            $mostrarBoton = $daoProducto->esClienteIdNull($producto['id']);
            echo "<div class='producto'>";
            echo "<h3> " . htmlspecialchars($producto['nombre']) . "</h3>";
            echo "<p>Descripción: " . htmlspecialchars($producto['descripcion']) . "</p>";
            echo "<p>Precio: " . number_format($producto['precio'], 2) . " €</p>";
            if ($mostrarBoton) {
                echo '<p>
                <form method="POST" action="../Controlador/procesarCarrito.php">
                    <input type="hidden" name="id" value="' . htmlspecialchars($producto['id']) . '">
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
</html>
