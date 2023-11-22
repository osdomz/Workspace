<!DOCTYPE html>
<html>
<head>
    <title>Formulario</title>
</head>
<body>
    <form method="POST" action="procesar.php">
        <label for="usuario">Usuario:</label>
        <input type="text" id="usuario" name="usuario" required><br><br>
        
        <label for="contrasena">Contraseña:</label>
        <input type="password" id="contrasena" name="contrasena" required><br><br>
        
        <input type="submit" name="validar" value="Validar usuario">
        <input type="submit" name="agregar" value="Agregar usuario">
        <input type="submit" name="eliminar" value="Eliminar usuario">
    </form>
</body>
</html>
