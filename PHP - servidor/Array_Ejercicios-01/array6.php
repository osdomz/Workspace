<?php

$petsonak=array(
    "Jon"=>"Lasa Jon",
    "Iker"=>"Herran Iker",
    "Ane"=>"Cruz Ane",
    "Silvia"=>"Agirre Silvia",
    "Jon Ander"=>"Galarraga Jon Ander"
    
);

echo "<br/>ORDENATU GABE :<br/>";
foreach ($petsonak as $key => $val) {
    echo "$key = $val <br>";
}

echo "<br/>ORDENATUTA (KEY) :<br/>";
ksort($petsonak);
foreach ($petsonak as $key => $val) {
    echo "$key = $val<br>";
}

echo "<br/>ORDENATUTA (VALUE) :<br/>";
natsort($petsonak);
foreach ($petsonak as $key => $val) {
    echo "$key = $val<br>";
}