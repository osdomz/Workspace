<html>

<head>
</head>

<body>


<font face="Arial">
	<h1><b>Ze karaktere da</b></h1>


<?php
$a=8;

if ($a>"A" && $a<"Z"){
    echo "$a Maiuskula da";
}else if($a>"a" && $a<"z"){
    echo "$a Minuskula da";
}else if($a==""){
    echo "Karaktere zuria da";
}else if($a=="." || $a==","){
    echo "$a Puntuazio-zeinua da";
}else if($a>1 && $a<9){
    echo "$a Zenbaki bat da";
}else{
    echo "Beste karaktere bat da";
}

?>

</font>

</body>

</html>