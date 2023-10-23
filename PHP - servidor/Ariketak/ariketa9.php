<html>

<head>
</head>

<body>


<font face="Arial">
	<h1><b>Zenbaki </b></h1>

	
<?php

$num = rand(1,100);

if($num < 50){
    echo "$num zenbakia 50 baino txikiagoa da";
}else if($num > 50){
    echo "$num zenbakia 50 baino handiagoa da";
}else{
    echo "Zenbakia 50 da";
}

?>

</font>

</body>

</html>