<?php // 


require_once("../modelo/pelikulaClass.php");
require_once("../modelo/pelikulaModel.php");
$cont=new pelikulaModel();
$cont->setList();
$datos=$cont->getJSONList();

$pelikulak=json_encode($datos);
echo($pelikulak);   
?>


