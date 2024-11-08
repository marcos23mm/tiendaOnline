<?php
$servername = "localhost";
$dbname = "tiendaPHP";
$username = "root";
$password = "123";

if (isset($_POST['id'])) {
    $productId = $_POST['id'];

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("DELETE FROM Producto WHERE id = :id");
        $stmt->bindParam(':id', $productId);
        $stmt->execute();

        echo "Producto eliminado correctamente.";
        // Redirigir a la página original o mostrar un mensaje de éxito
        header("Location: ../Vista/deleteProducto.php");
        exit();
    } catch (PDOException $e) {
        echo "Error al eliminar el producto: " . $e->getMessage();
    }
}
?>
