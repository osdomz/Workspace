<?php
class UsuarioModelo
{
    private $mysqli;

    // Función para realizar la conexión
    public function conectar()
    {
        try {
            $this->mysqli = new mysqli('localhost', 'root', '', 'tienda_ropa');
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
        $sql = "SELECT * FROM usuarios WHERE nombre = ? and contrasenya = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param('si', $usuario, $contrasena);
        $stmt->execute();
        $stmt->store_result();

        return $stmt->num_rows == 1;
    }

    public function obtenerTipoUsuario($usuario)
    {

        $sql = "SELECT nombre FROM  usuarios WHERE nombre='$usuario' AND admin = '1'";
        $this->mysqli->query($sql);
        if ($this->mysqli->affected_rows == 1) {
            return true;
        } else {
            return  false;
        }
    }
    public function agregarUsuario($id, $nombre, $contrasenya, $admin)
    {

        $sql = "INSERT INTO usuarios (id, nombre, contrasenya, admin) VALUES (?, ?, ?, ?)";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param('issi',$id , $nombre, $contrasenya, $admin);
        
        return $stmt->execute();
    }
    public function actualizarPass($nombre, $contrasena)
    {
        $sql = "UPDATE usuarios SET contrasenya = ? WHERE nombre = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param('ss', $contrasena, $nombre);
        return $stmt->execute();
    }

    public function crearProducto($id, $nombre, $precio)
    {
        $sql = "INSERT INTO ropa (id, nombre, precio) VALUES (?, ?, ?)";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param('iss', $id, $nombre, $precio);
        return $stmt->execute();
    }
}