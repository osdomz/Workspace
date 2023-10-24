<?php
$host = 'localhost';
$dbname = 'jokoa';
$username = 'root';
$password = '';
session_start();
include_once 'Login_Bista.php';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $erabiltzailea = $_POST['erab'];
        $pasahitza = $_POST['ph']; 
        
        $stmt = $pdo->prepare("SELECT * FROM jokalariak WHERE erabiltzailea = :erabiltzailea AND pasahitza = :pasahitza");
        $stmt->bindParam(':erabiltzailea', $erabiltzailea, PDO::PARAM_STR);
        $stmt->bindParam(':pasahitza', $pasahitza, PDO::PARAM_STR);
        $stmt->execute();
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($usuario) {
            echo "Logeado";
        } else {
            echo "Nombre de usuario o contraseña incorrectos";
        }
    }
} catch (PDOException $e) {
    error_log("Error de conexión: " . $e->getMessage());
    echo "Ha ocurrido un error. Por favor, inténtalo de nuevo más tarde.";
    die();
}

$loginBista = new Login_Bista();
$loginBista->HasierakoFormularioa();
?>




