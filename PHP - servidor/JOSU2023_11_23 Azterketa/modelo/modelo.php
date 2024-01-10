<?php

class modelo
{

    private $mysqli;

    public function conectar()
    {
        try {

            $this->mysqli = new mysqli('localhost', 'root', '', 'azterketa');
            if ($this->mysqli->connect_errno) {
                throw new Exception('Error al conectar: ' . $this->mysqli->connect_error);
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    
    public function validado($user, $pass)
    {

        $sql = "SELECT erab_usuario, pasahitza_contraseña FROM erabiltzaileak_usuarios WHERE erab_usuario = '$user' AND pasahitza_contraseña = '$pass';";
        $this->mysqli->query($sql);
        if ($this->mysqli->affected_rows == 1) {
            return true;
        } else {
            return false;
        }
    }
    
    public function insertar($user, $pass,$izen,$data)
    {
        $sql = "INSERT INTO erabiltzaileak_usuarios (erab_usuario, pasahitza_contraseña,izena_nombre,jaiotze_data_fecha_nacimiento) VALUES ('$user', '$pass', '$izen', '$data')";
        
        $this->mysqli->query($sql);
        if ($this->mysqli->affected_rows == 1) {
            return true;
        } else {
            return false;
        }
    }
    public function pas_berri($user, $pass,$newpass)
    {
        $sql = "UPDATE erabiltzaileak_usuarios SET pasahitza_contraseña = '$newpass' WHERE erab_usuario='$user' AND pasahitza_contraseña = '$pass';";
        $this->mysqli->query($sql);
        if ($this->mysqli->affected_rows == 1) {
            return true;
        } else {
            return false;
        }
    }
    
    public function usutipo($user, $pass)
    {
        
        $sql = "SELECT olentzero_MariDomingi FROM erabiltzaileak_usuarios WHERE erab_usuario = '$user' AND pasahitza_contraseña = '$pass';";
        $res = $this->mysqli->query($sql);
        
        while ($registro = mysqli_fetch_row($res)) {
            $tipo = $registro[0];
    
        }
        return $tipo;
    }
    public function opariak($edadescrito)
    {
        $maxiconsulta = "SELECT izena_nombre, puntuazioa_puntuacion, adina_edad FROM opariak_regalos";
        $res = $this->mysqli->query($maxiconsulta);
        
        while ($registro = mysqli_fetch_row($res)) {
            $ize = $registro[0];
            $punt = $registro[1];
            $respuesta = $registro[2];
            $opciones = explode('/', $respuesta);
            
            // Verifica si la categoría de edad buscada está presente en el array
            if (in_array($edadescrito, $opciones)) {
                $datos[$ize] = $punt;
            }
        }
        
        return $datos;
    }
    
    public function fecha($user)
    {
        
        $sql = "SELECT jaiotze_data_fecha_nacimiento FROM erabiltzaileak_usuarios WHERE erab_usuario = '$user';";
        $res = $this->mysqli->query($sql);
        
        while ($registro = mysqli_fetch_row($res)) {
            $tipo = $registro[0];
            
        }
        return $tipo;
    }
    public function comprobar_carta($user)
    {
        
        $sql = "SELECT erab_usuario FROM gutunak_cartas WHERE erab_usuario = '$user';";
        $this->mysqli->query($sql);
        if ($this->mysqli->affected_rows == 1) {
            return true;
        } else {
            return false;
        }
    }
    public function insertar_oparis($usu, $year,$pedido)
    {
        $sql = "INSERT INTO gutunak_cartas (erab_usuario, urtea,eskatutakoak_pedidos) VALUES ('$usu', '$year', '$pedido')";
        
        $this->mysqli->query($sql);
        if ($this->mysqli->affected_rows == 1) {
            return true;
        } else {
            return false;
        }
    }
    public function cambiar_gutu($eska,$user)
    {
        $sql = "UPDATE gutunak_cartas SET eskatutakoak_pedidos = '$eska' WHERE erab_usuario='$user';";
        
        $this->mysqli->query($sql);
        if ($this->mysqli->affected_rows == 1) {
            return true;
        } else {
            return false;
        }
    }
    public function cartas_elec($usu)
    {
        $sql = "SELECT eskatutakoak_pedidos FROM gutunak_cartas WHERE erab_usuario = '$usu';";
        $res = $this->mysqli->query($sql);
        while ($registro = mysqli_fetch_row($res)) {
            $tipo = $registro[0];
            
        }
        return $tipo;
    }
    public function users()
    {
        $sql = "SELECT erab_usuario FROM erabiltzaileak_usuarios WHERE erab_usuario != 'Olen';";
        $res = $this->mysqli->query($sql);
        
        $usuarios = array();
        
        while ($registro = mysqli_fetch_row($res)) {
            $usuarios[] = $registro[0];
        }
        
        return $usuarios;
    }
    public function ekintzak()
    {
        $sql = "SELECT izena_nombre, puntuak_puntuacion FROM ekintzak_acciones;";
        $res = $this->mysqli->query($sql);
        
        $datos = array(); // Inicializa un array para almacenar los datos
        
        while ($registro = mysqli_fetch_row($res)) {
            $ize = $registro[0];
            $punt = $registro[1];
            $datos[$ize] = $punt;
        }
        
        return $datos;
    }
    
    public function acciones($edadescrito)
    {
        $maxiconsulta = "SELECT izena_nombre, adina_edad, puntuak_puntuacion FROM ekintzak_acciones";
        $res = $this->mysqli->query($maxiconsulta);
        
        while ($registro = mysqli_fetch_row($res)) {
            $ize = $registro[0];
            $respuesta = $registro[1];
            $punt = $registro[2];
            $opciones = explode('/', $respuesta);
            
            // Verifica si la categoría de edad buscada está presente en el array
            if (in_array($edadescrito, $opciones)) {
                $datos[$ize] = $punt;
            }
        }
        
        return $datos;
    }
    public function cambiarpunticos($eska,$user)
    {
        $sql = "UPDATE erabiltzaileak_usuarios SET puntuazioa_puntuacion = '$eska' WHERE erab_usuario='$user';";
        
        $this->mysqli->query($sql);
        if ($this->mysqli->affected_rows == 1) {
            return true;
        } else {
            return false;
        }
    }
    public function ekinpunt($name)
    {
        $sql = "SELECT puntuak_puntuacion FROM ekintzak_acciones WHERE izena_nombre='$name'";
        $res = $this->mysqli->query($sql);
        
        while ($registro = mysqli_fetch_row($res)) {
            $tipo = $registro[0];
            
        }
        return $tipo;
    }
    public function anadirRegalo($id, $opari,$ano,$puntos)
    {
        $sql = "INSERT INTO abenduaren24_24diciembre (id_erab_usuario, opariak_regalos,urtea_año,puntuak_puntos) VALUES ('$id', '$opari', '$ano', '$puntos')";
        
        $this->mysqli->query($sql);
        if ($this->mysqli->affected_rows == 1) {
            return true;
        } else {
            return false;
        }
    }
    public function regalosusu()
    {
        $sql = "SELECT id_erab_usuario, erab_usuario, puntuazioa_puntuacion FROM erabiltzaileak_usuarios";
        $res = $this->mysqli->query($sql);
        
        $resultados = array();
        
        while ($registro = mysqli_fetch_assoc($res)) {
            $resultados[] = $registro;
        }
        
        return $resultados;
    }
    public function cartas()
    {
        $sql = "SELECT erab_usuario, eskatutakoak_pedidos FROM gutunak_cartas";
        $res = $this->mysqli->query($sql);
        
        $resultados = array();
        
        while ($registro = mysqli_fetch_assoc($res)) {
            $usuario = $registro['erab_usuario'];
            $pedidos = explode('/', $registro['eskatutakoak_pedidos']);
            $resultados[$usuario] = $pedidos;
        }
        
        return $resultados;
    }
    public function opariakeskatu($pedido)
    {
        $sql = "SELECT puntuazioa_puntuacion FROM opariak_regalos WHERE izena_nombre='$pedido'";
        $res = $this->mysqli->query($sql);
        
        $puntuaciones = array();
        
        while ($registro = mysqli_fetch_row($res)) {
            $puntuaciones[] = $registro[0];
        }
        
        return $puntuaciones;
    }
    public function comprobar_puntos($usu, $punt) {
        $sql = "SELECT * FROM erabiltzaileak_usuarios WHERE erab_usuario='$usu' AND puntuazioa_puntuacion>'$punt'";
        
        $result = $this->mysqli->query($sql);
        
        if ($result && $result->num_rows == 1) {
            return true;
        } else {
            return false;
        }
    }
    
}