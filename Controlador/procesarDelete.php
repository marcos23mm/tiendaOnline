<?php
session_start();

require_once '../Modelo/DAOProducto.php';

if (isset($_POST['id'])) {
    $productId = $_POST['id'];

    try {
        $daoProducto = new DAOProducto();
        if ($daoProducto->deleteProducto($productId)) {
            echo "Producto eliminado correctamente.";
            header("Location: ../Vista/deleteProducto.php");
            exit();
        } else {
            echo "Error al eliminar el producto.";
        }
    } catch (PDOException $e) {
        echo "Error al eliminar el producto: " . $e->getMessage();
    }
} else {
    echo "ID del producto no especificado.";
}
?>
