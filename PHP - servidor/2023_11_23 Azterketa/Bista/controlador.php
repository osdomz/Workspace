<?php

session_start();

include_once 'bista.php';
include_once 'modelo.php';

$Vista = new Login_Bista;
$modelo = new Model;
$modelo->conectar();

if (isset($_POST['accion'])) {
    switch ($_POST['accion']) {
        case "entrar":
            if (!$_SESSION["validado"]) {
                // Validar el inicio de sesión
                if ($modelo->validarInicioSesion($_POST['erab_usuario'], $_POST['password_usuario'])) {
                    $_SESSION["validado"] = true;
                    $_SESSION["Usuario"] = $_POST['erab_usuario'];
                    echo '<h3 style="color: green;">Bienvenido ' . $_POST['erab_usuario'] . ' </h3>';

                    // Obtener el valor de olentzero_MariDomingi desde la base de datos
                    $olentzero_MariDomingi = $modelo->balioztatuOlentzero($_SESSION['Usuario']);

                    // Redirigir a la vista correspondiente
                    if ($olentzero_MariDomingi == 0) {
                        $Vista->AukeraEmanErab_DarOpcionesUsuario();

                        // Verificar si se seleccionó "Gutuna idatzi / Escribir carta"
                        if (isset($_POST['opcion']) && $_POST['opcion'] == 'idatzi_escribir') {
                            // Lógica relacionada con 'idatzi_escribir'
                            if (isset($_POST['b_gutuna_carta'])) {
                                // Lógica después de hacer clic en el botón 'Ok'
                                $Vista->erakutsiOpariak_mostrarRegalos($modelo->obtenerRegalosSegunEdadYGrupo($fechaNacimiento));
                                exit; // Evitar que se ejecute más código después de la redirección
                            }
                        } elseif (isset($_POST['opcion']) && $_POST['opcion'] == 'aldatu_cambiar') {
                            // Lógica para "aldatu_cambiar"
                        }
                    
                    } elseif ($olentzero_MariDomingi == 1) {
                        $Vista->AukeraEmanOlen_DarOpcionesOlen($modelo->filtrarUsuarios());
                    } else {
                        echo '<h3 style="color: red;">Error al obtener la información del usuario.</h3>';
                    }
                } else {
                    echo '<h3 style="color: red;">Inténtalo de nuevo, el usuario o la contraseña no son válidos.</h3>';
                    $Vista->Login();
                }
            } else {
                echo '<h3 style="color: red;">Ya estás logueado.</h3>';
                $Vista->Login();
            }
            break;


        case "cambiar":
            if ($_SESSION["validado"]) {
                $Vista->ikusiPasahitzaAldatzeko_verCambioContras();
            } else {
                echo '<h3 style="color: red;">Debes iniciar sesión para cambiar la contraseña.</h3>';
                $Vista->Login();
            }
            break;

        case "aldatu":
            if ($_SESSION["validado"]) {
                $aldatu = true;
                if ($aldatu) {
                    if (isset($_POST['ph'])) {
                        // Actualizar la contraseña en la base de datos
                        $contrasena_actualizada = $_POST['ph'];
                        // Aquí deberías realizar las validaciones y hashing adecuados
                        $modelo->actualizarPass($_SESSION['Usuario'], $contrasena_actualizada);
                        echo '<h3 style="color: green;">Contraseña actualizada correctamente.</h3>';
                        $Vista->Login();
                    } else {
                        echo '<h3 style="color: red;">Error.</h3>';
                        $Vista->Login();
                    }
                }
            } else {
                echo '<h3 style="color: red;">Debes iniciar sesión para cambiar la contraseña.</h3>';
                $Vista->Login();
            }
            break;

        case "registrar":
            $Vista->Alta_AukeraEman_Opcion();
            break;
        case "Ok":
            $modelo->agregarUsuario(
                $_POST['izena_nombre'],
                $_POST['erab_usuario'],
                $_POST['ph'],
                $_POST['data_fecha']
            );
            echo '<h3 style="color: green;">Registrado correctamente.</h3>';
            $Vista->Login();
            break;

        default:
            echo '<h3 style="color: red;">No has seleccionado lo que quieres hacer.</h3>';
            $Vista->Login();
            break;
    }
}
