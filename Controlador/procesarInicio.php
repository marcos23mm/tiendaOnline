<?php

session_name("");
session_start();

$servername = "localhost";
$dbname = "";
$username = "root";
$password = "123";

if (isset($_POST['cliente']) && isset($_POST['contraseña'])) {
    $nickname = $_POST['cliente'];
    $password1 = $_POST['contraseña'];
}

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("SELECT * FROM Cliente WHERE nickname = :nombreUser AND password = :contrasena");
    $stmt->bindParam(':nombreUser', $nickname);
    $stmt->bindParam(':contrasena', $password1);

    $stmt->execute();

    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if($usuario){
        $_SESSION['usuario'] = $nickname;
        header('Location: menu2.php');
    }else{
        echo "Nombre de usuario o contraseña incorrectos";
    }


} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}


?>
