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
    }
    public function obtenerCaptcha(){
        
        $query = "SELECT result, image_path FROM captchas ORDER BY RAND() LIMIT 1";
        $conn = $this->mysqli;
        $result = $conn->query($query);
            
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $captchaId = $row["id"];
            $imagePath = $row['image_path']; // Ajusta la ruta de la imagen aquí
            $captchaResult = $row['result']; // Ajusta el nombre del campo según tu base de datos
            $array = array('path' => $imagePath, 'id' => $captchaId);
            return $array;
            // Aquí puedes usar $captchaId y $imagePath según sea necesario
        } else {
            // Si no se encontraron imágenes CAPTCHA en la base de datos
            echo "Error: No se encontraron imágenes CAPTCHA en la DB.";
            exit;
        }
    }
}    
    

