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
                        echo 'Estás aquí 1';

                    
                    } elseif ($olentzero_MariDomingi == 1) {
                        $Vista->AukeraEmanOlen_DarOpcionesOlen($modelo->filtrarUsuarios());
            
                    } else {
                        echo '<h3 style="color: red;">Error al obtener la información del usuario.</h3>';
                        $Vista->Login();
                
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

// ... (código previo)

if (isset($_POST['opcion'])) {
    if ($_POST['opcion'] == 'idatzi_escribir') {
        echo 'Estás aquí 2';

        // Obtener la fecha de nacimiento del usuario desde la base de datos
        $usuarioActual = $_SESSION['Usuario'];
        echo 'Usuario: ' . $usuarioActual;

        // Asegúrate de que la sesión del usuario está configurada correctamente
        if (!empty($usuarioActual)) {
            // Aquí deberías manejar la conexión a la base de datos, asegurándote de que $modelo->mysqli esté correctamente configurado
            $fechaNacimiento = $modelo->obtenerFechaNacimientoDesdeBD($usuarioActual);
            
            // Verifica si se obtuvo la fecha de nacimiento correctamente
            if ($fechaNacimiento !== false) {
                echo 'Fecha de nacimiento: ' . $fechaNacimiento->format('Y-m-d');

                // Mostrar los regalos según la edad y el grupo
                $Vista->erakutsiOpariak_mostrarRegalos($modelo->obtenerRegalosSegunEdadYGrupo($regalos));

                echo 'Número de Regalos: ' . count($regalos);
            } else {
                echo 'Error al obtener la fecha de nacimiento del usuario.';
            }
        } else {
            echo 'Error: La sesión del usuario no está configurada correctamente.';
        }
    } elseif ($_POST['opcion'] == 'aldatu_cambiar') {
        // Lógica para "aldatu_cambiar"
        // Puedes agregar aquí el código necesario para cambiar la información
    } else {
        // Manejar otras opciones si es necesario
    }
} else {
    // Manejar el caso en el que $_POST['opcion'] no está definido
}




