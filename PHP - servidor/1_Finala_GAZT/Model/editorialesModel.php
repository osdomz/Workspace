<?php
class editorialesModelo
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

    public function mostrarTodosLosLibrosInnerJoin() {
        $this->conectar();
        $sql = "SELECT libros.Titulo AS Titulo, personas_trabajadoras.Nombre AS NombreAutor, 
editoriales.Nombre AS NombreEditorial, libros.ISBN AS ISBN
                FROM libros
                LEFT JOIN personas_trabajadoras ON libros.AutorID = personas_trabajadoras.AutorID
                LEFT JOIN editoriales ON libros.EditorialID = editoriales.EditorialID";
        $resultado = $this->mysqli->query($sql);
        $libros = array();
        while ($fila = $resultado->fetch_assoc()) {
            $libros[] = $fila;
        }
        return $libros;
    }
    

    public function mostrarLibros()
    {
        $this->conectar();
        $sql = "SELECT personas_trabajadoras.Nombre AS nombre_autor, libros.Titulo AS titulo_libro
        FROM personas_trabajadoras 
        LEFT JOIN libros ON personas_trabajadoras.AutorID = libros.AutorID";


        $resultado = $this->mysqli->query($sql);
        $filas = array();
        while ($fila = $resultado->fetch_assoc()) {
            print_r($fila);
            $filas[] = $fila;
        }
        
        return $filas;
    }
}

