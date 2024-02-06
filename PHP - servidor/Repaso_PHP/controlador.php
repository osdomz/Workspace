<?php

include_once 'vista.php';
include_once 'modelo.php';
session_start();

$Vista = new vista_Tienda();
$modelo = new modelo_Tienda();
$modelo->conectar();
// Verificar si se envió el formulario de inicio de sesión
if (isset($_POST['accion'])) {
    $accion = $_POST['accion'];

    if ($accion === "iniciar") {
        if (!$_SESSION["validado"]) {
            $usuario = $_POST["login_usuario"];
            $contrasena = $_POST["login_contrasena"];

            if (!empty($usuario) && !empty($contrasena)) {
                if ($modelo->validarSesion($usuario, $contrasena)) {
                    $_SESSION["validado"] = true;
                    $_SESSION['usuarioValidado'] = $usuario;

                    // Obtener el rol del usuario desde el modelo (ajusta esto según tu modelo)
                    $rol = $modelo->obtenerRolUsuario($usuario);

                    // Escapar la salida para evitar ataques XSS
                    echo 'Bienvenido<br>' . $usuario . '<br>';

                    // Redirigir según el rol
                    if ($rol == 'admin') {
                        $Vista->opcionesAdmin();
                        exit();
                    } else {
                        // Lógica para usuarios clientes (deja esto preparado)
                        $Vista->opcionesCliente();
                    }
                } else {
                    echo 'Error, usuario o contraseña incorrectos';
                }
            } else {
                echo 'Todos los campos deben estar llenos';
            }
        } else {
            echo 'Ya has iniciado sesión';
        }
    } else {
        echo 'No se ha enviado el formulario';
    }
}
// Verificar si se ha enviado el formulario de CAPTCHA
if (isset($_POST['captcha']) && $_POST['captcha'] === 'validar') {
    // Verificar si se ha ingresado un valor para el CAPTCHA
    if (isset($_POST['captchaInput'])) {
        $captchaInput = $_POST['captchaInput']; // Obtener el texto ingresado por el usuario

        // Obtener el CAPTCHA actual
        $captchaData = $modelo->obtenerCaptcha();
        $captchaResult = $captchaData['result']; // Suponiendo que el resultado se llama 'result'

        // Verificar si el texto ingresado coincide con el resultado de la imagen CAPTCHA
        if ($captchaInput === $captchaResult) {
            // El CAPTCHA es válido, realizar acciones adicionales
            echo "¡El CAPTCHA es válido!";
        } else {
            // El CAPTCHA no es válido, mostrar un mensaje de error
            echo "¡El CAPTCHA ingresado es incorrecto!";
        }
    } else {
        // No se ha ingresado ningún valor para el CAPTCHA
        echo "¡Por favor, ingrese el texto de la imagen CAPTCHA!";
    }
}








