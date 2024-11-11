<?php
session_start();

$servername = "localhost";
$dbname = "tiendaPHP";
$username = "root";
$password = "123";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Si no hay resultados de búsqueda en la sesión, se hace un SELECT * para mostrar todos los productos
    if (!isset($_SESSION['resultadosBusqueda'])) {
        $stmt = $conn->prepare("SELECT * FROM Producto");
        $stmt->execute();
        $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        $productos = $_SESSION['resultadosBusqueda'];
        unset($_SESSION['resultadosBusqueda']); // Limpiar la sesión después de mostrar los resultados
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
                <li><a href="paginaPrincipal.php">Cerrar Sesión</a><?php session_destroy(); ?></li>
            <?php else: ?>
                <li><a href="inicioSesion.php">Iniciar sesión</a></li>
            <?php endif; ?>
            <li class="iconCa"><a href="#"><img src="shopping-cart-2-line (1).png"></a></li>
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
            print '<p>
            <form method="POST" action="#">
                <button type="submit">Añadir</button>
            </form>
           </p>';
            echo "</div>";
        }
    } else {
        echo "<p>No se encontraron productos que coincidan con la búsqueda.</p>";
    }
    ?>
</div>

</body>
</html>

