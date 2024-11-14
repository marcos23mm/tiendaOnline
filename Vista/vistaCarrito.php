<?php
session_start();
require_once '../Modelo/db.php'; // Asegúrate de que la ruta sea correcta

try {
    $conn = DB::getConnection(); // Obtener la conexión usando la clase DB

    // Obtener el carrito de la sesión o inicializarlo vacío
    $carrito = isset($_SESSION['carrito']) ? $_SESSION['carrito'] : [];

    if (!empty($carrito)) {
        $placeholders = implode(',', array_fill(0, count($carrito), '?'));
        $stmt = $conn->prepare("SELECT id, nombre, descripcion, precio FROM Producto WHERE id IN ($placeholders)");
        $stmt->execute(array_values($carrito));
        $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        $productos = [];
    }
} catch (PDOException $e) {
    echo "Error al conectarse a la base de datos: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
    <link rel="stylesheet" href="paginaPrincipal.css">
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
            echo "<div class='producto'>";
            echo "<h3> " . htmlspecialchars($producto['nombre']) . "</h3>";
            echo "<p>Descripción: " . htmlspecialchars($producto['descripcion']) . "</p>";
            echo "<p>Precio: " . number_format($producto['precio'], 2) . " €</p>";
            echo '<p>
                <form method="POST" action="../Controlador/procesarCarrito.php">
                    <input type="hidden" name="id" value="' . htmlspecialchars($producto['id']) . '">
                    <button type="submit" name="accion" value="eliminar">Eliminar del carrito</button>
                </form>
            </p>';
            echo "</div>";
        }
        echo '<form method="POST" action="../Controlador/procesarCarrito.php" style="margin-top: 20px;">
                <button type="submit" name="accion" value="vaciar">Vaciar carrito</button>
              </form>';
    } else {
        echo "<p>El carrito está vacío</p>";
    }
    ?>
</div>
</body>
</html>
