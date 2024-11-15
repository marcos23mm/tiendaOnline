<?php
class DTOCliente{
    private $id;
    private $nombre;
    private $apellido;
    private $nickname;
    private $password;
    private $telefono;
    private $domicilio;

    public function __construct($id, $nombre, $apellido, $nickname, $password, $telefono, $domicilio){
        $this->setId($id);
        $this->setNombre($nombre);
        $this->setApellido($apellido);
        $this->setNickname($nickname);
        $this->setPassword($password);
        $this->setTelefono($telefono);
        $this->setDomicilio($domicilio);
    }
    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getApellido() {
        return $this->apellido;
    }

    public function getNickname() {
        return $this->nickname;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getTelefono() {
        return $this->telefono;
    }

    public function getDomicilio() {
        return $this->domicilio;
    }

    // Setters
    public function setId($id) {
        if (!is_numeric($id) || $id <= 0) {
            throw new InvalidArgumentException("El ID debe ser un número positivo.");
        }
        $this->id = $id;
    }

    public function setNombre($nombre) {
        if (!preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚ\s]+$/', $nombre)) {
            throw new InvalidArgumentException("El nombre debe ser alfabético.");
        }
        $this->nombre = $nombre;
    }

    public function setApellido($apellido) {
        if (!preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚ\s]+$/', $apellido)) {
            throw new InvalidArgumentException("El apellido debe ser alfabético.");
        }

        $this->apellido = $apellido;
    }

    public function setNickname($nickname) {
        if (!preg_match('/^[a-zA-Z0-9_]+$/', $nickname)) {
            throw new InvalidArgumentException("El nickname debe ser alfanumérico y puede incluir guiones bajos.");
        }
        $this->nickname = $nickname;
    }

    public function setPassword($password) {
        if (strlen($password) < 6) {
            throw new InvalidArgumentException("La contraseña debe tener al menos 6 caracteres.");
        }
        $this->password = password_hash($password, PASSWORD_DEFAULT); // Hash para mayor seguridad
    }

    public function setTelefono($telefono) {
        if (!preg_match('/^\+?[0-9\s\-]+$/', $telefono)) {
            throw new InvalidArgumentException("El teléfono debe ser un número válido.");
        }
        $this->telefono = $telefono;
    }

    public function setDomicilio($domicilio) {
        if (empty($domicilio)) {
            throw new InvalidArgumentException("El domicilio no puede estar vacío.");
        }
        $this->domicilio = $domicilio;
    }
}
?>
