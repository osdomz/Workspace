<?php
echo $_SERVER['DOCUMENT_ROOT'];  // Muestra la raíz del documento web
echo $_SERVER['REQUEST_URI'];    // Muestra la URI de la solicitud actual
echo $_SERVER['PHP_SELF'];       // Muestra el nombre del archivo del script en ejecución

session_start();

require_once('config/database.php');
require_once('controllers/UserController.php');

// Manejar la solicitud de inicio de sesión
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $userController = new UserController($conn);
    if ($userController->loginUser($email, $password)) {
        header('Location: views/dashboard.php');
        exit;
    } else {
        echo "Login fallido. Verifica tus credenciales.";
    }
}
?>

<!-- views/login.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form action="../index.php" method="post">
        <label for="email">Email:</label>
        <input type="email" name="email" required><br>
        <label for="password">Contraseña:</label>
        <input type="password" name="password" required><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>





