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

    public function selectproductos(){ 
        $this->conectar();
        $sql = "SELECT id, nombre , precio FROM ropa";
        $resultado = $this->mysqli->query($sql);
        $filas = array();
        for ($i = 0; $i < $resultado->num_rows; $i++) {
            $fila[] = $resultado->fetch_assoc(); //Pongo en este array los datos de la consulta y lo que hace es poner en un array pongo array asociativos
        }
        return $fila;
    }
    public function agregarProducto($id, $nombre, $precio)
    {
        $this->conectar();
        
        // Verificar si el producto ya existe en la base de datos
        $sql = "SELECT nombre FROM ropa WHERE nombre = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("s", $nombre);
        $stmt->execute();
        $stmt->store_result();
        
        // Si ya existe un producto con ese nombre, mostrar un mensaje de error
        if ($stmt->num_rows > 0) {
            echo "<h1>Producto existente</h1>";
        } else {
            // Insertar el nuevo producto en la base de datos
            $sql = "INSERT INTO ropa (id, nombre, precio) VALUES (?, ?, ?)";
            $stmt = $this->mysqli->prepare($sql);
            $stmt->bind_param("sss", $id, $nombre, $precio);
            $stmt->execute();
            echo "<h1>Producto creado exitosamente</h1>";
        }
        
        $stmt->close();
        $this->mysqli->close();
    }

}