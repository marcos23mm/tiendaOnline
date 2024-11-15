<?php

session_name("");
session_start();
require_once '../Modelo/db.php';

if (isset($_POST['cliente']) && isset($_POST['contraseña'])) {
    $nickname = $_POST['cliente'];
    $password1 = $_POST['contraseña'];
}

try {
    // Obtener la conexión usando la clase DB<?php
session_start();
require_once '../Modelo/DAOCliente.php';

if (isset($_POST['cliente']) && isset($_POST['contraseña'])) {
    $nickname = $_POST['cliente'];
    $password1 = $_POST['contraseña'];

    try {
        // Crear una instancia del DAOCliente
        $daoCliente = new DAOCliente();

        // Buscar el cliente por su nickname
        $cliente = $daoCliente->getClienteById($nickname);

        if ($cliente && password_verify($password1, $cliente->getPassword())) {
            $_SESSION['usuario'] = $cliente->getNickname(); // Guardar el nickname del cliente en la sesión
            header('Location: ../Vista/paginaPrincipal.php');
            exit;
        } else {
            echo "Nombre de usuario o contraseña incorrectos";
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
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
