<?php

require_once 'db.php';
require_once 'DTOProducto.php';

class DAOProducto {
    private $conn;

    public function __construct() {
        $this->conn = DB::getConnection();
    }

    public function addProducto($producto) {
        $stmt = $this->conn->prepare("INSERT INTO Producto (nombre, descripcion, precio) VALUES (:nombre, :descripcion, :precio)");
        $stmt->bindParam(':nombre', $producto->getNombre());
        $stmt->bindParam(':descripcion', $producto->getDescripcion());
        $stmt->bindParam(':precio', $producto->getPrecio());
        return $stmt->execute();
    }

    public function updateProducto($id, $producto) {
        $stmt = $this->conn->prepare("UPDATE Producto SET nombre = :nombre, descripcion = :descripcion, precio = :precio WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nombre', $producto->getNombre());
        $stmt->bindParam(':descripcion', $producto->getDescripcion());
        $stmt->bindParam(':precio', $producto->getPrecio());
        return $stmt->execute();
    }

    public function deleteProducto($id) {
        $stmt = $this->conn->prepare("DELETE FROM Producto WHERE id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function esClienteIdNull($id) {
        $stmt = $this->conn->prepare("SELECT cliente_id FROM Producto WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $producto = $stmt->fetch(PDO::FETCH_ASSOC);

        return $producto && is_null($producto['cliente_id']);
    }
    
    public function getTodosProductos() {
        $stmt = $this->conn->prepare("SELECT * FROM Producto");
        $stmt->execute();
        $productosData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $productos = [];
        foreach ($productosData as $productoData) {
            $producto = new DTOProducto();
            $producto->setId($productoData['id']);
            $producto->setNombre($productoData['nombre']);
            $producto->setDescripcion($productoData['descripcion']);
            $producto->setPrecio($productoData['precio']);
            $productos[] = $producto;
        }

        return $productos;
    }
}
?>
