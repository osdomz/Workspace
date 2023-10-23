<?php

class pelikulaClass {
protected $cartelPeli;
protected $tituloPeli;
protected $butacasLibres;
protected $butacasTotal;

function getid(){
    return $this->id;
}
function getcartelPeli(){
    return $this->cartelPeli;
}
function gettituloPeli(){
    return $this->tituloPeli;
}
function getbutacasLibres(){
    return $this->butacasLibres;
}
function getbutacasTotal(){
    return $this->butacasTotal;
}
function setid($id){
    $this->id=$id;
}
function setcartelPeli($cartelPeli){
    $this->cartelPeli=$cartelPeli;
}
function settituloPeli($tituloPeli){
    $this->tituloPeli=$tituloPeli;
}
function setbutacasLibres($butacasLibres){
    $this->butacasLibres=$butacasLibres;
}
function setbutacasTotal($butacasTotal){
    $this->butacasTotal=$butacasTotal;
}
}

?>
