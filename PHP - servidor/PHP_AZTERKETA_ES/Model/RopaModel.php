<?php
class RopaModelo
{
    private $mysqli;

    // Función para realizar la conexión
    public function conectar()
    {
        try {
            $this->mysqli = new mysqli('localhost', 'root', '', 'tienda_ropa');
            if ($this->mysqli->connect_errno) {
                throw new Exception('Error en conexión: ' . $this->mysqli->connect_error);
            }
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function obtenerTipoUsuario($usuario)
    {

        $sql = "SELECT nombre FROM  usuarios WHERE nombre='$usuario' AND admin = '1'";
        $this->mysqli->query($sql);
        if ($this->mysqli->affected_rows == 1) {
            return true;
        } else {
            return  false;
        }
    }

    public function obtenerProductosDesdeBD()
    {
        $sql = "SELECT * FROM ropa";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $productos = array();
        while ($row = $result->fetch_assoc()) {
            $productos[$row['id']] = $row['nombre'];
        }
        $stmt->close();
        echo 'Productos: ' . print_r($productos, true);
        return $productos;
    }
    public function crearProducto($id, $nombre, $precio)
    {
        $sql = "INSERT INTO ropa (id, nombre, precio) VALUES (?, ?, ?)";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param('isi',$id , $nombre, $precio);
        
        return $stmt->execute();
    }

}