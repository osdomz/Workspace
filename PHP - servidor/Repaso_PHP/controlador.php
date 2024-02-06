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
