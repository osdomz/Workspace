<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Agenda</title>
</head>
<body>
<?php

// --- Programa principal ---

// Al principio, ingresamos algunos datos iniciales
// Ponemos unos valores iniciales
$agenda = array(
    'iker' => '555 666 77',
    'xabi' => '444 55 33'
);

$save = filter_input(INPUT_GET, 'save'); // Comprueba si se ha hecho clic en el botón "Guardar"
$view = filter_input(INPUT_GET, 'view'); // Comprueba si se ha hecho clic en el botón "Ver"
$name = filter_input(INPUT_GET, 'name'); // Obtiene el valor del campo "name" del formulario
$tel = filter_input(INPUT_GET, 'tel'); // Obtiene el valor del campo "tel" del formulario

// Comprueba si se ha hecho clic en el botón "Guardar"
if ($save != null) {
    // Comprueba si el campo "name" está vacío y muestra un mensaje de error si lo está
    if ($name == NULL) {
        echo 'No has ingresado un nombre'; // Mensaje de error
    } else {
        if ((array_key_exists($name, $agenda) == FALSE) && ($tel != NULL)) {
            // Si el nombre NO existe en la agenda y se ha ingresado un número de teléfono, se agrega un nuevo contacto
            $agenda[$name] = $tel;
            echo '<br/><b> Ahora tienes un nuevo contacto en la tabla </b>';
            displayContacts($agenda);
            echo '<br/><b> NUEVO CONTACTO </b>';
        } elseif ((array_key_exists($name, $agenda) == TRUE) && ($tel == NULL)) {
            // Si el nombre existe en la agenda y no se ha ingresado un número de teléfono, se elimina el contacto
            unset($agenda[$name]);
            displayContacts($agenda);
            echo '<br/><b> ELIMINADO </b>';
        } elseif ((array_key_exists($name, $agenda) == TRUE) && ($tel != NULL)) {
            // Si el nombre existe en la agenda y se ha ingresado un número de teléfono, se modifica el teléfono
            $agenda[$name] = $tel;
            displayContacts($agenda);
            echo '<br/><b> MODIFICADO </b>';
        } else {
            echo '<br/><b> NUEVO NOMBRE pero sin teléfono / Nombre NUEVO, pero sin número de teléfono </b>';
        }
    }
} else {
    // Si se hace clic en el botón "Ver", se muestra la agenda de contactos
    if ($view != null) {
        displayContacts($agenda);
    }
}

echo "<form action=index.html method=post>";
echo "<input type=submit name=return value=Return>";
echo "</form>";

// Función para mostrar la agenda de contactos en una tabla
function displayContacts($array)
{
    if ($array != NULL) {
        echo '<table border="1">';
        foreach ($array as $key => $value) {
            echo "<tr>";
            echo "<td> $key </td> <td> $value </td>";
            echo "</tr>";
        }
        echo '</table>';
    }
}
?>
</body>
</html>


