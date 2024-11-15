<?php
session_start();

require_once '../Modelo/DAOProducto.php';
require_once '../Modelo/DTOProducto.php';

if (isset($_POST['nombre'], $_POST['descripcion'], $_POST['precio'])) {
    try {
        $id = uniqid(); //La base de datos es autoincremental. Aún con ello, hemos de asignar esta id para que funcione.
        $producto = new DTOProducto($id, $_POST['nombre'], $_POST['descripcion'], $_POST['precio']);

        $daoProducto = new DAOProducto();
        if ($daoProducto->addProducto($producto)) {
            echo "Producto añadido correctamente.";
            header("Location: ../Vista/addProducto.php");
        } else {
            echo "Error al añadir el producto.";
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Todos los campos son obligatorios.";
}
?>
