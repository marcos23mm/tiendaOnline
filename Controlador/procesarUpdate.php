<?php
session_start();

require_once '../Modelo/DAOProducto.php';
require_once '../Modelo/DTOProducto.php';

if (isset($_POST['id'], $_POST['nombre'], $_POST['descripcion'], $_POST['precio'])) {
    $id = $_POST['id'];

    try {
        $producto = new DTOProducto($_POST['id'],$_POST['nombre'], $_POST['descripcion'], $_POST['precio']);

        $daoProducto = new DAOProducto();
        if ($daoProducto->updateProducto($id, $producto)) {
            echo "Producto actualizado correctamente.";
            header("Location: ../Vista/updateProducto.php");
        } else {
            echo "Error al actualizar el producto.";
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Todos los campos son obligatorios.";
}
?>
