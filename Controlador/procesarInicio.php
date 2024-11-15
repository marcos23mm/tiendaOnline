<?php
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
