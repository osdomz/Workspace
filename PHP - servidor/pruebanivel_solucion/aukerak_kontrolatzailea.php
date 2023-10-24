<?php

session_start();

include_once 'bista.php';
include_once 'modeloa.php';

$LogBis= new Login_Bista;

$jok_model = new Jokalari_Modeloa;
$jok_model->konektatu();

//Galdera eta erantzun posibleen array asoziatiboa.
//Array asociativo de la preguntas y posbles respuestas.
$joko_arraya=["Zein da urrearen elemetu kimikoa?" => array("Fr", "Au", "Ur"),
                    "Urdina eta gorriaren nahasketatatik zer ateratzen da?" => array("Berdea", "Morea"),
                    "Zenbat da 4x4?" => array("7", "16", "14", "15")];


//Galdera eta erantzunaren array asoziatiboa.
//Array asociativo de la pregunta con su respuesta.
$emaitzen_arraya=["Zein da urrearen elemetu kimikoa?" => "Au",
"Urdina eta gorriaren nahasketatatik zer ateratzen da?" => "Morea",
"Zenbat da 4x4?" => "16"];

//Logina egiaztatzen du, egokia ez bada mezua erakutsi eta formularioa berriro kargatuta.
//Comprueba el login, si no es adecuado muestra un mensaje y el formulario.
if (isset($_POST['botoia']) && !$_SESSION["balioztatua"]) {
    if($jok_model->balioztatzea($_POST['erab'], $_POST['ph'])){
        $_SESSION["balioztatua"]= TRUE;
        $_SESSION["Erab"]=$_POST['erab'];         
    }
    else{
        ?>
        <h3 style="color: red;">Saiatu berriro, erabiltzailea edo pasahitza ez dituzu ondo sartu. </h3>
        <?php
        $LogBis-> HasierakoFormularioa();
    }
}


/*Logina egiaztatuta dagola eta fomularioko botoia emanda, aukeraren arabera puntuazioak erakutsi
edo jokoari hasiera emango zaio. Aukerarik ez bada egin errore mezua agertuko da eta aukeren 
formularioa erakutsiko da. /

Una vez el login esté hecho y se pulse el boton del formulario según la opción escogida muestra 
la puntuación o muestra el juego. Si no se ha elegido ninguna opción muestra una un error y el 
fomulario para poder elegir la opción.*/

if ($_SESSION["balioztatua"] && isset($_POST['botoia'])){
    if(isset($_POST['opcion'])){
        switch ($_POST['opcion']) { 
            case "zerrenda":
                $LogBis->Aukera_Eman();
                $LogBis->zerrendatu($jok_model->zerrenda_ordenatuta());
                break;
            case "jokatu": 
                $LogBis->galdera_erantzunak_marraztu($joko_arraya);
                break;
        }
    }
    else{
        ?>
        <h3 style="color: red;">Ez duzu zehaztu zer den egin nahi duzuna/ No has elegido qué quieres hacer. </h3>
        <?php
        $LogBis->Aukera_Eman();
    }
}


/*Logina zuzenda izanda eta jokatzeko botoiari emanda, jokoko erantzunak egiaztatu eta 
puntuazioa kalkulatzen da ostean DBan eguneraketa egiteko./

Si el login es correcto y se ha elegido la opción de jugar se analizan la respuestas, se asigna 
la puntuación y se actualiza dicha puntuación el la DB.
*/
if ($_SESSION["balioztatua"] && isset($_POST['jokatu_botoia'])){
    $puntuak=0;
    $kont=0;
    foreach ($emaitzen_arraya as $galdera => $erantzuna){
        if ($_POST['galdera'.$kont++]==$erantzuna){
            echo ($galdera ." galderaren erantzuna ". $erantzuna." da. Beraz zuzena da, oso ondo puntuak lortu dituzu. <br><br>");
            $puntuak=$puntuak + 3;
            
        }
    }
    echo $puntuak . " puntu lortu dituzu. <br><br>";
    $jok_model->eguneratu_puntuazioa($_SESSION["Erab"], $puntuak);
    $LogBis->Aukera_Eman();


}






