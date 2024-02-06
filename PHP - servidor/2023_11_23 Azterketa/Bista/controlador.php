<?php

session_start();

include_once 'bista.php';
include_once 'modelo.php';

$Vista = new Login_Bista;
$modelo = new Model;
$modelo->conectar();

if (isset($_POST['accion'])) {
    $accion = $_POST['accion'];

    if ($accion === "entrar") {
        if (!$_SESSION["validado"]) {
            // Validar el inicio de sesión
            $submittedUsername = $_POST['erab_usuario'];
            $submittedPassword = $_POST['password_usuario'];

            if ($modelo->validarInicioSesion($submittedUsername, $submittedPassword)) {
                $_SESSION["validado"] = true;
                $_SESSION["Usuario"] = $submittedUsername;
                echo '<h3 style="color: green;">Bienvenido ' . $submittedUsername . ' </h3>';


                // Obtener el valor de olentzero_MariDomingi desde la base de datos
                $olentzero_MariDomingi = $modelo->balioztatuOlentzero($_SESSION['Usuario']);

                // Redirigir a la vista correspondiente
                if ($olentzero_MariDomingi == 0) {
                    $Vista->AukeraEmanErab_DarOpcionesUsuario();
                    echo 'Estás aquí 1';
                } elseif ($olentzero_MariDomingi == 1) {

                    $Vista->AukeraEmanOlen_DarOpcionesOlen($modelo->filtrarUsuarios());
                    echo 'Estás aquí 2';
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
    } elseif ($accion === "cambiar") {
        if ($_SESSION["validado"]) {
            $Vista->ikusiPasahitzaAldatzeko_verCambioContras();
        } else {
            echo '<h3 style="color: red;">Debes iniciar sesión para cambiar la contraseña.</h3>';
            $Vista->Login();
        }
    } elseif ($accion === "aldatu") {
        if ($_SESSION["validado"]) {
            $aldatu = true;
            if ($aldatu && isset($_POST['ph'])) {
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
        } else {
            echo '<h3 style="color: red;">Debes iniciar sesión para cambiar la contraseña.</h3>';
            $Vista->Login();
        }
    } elseif ($accion === "registrar") {
        $Vista->Alta_AukeraEman_Opcion();
    } elseif ($accion === "Ok") {
        $modelo->agregarUsuario(
            $_POST['izena_nombre'],
            $_POST['erab_usuario'],
            $_POST['ph'],
            $_POST['data_fecha']
        );
        echo '<h3 style="color: green;">Registrado correctamente.</h3>';
        $Vista->Login();
    } else {
        echo '<h3 style="color: red;">No has seleccionado lo que quieres hacer.</h3>';
        $Vista->Login();
    }
}

if (isset($_POST['opcion'])) {
    $opcion = $_POST['opcion'];

    if ($opcion == 'idatzi_escribir') {
        echo 'Estás aquí 3';

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
    } elseif ($opcion == 'aldatu_cambiar') {
        // Lógica para "aldatu_cambiar"
        // Puedes agregar aquí el código necesario para cambiar la información

        // Obtener el usuario actual de la sesión
        $usuarioActual = $_SESSION['Usuario'];

        // Verificar si el usuario tiene una carta creada
        $cartaCompletada = $modelo->verificarCartaCompletada($usuarioActual);

        if ($cartaCompletada) {
            // El usuario tiene una carta creada, permitir cambios

            try {
                // Obtener la fecha de nacimiento del usuario desde la base de datos
                $fechaNacimiento = $modelo->obtenerFechaNacimientoDesdeBD($usuarioActual);
                $fechaNacimientoStr = $fechaNacimiento->format('Y-m-d');

                // Mostrar los regalos según la edad y el grupo
                $regalos = $modelo->obtenerRegalosSegunEdadYGrupo($fechaNacimientoStr);

                // Muestra el formulario de regalos
                $Vista->erakutsiOpariak_mostrarRegalos($regalos);

                // Verificar si se han enviado nuevos datos desde el formulario
                if (isset($_POST['nuevos_datos'])) {
                    // Obtener los nuevos datos del formulario después de que el usuario selecciona los regalos
                    $nuevosDatos = $_POST['nuevos_datos'];

                    // Actualizar la información en la base de datos con los nuevos datos
                    $modelo->cambiarRegaloCarta($usuarioActual, $nuevosDatos);

                    echo 'La información de la carta ha sido actualizada correctamente.';
                } else {
                    echo 'Por favor, selecciona nuevos regalos antes de actualizar la información.';
                }
            } catch (Exception $e) {
                echo 'Error al actualizar la información de la carta: ' . $e->getMessage();
            }
        } else {
            // El usuario no tiene carta creada, mostrar mensaje
            echo 'No tienes cartas creadas. Por favor, crea una carta antes de realizar cambios.';
        }
    } else {
        // Manejar otras opciones si es necesario
    }
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

            // Aquí deberías tener $usuarioActual y $puntosNecesarios defin
            try {
                $puntosNecesarios = $modelo->calcularPuntosNecesarios($regalosElegidos);
                $modelo->completarCarta($usuarioActual, $regalosElegidos);
                // Agrega un mensaje de éxito
                echo 'La carta se completó correctamente.';
            } catch (Exception $e) {
                echo 'Error: ' . $e->getMessage();
            }
        } else {
            echo 'Error: Debes seleccionar al menos un regalo.';
        }
    }
} else {
    echo 'Error: La sesión del usuario no está configurada correctamente.';
}
if (isset($_POST['b_erabAukeratu_elegirUsuario'])) {
    // Asegúrate de que se haya seleccionado al menos un usuario
    if (isset($_POST['Erab_usuario'])) {
        // Obtén el ID del usuario seleccionado
        $selectedUserID = $_POST['Erab_usuario'];
        $_SESSION["Erab_usuario"] = $selectedUserID;
        // Después de enviar el formulario, imprime los valores de $_POST para depurar
        var_dump($_POST);

        // Ahora, puedes continuar con la lógica para mostrar las acciones del usuario seleccionado
        try {
            // Obtener la fecha de nacimiento del usuario desde la base de datos
            $fechaNacimiento = $modelo->obtenerFechaNacimientoDesdeBD($selectedUserID);
            $fechaNacimiento = $fechaNacimiento->format('Y-m-d');

            // Obtener las acciones según la fecha de nacimiento y grupo de edad
            $acciones = $modelo->obtenerAccionesSegunEdadYGrupo($fechaNacimiento);

            // Mostrar las acciones en la vista
            $Vista->EkintzakBistaratu_VisualizarAcciones($acciones);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
            // Manejar el error según tus necesidades
        }
    } else {
        // Manejar el caso en que no se ha seleccionado ningún usuario
        echo 'Error: Debes seleccionar un usuario.';
        // Puedes redirigir al usuario a la página anterior o realizar otra acción necesaria.
    }
}
// Actualizar la puntuación de acciones si se envió el formulario de acciones
if (isset($_POST['b_ekintzak_acciones'])) {
    // Obtener el ID del usuario seleccionado
    $selectedUserID = $_SESSION['Erab_usuario'];

    // Obtener las acciones seleccionadas
    $selectedActions = $_POST['ekintzak'];

    // Restar la puntuación de las acciones al usuario
    $modelo->restarPuntuacionAccionesAlUsuario($selectedUserID, $selectedActions);

    echo 'Puntuación actualizada correctamente.';
    // Puedes agregar redirección o mensajes de éxito aquí si es necesario
}



var_dump($_POST);
var_dump($_SESSION);
var_dump($_COOKIE);
