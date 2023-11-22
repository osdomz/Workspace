<?php

class ModeloJugador {

    private $mysqli;

    // Función para realizar la conexión.
  public function conectar() {
    try {
        $this->mysqli = new mysqli('localhost', 'root', '', 'juego');
        if ($this->mysqli->connect_errno) {
            throw new Exception('Error en conexión: ' . $this->mysqli->connect_error);
        }
    } catch (Exception $e) {
        throw $e;
    }
}


    // Función para comprobar el inicio de sesión.
 public function validarInicioSesion($usuario, $contrasena) {
    $sql = "SELECT * FROM jugadores WHERE usuario = ? and contrasena = ?";
    $stmt = $this->mysqli->prepare($sql);
    $stmt->bind_param('ss', $usuario, $contrasena);
    $stmt->execute();
    $stmt->store_result();
    
    return $stmt->num_rows == 1;
}


    // Se actualizará la puntuación en la base de datos.
  public function actualizarPuntuacion($usuario, $puntuacion) {
    $sql = "UPDATE jugadores SET puntuacion_maxima = puntuacion_maxima + ? WHERE usuario = ?";
    $stmt = $this->mysqli->prepare($sql);
    $stmt->bind_param('is', $puntuacion, $usuario);
    $stmt->execute();
}


    // Devolverá la lista asociativa de usuarios ordenada por puntuación.
    public function listaOrdenadaPorPuntuacion() {
        try {
            $sql = "SELECT usuario, puntuacion_maxima FROM jugadores ORDER BY puntuacion_maxima DESC;";
            $resultado = $this->mysqli->query($sql);
            $lista = array();
            foreach($resultado as $fila) {
                $lista[$fila['usuario']] = $fila['puntuacion_maxima'];
            }
            return $lista;
        } catch (Exception $ex) {
            throw $ex;
        }
    }
    
}

    