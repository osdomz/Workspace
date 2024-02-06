<?php

include_once 'vista.php';
include_once 'modelo.php';

// Guarda el estado del inicio de sesión.
session_start();
$_SESSION["validado"] = FALSE;

// Cargar el formulario inicial
$vistaInicio = new vista_Tienda();
$vistaInicio->Login();

echo "<p>El nombre del servidor es:  ".$_SERVER['SERVER_NAME']."</p>";
echo "<p>La direccion del servidor es:  ".$_SERVER['REMOTE_ADDR']."</p>";
echo "<p>El puerto por el que el servidor transmite la pagina es:  ".$_SERVER['SERVER_PORT']."</p>";
echo "<p>Cabecera de la peticion actual es:  ".$_SERVER['HTTP_HOST']."</p>";