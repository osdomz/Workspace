<html>

<head>
</head>

<body>


<font face="Arial">
	<h1><b>Taula sortu</b></h1>

<table border=2px aling=center>
<tr bgcolor="#0000FF" fgcolor="FFFFFF">
	<td width=100px>N</td>
	<td width=100px>Cuadrado</td>
	<td width=100px>Cubo</td>
</tr>
	
	

<?php
$a=4;

for ($i=1; $i<$a; $i++) {
    echo "<tr>";
    echo "<td> $i </td>";
    echo "<td>". $i*$i ."</td>";
    echo "<td>". $i*$i*$i ."</td>";
    echo "</tr>";
}

?>

</table>

</font>

</body>

</html>