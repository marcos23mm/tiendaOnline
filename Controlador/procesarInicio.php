<?php
session_start();
require_once '../Modelo/DAOCliente.php';

if (isset($_POST['cliente']) && isset($_POST['contraseña'])) {
    $nickname = $_POST['cliente'];
    $password1 = $_POST['contraseña'];

    try {
        $daoCliente = new DAOCliente();

        $cliente = $daoCliente->getClienteById($nickname);

        if ($cliente && $password1 === $cliente->getPassword()) {
            $_SESSION['usuario'] = $cliente->getNickname();
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
