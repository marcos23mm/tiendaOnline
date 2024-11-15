<?php

class DTOProducto {
    private $nombre;
    private $descripcion;
    private $precio;
    private $clienteId;

    public function __construct($nombre, $descripcion, $precio, $clienteId) {
        $this->setNombre($nombre);
        $this->setDescripcion($descripcion);
        $this->setPrecio($precio);
        $this->setClienteId($clienteId);
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

    public function setNombre($nombre) {
        if (empty($nombre)) {
            throw new Exception("El nombre es obligatorio.");
        }
        if (!preg_match('/^[a-zA-Z0-9\s]+$/', $nombre)) {
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

        if ($precio < 10) {
            $this->descripcion .= " - producto de oferta";
        } elseif ($precio > 200) {
            $this->descripcion .= " - producto de calidad";
        }

        $this->precio = $precio;
    }

    public function setClienteId($clienteId) {
        if (empty($clienteId)) {
            throw new Exception("El ID del cliente es obligatorio.");
        }

        $this->clienteId = $clienteId;
    }
}

?>