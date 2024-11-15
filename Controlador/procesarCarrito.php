<?php
session_start();
require_once '../Modelo/db.php';
require_once '../Modelo/DAOProducto.php';

if (isset($_POST['accion'])) {
    $daoProducto = new DAOProducto();

    if ($_POST['accion'] === 'añadir' && isset($_POST['id'])) {
        $id = $_POST['id'];

        if ($daoProducto->esClienteIdNull($id)) {
            $_SESSION['carrito'][] = $id;
        }
    } elseif ($_POST['accion'] === 'eliminar' && isset($_POST['id'])) {
        $id = $_POST['id'];
        $_SESSION['carrito'] = array_diff($_SESSION['carrito'], [$id]);
    } elseif ($_POST['accion'] === 'vaciar') {
        $_SESSION['carrito'] = [];
    }
}

header('Location: ' . ($_POST['accion'] === 'añadir' ? '../Vista/paginaPrincipal.php' : '../Vista/vistaCarrito.php'));
exit();
