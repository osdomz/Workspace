<?php

include_once 'vista.php';
include_once 'modelo.php';

// Guarda el estado del inicio de sesión.
session_start();
$_SESSION["autenticado"] = FALSE;

// Cargar el formulario inicial
$VistaInicio = new VistaInicioSesion;
$VistaInicio->FormularioInicioSesion();
?>

