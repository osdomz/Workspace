<?php

include_once 'vista.php';
include_once 'modelo.php';

// Guarda el estado del inicio de sesión para verificar si se ha iniciado sesión correctamente.
session_start();
$_SESSION["autenticado"] = FALSE;

// Cargar el formulario inicial.
$VistaLogin = new VistaLogin;
$VistaLogin->CargarFormularioInicial();

?>
