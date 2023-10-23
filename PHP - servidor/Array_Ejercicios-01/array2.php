<?php
    $egunak=array('astelehena'=>2,
        'asteartea'=>7,
        'asteazkena'=>4,
        'osteguna'=>9,
        'ostirala'=>2,
        'larunbata'=>5,
        'igandea'=>3,
    );
    $guztira=0;
    

    foreach ($egunak as $clave=>$valor){
        echo "$clave => $valor <br>";
     //   $guztira= $guztira+$valor;
    }
    $guztira=array_sum($egunak); 
    echo 'GUZTIRA : '.$guztira;
    
    echo '</br></br>BATAZBESTEKOA : '.$guztira/sizeof($egunak);