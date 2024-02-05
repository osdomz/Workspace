<?php

class Model
{

    private $mysqli;


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
        $sql = "SELECT jaiotze_data_fecha_nacimiento FROM erabiltzaileak_usuarios WHERE erab_usuario = ?";
        $stmt = $this->mysqli->prepare($sql);

        if (!$stmt) {
            die('Error en la preparación de la consulta: ' . $this->mysqli->error);
        }

        $stmt->bind_param('s', $usuarioID);
        $stmt->execute();

        // Vincula el resultado a una variable
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            // No se encontró la fecha de nacimiento
            return null;
        }

        // Obtén el valor de la fecha de nacimiento
        $fechaNacimiento = $result->fetch_assoc()['jaiotze_data_fecha_nacimiento'];

        // Cierra la declaración preparada
        $stmt->close();

        // Crea un objeto DateTime a partir de la cadena de fecha
        $fechaNacimiento = new DateTime($fechaNacimiento);

        return $fechaNacimiento;
    }



    public function calcularEdad($fechaNacimiento)
    {
        // Asegúrate de que $fechaNacimiento es una cadena
        if (!is_string($fechaNacimiento)) {
            throw new InvalidArgumentException('La fecha de nacimiento debe ser una cadena.');
        }

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
            return "Gazte";
        } else {
            return "Desconocido";
        }
    }

    public function obtenerGrupoEdadDesdeBD($grupoEdad)
    {
        $sql = "SELECT * FROM opariak_regalos WHERE adina_edad LIKE concat('%', ?, '%')";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param('s', $grupoEdad);
        $stmt->execute();
        $result = $stmt->get_result();
        $regalos = array();
        while ($row = $result->fetch_assoc()) {
            $regalos[$row['izena_nombre']] = $row['puntuazioa_puntuacion'];
        }
        $stmt->close();
        echo 'Regalos: ' . print_r($regalos, true);
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
            return $this->obtenerGrupoEdadDesdeBD($grupoEdad);
        } else {
            // Manejar la situación cuando $fechaNacimiento no está definida o es vacía
            echo '<h3 style="color: red;">Error: La fecha de nacimiento no está definida o es inválida.</h3>';
            // return array();  // Otra acción que debas realizar en este caso.
        }
    }

    public function verificarCartaCompletada($usuarioID)
    {
        $sql = "SELECT COUNT(*) as count FROM gutunak_cartas WHERE erab_usuario = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param('s', $usuarioID);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            // El usuario no tiene carta existente
            return false;
        }

        $count = $result->fetch_assoc()['count'];

        // Cierra la declaración preparada
        $stmt->close();

        return $count > 0;
    }

    public function verificarPuntosSuficientes($usuarioID, $puntosNecesarios)
    {
        $sql = "SELECT puntuazioa_puntuacion FROM erabiltzaileak_usuarios WHERE erab_usuario = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param('s', $usuarioID);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            // El usuario no existe
            throw new Exception('Error: El usuario no existe.');
        }

        $usuarioPuntos = $result->fetch_assoc()['puntuazioa_puntuacion'];

        // Cierra la declaración preparada
        $stmt->close();

        return $usuarioPuntos >= $puntosNecesarios;
    }


    public function completarCarta($usuarioID, $opciones)
    {
        // Verificar si el usuario ya tiene una carta existente
        if ($this->verificarCartaCompletada($usuarioID)) {
            // Si el usuario ya ha completado la carta previamente, actualizar la carta existente
            return $this->actualizarCarta($usuarioID, $opciones);
        }

        // El usuario no ha completado la carta previamente, proceder con la creación de una nueva carta
        $anoActual = date('Y');
        $opcionesStr = implode(', ', $opciones);
        $puntosNecesarios = $this->calcularPuntosNecesarios($opciones);

        $sql = "INSERT INTO gutunak_cartas (erab_usuario, urtea, eskatutakoak_pedidos) VALUES (?, ?, ?)";
        $stmt = $this->mysqli->prepare($sql);

        if ($stmt) {
            $stmt->bind_param('sss', $usuarioID, $anoActual, $opcionesStr);
            $stmt->execute();
            $stmt->close();

            if (isset($puntosNecesarios)) {
                $this->restarPuntosUsuario($usuarioID, $puntosNecesarios);
            }
        } else {
            throw new Exception('Error: No se pudo preparar la consulta para completar la carta.');
        }
    }

    // Función para actualizar una carta existente
    private function actualizarCarta($usuarioID, $opciones)
    {
        $opcionesStr = implode(', ', $opciones);
        $puntosNecesarios = $this->calcularPuntosNecesarios($opciones);

        $sql = "UPDATE gutunak_cartas SET eskatutakoak_pedidos = ? WHERE erab_usuario = ?";
        $stmt = $this->mysqli->prepare($sql);

        if ($stmt) {
            $stmt->bind_param('ss', $opcionesStr, $usuarioID);
            $stmt->execute();
            $stmt->close();

            if (isset($puntosNecesarios)) {
                $this->restarPuntosUsuario($usuarioID, $puntosNecesarios);
            }
        } else {
            throw new Exception('Error: No se pudo preparar la consulta para actualizar la carta existente.');
        }
    }



    private function restarPuntosUsuario($usuarioID, $puntos)
    {
        $sql = "UPDATE erabiltzaileak_usuarios SET puntuazioa_puntuacion = puntuazioa_puntuacion - ? WHERE erab_usuario = ?";
        $stmt = $this->mysqli->prepare($sql);

        if ($stmt) {
            $stmt->bind_param('ss', $puntos, $usuarioID);
            $stmt->execute();
            $stmt->close();
        } else {
            throw new Exception('Error: No se pudo preparar la consulta para restar puntos al usuario.');
        }
    }

    public function calcularPuntosNecesarios($opciones)
    {
        // Inicializar la suma de puntos
        $totalPuntos = 0;

        // Consultar la base de datos para obtener los puntos de cada regalo seleccionado
        foreach ($opciones as $regalo) {
            $sql = "SELECT puntuazioa_puntuacion FROM opariak_regalos WHERE izena_nombre = ?";
            $stmt = $this->mysqli->prepare($sql);

            if ($stmt) {
                $stmt->bind_param('s', $regalo);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    $puntosRegalo = $result->fetch_assoc()['puntuazioa_puntuacion'];
                    $totalPuntos += $puntosRegalo;
                } else {
                    // Manejar el caso cuando el regalo no está en la base de datos
                    throw new Exception('Error: El regalo "' . $regalo . '" no está en la base de datos.');
                }

                $stmt->close();
            } else {
                // Manejar el caso cuando la preparación de la consulta falla
                throw new Exception('Error: No se pudo preparar la consulta para obtener los puntos del regalo.');
            }
        }

        return $totalPuntos;
    }

    // En tu clase de modelo (Model.php)

    public function cambiarRegaloCarta($usuarioID, $nuevoRegalo)
    {
        // Verificar si el usuario tiene una carta existente
        if ($this->verificarCartaCompletada($usuarioID)) {
            try {
                // Actualizar el regalo en la tabla de pedidos
                $sql = "UPDATE gutunak_cartas SET eskatutakoak_pedidos = ? WHERE erab_usuario = ?";
                $stmt = $this->mysqli->prepare($sql);

                if ($stmt) {
                    $stmt->bind_param('ss', $nuevoRegalo, $usuarioID);
                    $stmt->execute();
                    $stmt->close();
                } else {
                    throw new Exception('Error: No se pudo preparar la consulta para cambiar el regalo.');
                }
            } catch (Exception $e) {
                throw new Exception('Error al cambiar el regalo de la carta: ' . $e->getMessage());
            }
        } else {
            throw new Exception('Error: El usuario no tiene una carta existente para cambiar el regalo.');
        }
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function obtenerAccionesSegunEdad($grupoEdad)
    {
        $sql = "SELECT * FROM ekintzak_acciones WHERE adina_edad LIKE concat('%', ?, '%')";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param('s', $grupoEdad);
        $stmt->execute();
        $result = $stmt->get_result();
        $acciones = array();
        while ($row = $result->fetch_assoc()) {
            $acciones[$row['izena_nombre']] = $row['puntuak_puntuacion'];
        }
        $stmt->close();
        return $acciones;
    }
    public function actualizarPuntuacionUsuario($usuarioID, $acciones)
    {
        // Obtener la puntuación actual del usuario
        $puntuacionActual = $this->obtenerPuntuacionUsuario($usuarioID);

        // Sumar las puntuaciones de las nuevas acciones
        $nuevaPuntuacion = $puntuacionActual;
        foreach ($acciones as $puntuacion) {
            $nuevaPuntuacion += $puntuacion;
        }

        // Actualizar la puntuación en la base de datos
        $this->actualizarPuntuacionUsuarioBD($usuarioID, $nuevaPuntuacion);
    }

    private function actualizarPuntuacionUsuarioBD($usuarioID, $nuevaPuntuacion)
    {
        $sql = "UPDATE usuarios SET puntuazioa_puntuacion = ? WHERE erab_usuario = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param('ss', $nuevaPuntuacion, $usuarioID);
        $stmt->execute();
        $stmt->close();
    }
    public function obtenerPuntuacionUsuario($usuarioID)
    {
        $sql = "SELECT puntuazioa_puntuacion FROM erabiltzaileak_usuarios WHERE erab_usuario = ?";
        $stmt = $this->mysqli->prepare($sql);

        if (!$stmt) {
            die('Error en la preparación de la consulta: ' . $this->mysqli->error);
        }

        $stmt->bind_param('s', $usuarioID);
        $stmt->execute();

        // Vincula el resultado a una variable
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            // No se encontró la puntuación del usuario
            return 0; // Otra acción que debas realizar en este caso.
        }

        // Obtén la puntuación del usuario
        $puntuacion = $result->fetch_assoc()['puntuazioa_puntuacion'];

        // Cierra la declaración preparada
        $stmt->close();

        return $puntuacion;
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function obtenerGrupoEdadDesdeBDacciones($grupoEdad)
    {
        $sql = "SELECT * FROM ekintzak_acciones WHERE adina_edad LIKE concat('%', ?, '%')";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param('s', $grupoEdad);
        $stmt->execute();
        $result = $stmt->get_result();
        $regalos = array();
        while ($row = $result->fetch_assoc()) {
            $regalos[$row['izena_nombre']] = $row['puntuak_puntuacion'];
        }
        $stmt->close();
        echo 'Acciones: ' . print_r($regalos, true);
        return $regalos;
    }

    public function obtenerAccionesSegunEdadYGrupo($fechaNacimiento)
    {
        if (isset($fechaNacimiento) && !empty($fechaNacimiento)) {
            // Obtener la edad en años
            $edad = $this->calcularEdad($fechaNacimiento);
            // Determinar el grupo de edad
            $grupoEdad = $this->determinarGrupoEdad($edad);
            echo "Grupo de Edad: " . $grupoEdad;
            // Obtener las acciones según el grupo de edad
            return $this->obtenerGrupoEdadDesdeBDacciones($grupoEdad);
        } else {
            // Manejar la situación cuando $fechaNacimiento no está definida o es vacía
            echo '<h3 style="color: red;">Error: La fecha de nacimiento no está definida o es inválida.</h3>';
            // return array();  // Otra acción que debas realizar en este caso.
        }
    }
    public function actualizarPuntuacionUsuariosBD($usuarioID, $nuevaPuntuacion)
    {
        $sql = "UPDATE erabiltzaileak_usuarios SET   puntuazioa_puntuacion 	  = ? WHERE erab_usuario = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param('ss', $nuevaPuntuacion, $usuarioID);
        $stmt->execute();
        $stmt->close();
    }
    public function obtenerPuntuacionAcciones($usuarioID)
    {
        $sql = "SELECT puntuak_puntuacion FROM ekintzak_acciones WHERE izena_nombre = ?";
        $stmt = $this->mysqli->prepare($sql);

        if (!$stmt) {
            die('Error en la preparación de la consulta: ' . $this->mysqli->error);
        }

        $stmt->bind_param('s', $usuarioID);
        $stmt->execute();

        // Vincula el resultado a una variable
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            // No se encontró la puntuación del usuario
            return 0; // Otra acción que debas realizar en este caso.
        }

        // Obtén la puntuación del usuario
        $puntuacion = $result->fetch_assoc()['puntuak_puntuacion'];

        // Cierra la declaración preparada
        $stmt->close();

        return $puntuacion;
    }
    public function restarPuntuacionAccionesAlUsuario($usuarioID, $acciones)
    {
        // Obtener la puntuación actual del usuario
        $puntuacionActual = $this->obtenerPuntuacionUsuario($usuarioID);

        // Iterar sobre las acciones seleccionadas y restar la puntuación
        foreach ($acciones as $selectedAction) {
            $actionScore = $this->obtenerPuntuacionAcciones($selectedAction);
            $puntuacionActual -= $actionScore;  // Restar en lugar de reemplazar
        }

        // Actualizar la puntuación en la base de datos de usuarios
        $this->actualizarPuntuacionUsuariosBD($usuarioID, $puntuacionActual);

        // Puedes agregar redirección o mensajes de éxito aquí si es necesario
    }
}
