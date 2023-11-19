<?php
require_once "modelo.php";

$modelo = new $model();
$datos = $modelo->obtenerDatos();

echo json_encode($datos);
?>