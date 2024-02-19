<?php
class PedidoModelo
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

    public function mostrarPedidosInnerJoin()
{
    $this->conectar();
    $sql = "SELECT usuarios.nombre AS nombre_cliente, COALESCE(ropa.nombre, '-') AS nombre_producto, COALESCE(pedidos.cantidad, 0) AS cantidad
            FROM usuarios 
            LEFT JOIN pedidos ON usuarios.id = pedidos.id_usuario 
            LEFT JOIN ropa ON pedidos.id_ropa = ropa.id";
    $resultado = $this->mysqli->query($sql);
    $filas = array();
    while ($fila = $resultado->fetch_assoc()) {
        $filas[] = $fila;
    }
    return $filas;
}

public function agregarPedido($id_usuario, $id_ropa, $cantidad)
{
    $this->conectar();
    // Aquí concatenamos los valores directamente en la cadena SQL
    $sql = "INSERT INTO pedidos (id_usuario, id_ropa, cantidad) VALUES ('$id_usuario', '$id_ropa', '$cantidad')";
    $this->mysqli->query($sql);
}
public function obtenerIdProductopornombre($nombre_producto)
{
    $this->conectar();
    
    // Preparar la consulta SQL
    $sql = "SELECT id FROM ropa WHERE nombre = '$nombre_producto'";
    
    // Ejecutar la consulta
    $resultado = $this->mysqli->query($sql);
    
    // Obtener el ID de producto si existe
    if ($resultado && $resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
        return $fila['id'];
    } else {
        return null; // El producto no existe
    }
}

public function obtenerIdUsuarioPorNombre($nombre_usuario)
{
    $this->conectar();
    
    // Preparar la consulta SQL
    $sql = "SELECT id FROM usuarios WHERE nombre = '$nombre_usuario'";
    
    // Ejecutar la consulta
    $resultado = $this->mysqli->query($sql);
    
    // Obtener el ID de usuario si existe
    if ($resultado && $resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
        return $fila['id'];
    } else {
        return null; // El usuario no existe
    }
}

}
// public function mostrarPedidosInnerJoin()
// {
//     $this->conectar();
//     $sql = "SELECT usuarios.nombre AS nombre_cliente, ropa.nombre AS nombre_producto, pedidos.cantidad 
//             FROM pedidos 
//             INNER JOIN usuarios ON pedidos.id_usuario = usuarios.id 
//             INNER JOIN ropa ON pedidos.id_ropa = ropa.id";
//     $resultado = $this->mysqli->query($sql);
//     $filas = array();
//     while ($fila = $resultado->fetch_assoc()) {
//         $filas[] = $fila;
//     }
//     return $filas;
// }
// }