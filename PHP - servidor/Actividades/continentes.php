<?php
$ar_herriak=array(
    "China"=>"",
    "Francia"=>"",
    "Somalia"=>"",
    "Canada"=>"",
    "Australia"=>"",
    "Marruecos"=>"",
    "Italia"=>"",
    "Nueva Zelanda"=>"",
    "Argentina"=>"",
    "Japon"=>""
);
$ar_Europa=array("Francia", "Italia","Grecia");
$ar_Asia=array("China", "Rusia","Japon");
$ar_Africa=array("Mali","Egipto","Somalia");
$ar_America=array("Chile","EEUU","Argentina","Canada");
$ar_Oceania=array("Nueva Zelanda","Papua","Australia");

foreach ($ar_herriak as $key=>$value)
{
    if (in_array($key,$ar_Europa ))
    {
        $ar_herriak[$key]="Europa";
        
    }else if (in_array($key,$ar_Asia ))
    {
        $ar_herriak[$key]="Asia";
        
    }else if (in_array($key,$ar_Africa ))
    {
        $ar_herriak[$key]="Africa";
        
    }else if (in_array($key,$ar_America ))
    {
        $ar_herriak[$key]="America";
        
    }else if (in_array($key,$ar_Oceania ))
    {
        $ar_herriak[$key]="Oceania";
        
    }
}

foreach ($ar_herriak as $key1=>$value1)
{
    echo $key1."->".$ar_herriak[$key1];
    echo "<br>";
}