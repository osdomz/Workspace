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
    public function validarSesion($usuario)
    {
        $this->conectar();
        $sql = "SELECT nombre, contrasenya FROM usuarios WHERE nombre = ?";
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
                $contrasenas[$log["nombre"]] = $log["contrasenya"];
            }
        }

        // Devolver el array de contraseñas
        return $contrasenas;
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
    public function agregarUsuario($id, $usuario, $contrasenya, $admin)
    {
        $this->conectar();
        $sql = "SELECT nombre from usuarios where nombre='$usuario'";
        $this->mysqli->query($sql);
        if ($this->mysqli->affected_rows == 1) {
            echo "<h1>Usuario ya existe</h1>";
        } else {
            $contrasenya = password_hash($contrasenya, PASSWORD_DEFAULT);
            $sql = "INSERT into usuarios values ('$id','$usuario','$contrasenya','$admin');";
            $this->mysqli->query($sql);
        }
    }
    public function actualizarPass($usuario, $contrasena)
    {
        // Hashear la contraseña antes de almacenarla
        $contrasena_hasheada = password_hash($contrasena, PASSWORD_DEFAULT);

        // Preparar la consulta SQL
        $sql = "UPDATE usuarios SET contrasenya = '$contrasena_hasheada' WHERE nombre = '$usuario'";

        // Ejecutar la consulta
        $this->mysqli->query($sql);
    }
}
