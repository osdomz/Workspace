<?php
class librosModelo
{
    private $mysqli;

    // Función para realizar la conexión
    public function conectar()
    {
        try {
            $this->mysqli = new mysqli('localhost', 'root', '', 'editorial');
            if ($this->mysqli->connect_errno) {
                throw new Exception('Error en conexión: ' . $this->mysqli->connect_error);
            }
        } catch (Exception $e) {
            throw $e;
        }
    }
    public function mostrarLibrosFiltrados($autorID) {
        $this->conectar();
        $sql = "SELECT libros.Titulo AS nombre_libro, COALESCE(libros.AñoPublicacion, '-') AS año_publicacion, 
COALESCE(editoriales.Nombre, '-') AS nombre_editorial, COALESCE(libros.ISBN, '-') AS ISBN
                FROM libros
                LEFT JOIN editoriales ON libros.EditorialID = editoriales.EditorialID
                WHERE libros.AutorID = $autorID";
        $resultado = $this->mysqli->query($sql);
        $libros = array();
        while ($fila = $resultado->fetch_assoc()) {
            $libros[] = $fila;
        }
        return $libros;
    }
    public function obtenerIdUsuarioPorNombre($usuario)
    {
        $this->conectar();
        $sql = "SELECT AutorID FROM personas_trabajadoras WHERE Usuario = '$usuario'";
        
        $resultado = $this->mysqli->query($sql);
        // Obtener el ID de usuario si existe
        if ($resultado && $resultado->num_rows > 0) {
            $fila = $resultado->fetch_assoc();
            return $fila['AutorID'];
        } else {
            return null; 
        }
    }
    public function agregarLibro($Titulo, $AutorID)
{
    $this->conectar();
    // Aquí concatenamos los valores directamente en la cadena SQL
    $sql = "INSERT INTO libros (Titulo, AutorID) VALUES ('$Titulo', '$AutorID')";
    $this->mysqli->query($sql);
}

}

