<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Operaciones de Usuario</title>
</head>
<body>
    <h2>Operaciones de Usuario</h2>

    <?php
function formularioValidarUsuario()
{
    echo '<form action="controlador.php" method="post">
            <label for="nombre_validar">Nombre:</label>
            <input type="text" name="nombre_validar" required>
            <br>

            <label for="password_validar">Contraseña:</label>
            <input type="password" name="password_validar" required>
            <br>

            <input type="submit" name="accion" value="validarUsuario">
        </form>';
}


    function formularioAgregarUsuario()
    {
        echo '<form action="controlador.php" method="post">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" required>
                <br>

                <label for="apellido">Apellido:</label>
                <input type="text" name="apellido" required>
                <br>

                <label for="email">Email:</label>
                <input type="email" name="email" required>
                <br>

                <label for="password">Contraseña:</label>
                <input type="password" name="password" required>
                <br>

                <label for="idrol">Rol (1 o 2):</label>
                <input type="number" name="idrol" required min="1">
                <br>

                <input type="submit" name="accion" value="agregarUsuario">
            </form>';
    }

    function formularioActualizarUsuario()
    {
        echo '<form action="controlador.php" method="post">
                <label for="idActualizar">ID del usuario a actualizar:</label>
                <input type="number" name="idActualizar" required min="1">
                <br>
    
                <label for="nuevoIdRol">Nuevo idrol:</label>
                <input type="number" name="nuevoIdRol" required min="1">
                <input type="submit" name="accion" value="actualizarUsuario"> <!-- Ajuste aquí -->
            </form>';
    }
    


    function formularioEliminarUsuario()
    {
        echo '<form action="controlador.php" method="post">
                <label for="idEliminar">ID del usuario a eliminar:</label>
                <input type="number" name="idEliminar" required min="1">
                <input type="submit" name="accion" value="eliminarUsuario">
            </form>';
    }
    ?>

    <!-- Llama a las funciones según sea necesario -->
    <?php formularioValidarUsuario(); ?>
    <br><br>
    <?php formularioAgregarUsuario(); ?>
    <br><br>
    <?php formularioActualizarUsuario(); ?>
    <br><br>
    <?php formularioEliminarUsuario(); ?>
</body>
</html>




