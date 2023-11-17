<?php

require_once 'Model.php';
require_once 'Controller.php';

$model = new Model();
$controller = new Controller($model);

if (isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'insertData':
            $name = $_POST['name'];
            $email = $_POST['email'];
            $result = $controller->insertData($name, $email);
            if ($result) {
                echo 'Datos insertados correctamente.';
            } else {
                echo 'Error al insertar datos.';
            }
            break;
        // Agrega más casos según sea necesario
    }
}

