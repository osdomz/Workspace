<?php
class Modelo {
    private $conn;

    public function __construct($servername, $username, $password, $database) {
        $this->conn = new mysqli($servername, $username, $password, $database);

        if ($this->conn->connect_error) {
            die("Conexión fallida: " . $this->conn->connect_error);
        }
    }

    public function agregarUsuario($nombre, $apellido, $email, $password, $fechaRegistro, $idRol) {
       // $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO usuarios (nombre, apellido, email, passw, fechaRegistro, idRol) VALUES ('$nombre', '$apellido', '$email', '$password', '$fechaRegistro', '$idRol')";

        return $this->conn->query($sql);
    }

    public function validarUsuario($nombre, $password) {
        $sql = "SELECT * FROM usuarios WHERE nombre = '$nombre'";
        $result = $this->conn->query($sql);
    
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo "Contraseña de la base de datos: " . $row['passw'];  // Mensaje de depuración
            return password_verify($password, $row['passw']);
        } else {
            echo "No se encontró el usuario en la base de datos.";  // Mensaje de depuración
            return false;
        }
    }
    

    public function actualizarIdRol($idUsuario, $nuevoIdRol) {
        $sql = "UPDATE usuarios SET idRol = '$nuevoIdRol' WHERE id = '$idUsuario'";
        return $this->conn->query($sql);
    }

    public function eliminarUsuario($idUsuario) {
        $sql = "DELETE FROM usuarios WHERE id = '$idUsuario'";
        return $this->conn->query($sql);
    }

    public function cerrarConexion() {
        $this->conn->close();
    }
}
?>




