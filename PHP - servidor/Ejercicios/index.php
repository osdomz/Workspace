<?php
include("IrudiGeometrikoa.php");
include ("Triangelua.php");

$fig=new IrudiGeometrikoa();
$fig->setIzena("A");
$fig->setKolorea("urdina");
$fig->idatzi();

$tri=new Triangelua();
$tri->setIzena("B");
$tri->setKolorea("berdea");
$tri->setAltuera(5);
$tri->setOinarria(3);
$tri->idatzi();
$tri->areaKalkulatu();
