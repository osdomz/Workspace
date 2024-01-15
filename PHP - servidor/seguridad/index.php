<?php
// index.php

// Autoload para cargar clases automáticamente
spl_autoload_register(function ($className) {
    require_once "controllers/$className.php";
    require_once "models/$className.php";
});

// Iniciar la sesión
session_start();

// Enrutamiento
$action = isset($_GET['action']) ? $_GET['action'] : 'login';
$userController = new UserController();

switch ($action) {
    case 'login':
        $userController->login();
        break;
    case 'signup':
        $userController->signup();
        break;
    case 'dashboard':
        // Asegurarse de que el usuario esté autenticado
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?action=login');
            exit();
        }
        include('../views/dashboard.php');
        break;
    case 'logout':
        $userController->logout();
        break;
    default:
        echo 'Ruta no válida';
}




