<?php

session_name("");
session_start();

$servername = "localhost";
$dbname = "";
$username = "root";
$password = "123";

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['nickname']) && isset($_POST['password']) && isset($_POST['telefono']) && isset($_POST['domicilio'])) {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $nickname = $_POST['nickname'];
    $contraseña = $_POST['password'];
    $telefono = $_POST['telefono'];
    $domicilio = $_POST['domicilio'];


    $stmt = $conn->prepare("INSERT INTO Cliente (nombre, apellido, nickname, password, telefono, domicilio) 
                                VALUES (:nombre, :apellido, :nickname, :password, :telefono, :domicilio)");

    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':apellido', $apellido);
    $stmt->bindParam(':nickname', $nickname);
    $stmt->bindParam(':password', $telefono);
    $stmt->bindParam(':telefono', $contraseña);
    $stmt->bindParam(':domicilio', $domicilio);

    $stmt->execute();

    header('Location: ../inicioSesion.php');

}else{
    echo "Son necesarios todos los campos";
}

?>
