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
</html>