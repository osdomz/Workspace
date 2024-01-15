<?php
// controllers/UserController.php

require_once(__DIR__ . '/../models/UserModel.php');


class UserController
{
    public function login()
    {
        // Lógica de inicio de sesión
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $userModel = new UserModel();
            $user = $userModel->getUserByEmail($email);

            if ($user && password_verify($password, $user['Contrasena'])) {
                // Iniciar sesión y redirigir a dashboard
                session_start();
                $_SESSION['user_id'] = $user['UsuarioID'];
                header('Location: dashboard.php');
                exit();
            } else {
                echo 'Credenciales incorrectas';
            }
        }

        // Mostrar formulario de inicio de sesión
        include('../views/login.php');
    }

    public function signup()
    {
        // Lógica de registro de usuario
    }

    public function logout()
    {
        // Lógica de cierre de sesión
    }
}
