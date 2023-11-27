<?php

include_once 'bista.php';
include_once 'modelo.php';

// Guarda el estado del inicio de sesión.
session_start();
$_SESSION["validado"] = FALSE;

// Cargar el formulario inicial
$VistaInicio = new Login_Bista();
$VistaInicio->Login();