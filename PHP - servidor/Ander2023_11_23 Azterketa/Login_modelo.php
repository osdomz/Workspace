<?php 

class LoginModeloa{
    private $mysql;
    // datu basera conectatzeko
        public function conectar()
        {
            try {
                
                $this->mysqli = new mysqli('localhost', 'root', '', 'gabonak');
                if ($this->mysqli->connect_errno) {
                    throw new Exception('Error al conectar: ' . $this->mysqli->connect_error);
                }
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }
        
        // erabilztailea datu basean badago jakiteko 
        public function validado($user, $pass)
        { echo $user;
        echo $pass;
            $sql = "SELECT * FROM erabiltzaileak_usuarios WHERE erab_usuario = '$user' and pasahitza_contraseña = '$pass'";
         
            $this->mysqli->query($sql);
            if ($this->mysqli->affected_rows == 1) {
                echo"true";
                return TRUE;
            } else {
                return FALSE;
            }
        }
        
        // erabiltzailea komprobatu eta alta emateko datu basean
        public function altaEman($user,$ph,$izena,$gaiotzeeguna) {
            $sql="select erab_usuario from  erabiltzaileak_usuarios where erab_usuario='$user'";
            $this->mysqli->query($sql);
            if($this->mysqli->affected_rows == 1){
                echo "<h1>alta emanda zaude</h1>";
            }else{
            $sql = "INSERT  into  erabiltzaileak_usuarios(erab_usuario,pasahitza_contraseña,izena_nombre,jaiotze_data_fecha_nacimiento) values('$user','$ph','$izena','$gaiotzeeguna');" ;
            $this->mysqli->query($sql);
                }
        }
        
        // pasahitza aldatzeko funtzioa erabilzailea eta pasahitza berria sartu behar dira
        public function aldatuPasahitza($user,$newpass) {
            $sql="update erabiltzaileak_usuarios set pasahitza_contraseña='$newpass' where erab_usuario='$user'";
            $this->mysqli->query($sql);
        }
        
        // sartu dan erabiltzailea olentzero edo mari domingi badan jakiteko
        public function balioztatuOlentzero($user)
        {
            
            $sql="select erab_usuario from  erabiltzaileak_usuarios where erab_usuario='$user' and  olentzero_MariDomingi='1'";
            $this->mysqli->query($sql);
            if($this->mysqli->affected_rows == 1){
               return true;
            }else{
                return  false;
            }
            
        }
        public function opariak_erakutzi($erabiltzailea) 
        {
            $sql="select jaiotze_data_fecha_nacimiento from  erabiltzaileak_usuarios where erab_usuario='$erabiltzailea'";
            $data=$this->mysqli->query($sql);
            $result=$data->fetch_array();
            
            return $result;
            
        }
        
        public function adinaKalkulatu_calcularEdad($jaiotzData_fechaNacimiento) {
            // Fecha actual
            
            $fechaActual = date("Y-m-d");
            
            // Convertir las fechas a timestamps
            $timestampNacimiento = strtotime($jaiotzData_fechaNacimiento);
            
            $timestampActual = strtotime($fechaActual);
            // Calcular la diferencia en segundos
            $diferenciaSegundos = $timestampActual - $timestampNacimiento;
            // Calcular la diferencia en años
            $adina_edad = floor($diferenciaSegundos / (365 * 24 * 60 * 60));
            return $adina_edad;
        }
        
        public function zerrendatuErabiltzaileak(){
            
            $sql="select erab_usuario from  erabiltzaileak_usuarios where olentzero_MariDomingi=0";
             $erabiltzaileak=$this->mysqli->query($sql);
             foreach ($erabiltzaileak as $a){
                 $array_asoziatiboa[]=$a['erab_usuario'];
             }
             return $array_asoziatiboa;
        }
        public function opariakikusi($adina,$user) {
          $sql="select puntuazioa_puntuacion from erabiltzaileak_usuarios where erab_usuario='$user'";
          $puntuazio=$this->mysqli->query($sql);
          $puntuacion=$puntuazio->fetch_array();
         
          $p=$puntuacion["puntuazioa_puntuacion"];
            if($adina <= 7){
                $a="Umeak";
                
            }
            elseif(8>= $adina ||  $adina <= 14){
                $a="Nerabeak";
            }
            elseif($adina >= 15){
                $a="Gazte";
            }
            //and puntuazioa_puntuacion =< $puntuacion["puntuazioa_puntuacion"]
            $sql="SELECT izena_nombre,puntuazioa_puntuacion from opariak_regalos where adina_edad like '%$a%' and puntuazioa_puntuacion <='$p' ";
            $opariak=$this->mysqli->query($sql);
            if($this->mysqli->affected_rows >= 1){
            foreach ($opariak as $lerroa) {
                $array_asoziatiboa[$lerroa['izena_nombre']] = $lerroa['puntuazioa_puntuacion'];
            }}
            else{  $array_asoziatiboa[$lerroa['izena_nombre']="ikatza"] = $lerroa['puntuazioa_puntuacion']="0";
            }
            return $array_asoziatiboa;
        }
        public function gehitugutuna($user,$opariak){
            $urtea=date("Y-m-d");
            $sql="INSERT into gutunak_cartas(erab_usuario,urtea,eskatutakoak_pedidos) values('$user','$urtea','$opariak')";
            $this->mysqli->query($sql);
            if($this->mysqli->affected_rows == 1){
                $mezua="<h1 style='color:green '> gutuna bidali da/la carta ha sido enviada</h1>";
            }else{
                $mezua="<h1 style='color :red '>gutuna lehendik idatzita dago/la carta ya habia sido escrita</h1>";
            }
            echo $mezua;
        }
        public function aldatugutuna($user,$opariak){
            $urtea=date("Y-m-d");
            $sql="UPDATE gutunak_cartas set eskatutakoak_pedidos='$opariak' where erab_usuario='$user' and urtea='$urtea'";
            $this->mysqli->query($sql);
            if($this->mysqli->affected_rows == 1){
                $mezua="<h1 style='color:green '> gutuna berrebidali da/la carta ha sido reenviada</h1>";
            }else{
                $mezua="<h1 style='color:red '>gutuna lehendik idatzita dago/la carta ya habia sido escrita</h1>";
            }
            echo $mezua;
        }
        public function acciones($adina) {
            if($adina <= 7){
                $a="Umeak";
                
            }
            elseif(8>= $adina ||  $adina <= 14){
                $a="Nerabeak";
            }
            elseif($adina >= 15){
                $a="Gazte";
            }
            $sql="SELECT izena_nombre, puntuak_puntuacion from ekintzak_acciones where adina_edad like '%$a%'";
            $ekintzak=$this->mysqli->query($sql);
            foreach ($ekintzak as $posisio){
                $arrayasoziatiboa[$posisio["izena_nombre"]]=$posisio["puntuak_puntuacion"];
            }
            return $arrayasoziatiboa;
        }
        public function puntuaziogehitu($array,$erabiltzailea){
            $puntuazio_berria=0;
            foreach ($array as $ekintza){
               
            $sql="SELECT puntuak_puntuacion from ekintzak_acciones where izena_nombre='$ekintza'";
            
            $puntuak= $this->mysqli->query($sql);
            $puntos=$puntuak->fetch_array();
            $puntuazio_berria+=$puntos["puntuak_puntuacion"];
            
            }
            echo "<h1 style='color:green'>puntuak eta ekintzak aktualizatu</h1>";
            $ekintzak=implode("/", $array);
            $sql2="INSERT into egindakoak_accionesrealizadas(erab_usuario,egindakoa_realizado) values('$erabiltzailea','$ekintzak')";
            $this->mysqli->query($sql2);
            
            $sql="UPDATE erabiltzaileak_usuarios set puntuazioa_puntuacion = puntuazioa_puntuacion+$puntuazio_berria where erab_usuario='$erabiltzailea'";
            $this->mysqli->query($sql);
        }

}
?>