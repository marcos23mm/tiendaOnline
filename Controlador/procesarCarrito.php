<?php
session_start();

if (isset($_POST['id'], $_POST['accion'])) {
    $id = $_POST['id'];

    if ($_POST['accion'] === 'añadir') {
        $_SESSION['carrito'][] = $id;
    } elseif ($_POST['accion'] === 'eliminar') {
        $_SESSION['carrito'] = array_diff($_SESSION['carrito'], [$id]);
    }
}

header('Location: ' . ($_POST['accion'] === 'añadir' ? '../Vista/paginaPrincipal.php' : '../Vista/vistaCarrito.php'));
exit();
?>