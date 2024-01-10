<?php

class Model
{

    private $mysqli;

    // Función para realizar la conexión
    public function conectar()
    {
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
    public function validarInicioSesion($usuario, $contrasena)
    {
        $sql = "SELECT * FROM erabiltzaileak_usuarios WHERE erab_usuario = ? and pasahitza_contraseña = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param('si', $usuario, $contrasena);
        $stmt->execute();
        $stmt->store_result();

        return $stmt->num_rows == 1;
    }

    // Función para agregar un nuevo usuario
    public function agregarUsuario($nombre, $usuario, $contrasena, $fechaNac)
    {
        // Utilizamos NULL para permitir que el campo id_erab_usuario se autoincremente
        $sql = "INSERT INTO erabiltzaileak_usuarios (erab_usuario, pasahitza_contraseña, izena_nombre, jaiotze_data_fecha_nacimiento, olentzero_MariDomingi, puntuazioa_puntuacion) VALUES (?, ?, ?, ?, 0, 0)";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param('ssss', $usuario, $contrasena, $nombre, $fechaNac);

        return $stmt->execute();
    }

    // Se actualizará la password en la base de datos
    public function actualizarPass($erab_usuario, $contrasena)
    {
        $sql = "UPDATE erabiltzaileak_usuarios SET pasahitza_contraseña = '$contrasena' WHERE erab_usuario = '$erab_usuario'";
        return $this->mysqli->query($sql);
    }
    public function balioztatuOlentzero($user)
    {

        $sql = "SELECT erab_usuario FROM  erabiltzaileak_usuarios WHERE erab_usuario='$user' AND olentzero_MariDomingi = '1'";
        $this->mysqli->query($sql);
        if ($this->mysqli->affected_rows == 1) {
            return true;
        } else {
            return  false;
        }
    }
    public function filtrarUsuarios()
    {
        $usuarios = array();
        $sql = "SELECT erab_usuario FROM erabiltzaileak_usuarios WHERE olentzero_MariDomingi = '0'";
        $resultado = $this->mysqli->query($sql);
        while ($fila = $resultado->fetch_assoc()) {
            $usuarios[] = $fila['erab_usuario'];
        }
        return $usuarios;
    }
    //////////////////////////////////////////////REGALOS//////////////////////////////////////////////

    public function obtenerRegalosSegunFechaNacimiento($fechaNacimiento)
    {
        // Calcular la edad del usuario
        $edad = $this->calcularEdad($fechaNacimiento);

        // Determinar el grupo de edad del usuario
        $grupoEdad = $this->determinarGrupoEdad($edad);

        // Obtener regalos según el grupo de edad
        return $this->obtenerRegalosDesdeBD($grupoEdad);
    }

    private function calcularEdad($fechaNacimiento)
    {
        $fechaNacimientoObj = new DateTime($fechaNacimiento);
        $fechaActual = new DateTime();
        $edad = $fechaNacimientoObj->diff($fechaActual)->y;
        return $edad;
    }

    private function determinarGrupoEdad($edad)
    {
        if ($edad <= 7) {
            return "Umeak";
        } elseif ($edad >= 8 && $edad <= 14) {
            return "Nerabeak";
        } elseif ($edad >= 15) {
            return "Gazteak";
        } else {
            return "Desconocido";
        }
    }

    public function obtenerRegalosDesdeBD($grupoEdad)
    {
        // Asumiendo que tienes una tabla en la base de datos llamada 'opariak_regalos'
        $sql = "SELECT * FROM opariak_regalos WHERE adina_edad = ?";

        // Preparar la consulta SQL
        $stmt = $this->mysqli->prepare($sql);

        // Vincular el parámetro de la edad
        $stmt->bind_param('s', $grupoEdad); // Cambiar 's' según el tipo de dato real en la base de datos

        // Ejecutar la consulta
        $stmt->execute();

        // Obtener el resultado
        $result = $stmt->get_result();

        // Obtener los datos de los regalos como un array asociativo
        $regalos = array();
        while ($row = $result->fetch_assoc()) {
            $regalos[] = $row;
        }

        // Cerrar la declaración
        $stmt->close();

        return $regalos;
    }
}
