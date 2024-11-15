<?php
require_once 'db.php';
require_once 'DTOCliente.php';

class DAOCliente {
    private $conn;

    public function __construct() {
        $this->conn = DB::getConnection();
    }

    public function getClienteById($nickname) {
        $stmt = $this->conn->prepare("SELECT * FROM Cliente WHERE nickname = :nickname");
        $stmt->bindParam(':nickname', $nickname);
        $stmt->execute();
        $fila = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($fila) {
            return new DTOCliente(
                $fila['nombre'],
                $fila['apellido'],
                $fila['nickname'],
                $fila['password'],
                $fila['telefono'],
                $fila['domicilio']
            );
        } else {
            return null;
        }
    }

    public function getAllClientes() { //Hecha "por si acaso"
        $stmt = $this->conn->prepare("SELECT * FROM Cliente");
        $stmt->execute();
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $clientes = [];
        foreach ($resultados as $fila) {
            $cliente = new DTOCliente($fila['nombre'], $fila['apellido'], $fila['nickname'], $fila['password'], $fila['telefono'], $fila['domicilio']);
            $clientes[] = $cliente;
        }

        return $clientes;
    }

    public function addCliente($cliente) {
        $stmt = $this->conn->prepare("INSERT INTO Cliente (nombre, apellido, nickname, password, telefono, domicilio) VALUES (:nombre, :apellido, :nickname, :password, :telefono, :domicilio)");
        $stmt->bindParam(':nombre', $cliente->getNombre());
        $stmt->bindParam(':apellido', $cliente->getApellido());
        $stmt->bindParam(':nickname', $cliente->getNickname());
        $stmt->bindParam(':password', $cliente->getPassword());
        $stmt->bindParam(':telefono', $cliente->getTelefono());
        $stmt->bindParam(':domicilio', $cliente->getDomicilio());
        return $stmt->execute();
    }

    public function updateCliente($cliente) { //Hecha también "por si acaso"
        $stmt = $this->conn->prepare("UPDATE Cliente SET nombre = :nombre, apellido = :apellido, nickname = :nickname, password = :password, telefono = :telefono, domicilio = :domicilio WHERE id = :id");
        $stmt->bindParam(':id', $cliente->getId());
        $stmt->bindParam(':nombre', $cliente->getNombre());
        $stmt->bindParam(':apellido', $cliente->getApellido());
        $stmt->bindParam(':nickname', $cliente->getNickname());
        $stmt->bindParam(':password', $cliente->getPassword());
        $stmt->bindParam(':telefono', $cliente->getTelefono());
        $stmt->bindParam(':domicilio', $cliente->getDomicilio());
        return $stmt->execute();
    }

    public function deleteCliente($id) { //Y también por si acaso...
        $stmt = $this->conn->prepare("DELETE FROM Cliente WHERE id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>
