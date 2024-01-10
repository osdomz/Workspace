<?php


//Incledeak funtzioak eta objektuak hartzeko
include_once '..\Bista\Login_Bista.php';
include_once '..\Modelo\modelo.php';
session_start();
$usuario = new modelo();
$usuario->conectar();
$html = new Login_Bista();


//Usuarioaren Logina, olentzero/mari eta erabiltzaileak banatzen ditu
if (isset($_POST["b_sartu_entrar"])) {
    if (! $_POST["erab_usuario"] == '' && ! $_POST["ph"] == '') {
        if ($usuario->validado($_POST["erab_usuario"], $_POST["ph"])) {
            $_SESSION['user'] = $_POST["erab_usuario"];
            $_SESSION['ph'] = $_POST["ph"];
            echo 'Oso ondo logina eginda<br><br>';
            $tipo = $usuario->usutipo($_POST["erab_usuario"], $_POST["ph"]);
            if ($tipo == 1) {
                
                
                
                $ebailtzaileak_usuarios=$usuario->users();
                $html->AukeraEmanOlen_DarOpcionesOlen($ebailtzaileak_usuarios);
            }
            if ($tipo == 0) {
                $html->AukeraEmanErab_DarOpcionesUsuario();
            }
        } else {
            echo '<font color="red"><h1><b>Error bete formularioa ondo, erabiltzaile edo pasahitz okerra</h1></font><br>
        <a href="../Bista/index.php"><button>Vueltatu</button></a>';
        }
    } else {
        echo '<font color="red"><h1><b>Error bete formularioa ondo</h1></font><br>
        <a href="../Bista/index.php"><button>Vueltatu</button></a>';
    }
}
//Alta aukera
if (isset($_POST["b_berria_nuevo"])) {
    $html->Alta_AukeraEman_Opcion();
}
//Alta balidatu
if (isset($_POST["ok_alta"])) {
    if (! $_POST["erab_usuario"] == '' && ! $_POST["ph"] == '' && ! $_POST["data_fecha"] == '' && ! $_POST["izena_nombre"] == '') {
        if ($usuario->validado($_POST["erab_usuario"], $_POST["ph"])) {
            echo '<font color="red"><h1><b>Error ' . $_POST["erab_usuario"] . ' datubsean dago erregistratuta Sartu beste bat</h1></font><br>
         <a href="../Bista/index.php"><button>Vueltatu</button></a>';
        } else {
            $usuario->insertar($_POST["erab_usuario"], $_POST["ph"], $_POST["izena_nombre"], $_POST["data_fecha"]);
            echo '<a>Usuario insertado</a>';
        }
    } else {
        echo '<font color="red"><h1><b>Error bete formularioa ondo, kutxak daude hutsik</h1></font><br>
        <a href="../Bista/index.php"><button>Vueltatu</button></a>';
    }
}

//Pasahitza aldaketa
if (isset($_POST["b_aldatu_cambiar"])) {
    if (! $_POST["erab_usuario"] == '' && ! $_POST["ph"] == '') {
        if ($usuario->validado($_POST["erab_usuario"], $_POST["ph"])) {
            $_SESSION['user'] = $_POST["erab_usuario"];
            $_SESSION['ph'] = $_POST["ph"];
            $html->ikusiPasahitzaAldatzeko_verCambioContras();
        } else {
            echo '<font color="red"><h1><b>Error bete formularioa ondo, erabiltzaile edo pasahitz okerra</h1></font><br>
        <a href="../Bista/index.php"><button>Vueltatu</button></a>';
        }
    } else {
        echo '<font color="red"><h1><b>Error erregistratu lehenengo</h1></font><br>
        <a href="../Bista/index.php"><button>Vueltatu</button></a>';
    }
    //
}
//pasahitz aldaketa egin
if (isset($_POST['onartuAldaketa_aceptarCambio'])) {
    $usuario->pas_berri($_SESSION['user'], $_SESSION['ph'], $_POST['ph1']);
    echo 'pasahitza aldatuta <a href="../Bista/index.php"><button>Vueltatu</button></a>';
}

//Gutun karta balidatu eta sortu
if (isset($_POST['b_gutuna_carta'])) {
    if ($_POST['opcion'] === 'idatzi_escribir') {
        if (! $usuario->comprobar_carta($_SESSION['user'])) {
            $mifecha = $usuario->fecha($_SESSION['user'], $_SESSION['ph']);
            $adin = adinaKalkulatu_calcularEdad($mifecha);
            if ($adin <= 7) {
                $adinidatz = 'Umeak';
            } else if ($adin >= 8 && $adin <= 14) {
                $adinidatz = 'Nerabeak';
            } else if ($adin >= 15) {
                $adinidatz = 'Gazteak';
            }
            $zerrenda_asoziatiboa = $usuario->opariak($adinidatz);
            $html->erakutsiOpariak_mostrarRegalos($zerrenda_asoziatiboa);
        } else {
            echo 'Barkatu baina gutuna badaukazu idatzita, aldatu nahi baduzu';
            $html->AukeraEmanErab_DarOpcionesUsuario();
        }
    }
    
    //Gutun karta balidatu aldatzeko
    if ($_POST['opcion'] === 'aldatu_cambiar') {
        if ($usuario->comprobar_carta($_SESSION['user'])) {
            $eleccion = $usuario->cartas_elec($_SESSION['user']);
            echo $eleccion . ' Aukeratu duzu';
            $mifecha = $usuario->fecha($_SESSION['user'], $_SESSION['ph']);
            $adin = adinaKalkulatu_calcularEdad($mifecha);
            if ($adin <= 7) {
                $adinidatz = 'Umeak';
            } else if ($adin >= 8 && $adin <= 14) {
                $adinidatz = 'Nerabeak';
            } else if ($adin >= 15) {
                $adinidatz = 'Gazteak';
            }
            $zerrenda_asoziatiboa = $usuario->opariak($adinidatz);
            $html->erakutsiOpariak_mostrarRegalos($zerrenda_asoziatiboa);
        } else {
            echo 'Zure gutuna ez dago sortuta <br>  <a href="../Bista/index.php"><button>Vueltatu</button></a>';
        }
    }
}

//Eskariak kudeatu
if (isset($_POST['b_eskariak_peticiones'])) {
    $opariakSeleccionados = implode("/ ", $_POST['opariak']);
    echo "Regalos seleccionados: " . $opariakSeleccionados;
    if ($usuario->comprobar_carta($_SESSION['user'])) {
        $usuario->cambiar_gutu($opariakSeleccionados, $_SESSION['user']);
    } else {
        $usuario->insertar_oparis($_SESSION['user'], date('Y'), $opariakSeleccionados);
        echo 'Zure gutuna sartu dugu datubasean <br>  <a href="../Bista/index.php"><button>Vueltatu</button></a>';
    }
}

//Erabiltzailea administrariak aukeratzea, ekintza puntuak gehitzeko
if(isset($_POST['b_erabAukeratu_elegirUsuario'])){
   $_SESSION['usuadmin']= $_POST['erab_usuario'];
   
   $mifecha = $usuario->fecha($_POST['erab_usuario']);
   $adin = adinaKalkulatu_calcularEdad($mifecha);
   if ($adin <= 7) {
       $adinidatz = 'Umeak';
   } else if ($adin >= 8 && $adin <= 14) {
       $adinidatz = 'Nerabeak';
   } else if ($adin >= 15) {
       $adinidatz = 'Gazteak';
   }
   
   $ekintzak_acciones=$usuario->acciones($adinidatz);
   $html->EkintzakBistaratu_VisualizarAcciones($ekintzak_acciones);
}

//ekintzak berrizteko(Update)
if(isset($_POST['b_ekintzak_acciones'])){
    if(isset($_POST['ekintzak'])) {
        $opariakSeleccionados = $_POST['ekintzak'];
        $puntosuma=0;
        foreach ($opariakSeleccionados as $oparia) {
          $puntosuma += $usuario->ekinpunt($oparia);
        }
        $usuario->cambiarpunticos($puntosuma, $_SESSION['usuadmin']);
        
        echo 'Puntuak aldatuta <br>  <a href="../Bista/index.php"><button>Vueltatu</button></a>';
    } else {
        echo "No se ha seleccionado ningún regalo.";
    }
     
}

if (isset($_POST['oparizek'])) {

    $resultados = $usuario->regalosusu();
    $reg = $usuario->cartas();
    
    foreach ($resultados as $registro) {
        echo "ID Usuario: {$registro['id_erab_usuario']}, Usuario: {$registro['erab_usuario']}, Puntuación: {$registro['puntuazioa_puntuacion']}<br>";
        
        if ($registro['puntuazioa_puntuacion'] <= 0) {
            $opari = 'ikatza';
            $usuario->anadirRegalo($registro['id_erab_usuario'], $opari, date('Y'), $registro['puntuazioa_puntuacion']);
        } else {
            $palabrasString = '';
            echo '<br>';
            foreach ($reg as $usuarioKey => $pedidos) {
                if ($usuarioKey == $registro['erab_usuario']) {
                    $maxi_puntos=0;
                    foreach ($pedidos as $palabra) {
                        $punt_regalo = $usuario->opariakeskatu($palabra);
                        $palabrasString .= $palabra . '/';
                        
                        foreach ($punt_regalo as $puntuazioa) {
                        $maxi_puntos+=$puntuazioa;
                        }
    
                    }
                    echo $registro['erab_usuario'];
                    echo $maxi_puntos;
                    if($usuario->comprobar_puntos($registro['erab_usuario'], $maxi_puntos)){
                    
                        $usuario->anadirRegalo($registro['id_erab_usuario'], $palabrasString, date('Y'), $maxi_puntos);
                    }else{
                        $primerPalabra = strtok($palabrasString, '/');
                        $usuario->anadirRegalo($registro['id_erab_usuario'], $primerPalabra, date('Y'), $maxi_puntos);
                    }
                }
                
                echo "<br><br>";
            }
        }
        // $usuario->anadirRegalo($idUsuario, $opari, date('Y'), $puntuacion);
    }
}


// Funtzioa emanda adina Kalkulatzeko
function adinaKalkulatu_calcularEdad($jaiotzData_fechaNacimiento)
{
    $fechaActual = date("d-m-Y");
    $timestampNacimiento = strtotime($jaiotzData_fechaNacimiento);
    $timestampActual = strtotime($fechaActual);
    $diferenciaSegundos = $timestampActual - $timestampNacimiento;
    $adina_edad = floor($diferenciaSegundos / (365 * 24 * 60 * 60));
    return $adina_edad;
}