<?php

session_start();

$servername = "localhost";
$dbname = "tiendaPHP";
$username = "root";
$password = "123";

if (isset($_POST['nombreP'])) {
    $nombreP = $_POST['nombreP'];

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Preparar la consulta con un comodín para el LIKE
        $stmt = $conn->prepare("SELECT * FROM Producto WHERE LOWER(nombre) LIKE :palabra");
        $nombreP = '%' . strtolower($nombreP) . '%'; // Convertir a minúsculas y añadir comodines
        $stmt->bindParam(':palabra', $nombreP, PDO::PARAM_STR);
        $stmt->execute();

        // Guardar los resultados en la sesión
        $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($productos) {
            $_SESSION['resultadosBusqueda'] = $productos; // Guardar todos los productos en la sesión
        } else {
            $_SESSION['resultadosBusqueda'] = []; // Si no hay resultados, guardar un array vacío
        }

        header("Location: ../Vista/selectProducto.php"); // Redirigir a la vista
        exit();

    } catch (PDOException $e) {
        echo "Error al buscar el producto: " . $e->getMessage();
    }
}

?>
