<?php
class model {
    private $conexion;

    public function __construct() {
        $this->conexion = new mysqli("localhost", "usuario", "contraseña", "basededatos");
        if ($this->conexion->connect_error) {
            die("Error de conexión: " . $this->conexion->connect_error);
        }
    }

    public function obtenerDatos() {
        $query = "SELECT * FROM tabla";
        $result = $this->conexion->query($query);
        $datos = array();
        while ($row = $result->fetch_assoc()) {
            $datos[] = $row;
        }
        return $datos;
    }

    // Otros métodos del modelo para insertar, actualizar o eliminar datos
}
?>






