<?php
session_name("");
session_start();

$servername = "localhost";
$dbname = "tiendaPHP";
$username = "root";
$password = "123";

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $conn->prepare("SELECT * FROM Producto");
$stmt->execute();
?>
    <!DOCTYPE html>
    <html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Electrónica Calico</title>
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
<table>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Descripción</th>
        <th>Precio</th>
        <th>Acciones</th>
    </tr>
    <?php
    $listaResultados = $stmt->fetchAll();

    foreach ($listaResultados as $row) {
        print "<tr>";
        print "<td>" . $row["id"] . "</td>";
        print "<td>" . $row["nombre"] . "</td>";
        print "<td>" . $row["descripcion"] . "</td>";
        print "<td>" . number_format($row["precio"], 2) . " €</td>";
        print '<td>
            <form method="POST" action="../Controlador/procesarDelete.php">
                <input type="hidden" name="id" value="' . $row["id"] . '">
                <button type="submit">Eliminar</button>
            </form>
           </td>';
        print "</tr>";
    }
    ?>
</table>
</body>
    </html><?php
