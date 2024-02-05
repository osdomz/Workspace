<?php

session_start();

include_once './View/vista.php';
include_once './Model/modelo.php';

$Vista = new Vista_Tienda();
$modelo = new Model;
$modelo->conectar();

// Verificar si se envió el formulario de inicio de sesión
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['iniciar'])) {
    // Obtener datos del formulario
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];
    // Validar inicio de sesión con el modelo
    $validado = $modelo->validarInicioSesion($usuario, $contrasena);

    // Mostrar mensaje en la vista según la validación
    if ($validado) {
        echo "Usuario validado con éxito.";
        // Puedes redirigir a otra página después de un inicio de sesión exitoso
        // header("Location: bienvenido.php");
        // exit();
    } else {
        echo "Usuario no encontrado o contraseña incorrecta.";
    }
}
