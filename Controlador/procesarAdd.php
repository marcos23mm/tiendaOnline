<?php
// Iniciar la sesión si es necesario (opcional)
session_start();

// Configuración de la conexión a la base de datos
$servername = "localhost";
$dbname = "tiendaPHP";
$username = "root";
$password = "123";

try {
    // Conectar a la base de datos usando PDO
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Verificar si se han enviado los datos del formulario
    if (isset($_POST['nombre'], $_POST['descripcion'], $_POST['precio'])) {
        // Sanitizar los datos de entrada
        $nombre = htmlspecialchars($_POST['nombre']);
        $descripcion = htmlspecialchars($_POST['descripcion']);
        $precio = floatval($_POST['precio']); // Convertir el precio a float

        // Preparar la consulta de inserción
        $stmt = $conn->prepare("INSERT INTO Producto (nombre, descripcion, precio) VALUES (:nombre, :descripcion, :precio)");
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':precio', $precio);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "Producto añadido correctamente.";
            header("Location: ../Vista/añadirProducto.php");
        } else {
            echo "Error al añadir el producto.";
        }
    } else {
        echo "Todos los campos son obligatorios.";
    }
} catch (PDOException $e) {
    echo "Error en la conexión a la base de datos: " . $e->getMessage();
}


?>
