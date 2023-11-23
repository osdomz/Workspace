<?php

class Model {

    private $mysqli;

    // Función para realizar la conexión
    public function conectar() {
        try {
            $this->mysqli = new mysqli('localhost', 'root', '', 'gabonak');
            if ($this->mysqli->connect_errno) {
                throw new Exception('Error en conexión: ' . $this->mysqli->connect_error);
            }
        } catch (Exception $e) {
            throw $e;
        }
    }

    // Función para comprobar el inicio de sesión
    public function validarInicioSesion($usuario, $contrasena) {
        $sql = "SELECT * FROM erabiltzaileak_usuarios WHERE erab_usuario = ? and pasahitza_contraseña = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param('si', $usuario, $contrasena);
        $stmt->execute();
        $stmt->store_result();
        
        return $stmt->num_rows == 1;
    }

    public function agregarUsuario($erab_usuario, $pasahitza_contraseña, $izena_nombre, $jaiotze_data_fecha_nacimiento) {
        $sql = "INSERT INTO erabiltzaileak_usuarios (erab_usuario, pasahitza_contraseña, izena_nombre, jaiotze_data_fecha_nacimiento) VALUES (?, ?, ?, ?)";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param('sisd', $erab_usuario, $pasahitza_contraseña, $izena_nombre, $jaiotze_data_fecha_nacimiento);
        return $stmt->execute();
    }

    // Se actualizará la password en la base de datos

    public function actualizarPass($usuario, $contrasena) {
        $sql = "UPDATE erabiltzaileak_usuarios SET pasahitza_contraseña = pasahitza_contraseña + ? WHERE erab_usuario = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param('si',$usuario, $contrasena);
        $stmt->execute();
    }

}

