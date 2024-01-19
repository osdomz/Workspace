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
    $sql = "UPDATE erabiltzaileak_usuarios SET pasahitza_contraseña = ? WHERE erab_usuario = ?";
    $stmt = $this->mysqli->prepare($sql);
    $stmt->bind_param('ss', $contrasena, $erab_usuario);
    return $stmt->execute();
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

    public function obtenerFechaNacimientoDesdeBD($usuarioID)
    {
        $sql = "SELECT jaiotze_data_fecha_nacimiento FROM erabiltzaileak_usuarios WHERE id = ?";
        $stmt = $this->mysqli->prepare($sql);
    
        // Asegúrate de que el ID sea del tipo correcto
        $stmt->bind_param('s', $usuarioID);
    
        $stmt->execute();
        
        // Vincula el resultado a una variable
        $fechaNacimiento = $stmt->get_result();
    
        // Obtiene el resultado
        $stmt->fetch();
    
        $stmt->close();
    
        // Crea un objeto DateTime a partir de la cadena de fecha
        $fechaNacimiento = new DateTime($fechaNacimiento);
    
        return $fechaNacimiento;
    }
    
    private function calcularEdad($fechaNacimiento)
    {
        $fechaNacimientoObj = new DateTime($fechaNacimiento);
        $fechaActual = new DateTime();
        $edad = $fechaNacimientoObj->diff($fechaActual)->y;
        return $edad;
    }
    
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
    
    public function obtenerRegalosDesdeBD($grupoEdad)
    {
        $sql = "SELECT * FROM opariak_regalos WHERE adina_edad = ?";
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
    
    public function obtenerRegalosSegunEdadYGrupo($fechaNacimiento)
    {
        if (isset($fechaNacimiento) && !empty($fechaNacimiento)) {
            // Obtener la edad en años
            $edad = $this->calcularEdad($fechaNacimiento);
            // Determinar el grupo de edad
            $grupoEdad = $this->determinarGrupoEdad($edad);
            echo "Grupo de Edad: " . $grupoEdad; 
            // Obtener los regalos según el grupo de edad
            return $this->obtenerRegalosDesdeBD($grupoEdad);
        } else {
            // Manejar la situación cuando $fechaNacimiento no está definida o es vacía
            echo '<h3 style="color: red;">Error: La fecha de nacimiento no está definida o es inválida.</h3>';
            return array();  // Otra acción que debas realizar en este caso.
        }
    }
    
    // Función para calcular la edad
   
}    