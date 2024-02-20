<?php
class TrabajadorasModelo
{
    private $mysqli;

    // Función para realizar la conexión
    public function conectar()
    {
        try {
            $this->mysqli = new mysqli('localhost', 'root', '', 'editorial');
            if ($this->mysqli->connect_errno) {
                throw new Exception('Error en conexión: ' . $this->mysqli->connect_error);
            }
        } catch (Exception $e) {
            throw $e;
        }
    }

    // Función para validar el inicio de sesión con la base de datos
    public function validarSesion($usuario)
    {
        $this->conectar();
        $sql = "SELECT usuario, contraseña FROM personas_trabajadoras WHERE usuario = ?";
        // Preparar la consulta con parámetros
        $stmt = $this->mysqli->prepare($sql);
        // Enlazar el parámetro de nombre
        $stmt->bind_param("s", $usuario);
        // Ejecutar la consulta
        $stmt->execute();
        // Obtener el resultado de la consulta
        $resultado = $stmt->get_result();
        // Crear un array para almacenar los nombres de usuario y contraseñas
        $contrasenas = array();
        // Verificar si se encontró algún resultado
        if ($resultado->num_rows > 0) {
            // Recorrer los resultados y almacenarlos en el array de contraseñas
            while ($log = $resultado->fetch_assoc()) {
                $contrasenas[$log["usuario"]] = $log["contraseña"];
            }
        }

        // Devolver el array de contraseñas
        return $contrasenas;
    }


    public function obtenerTipoUsuario($usuario)
    {

        $sql = "SELECT usuario FROM  personas_trabajadoras WHERE usuario='$usuario' AND Autor = '1'";
        $this->mysqli->query($sql);
        if ($this->mysqli->affected_rows == 1) {
            return true;
        } else {
            return  false;
        }
    }

    public function actualizarPass($usuario, $contrasena)
    {
        // Hashear la contraseña antes de almacenarla
        $contrasena_hasheada = password_hash($contrasena, PASSWORD_DEFAULT);

        // Preparar la consulta SQL
        $sql = "UPDATE personas_trabajadoras SET contraseña = '$contrasena_hasheada' WHERE usuario = '$usuario'";

        // Ejecutar la consulta
        $this->mysqli->query($sql);
    }

public function agregarUsuario($AutorID, $Usuario, $Contraseña, $Nombre, $Nacionalidad, $Autor)
    {
        $this->conectar();
        $sql = "SELECT Usuario from personas_trabajadoras where Autor = '$Autor'";
        $this->mysqli->query($sql);
        if ($this->mysqli->affected_rows == 1) {
        } else {
            $Contraseña = password_hash($Contraseña, PASSWORD_DEFAULT);
            $sql = "INSERT into personas_trabajadoras values ('$AutorID','$Usuario','$Contraseña','$Nombre', '$Nacionalidad', '$Autor');";
            $this->mysqli->query($sql);
        }
    }
}
