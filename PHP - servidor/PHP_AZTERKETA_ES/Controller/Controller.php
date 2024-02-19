<?php

include_once '../View/Vista.php';
include_once '../Model/UsuarioModel.php';
include_once '../Model/RopaModel.php';
include_once '../Model/PedidoModel.php';

session_start();

$Vista = new Vista();
$modelo = new UsuarioModelo();
$modelo->conectar();



if (isset($_POST["validarusuario"])) {
    if (!$_SESSION["validado"]) {
        $usuario = $_POST["username"];
        $contrasena = $_POST["password"];
        
        if (!empty($usuario) && !empty($contrasena)) {
            if ($modelo->validarSesion($usuario, $contrasena)) {
                $_SESSION["validado"] = true;
                $_SESSION['usuarioValidado'] = $usuario;

                $tipo = $modelo->obtenerTipoUsuario($usuario);

                echo 'Bienvenido<br>' . $usuario . '<br>';
                if ($admin == 0) {
                    // Actualizar la cookie de usuario si el usuario es no administrador
                    setcookie('cookie', $usuario, time() + 10); // Extendemos la cookie por 10 segundos más
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
            echo '<h3 style="color: red;">Por favor, ingresa tu usuario y contraseña.</h3>';
            $Vista->Login();
        }
    } else {
        echo '<h3 style="color: red;">Ya estás logueado.</h3>';
        $Vista->Login();
    }
}


if (isset($_POST["daralta"])) {
    $Vista->darseDeAlta();
}

if (isset($_POST["Darse_de_alta"])) {
    $modelo->agregarUsuario(
        $_POST['id'],
        $_POST['username'],
        $_POST['password'],
        $_POST['admin'],
    );
    echo '<h3 style="color: green;">Registrado correctamente.</h3>';
    $Vista->Login();
}

if (isset($_POST["cambiarcontra"])) {
    if (!$_SESSION["validado"]) {
        $usuario = $_POST["username"];
        $contrasena = $_POST["password"];
        if (!empty($usuario) && !empty($contrasena)) {
            if ($modelo->validarSesion($usuario, $contrasena)) {
                $_SESSION["validado"] = true;
                $_SESSION['usuarioValidado'] = $usuario;
                $Vista->cambiarContra();
            } else {
                echo '<h3 style="color: red;">Debes iniciar sesión para cambiar la contraseña.</h3>';
                $Vista->Login();
            }
        }
    }
}

if (isset($_POST["cambiarpass"])) {
    $cambiarcontra = true;
    if ($cambiarcontra && isset($_POST['password'])) {

        $contrasena_actualizada = $_POST['password'];

        $modelo->actualizarPass($_SESSION['usuarioValidado'], $contrasena_actualizada);
        echo '<h3 style="color: green;">Contraseña actualizada correctamente.</h3>';
        $Vista->Login();
    } else {
        echo '<h3 style="color: red;">Error.</h3>';
        $Vista->Login();
    }
}

if (!$_SESSION["validado"]) {
    echo '<h3 style="color: red;">Debes iniciar sesión para cambiar la contraseña.</h3>';
    $Vista->Login();
}

// Verificar si la cookie de usuario no está establecida
if (!isset($_COOKIE['cookie'])) {
    // La cookie no está establecida, redirigir al usuario al inicio de sesión
    header('Location: /index.php');
    exit; // Terminar el script para evitar que se procese más código
}