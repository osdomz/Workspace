<!-- views/login.php -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form action="index.php?action=login" method="post">
        <label for="email">Email:</label>
        <input type="email" name="email" required><br>
        <label for="password">Contraseña:</label>
        <input type="password" name="password" required><br>
        <button type="submit">Iniciar sesión</button>
    </form>
    <p>No tienes una cuenta? <a href="index.php?action=signup">Regístrate aquí</a></p>
</body>
</html>

