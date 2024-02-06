<?php

class modelo_Tienda
{
    private $mysqli;

    // Función para realizar la conexión
    public function conectar()
    {
        try {
            $this->mysqli = new mysqli('localhost', 'root', '', 'tienda');
            if ($this->mysqli->connect_errno) {
                throw new Exception('Error en conexión: ' . $this->mysqli->connect_error);
            }
        } catch (Exception $e) {
            throw $e;
        }
    }

    // Función para validar el inicio de sesión con la base de datos
    public function validarSesion($usuario, $contrasena)
    {
        $sql = "SELECT * FROM usuarios WHERE usuario = ? and contrasena = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param('si', $usuario, $contrasena);
        $stmt->execute();
        $stmt->store_result();

        return $stmt->num_rows == 1;
    }

    ////////////////////////////////////////////////////////////////////////////////////////
    public function obtenerRolUsuario($usuario)
    {
        $sql = "SELECT rol FROM usuarios WHERE usuario = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param('s', $usuario);  // Usar $usuario en lugar de $rol
        $stmt->execute();
        $stmt->store_result();
    
        if ($stmt->num_rows == 1) {
            $rol = null; // Declare the variable $rol
            $stmt->bind_result($rol);
            $stmt->fetch();
            return $rol;
        } else {
            return null;
        }
    }}
    

