<?php
session_name("");
session_start();

require_once '../Modelo/DAOCliente.php';
require_once '../Modelo/DTOCliente.php';

if (isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['nickname']) && isset($_POST['password']) && isset($_POST['telefono']) && isset($_POST['domicilio'])) {
    try {
        $cliente = new DTOCliente($_POST['nombre'], $_POST['apellido'], $_POST['nickname'], $_POST['password'], $_POST['telefono'], $_POST['domicilio']);

        $daoCliente = new DAOCliente();
        $daoCliente->addCliente($cliente);

        header('Location: ../Vista/inicioSesion.php');
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Todos los campos son obligatorios.";
}
?>
