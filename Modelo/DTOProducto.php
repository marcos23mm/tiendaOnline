<?php
class DTOProducto {
    private $id;
    private $nombre;
    private $descripcion;
    private $precio;
    private $clienteId;

    public function __construct($id, $nombre, $descripcion, $precio, $clienteId = null) {
        $this->setId($id);
        $this->setNombre($nombre);
        $this->setDescripcion($descripcion);
        $this->setPrecio($precio);
        $this->setClienteId($clienteId);
    }

    public function getId() {
        return $this->id;
    }
    public function getNombre() {
        return $this->nombre;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function getPrecio() {
        return $this->precio;
    }

    public function getClienteId() {
        return $this->clienteId;
    }
    public function setId($id) {
        if (empty($id)) {
            throw new Exception("El ID es obligatorio.");
        }

        $this->id = $id;
    }

    public function setNombre($nombre) {
        if (empty($nombre)) {
            throw new Exception("El nombre es obligatorio.");
        }

        if (!preg_match('/^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ\s]+$/', $nombre)) {
            throw new Exception("El nombre solo debe contener caracteres alfanuméricos.");
        }

        $this->nombre = $nombre;
    }

    public function setDescripcion($descripcion) {
        if (empty($descripcion)) {
            throw new Exception("La descripción es obligatoria.");
        }

        $this->descripcion = $descripcion;
    }

    public function setPrecio($precio) {
        if (empty($precio)) {
            throw new Exception("El precio es obligatorio.");
        }
        if (!is_numeric($precio) || $precio <= 0) {
            throw new Exception("El precio debe ser un valor numérico positivo.");
        }

        $this->precio = $precio;
    }
    public function setClienteId($clienteId) {
        $this->clienteId = $clienteId;
    }
}

?>
