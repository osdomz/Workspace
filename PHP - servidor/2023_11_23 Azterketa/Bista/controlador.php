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

if (isset($_POST['opcion'])) {
    if ($_POST['opcion'] == 'idatzi_escribir') {
        echo 'Estás aquí 2';

        // Obtener la fecha de nacimiento del usuario desde la base de datos
        $usuarioActual = $_SESSION['Usuario'];
        echo 'Usuario: ' . $usuarioActual;

        // Asegúrate de que la sesión del usuario esté configurada correctamente
        if (!empty($usuarioActual)) {
            try {
                // Obtener la fecha de nacimiento
                $fechaNacimiento = $modelo->obtenerFechaNacimientoDesdeBD($usuarioActual);

                // Obtener la cadena de fecha
                $fechaNacimientoStr = $fechaNacimiento->format('Y-m-d');
                echo 'Fecha en controller: ' . $fechaNacimientoStr;

                // Calcular la edad pasando la cadena de fecha a la función
                $edad = $modelo->calcularEdad($fechaNacimientoStr);
                echo 'Edad: ' . $edad;

                // Verificar si la carta ya se ha completado previamente
                $cartaCompletada = $modelo->verificarCartaCompletada($usuarioActual);

                if (!$cartaCompletada) {
                    // Mostrar los regalos según la edad y el grupo
                    $regalos = $modelo->obtenerRegalosSegunEdadYGrupo($fechaNacimientoStr);

                    // Muestra el formulario de regalos
                    $Vista->erakutsiOpariak_mostrarRegalos($regalos);
                } else {
                    echo 'Error: La carta ya ha sido completada previamente.';
                }
            } catch (Exception $e) {
                echo 'Error: ' . $e->getMessage();
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

// Antes de cualquier estructura condicional en tu controlador, define $regalosElegidos
$regalosElegidos = array(); // O inicializa con el valor que necesites

if (!empty($_SESSION['Usuario'])) {
    $usuarioActual = $_SESSION['Usuario'];
    // Resto de tu código...

    // Verificar si se ha enviado el formulario
    if (isset($_POST['b_eskariak_peticiones'])) {
        // Verificar si se ha seleccionado al menos un regalo
        if (isset($_POST['opariak']) && !empty($_POST['opariak'])) {
            $regalosElegidos = $_POST['opariak'];

            // Aquí deberías tener $usuarioActual y $puntosNecesarios definidos
            try {
                $puntosNecesarios = $modelo->calcularPuntosNecesarios($regalosElegidos);
                $modelo->completarCarta($usuarioActual, $regalosElegidos, $puntosNecesarios);

                // Agrega un mensaje de éxito
                echo 'La carta se completó correctamente.';
            } catch (Exception $e) {
                echo 'Error: ' . $e->getMessage();
            }
        } else {
            echo 'Error: Debes seleccionar al menos un regalo.';
        }
    }

    // Resto de tu código...
} else {
    echo 'Error: La sesión del usuario no está configurada correctamente.';
}







