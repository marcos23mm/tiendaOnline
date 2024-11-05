<?php
require_once 'db.php';
require_once 'DTOCliente.php';

class DAOCliente {
    private $conn;
    public function __construct() {
        $this->conn = DB::getConnection();
    }
    public function getClienteById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM clientes WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $fila = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($fila) {
            return new DTOCliente($fila['id'], $fila['nombre'], $fila['apellido'], $fila['nickname'], $fila['password'], $fila['telefono'], $fila['domicilio']);
        } else {
            return null; // Si no se encuentra, devolvemos null
        }
    }
    // Metodo que retorna una lista de empleados como objetos DTOCliente
    public function getAllClientes() {
        $stmt = $this->conn->prepare("SELECT * FROM clientes");
        $stmt->execute();
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $clientes = [];
        foreach ($resultados as $fila) {
            $cliente = new DTOCliente($fila['id'], $fila['nombre'], $fila['apellido'], $fila['nickname'], $fila['password'], $fila['telefono'], $fila['domicilio']);
            $clientes[] = $cliente;
        }

        return $clientes; // Retornamos una lista de objetos DTOCliente
    }

    public function addCliente($cliente) {
        $stmt = $this->conn->prepare("INSERT INTO clientes (id, nombre, apellido, nickname, password, telefono, domicilio) VALUES (:id, :nombre, :apellido, :nickname, :password, :telefono, :domicilio)");
        $stmt->bindParam(':id', $cliente->getId());
        $stmt->bindParam(':nombre', $cliente->getNombre());
        $stmt->bindParam(':apellido', $cliente->getApellido());
        $stmt->bindParam(':nickname', $cliente->getNickname());
        $stmt->bindParam(':password', $cliente->getPassword());
        $stmt->bindParam(':telefono', $cliente->getTelefono());
        $stmt->bindParam(':domicilio', $cliente->getDomicilio());
        return $stmt->execute();
    }
    public function updateCliente($cliente) {
        $stmt = $this->conn->prepare("UPDATE clientes SET nombre = :nombre, apellido = :apellido, nickname = :nickname, password = :password, telefono = :telefono, domicilio = :domicilio WHERE id = :id");
        $stmt->bindParam(':id', $cliente->getId());
        $stmt->bindParam(':nombre', $cliente->getNombre());
        $stmt->bindParam(':apellido', $cliente->getApellido());
        $stmt->bindParam(':nickname', $cliente->getNickname());
        $stmt->bindParam(':password', $cliente->getPassword());
        $stmt->bindParam(':telefono', $cliente->getTelefono());
        $stmt->bindParam(':domicilio', $cliente->getDomicilio());
        return $stmt->execute();
    }

    public function deleteCliente($id) {
        $stmt = $this->conn->prepare("DELETE FROM clientes WHERE id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>