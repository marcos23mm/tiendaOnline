<?php
session_start();

require_once '../Modelo/DAOProducto.php';
require_once '../Modelo/DTOProducto.php';

$daoProducto = new DAOProducto();
$productos = $daoProducto->getTodosProductos();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Eliminar Producto</title>
    <link rel="stylesheet" href="Recursos/paginaPrincipal.css">
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

<table>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Descripción</th>
        <th>Precio</th>
        <th>Acciones</th>
    </tr>
    <?php foreach ($productos as $producto): ?>
        <tr>
            <td><?= $producto->getId() ?></td>
            <td><?= htmlspecialchars($producto->getNombre()) ?></td>
            <td><?= htmlspecialchars($producto->getDescripcion()) ?></td>
            <td><?= number_format($producto->getPrecio(), 2) ?> €</td>
            <td>
                <form method="POST" action="../Controlador/procesarDelete.php">
                    <input type="hidden" name="id" value="<?= $producto->getId() ?>">
                    <button type="submit">Eliminar</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
</body>
</html>
