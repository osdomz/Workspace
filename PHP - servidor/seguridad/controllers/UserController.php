<?php
// controllers/UserController.php

require_once('models/UserModel.php');

class UserController {
    private $model;

    public function __construct($conn) {
        $this->model = new UserModel($conn);
    }

    public function loginUser($email, $password) {
        $user = $this->model->getUserByEmail($email);

        if ($user && password_verify($password, $user['Contrasena'])) {
            // Iniciar sesión y establecer cookies si el login es exitoso
            $_SESSION['UsuarioID'] = $user['UsuarioID'];
            $_SESSION['Nombre'] = $user['Nombre'];
            // Otras acciones necesarias

            return true;
        } else {
            return false;
        }
    }
}


