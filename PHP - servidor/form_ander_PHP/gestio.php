<?php
session_start();
$encontrado = FALSE;

$host = "localhost";
$usuario = "root";
$contraseña = "";

$nombre = $_POST["username"];
$contraseña_usuario = $_POST["password"];
$opcion_radio = isset($_POST["accion"]) ? $_POST["accion"] : "";

// Establecer la conexión con MySQL
$conexion = mysqli_connect($host, $usuario, $contraseña) or die("Error de conexión");

// Seleccionar la Base de Datos
mysqli_select_db($conexion, "erabiltzileak");

// Crear la sentencia SQL de consulta
$consulta = "SELECT user FROM erabiltzileak WHERE user = '$nombre'";

// Ejecutar la sentencia SQL
$registros = mysqli_query($conexion, $consulta);

while ($registro = mysqli_fetch_row($registros)) {
    echo "Nombre: " . $registro[0];
    echo "<p></p>";
    if ($registro[0] == $nombre) {
        $encontrado = TRUE;
    }
}

if ($encontrado) {
    if ($opcion_radio == "Baja") {
        $sql = "DELETE FROM erabiltzileak WHERE user = '$nombre' and password = '$contraseña_usuario'";
        mysqli_query($conexion, $sql);
        echo "Se ha eliminado de la base de datos";
    } elseif ($opcion_radio == "Alta") {
        echo $nombre . " ya existe en la base de datos.";
    } elseif ($opcion_radio == "Cambio") {
        echo '<form action="" method="post">
                  <label for="passwordn">Nueva contraseña:</label>
                  <input type="password" name="passwordn" required><br>
                  <input type="submit" name="cambiar" value="Cambiar">
              </form>';
        $_SESSION["user"] = $nombre;
    }
} else {
    if ($opcion_radio == "Baja") {
        echo $nombre . " no se encuentra en la base de datos";
    } elseif ($opcion_radio == "Alta") {
        $insertar = "INSERT INTO erabiltzileak (user, password) VALUES ('$nombre', '$contraseña_usuario')";
        mysqli_query($conexion, $insertar);
    } elseif ($opcion_radio == "Cambio") {
        echo "El usuario no existe en la base de datos";
    }
}

if (isset($_POST['cambiar']) && $_POST['cambiar'] == "Cambiar") {
    $usuario_sesion = $_SESSION["user"];
    $nueva_contraseña = $_POST['passwordn'];
    $sql = "UPDATE erabiltzileak SET password = '$nueva_contraseña' WHERE user = '$usuario_sesion'";
    mysqli_query($conexion, $sql);
    echo "Se ha cambiado la contraseña";
}

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>




