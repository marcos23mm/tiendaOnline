<?php

class DAOProducto{
    private $conn;
    public function __construct(){
        $this->conn = DB::getConnection();
    }
    public function getProductosNombre(){
        $stmt = $this->conn->prepare("SELECT nombre FROM producto WHERE nombre = :nombre");
        $stmt->bindParam(':nombre', $nombre );
        $stmt->execute();

        $fila = $stmt->fetch(PDO::FETCH_ASSOC);

        if($fila){
            return new DTOProducto($fila['nombre'], $fila['descripcion'], $fila['precio']);
        }else{
            return null;
        }
    }

    public function getTodosProductos(){
        $stmt = $this->conn->prepare("SELECT * FROM producto");
        $stmt->execute();
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $productos = [];
        foreach ($resultados as $fila) {
            $producto = new DTOProducto($fila['nombre'], $fila['descripcion'], $fila['precio']);
        }

        return $productos;
    }

    public function addProducto($producto) {
        $stmt = $this->conn->prepare("INSERT INTO productos (nombre, descripcion, precio, clienteId) VALUES (:nombre, :descripcion, :precio, :clienteId)");
        $stmt->bindParam(':nombre', $producto->getNombre());
        $stmt->bindParam(':descripcion', $producto->getDescripcion());
        $stmt->bindParam(':precio', $producto->getPrecio());
        $stmt->bindParam(':clienteId', $producto->getClienteId());
        return $stmt->execute();
    }

    // Método para actualizar un producto
    public function updateProducto($producto) {
        $stmt = $this->conn->prepare("UPDATE productos SET nombre = :nombre, descripcion = :descripcion, precio = :precio, clienteId = :clienteId WHERE nombre = :nombre");
        $stmt->bindParam(':nombre', $producto->getNombre());
        $stmt->bindParam(':descripcion', $producto->getDescripcion());
        $stmt->bindParam(':precio', $producto->getPrecio());
        $stmt->bindParam(':clienteId', $producto->getClienteId());
        return $stmt->execute();
    }

    // Método para eliminar un producto por nombre
    public function deleteProducto($nombre) {
        $stmt = $this->conn->prepare("DELETE FROM productos WHERE nombre = :nombre");
        $stmt->bindParam(':nombre', $nombre);
        return $stmt->execute();
    }

}
