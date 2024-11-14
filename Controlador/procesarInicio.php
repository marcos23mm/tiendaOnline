<?php

session_name("");
session_start();
require_once '../Modelo/db.php';

if (isset($_POST['cliente']) && isset($_POST['contraseña'])) {
    $nickname = $_POST['cliente'];
    $password1 = $_POST['contraseña'];
}

try {
    // Obtener la conexión usando la clase DB
    $conn = DB::getConnection();

    $stmt = $conn->prepare("SELECT * FROM Cliente WHERE nickname = :nombreUser AND password = :contrasena");
    $stmt->bindParam(':nombreUser', $nickname);
    $stmt->bindParam(':contrasena', $password1);

    $stmt->execute();

    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario) {
        $_SESSION['usuario'] = $nickname;
        header('Location: ../Vista/paginaPrincipal.php');
    } else {
        echo "Nombre de usuario o contraseña incorrectos";
    }

} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
