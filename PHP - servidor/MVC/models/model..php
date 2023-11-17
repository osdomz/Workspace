<?php

class Model {
    private $db;

    public function __construct() {
        $this->db = new mysqli('localhost', 'usuario', 'contraseña', 'basededatos');
        if ($this->db->connect_error) {
            die('Error de conexión a la base de datos: ' . $this->db->connect_error);
        }
    }

    public function insertData($name, $email) {
        $query = "INSERT INTO usuarios (nombre, email) VALUES ('$name', '$email')";
        return $this->db->query($query);
    }
}






