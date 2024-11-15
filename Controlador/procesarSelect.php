<?php
session_start();
require_once '../Modelo/DAOProducto.php';

if (isset($_POST['nombreP'])) {
    $nombreP = $_POST['nombreP'];

    try {
        $daoProducto = new DAOProducto();

        $productos = $daoProducto->buscarProductosPorNombre($nombreP);

        if ($productos) {
            $_SESSION['resultadosBusqueda'] = $productos;
        } else {
            $_SESSION['resultadosBusqueda'] = [];
        }

        header("Location: ../Vista/paginaPrincipal.php");
        exit();

    } catch (PDOException $e) {
        echo "Error al buscar el producto: " . $e->getMessage();
    }
}
?>