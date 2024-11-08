<?php
session_name("sesion1");
session_start();

$servername = "localhost";
$dbname = "tiendaPHP";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $precio = $_POST['precio'];

        $stmt = $conn->prepare("INSERT INTO producto (nombre, descripcion, precio) VALUES (:nombre, :descripcion, :precio)");
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':precio', $precio);

        $stmt->execute();
        header("Location: ../Vista/paginaPrincipal.php");
        exit();
    }
} catch (PDOException $e) {
    print "Error al añadir producto: " . $e->getMessage();
}
$conn = null;
?>