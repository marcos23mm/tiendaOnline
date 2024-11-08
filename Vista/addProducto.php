<?php
session_name("sesion1");
session_start();

$servername = "localhost";
$dbname = "tiendaPHP";
$username = "root";
$password = "";

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Añadir producto</title>
</head>
<body>
<form action="../Controlador/procesarAdd.php" method="POST">
    <label>Nombre:</label>
    <input type="text" name="nombre" required>
    <br>
    <label>Descripción:</label>
    <textarea name="descripcion" required></textarea>
    <br>
    <label>Precio:</label>
    <input type="number" name="precio" step="0.01" required>
    <br>
    <input type="submit" value="Añadir producto">
</form>
<?php
if (isset($_SESSION['nickname'])) {
    $nickname = $_SESSION['nickname'];
    print "Logeado con este usuario: " . $nickname;
} else {
    print "No hay usuario registrado.";
}
?>

</body>
</html>
