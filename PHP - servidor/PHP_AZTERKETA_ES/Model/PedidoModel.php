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

    public function mostrarPedidos()
    {
        $sql = "SELECT * FROM pedidos";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $pedidos = array();
        while ($row = $result->fetch_assoc()) {
            $pedidos[$row['id']] = $row['nombre'];
        }
        $stmt->close();
        echo 'Pedidos: ' . print_r($pedidos, true);
        return $pedidos;
    }
}