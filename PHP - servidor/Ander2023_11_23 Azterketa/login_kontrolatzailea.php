<html>
<head>
</head>
<body>
<?php 
include_once 'bista.php';
include 'Login_modelo.php';
session_start();


$bista=new  Login_Bista();
$modelo=new LoginModeloa();


$modelo->conectar();



if(isset($_POST["b_sartu_entrar"])&& $modelo->validado($_POST["erab_usuario"],$_POST["ph"])){
   $_SESSION["user"]=$_POST["erab_usuario"];
    if(isset($_POST["b_sartu_entrar"])&&$modelo->balioztatuOlentzero($_POST["erab_usuario"])){
       
        $bista->AukeraEmanOlen_DarOpcionesOlen($modelo->zerrendatuErabiltzaileak());
       
        $bista->logout();
   
    }
    else{
       
        $bista->AukeraEmanErab_DarOpcionesUsuario();
        $bista->logout();
    }
}
//1
if(isset($_POST["b_aldatu_cambiar"])&& $modelo->validado($_POST["erab_usuario"],$_POST["ph"])){
    $bista->ikusiPasahitzaAldatzeko_verCambioContras();
    $bista->logout();
}
//2
if(isset($_POST["onartuAldaketa_aceptarCambio"])){
    $modelo->aldatuPasahitza($_SESSION["erabitzailea"], $_POST["ph"]);
    $bista->logout();
}
if(isset($_POST["b_berria_nuevo"])&& !$modelo->validado($_POST["erab_usuario"],$_POST["ph"])){
    $bista->Alta_AukeraEman_Opcion();
   
}

if(isset($_POST["ok_alta"])){
    $modelo->altaEman($_POST["erab_usuario"],$_POST["ph"],$_POST["izena_nombre"],$_POST["data_fecha"]);
    $bista->Login();
    
}
if(isset($_POST["salir"])){
session_abort();
$bista->Login();

}

?>


</body>
</html>