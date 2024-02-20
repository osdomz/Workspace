<?php

include_once './View/Vista.php';
include_once './Model/trabajadorasModel.php';

// Guarda el estado del inicio de sesión.
session_start();
$_SESSION["validado"] = FALSE;

// Cargar el formulario inicial
$VistaInicio = new Vista();
$VistaInicio->Login();