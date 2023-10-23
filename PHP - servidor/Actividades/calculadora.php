<html> 
<head> 
<title>Formulario.</title> 
</head> 

<body> 

<form method="POST" action="sumar.php">
    <p>Valor 1: <input type="text" name="T1" size="20"></p>
    <p>Valor 2: <input type="text" name="T2" size="20"></p>
    <p>Valor 3: <input type="text" name="T3" size="20"></p>
    <p><input type="submit" value="Sumar" name="B1"></p>
</form>

</body>
</html>
===============================
<html> 
<head> 
<title>Sumar.</title> 
</head> 

<body> 

<?php
$valor1 = $_POST['T1'];
$valor2 = $_POST['T2'];
$valor3 = $_POST['T3'];

$suma = $valor1 + $valor2 + $valor3;

echo "$valor1 + $valor2 + $valor3 = $suma";
?>

</body>
</html>