<html>

<head>
</head>

<body>


<font face="Arial">
	<h1><b> Zenbat zenbaki errepikatzen dira? </b></h1>


<?php
$num1=6;
$num2=6;
$num3=6;

if ($num1 == $num2 && $num1 == $num3){
    echo "Hay 3 numeros iguales a $num1";
}else if ($num1 == $num2 && $num1 <> $num3){
    echo "Hay 2 numeros iguales a $num1";
}else if ($num1 <> $num2 && $num1==$num3){
    echo "Hay 2 numeros iguales a $num1";
}else if ($num1 <> $num2 && $num1<>$num3 && $num2==$num3){
    echo "Hay 2 numeros iguales a $num2";
}else{
    echo "No hay ningun numero igual";
}

?>

</font>

</body>

</html>