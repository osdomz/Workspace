<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario con Casillas de Verificación</title>
</head>
<body>

    <form action="procesar_formulario.php" method="post">
        <label>Selecciona frutas:</label>
        <input type="checkbox" id="manzana" name="frutas[]" value="manzana">
        <label for="manzana">Manzana</label>

        <input type="checkbox" id="platano" name="frutas[]" value="platano">
        <label for="platano">Plátano</label>

        <input type="checkbox" id="uva" name="frutas[]" value="uva">
        <label for="uva">Uva</label>

        <input type="checkbox" id="fresa" name="frutas[]" value="fresa">
        <label for="fresa">Fresa</label>

        <input type="submit" value="Enviar">
    </form>

</body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener las frutas seleccionadas
    if (isset($_POST['frutas']) && is_array($_POST['frutas'])) {
        $frutasSeleccionadas = $_POST['frutas'];
        
        // Hacer algo con las frutas seleccionadas
        foreach ($frutasSeleccionadas as $fruta) {
            echo "Fruta seleccionada:". $fruta."<br>";
        }
    } else {
        echo "No se seleccionaron frutas.";
    }
}


$frutas = array('manzana', 'plátano', 'uva');
$cadena = implode(', ', $frutas);

//echo $cadena; // Salida: manzana, plátano, uva




?>
