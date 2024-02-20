<?php

include_once '../View/Vista.php';
include_once '../Model/editorialesModel.php';
include_once '../Model/librosModel.php';
include_once '../Model/trabajadorasModel.php';

session_start();

$Vista = new Vista();
$modelo = new trabajadorasModelo();

$modelo->conectar();

// Verificar si el usuario ya está logueado
if (isset($_COOKIE['cookie']) && !isset($_SESSION['validado'])) {
    $_SESSION['validado'] = true;
    $_SESSION['usuarioValidado'] = $_COOKIE['cookie'];

    // Destruir la sesión si la cookie ha expirado
    if (!isset($_COOKIE['cookie'])) {
        session_destroy();
        header("Location: /index.php");
        exit;
    }
}

if (isset($_POST["Entrar"])) {
    if (!$_SESSION["validado"]) {
        $usuario = $_POST["username"];
        $contrasena = $_POST["password"];

        if (!empty($usuario) && !empty($contrasena)) {
            $contrasenas = $modelo->validarSesion($usuario);

            if (!empty($contrasenas)) {
                if (password_verify($contrasena, $contrasenas[$usuario])) {
                    $_SESSION["validado"] = true;
                    $_SESSION['usuarioValidado'] = $usuario;

                    $tipo = $modelo->obtenerTipoUsuario($usuario);
                    setcookie('cookie', $usuario, time() + 10, "/");
                    if ($tipo == 1) {
                        setcookie('cookie', $usuario, time() + 10, "/");
                        echo 'Bienvenido<br>' . $usuario . '<br>';
                        echo '<h3 style="color: green;">Área de Autores.</h3>';

                        $Vista->area_autor();
                    } else {
                        setcookie('cookie', $usuario, time() + 10, "/");
                        echo 'Bienvenido<br>' . $usuario . '<br>';
                        echo '<h3 style="color: green;">Área de Editores.</h3>';

                        $Vista->area_editor(); //($modelo->selectproductos());
                    }
                } else {
                    echo '<h3 style="color: red;">Inténtalo de nuevo, la contraseña no es válida.</h3>';
                    $Vista->Login();
                }
            } else {
                echo '<h3 style="color: red;">El usuario no existe.</h3>';
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

if (isset($_POST["Cambiar"])) {
    // Verificar si se proporcionaron un nombre de usuario y contraseña
    $usuario = $_POST["username"];
    $contrasena = $_POST["password"];
    if (!empty($usuario) && !empty($contrasena)) {
        // Verificar si el usuario y la contraseña son válidos
        $contrasenas = $modelo->validarSesion($usuario);
        if (!empty($contrasenas) && password_verify($contrasena, $contrasenas[$usuario])) {
            // Establecer el usuario validado en la sesión
            $_SESSION['usuarioValidado'] = $usuario;
            // Mostrar el formulario para cambiar la contraseña
            $Vista->cambiarContra();
        } else {
            // Si el usuario o la contraseña no son válidos, mostrar un mensaje de error
            echo '<h3 style="color: red;">El usuario o la contraseña no son válidos.</h3>';
            $Vista->Login();
        }
    } else {
        // Si no se proporcionó el usuario o la contraseña, mostrar un mensaje de error
        echo '<h3 style="color: red;">Por favor, ingresa tu usuario y contraseña.</h3>';
        $Vista->Login();
    }
}



if (isset($_POST["Cambiarph"])) {
    // Verificar si se puso una nueva contraseña
    $nueva_contrasena = $_POST['contra'];
    if (!empty($nueva_contrasena)) {
        // Actualizar la contraseña en la base de datos utilizando el usuario validado en la sesión
        $modelo->actualizarPass($_SESSION['usuarioValidado'], $nueva_contrasena);
        echo '<h3 style="color: green;">Contraseña actualizada correctamente.</h3>';
        $Vista->Login();
    } else {
        // si no se pone una nueva contraseña, mostrar un mensaje de error
        echo '<h3 style="color: red;">Por favor, ingresa una contraseña valida.</h3>';
        $Vista->cambiarContra(); // Mostrar nuevamente el formulario para cambiar la contraseña
    }
}

if (isset($_POST["Alta"])) {
    $Vista->nuevoUsuario();
}

if (isset($_POST["Dar_de_alta"])) {
    $modelo->agregarUsuario(
        $_POST['id'],
        $_POST['usuario'],
        $_POST['contra'],
        $_POST['nombre'],
        $_POST['nacionalidad'],
        $_POST['autor'],
    );
    echo '<h3 style="color: green;">Registrado correctamente.</h3>';
    $Vista->Login();
}

if (isset($_POST["lib_editor_ver"])) {
    //instanciamos los modelo
    $modelo = new editorialesModelo();
    $Vista->CrearTablaLibrosEditor($modelo->mostrarTodosLosLibrosInnerJoin());
    $Vista->Login();
}
if (isset($_POST["publi_lib"])) {

    $modelo = new editorialesModelo();
    $Vista->Libros($modelo->mostrarLibros());
}

if (isset($_POST["subir"])) {

    $modelo = new librosModelo();
    $Vista->SubirLibro();
}

if (isset($_POST["Subir"])) {
    $modelo = new librosModelo();
    $nombre_usuario = $_SESSION['usuarioValidado'];
    $id_usuario = $modelo->obtenerIdUsuarioPorNombre($nombre_usuario);
    $modelo->agregarLibro(
        $_POST['nombre'],
        $id_usuario,
    );
    echo '<h3 style="color: green;">Registrado correctamente.</h3>';
    $Vista->Login();
}

if (isset($_POST["lib_autor_ver"])) {

    $modelo = new librosModelo();
    $nombre_usuario = $_SESSION['usuarioValidado'];
    $id_usuario = $modelo->obtenerIdUsuarioPorNombre($nombre_usuario);
    $Vista->CrearTablaLibro($modelo->mostrarLibrosFiltrados($id_usuario));
    $Vista->Login();
    
}
