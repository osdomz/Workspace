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
            $contrasenas = $modelo->validarSesion($usuario);

            if (!empty($contrasenas)) {
                if (password_verify($contrasena, $contrasenas[$usuario])) {
                    $_SESSION["validado"] = true;
                    $_SESSION['usuarioValidado'] = $usuario;

                    $tipo = $modelo->obtenerTipoUsuario($usuario);

                    if ($tipo == 1) {
                        setcookie('cookie', $usuario, time() + 10, "/");
                        echo 'Bienvenido<br>' . $usuario . '<br>';
                        echo '<h3 style="color: green;">Área de Admin.</h3>';
                        $modelo = new UsuarioModelo();
                        $Vista->area_usuario_admin();
                    } else {
                        setcookie('username', $usuario, time() + 10, "/");
                        echo 'Bienvenido<br>' . $usuario . '<br>';
                        echo '<h3 style="color: green;">Área de usuarios.</h3>';
                        $modelo = new RopaModelo();
                        $Vista->area_usuario($modelo->selectproductos());
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


if (isset($_POST["daralta"])) {
    $Vista->darseDeAlta();
}

if (isset($_POST["Darse_de_alta"])) {
    $modelo->agregarUsuario(
        $_POST['id'],
        $_POST['nombre'],
        $_POST['contra'],
        $_POST['admin'],
    );
    echo '<h3 style="color: green;">Registrado correctamente.</h3>';
    $Vista->Login();
}

if (isset($_POST["cambiarcontra"])) {
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



if (isset($_POST["cambiarpass"])) {
    // Verificar si se proporcionó una nueva contraseña
    $nueva_contrasena = $_POST['contra'];
    if (!empty($nueva_contrasena)) {
        // Actualizar la contraseña en la base de datos utilizando el usuario validado en la sesión
        $modelo->actualizarPass($_SESSION['usuarioValidado'], $nueva_contrasena);
        echo '<h3 style="color: green;">Contraseña actualizada correctamente.</h3>';
        $Vista->Login();
    } else {
        // Si no se proporcionó una nueva contraseña, mostrar un mensaje de error
        echo '<h3 style="color: red;">Por favor, ingresa una contraseña valida.</h3>';
        $Vista->cambiarContra(); // Mostrar nuevamente el formulario para cambiar la contraseña
    }
}

if (isset($_POST["Productos"])) {
    // Aquí deberías crear una instancia de RopaModelo
    $modelo = new RopaModelo();
    $Vista->crearProducto();
}

if (isset($_POST["Crear_Producto"])) {
    // Aquí también necesitas crear una instancia de RopaModelo
    $modelo = new RopaModelo();

    // Verificar si se enviaron todos los datos del formulario
    $modelo->agregarProducto(
        $_POST['id_producto'],
        $_POST['nombre'],
        $_POST['precio']
    );
    echo '<h3 style="color: green;">Producto añadido correctamente.</h3>';
    $Vista->Login();
}

if (isset($_POST["Pedidos"])) {
    // Aquí deberías crear una instancia de PedidoModelo
    $modelo = new PedidoModelo();
    $Vista->generarTablaPedidos($modelo->mostrarPedidosInnerJoin());
}

if (isset($_POST["Comprar"])) {
    // Aquí creas una instancia de PedidoModelo
    $modelo = new PedidoModelo();
    // Obtener el ID de usuario usando el nombre de usuario
    $nombre_usuario = $_SESSION['usuarioValidado'];
    $id_usuario = $modelo->obtenerIdUsuarioPorNombre($nombre_usuario); // Asegúrate de implementar este método en tu modelo
    $id_producto = $_POST['productos'];
    $numeros = $_POST['numeros'];
    // Llamar al método agregarPedido con el ID de usuario obtenido
    $modelo->agregarPedido(
        $id_usuario,
        $id_producto,
        $numeros
    );

    echo '<h3 style="color: green;">Pedido añadido correctamente.</h3>';
    $Vista->Login();
} else {
    echo '<h3 style="color: red;">El ID de usuario no es válido.</h3>';
    // Manejar el caso en que el ID de usuario no es válido
}
