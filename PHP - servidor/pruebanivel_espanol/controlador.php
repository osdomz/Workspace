<?php

session_start();

include_once 'vista.php';
include_once 'modelo.php';

$Vista = new VistaLogin;

$modelo = new ModeloJugador;
$modelo->conectar();

// Array asociativo de preguntas y posibles respuestas.
$preguntas_respuestas = [
    "¿Cuál es el elemento químico del oro?" => array("Fr", "Au", "Ur"),
    "¿Qué se obtiene de la mezcla de azul y rojo?" => array("Verde", "Morado"),
    "¿Cuánto es 4x4?" => array("7", "16", "14", "15")
];

// Array asociativo de preguntas y sus respuestas.
$respuestas_correctas = [
    "¿Cuál es el elemento químico del oro?" => "Au",
    "¿Qué se obtiene de la mezcla de azul y rojo?" => "Morado",
    "¿Cuánto es 4x4?" => "16"
];

// Comprobar el inicio de sesión, mostrar un mensaje de error y cargar el formulario nuevamente si no es válido.
if (isset($_POST['boton']) && !$_SESSION["validado"]) {
    if ($modelo->validar($_POST['usuario'], $_POST['clave'])) {
        $_SESSION["validado"] = true;
        $_SESSION["Usuario"] = $_POST['usuario'];
    } else {
        ?>
        <h3 style="color: red;">Inténtalo de nuevo, el usuario o la contraseña no son válidos.</h3>
        <?php
        $Vista->CargarFormularioInicial();
    }
}

// Una vez iniciada la sesión y enviado el botón del formulario, según la opción elegida, mostrará la puntuación o el juego.
// Si no se ha elegido ninguna opción, mostrará un error y el formulario para hacer una elección.
if ($_SESSION["validado"] && isset($_POST['boton'])) {
    if (isset($_POST['opcion'])) {
        switch ($_POST['opcion']) {
            case "puntuacion":
                $Vista->ElegirOpcion();
                $Vista->MostrarPuntuaciones($modelo->obtenerPuntuacionesOrdenadas());
                break;
            case "jugar":
                $Vista->MostrarPreguntas($preguntas_respuestas);
                break;
        }
    } else {
        ?>
        <h3 style="color: red;">No has seleccionado lo que quieres hacer.</h3>
        <?php
        $Vista->ElegirOpcion();
    }
}

// Una vez iniciada la sesión y enviado el botón de juego, se validan las respuestas, se asigna la puntuación y se actualiza en la base de datos.
if ($_SESSION["validado"] && isset($_POST['boton_jugar'])) {
    $puntos = 0;
    $contador = 0;
    foreach ($respuestas_correctas as $pregunta => $respuesta) {
        if ($_POST['pregunta' . $contador++] == $respuesta) {
            echo ($pregunta . " la respuesta es " . $respuesta . ". Por lo tanto, has obtenido puntos. <br><br>");
            $puntos = $puntos + 3;
        }
    }
    echo "Has obtenido " . $puntos . " puntos. <br><br>";
    $modelo->actualizarPuntuacion($_SESSION["Usuario"], $puntos);
    $Vista->ElegirOpcion();
}








