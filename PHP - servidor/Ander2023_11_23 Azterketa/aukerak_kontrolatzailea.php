<?php 
include_once 'bista.php';
include_once 'Login_modelo.php';
$bista=new  Login_Bista();
$modelo=new LoginModeloa();
$modelo->conectar();
session_start();
if(isset($_POST["b_gutuna_carta"])){
    switch ($_POST['opcion']) {
        case "idatzi_escribir":
            $jaiotzedata=$modelo->opariak_erakutzi($_SESSION["user"]);
           
            $adina=$modelo->adinaKalkulatu_calcularEdad($jaiotzedata['jaiotze_data_fecha_nacimiento']);
           
            $bista->erakutsiOpariak_mostrarRegalos($modelo->opariakikusi($adina,$_SESSION["user"]));
            $_SESSION["optio"]="gehitu";
            $bista->logout();
            break;
            
        case "aldatu_cambiar":
            $jaiotzedata=$modelo->opariak_erakutzi($_SESSION["user"]);
            
            $adina=$modelo->adinaKalkulatu_calcularEdad($jaiotzedata['jaiotze_data_fecha_nacimiento']);
            
            $bista->erakutsiOpariak_mostrarRegalos($modelo->opariakikusi($adina,$_SESSION["user"]));
            $_SESSION["optio"]="aldatu";
            $bista->logout();
            break;
    }
}
if(isset($_POST["b_erabAukeratu_elegirUsuario"])){
    $_SESSION["Erab_usuario"]=$_POST["erab_usuario"];
    $jaiotzedata=$modelo->opariak_erakutzi($_POST["erab_usuario"]);
    $adina=$modelo->adinaKalkulatu_calcularEdad($jaiotzedata['jaiotze_data_fecha_nacimiento']);
    $bista->EkintzakBistaratu_VisualizarAcciones($modelo->acciones($adina));
}



if(isset($_POST["b_eskariak_peticiones"])){
    if( $_SESSION["optio"]=="gehitu"){
    $opariakarray=implode('/', $_POST["opariak"]);
    $modelo->gehitugutuna($_SESSION["user"], $opariakarray);
    
    $bista->AukeraEmanErab_DarOpcionesUsuario();
    $bista->logout();}
    else{
        $opariakarray=implode('/', $_POST["opariak"]);
        $modelo->aldatugutuna($_SESSION["user"], $opariakarray);
        $bista->AukeraEmanErab_DarOpcionesUsuario();
        $bista->logout();
    }
}
if(isset($_POST["b_ekintzak_acciones"])){
  
    $modelo->puntuaziogehitu($_POST["ekintzak"], $_SESSION["Erab_usuario"]);
    $bista->logout();
    $bista->AukeraEmanOlen_DarOpcionesOlen($modelo->zerrendatuErabiltzaileak());
    
}


?>