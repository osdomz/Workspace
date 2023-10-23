<?php

require_once("../modelo/pelikulaClass.php");
require_once("../modelo/pelikulaModel.php");
$cont=new pelikulaModel();
$json_str = file_get_contents('php://input');
$pelikula_array = json_decode($json_str);
 
//$pelikula_array=json_decode($_POST['misdatos']);
$id=$pelikula_array->id;
$butacasLibres=$pelikula_array->butacasLibres;





//$cont->setid($id);
//$cont->setbutacasLibres($butacasLibres);


$cont->modificar_butacasLibres($id,$butacasLibres);
//print($nombre)
?>