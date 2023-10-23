<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title></title>
</head>
<body>
<?php

	// MySQL

    $servidor = 'localhost:3306';
    $usuario = 'root';
    $contraseña = '';
    $conexion = mysqli_connect($servidor, $usuario, $contraseña);
	
    if (!$conexion) {
         echo 'Conexión fallida<br>';
     }
	else{
		
		// Crear BD
		// También se puede crear desde phpMyAdmin
		$sql = "CREATE DATABASE IF NOT EXISTS erabiltzileak";
		if (mysqli_query($conexion, $sql)) {
            echo "Base de datos creada con éxito";
		} else {
            echo "Error: " . mysqli_error($conexion);
		}
		
		// Seleccionar base de datos usuarios
		mysqli_select_db($conexion, "erabiltzileak");
		
		// Crear tabla
		$sql2 = "CREATE OR REPLACE TABLE erabiltzileak(ID int AUTO_INCREMENT PRIMARY key,user VARCHAR(10),password VARCHAR(20))";  
         
         if(mysqli_query($conexion, $sql2)){  
         echo "Tabla creada con éxito";  
         } else {  
            echo "La tabla no se ha creado correctamente";  
         }  
	}
?>
</body>
</html>
