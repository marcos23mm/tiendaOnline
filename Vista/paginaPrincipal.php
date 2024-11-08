<?php
session_name("sesion1");
session_start();

$servername = "localhost";
$dbname = "TiendaPHP";
$username = "root";
$password = "";

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $conn->prepare("SELECT * FROM producto");
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
            <form method="POST" action="eliminarProducto.php">
                <input type="hidden" name="id" value="' . $row["id"] . '">
                <button type="submit">Eliminar</button>
            </form>
           </td>';
    print "</tr>";
}
?>
if (isset($_SESSION['nickname'])) {
    $nickname = $_SESSION['nickname'];
    print "Está conectado con este usuario: " . $nickname;
} else {
    print "No hay usuario registrado.";
}
?>
<p><a href="formAdd.php">Añadir producto</a></p>
<p><a href="formDelete.php">Borrar producto</a></p>
<p><a href="formUpdate.php">Actualizar producto</a></p>
<p><a href="formSelect.php">Seleccionar producto</a></p>
</body>
</html>
