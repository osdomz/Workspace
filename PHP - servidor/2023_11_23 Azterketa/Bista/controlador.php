<?php

session_start();

include_once 'bista.php';
include_once 'modelo.php';

$Vista = new Login_Bista;

$modelo = new Model;
$modelo->conectar();

// Comprobar el inicio de sesión, mostrar un mensaje de error y cargar el formulario nuevamente si no es válido.
if (isset($_POST['accion']) && !$_SESSION["validado"]) {
    if ($modelo->validarInicioSesion($_POST['erab_usuario'], $_POST['password_usuario'])) {
        $_SESSION["validado"] = true;
        $_SESSION["Usuario"] = $_POST['erab_usuario'];
        
        echo'Usuario validado;)';
        $Vista->Login();
    } else {
        ?>
        <h3 style="color: red;">Inténtalo de nuevo, el usuario o la contraseña no son válidos.</h3>
        <?php
       $Vista->Login();
    }
    if ($_SESSION["validado"] && isset($_POST['accion'])) {
        if (isset($_POST['accion'])) {
            switch ($_POST['accion']) {
                case "cambiar":
                    $Vista->ikusiPasahitzaAldatzeko_verCambioContras();
                    break;
                case "aldatu":
                    // Check if required data is set
                    if (isset($_POST['erab_usuario']) && isset($_POST['password_usuario'])) {
                        $modelo->actualizarPass($_POST['erab_usuario'], $_POST['password_usuario']);
                        echo "Contraseña actualizada con éxito";
                    } else {
                        echo "Error: Datos incompletos";
                    }
                    break;
                case "registrar":
                    $Vista->Alta_AukeraEman_Opcion();
                case"Ok":
                    $Vista = new Login_Bista;
                    $nombre = $_POST["izena_nombre"];
                    $usuario = $_POST["erab_usuario"];
                    $password = $_POST["ph"];
                    $fechaNac = date('Y-m-d H:i:s');
        
                    $resultado = $modelo->agregarUsuario($nombre, $usuario, $password, $fechaNac);
        
                    if ($resultado) {
                        echo "Usuario añadido con éxito";
                    } else {
                        echo "Error al añadir usuario";
                    }
                    break;             
            }
        } else {
            ?>
            <h3 style="color: red;">No has seleccionado lo que quieres hacer.</h3>
            <?php
            $Vista->ikusiPasahitzaAldatzeko_verCambioContras();
        }
    }
}

