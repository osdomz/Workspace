<?php

session_start();

include_once 'vista.php';
include_once 'modelo.php';

$VistaLogin = new VistaLogin;

$ModeloJugador = new ModeloJugador;
$ModeloJugador->conectar();

// Array asociativo de preguntas y posibles respuestas.
$juegoArray = [
    "¿Cuál es el elemento químico del oro?" => ["Fr", "Au", "Ur"],
    "¿Qué color se obtiene mezclando azul y rojo?" => ["Verde", "Morado"],
    "¿Cuánto es 4x4?" => ["7", "16", "14", "15"]
];

// Array asociativo de preguntas con sus respuestas.
$resultadosArray = [
    "¿Cuál es el elemento químico del oro?" => "Au",
    "¿Qué color se obtiene mezclando azul y rojo?" => "Morado",
    "¿Cuánto es 4x4?" => "16"
];

// Comprueba el inicio de sesión, muestra un mensaje de error y el formulario si no es válido.
if (isset($_POST['boton']) && !$_SESSION["autenticado"]) {
    if ($ModeloJugador->validarInicioSesion($_POST['usuario'], $_POST['contrasena'])) {
        $_SESSION["autenticado"] = TRUE;
        $_SESSION["Usuario"] = $_POST['usuario'];
    } else {
        ?>
        <h3 style="color: red;">Intenta de nuevo, el nombre de usuario o la contraseña no son válidos.</h3>
        <?php
        $VistaLogin->CargarFormularioInicial();
    }
}

/* Una vez que el inicio de sesión se ha verificado y se ha presionado el botón del formulario, 
   muestra la puntuación o comienza el juego. Si no se ha elegido ninguna opción, muestra un 
   error y el formulario para elegir la opción. */
if ($_SESSION["autenticado"] && isset($_POST['boton'])) {
    if (isset($_POST['opcion'])) {
        switch ($_POST['opcion']) {
            case "ranking":
                $VistaLogin->MostrarOpcion();
                $VistaLogin->Listar($ModeloJugador->listaOrdenadaPorPuntuacion());
                break;
            case "jugar":
                $VistaLogin->DibujarPreguntasRespuestas($juegoArray);
                break;
        }
    } else {
        ?>
        <h3 style="color: red;">No has elegido qué deseas hacer.</h3>
        <?php
        $VistaLogin->MostrarOpcion();
    }
}

/* Una vez que el inicio de sesión está establecido y se ha presionado el botón de jugar, 
   verifica las respuestas del juego, asigna una puntuación y actualiza esa puntuación en la 
   base de datos. */
if ($_SESSION["autenticado"] && isset($_POST['boton_jugar'])) {
    $puntos = 0;
    $contador = 0;
    foreach ($resultadosArray as $pregunta => $respuesta) {
        if ($_POST['pregunta' . $contador++] == $respuesta) {
            echo ($pregunta . " - La respuesta es " . $respuesta . ". ¡Así que es correcto, has ganado muchos puntos!<br><br>");
            $puntos += 3;
        }
    }
    echo "Has ganado " . $puntos . " puntos.<br><br>";
    $ModeloJugador->actualizarPuntuacion($_SESSION["Usuario"], $puntos);
    $VistaLogin->MostrarOpcion();
}







