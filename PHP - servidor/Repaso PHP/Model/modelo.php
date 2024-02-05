<?php

class Model
{
    private $mysqli;

    // Constructor para iniciar la conexión
    public function __construct()
    {
        $this->conectar();
    }

    // Destructor para cerrar la conexión
    public function __destruct()
    {
        $this->cerrarConexion();
    }

    // Función para realizar la conexión
    public function conectar()
    {
        try {
            // Configuración de la conexión
            $host = 'localhost';
            $usuario = 'root';
            $contrasena = '';
            $nombreBaseDatos = 'tienda';

            // Conexión a la base de datos
            $this->mysqli = new mysqli($host, $usuario, $contrasena, $nombreBaseDatos);

            // Verificar errores de conexión
            if ($this->mysqli->connect_errno) {
                throw new Exception('Error en conexión: ' . $this->mysqli->connect_error);
            }
        } catch (Exception $e) {
            // Registrar el error en un sistema de registro
            error_log('Error de conexión: ' . $e->getMessage());
            // Puedes lanzar la excepción nuevamente si deseas que se propague
            // throw $e;
        }
    }

    // Función para validar el inicio de sesión con la base de datos
    public function validarInicioSesion($usuario, $contrasena)
    {
        $sql = "SELECT * FROM usuarios WHERE usuario = ? AND contrasena = ?";
        $stmt = $this->mysqli->prepare($sql);
        // El tipo de dato para la contraseña debe ser 's' (cadena)
        $stmt->bind_param('si', $usuario, $contrasena);
        $stmt->execute();
        $stmt->store_result();

        return $stmt->num_rows == 1;
    }

    // Función para cerrar la conexión
    public function cerrarConexion()
    {
        if ($this->mysqli) {
            $this->mysqli->close();
        }
    }
}
