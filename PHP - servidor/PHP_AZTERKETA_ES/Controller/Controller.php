<?php

include_once '../View/Vista.php';
include_once '../Model/UsuarioModel.php';
include_once '../Model/RopaModel.php';
include_once '../Model/PedidoModel.php';

session_start();

$Vista = new Vista();
$modelo = new UsuarioModelo();
$modelo->conectar();

if (!isset($_POST['accion'])) {
    exit; // Salir si no hay acción
}

$accion = $_POST['accion'];

if ($accion === "Validar") {
    validarSesion($modelo, $Vista);
} elseif ($accion === "Alta") {
    mostrarFormularioAlta($Vista);
} elseif ($accion === "Darse_de_alta") {
    procesarAltaUsuario($modelo, $Vista);
} elseif ($accion === "Cambiar") {
    verificarSesionCambiarContrasena($modelo, $Vista);
} elseif ($accion === "cambiarpass") {
    procesarCambioContrasena($modelo, $Vista);
}

function validarSesion($modelo, $Vista) {
    if (!$_SESSION["validado"]) {
        $usuario = $_POST["username"];
        $contrasena = $_POST["password"];

        if (!empty($usuario) && !empty($contrasena)) {
            if ($modelo->validarSesion($usuario, $contrasena)) {
                $_SESSION["validado"] = true;
                $_SESSION['usuarioValidado'] = $usuario;

                $admin = $modelo->obtenerTipoUsuario($usuario);

                echo 'Bienvenido<br>' . $usuario . '<br>';

                $admin = $modelo->obtenerTipoUsuario($_SESSION['usuarioValidado']);
                if ($admin == 0) {
                    echo '<h3 style="color: green;">Área de usuarios.</h3>';
                    $modelo = new RopaModelo();
                    $Vista->area_usuario($modelo->obtenerProductosDesdeBD());

                } elseif ($admin == 1) {
                    echo '<h3 style="color: green;">Área de Admin.</h3>';
                    $Vista->area_usuario_admin();
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
    }
}

function mostrarFormularioAlta($Vista) {
    $Vista->darseDeAlta();
}

function procesarAltaUsuario($modelo, $Vista) {
    $modelo->agregarUsuario(
        $_POST['id'],
        $_POST['username'],
        $_POST['password'],
        $_POST['admin'],
    );
    echo '<h3 style="color: green;">Registrado correctamente.</h3>';
    $Vista->Login();
}

function verificarSesionCambiarContrasena($modelo, $Vista) {
    if (!$_SESSION["validado"]) {
        $usuario = $_POST["username"];
        $contrasena = $_POST["password"];
        if (!empty($usuario) && !empty($contrasena)) {
            if ($modelo->validarSesion($usuario, $contrasena)) {
                $Vista->cambiarContra();
                return; // Salir de la función después de mostrar el formulario
            }
        }
        // Mostrar mensaje de error
        echo '<h3 style="color: red;">Debes iniciar sesión para cambiar la contraseña.</h3>';
        $Vista->Login();
    }
}

function procesarCambioContrasena($modelo, $Vista) {
    $cambiarpass = true;
    if ($cambiarpass && isset($_POST['password'])) {
        $contrasena_actualizada = $_POST['password'];
        $modelo->actualizarPass($_SESSION['usuarioValidado'], $contrasena_actualizada);
        echo '<h3 style="color: green;">Contraseña actualizada correctamente.</h3>';
        $Vista->Login();
    } else {
        // Mostrar mensaje de error
        echo '<h3 style="color: red;">Error.</h3>';
        $Vista->Login();
    }
}
