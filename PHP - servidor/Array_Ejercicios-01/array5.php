<?php
$urtaroak=["negua","udaberria","uda","udazkena"];
var_dump($urtaroak);
echo "<br>";
$ur=implode(",", $urtaroak);

var_dump($ur);
echo "<br>";

$urtaroak=explode(",", $ur);

var_dump($urtaroak);