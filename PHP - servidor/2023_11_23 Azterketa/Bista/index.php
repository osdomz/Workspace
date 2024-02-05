<?php

include_once 'bista.php';
include_once 'modelo.php';

// Guarda el estado del inicio de sesión.
session_start();
$_SESSION["validado"] = FALSE;

// Cargar el formulario inicial
$VistaInicio = new Login_Bista();
$VistaInicio->Login();

echo "<p>El nombre del servidor es:  ".$_SERVER['SERVER_NAME']."</p>";
echo "<p>La direccion del servidor es:  ".$_SERVER['REMOTE_ADDR']."</p>";
echo "<p>El puerto por el que el servidor transmite la pagina es:  ".$_SERVER['SERVER_PORT']."</p>";
echo "<p>Cabecera de la peticion actual es:  ".$_SERVER['HTTP_HOST']."</p>";

 // Imprimir el valor de la cookie para depuración
 echo "Valor de la cookie 'username': " . $_COOKIE['username'];
 // Aquí puedes agregar el contenido de tu área de usuario
 echo "¡Adiós, " . $_COOKIE['username'] . "!";


