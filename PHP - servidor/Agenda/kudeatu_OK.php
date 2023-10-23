<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
<head>
<meta charset="UTF-8">
<title>Agenda</title>
</head>
<body>
        <?php

        // --- Programa nagusia---
        
        // Hasieran datu batzuk sartzen ditugu
        // Ponemos unos valores iniciales
        $agenda = array(
            'iker' => '555 666 77',
            'xabi' => '444 55 33'
        );
        
        $gorde=filter_input(INPUT_GET,'gorde');
        $ikusi=filter_input(INPUT_GET,'ikusi');
        $izena=filter_input(INPUT_GET,'izena');
        $tel=filter_input(INPUT_GET,'tel');
        
        // Gorde botoia sakatu den ala ez konprobatzeko
        // Comprobar si ha pulsado el botón GORDE o IKUSI 
        if ($gorde!= null) 
        { 
            // ez badut izena sartu ez du ezer egiten
            // si el param izena está vacio o no viene--->Error
            if ($izena == NULL)
            {
                echo 'ez duzu izenik sartu'; //errorea
                
            } else { 
                if ((array_key_exists($izena, $agenda) == FALSE) && ($tel != NULL)) // sartu
                {
                    // Sartutako izena ez badago agendan eta tel sartu badute --->kontaktu berria
                    // Si el nombre NO está en la agenda y el param tel no está vacio-->insertar
                    
                    $agenda[$izena] = $tel;
                    echo '<br/><b> Orain taulan kontaktu berri bat / Nuevo contacto en la tabla </b>';
                    idatzi($agenda);
                    echo '<br/><b> BERRIA / NUEVO </b>';
                    
                } elseif ((array_key_exists($izena, $agenda) == TRUE) && ($tel == NULL)) 
                    // Izena agendan badago eta telefonoa hutsik-->ezabatu
                    // El nombre está en la agenda y el tel vacío-->eliminar
                {
                    unset($agenda[$izena]); // aldagai bat deusezten du---se borra el elemento
                    idatzi($agenda);
                    echo '<br/><b> EZABATU / ELIMINAR </b>';
                    
                } elseif ((array_key_exists($izena, $agenda) == TRUE) && ($tel != NULL)) 
                {
                    // Izena badago agendan eta telefonoa sartu badute-->telefonoa aldatzen da
                    // Nombre en la agenda y telefono no vacio-->modificar el telefono
                    $agenda[$izena] = $tel; // aldatu
                    idatzi($agenda);
                    echo '<br/><b> ALDATU / MODIFICAR </b>';
                } else {
                    echo '<br/><b> IZEN BERRIA baina TELF bete gabe / NOMBRE NUEVO pero el TELF vacio </b>';
                }
            }
        } else { 
            // ikusi botoia sakatu badute, agenda erakusten da.
            // Ha pulsado el botón IKUSI
            if ($ikusi != null) 
            {
                idatzi($agenda);
            }
        }
        
        echo "<form action=index.html method=post>";
        echo "<input type=submit name=itzuli value=Itzuli>";
        echo "</form>";
       
        // Funtzio hau array-a pantailan idazteko da taula baten
        //Función para escribir la agenda en una tabla
        function idatzi($arraya)
        {
            if ($arraya != NULL) {
                echo '<table border="1">';
                foreach ($arraya as $key => $value) {
                    echo "<tr>";
                    echo "<td> $key </td> <td> $value </td>";
                    echo "</tr>";
                }
                echo '</table>';
            }
        }
        // -------------------------------------------------------------------
        
        ?>
    </body>
</html>

