<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        if($_POST['usuario'] == 'desarrollador' && $_POST['contrasena'] == '1234'){//usuario y password correctos
        ?>
            <h1>Estas en el sistema</h1>
        <?php
        }else{//usuario o password incorrectos
        ?>
           <h1 style="color:red">Usuario o contraseña incorrectos</h1>
           <a href="login.php">Volver a Login</a>
        
        <?php
        }
        ?>
    </body>
</html>
