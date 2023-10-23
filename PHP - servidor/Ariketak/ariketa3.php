<html>

<head>
</head>

<body>


<font face="Arial">
	<h1><b> 3 zenbaki ordenatu </b></h1>


<?php
$num1=4;
$num2=2;
$num3=6;

if ($num1 > $num2){
    if ($num1 > $num3){
        if ($num2 > $num3){
            echo "$num1, $num2, $num3";
        }else{
            echo "$num1, $num3, $num2";
        }
    }else{
        echo "$num3, $num1, $num2";
    }
}else{
    if ($num1 > $num3){
        echo "$num2, $num1, $num3";
    }else{
        if ($num3 > $num2){
            echo "$num3, $num2, $num1";
        }else{
            echo "$num2, $num3, $num1";
        }
        
    }
}

?>

</font>

</body>

</html>