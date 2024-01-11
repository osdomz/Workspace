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

    private function calcularEdad($fechaNacimiento)
    {
        $fechaNacimientoObj = new DateTime($fechaNacimiento);
        $fechaActual = new DateTime();
        $edad = $fechaNacimientoObj->diff($fechaActual)->y;
        return $edad;
    }
    public function obtenerRegalosSegunEdadYGrupo($fechaNacimiento)
    {
        $edad = $this->calcularEdad($fechaNacimiento);
        $grupoEdad = $this->determinarGrupoEdad($edad);

        return $this->obtenerRegalosDesdeBD($grupoEdad);
    }

    // Modifica la función obtenerRegalosDesdeBD para que acepte el grupo de edad
    public function obtenerRegalosDesdeBD($grupoEdad)
    {
        $sql = "SELECT * FROM opariak_regalos WHERE grupo_edad = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param('s', $grupoEdad);
        $stmt->execute();
        $result = $stmt->get_result();
        $regalos = array();
        while ($row = $result->fetch_assoc()) {
            $regalos[] = $row;
        }
        $stmt->close();
        return $regalos;
    }

    // Agrega una función para determinar el grupo de edad según la clasificación que tienes
    public function determinarGrupoEdad($edad)
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
}

  