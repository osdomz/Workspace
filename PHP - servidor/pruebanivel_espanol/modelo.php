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
            echo $e->getMessage();
        }
    }

    // Función para comprobar el inicio de sesión.
    public function validarInicioSesion($usuario, $contrasena) {
        $sql = "SELECT * FROM jugadores WHERE usuario = '" . $usuario . "' and contrasena = '" . $contrasena . "'";
        $this->mysqli->query($sql);
        if ($this->mysqli->affected_rows == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    // Se actualizará la puntuación en la base de datos.
    public function actualizarPuntuacion($usuario, $puntuacion) {
        $sql = "SELECT puntuacion_maxima FROM jugadores WHERE usuario = '" . $usuario . "'";
        $resultado = $this->mysqli->query($sql);
        $fila = $resultado->fetch_array();
        $puntuacionActual = $fila[0];
        $puntuacionActual = $puntuacionActual + $puntuacion;

        $sql = "UPDATE jugadores SET puntuacion_maxima = " . $puntuacionActual . "  WHERE usuario = '" . $usuario . "'";
        $this->mysqli->query($sql);
    }

    // Devolverá la lista asociativa de usuarios ordenada por puntuación.
    public function listaOrdenadaPorPuntuacion() {
        try {
            $sql = "SELECT usuario, puntuacion_maxima FROM jugadores ORDER BY puntuacion_maxima DESC;";
            $resultado = $this->mysqli->query($sql);
            foreach($resultado as $fila) {
                $lista[$fila['usuario']] = $fila['puntuacion_maxima'];
            }
            return $lista;
        } catch (Exception $ex) {
            throw $ex;
        }
    }
}

    