<?php

session_start();
require_once '../Modelo/db.php';

if (isset($_POST['nombreP'])) {
    $nombreP = $_POST['nombreP'];

    try {
        $conn = DB::getConnection();

        $stmt = $conn->prepare("SELECT * FROM Producto WHERE LOWER(nombre) LIKE :palabra");
        $nombreP = '%' . strtolower($nombreP) . '%';
        $stmt->bindParam(':palabra', $nombreP, PDO::PARAM_STR);
        $stmt->execute();

        $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
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

