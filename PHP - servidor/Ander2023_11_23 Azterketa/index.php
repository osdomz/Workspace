<html>
<head>
</head>
<body><?php
include_once 'bista.php';
include_once 'Login_modelo.php';
session_start();
$_SESSION['login']=False;


$login_bista = new Login_Bista();
$login_bista->Login();

?>


</body>
</html>