<?php
/*Reprogramar el ejercicio anterior de modo que recibiendo por URL un día concreto, se
 muestre en pantalla el día seleccionado y el valor entero asociado al mismo.
 */

$astea=array( 'astelehena'=>1,
    'asteartea'=>2,
    'asteazkena'=>5,
    'osteguna'=>4,
    'ostirala'=>6,
    'larunbata'=>6,
    'igandea'=>7);

$eguna=filter_input(INPUT_GET, "eguna");

if (isset($eguna))
{
    if (array_key_exists($eguna, $astea))
    {
        echo 'EGUNA : '.$eguna.'ren balioa '.$astea[$eguna].' da</br>';
        
    } else {
        echo 'EGUNA : '.$eguna.'ez dago taulan ';
    }
    
} else {
    echo 'Ez duzu egunik aukeratu';
}