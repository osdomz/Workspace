<?php
session_start(); // Inicia la sesión

require_once 'modelo.php';

$servername = "localhost";
$username = "root";
$password = "";
$database = "vandier";

$modelo = new Modelo($servername, $username, $password, $database);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["accion"])) {
        switch ($_POST["accion"]) {
            case "agregarUsuario":
                $nombre = $_POST["nombre"];
                $apellido = $_POST["apellido"];
                $email = $_POST["email"];
                $password = $_POST["password"];
                $idrol = $_POST["idrol"];
                $fechaRegistro = date('Y-m-d H:i:s');

                $resultado = $modelo->agregarUsuario($nombre, $apellido, $email, $password, $fechaRegistro, $idrol);

                if ($resultado) {
                    echo "Usuario añadido con éxito";
                } else {
                    echo "Error al añadir usuario";
                }
                break;

                case "validarUsuario":
                    $usuarioValidar = $_POST["usuario_validar"];
                    $passwordValidar = $_POST["password_validar"];
                
                    $validado = $modelo->validarUsuario($usuarioValidar, $passwordValidar);
                
                    if ($validado) {
                        echo "Usuario validado con éxito";
                    } else {
                        echo "Usuario o contraseña incorrectos";
                    }
                    break;
                

                case "actualizarUsuario":
                    $idUsuarioModificar = $_POST["idActualizar"];
                    $nuevoIdRol = $_POST["nuevoIdRol"];
                
                    $resultadoModificar = $modelo->actualizarIdRol($idUsuarioModificar, $nuevoIdRol);
                
                    if ($resultadoModificar) {
                        echo "IdRol modificado con éxito";
                    } else {
                        echo "Error al modificar IdRol";
                    }
                    break;
                

            case "eliminarUsuario":
                $idUsuarioEliminar = $_POST["idEliminar"];

                $resultadoEliminar = $modelo->eliminarUsuario($idUsuarioEliminar);

                if ($resultadoEliminar) {
                    echo "Usuario eliminado con éxito";
                } else {
                    echo "Error al eliminar usuario";
                }
                break;

            // Agrega más casos según sea necesario

            default:
                echo "Acción no reconocida";
                break;
        }
    } else {
        echo "Acción no especificada";
    }
}

$modelo->cerrarConexion();
?>



