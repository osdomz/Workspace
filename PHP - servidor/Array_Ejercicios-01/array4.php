<?php
$ar_hileak = array(
    'urtarrila' => 0,
    'otsaila' => 0,
    'martxoa' => 0,
    'apirila' => 0,
    'maiatza' => 0,
    'ekaina' => 0,
    'uztaila' => 0,
    'abuztua' => 0,
    'iraila' => 0,
    'urria' => 0,
    'azaroa' => 0,
    'abendua' => 0
);
$laburrak=array('apirila','ekaina','iraila','azaroa');   //array numérico
$luzeak=array('urtarrila','martxoa','maiatza','uztaila','abuztua','urria','abendua');  //array numérico 

foreach ($ar_hileak as $key=>$value)
{
    
    if (in_array($key,$laburrak ))
    {
        $value=30;
        
    } elseif (in_array($key,$luzeak )) { 
        $value=31;
        
    } else {
        
        $value=cal_days_in_month(CAL_GREGORIAN, 2, date("Y"));
    }
    $meses[$key]=$value;
}
// escribir el array meses con sus valores
echo '<table>';
foreach ($meses as $key=>$value)
{
    echo '<tr><td>'.$key.'</td><td>'.$value.'</td></tr>';
}
echo '</table>';