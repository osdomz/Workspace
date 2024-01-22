<?php

/**
 * Bistaren deskribapena
 * Descripcion de la vista
 */

class Login_Bista
{

    //Logina egin aurretik agertuko dena, formulario osoa.
    //Formulario completo con la parte del login.
    public function Login()
    {
?>
        <form method="POST" action="controlador.php">
            <div>
                <div>
                    <label><b>Erabiltzailea/ Usuario</b></label>
                    <input type="text" placeholder="Sartu Erabiltzaile izena" name="erab_usuario" />
                </div>

                <div>
                    <label><b>Pasahitza/ Contraseña</b></label>
                    <input type="password" placeholder="Sartu pasahitza" name="password_usuario" />
                </div>
                <br>

                <input type="submit" name="accion" value="entrar">
                <input type="submit" name="accion" value="cambiar">
                <input type="submit" name="accion" value="registrar">

            </div>
        </form>
    <?php
    }

    public function ikusiPasahitzaAldatzeko_verCambioContras()
    {
    ?>
        <form method="POST" action="controlador.php">
            <div>
                <div>
                    <label><b> Sartu Pasahitz berria/ Introduce la nueva contraseña</b></label>
                    <input type="text" name="ph" />
                </div>

                <input type="submit" value="aldatu" name="accion" />
            </div>
        </form>
    <?php
    }



    //Behin logina agiaztatuta dagoenean agertuko dena, login gabeko formularioa.
    //Una vez que el login esté verificado, el fomulario sin la parte de login.
    public function Alta_AukeraEman_Opcion()
    {
    ?>
        <form method="POST" action="controlador.php">
            <div>
                <div>
                    <label><b> Izena/ Nombre</b></label>
                    <input type="text" placeholder="Sartu Erabiltzailearen izena" name="izena_nombre" />
                </div>

                <div>
                    <label><b>Jaiotze Data/ Fecha de nacimiento</b></label>
                    <input type="date" name="data_fecha" />
                </div>
                <br>
                <div>
                    <label><b>Erabiltzailea berria/ Nuevo Usuario</b></label>
                    <input type="text" placeholder="Sartu Erabiltzailea" name="erab_usuario" />
                </div>

                <div>
                    <label><b>Pasahitza/ Contraseña</b></label>
                    <input type="password" placeholder="Sartu pasahitza" name="ph" />
                </div>
                <br>

                <input type="submit" value="Ok" name="accion" />
            </div>
        </form>
    <?php
    }

    public function AukeraEmanErab_DarOpcionesUsuario()
    {
    ?>
        <form method="POST" action="controlador.php">
            <div>
                <div>
                    <label><b>¿Qué es lo que quieres hacer?</b></label>
                </div>
    
                <input type="radio" value="idatzi_escribir" name="opcion" />Gutuna idatzi / Escribir carta
                <input type="radio" value="aldatu_cambiar" name="opcion" /> Gutuna aldatu / Cambiar carta
                <br>
                <br>
                <input type="submit" value="Ok" name="b_gutuna_carta" />

            </div>
        </form>
    <?php
    }
    

    public function AukeraEmanOlen_DarOpcionesOlen($ebailtzaileak_usuarios)
    {

    ?>
        <form method="POST" action="controlador.php">
            <div>
                <div>
                    <label><b>¿A qué usuario quieres le quieres asignar acciones? </b></label>
                </div>
                <?php
                echo '<select name="erab_usuario">';
                foreach ($ebailtzaileak_usuarios as $user) {

                    echo '<option value="' . $user . '">' . $user . '</option>';
                }     ?>
                <br>
                <br>
                <input type="submit" value="Ok" name="b_erabAukeratu_elegirUsuario" />
            </div>
        </form>
    <?php
    }


    public function EkintzakBistaratu_VisualizarAcciones($ekintzak_acciones)
    {

    ?>
        <form method="POST" action="controlador.php">
            <label><b> <?php $_SESSION['Erab_usuario'] ?> Erabiltzailearen ekintzak eguneratu:</b></label>
            <br><br>


            <?php
            foreach ($ekintzak_acciones as $ekintza_accion => $puntuazioa_puntuacion) {
                echo ($ekintza_accion . " " . $puntuazioa_puntuacion . " puntu/puntos");
            ?>
                <input type="checkbox" name="ekintzak[]" value="<?php echo ($ekintza_accion); ?>">

            <?php
            } ?>
            <br>
            <input type="submit" value="Ok" name="b_ekintzak_acciones" />
        </form>

    <?php

    }


    //Array asoziatibo bat emanda, arraya erakutsiko du pantailan.
    //Mostrará en pantalla el array asociativo dado.
    public function erakutsiOpariak_mostrarRegalos($zerrenda_asoziatiboa)
    {
        echo 'Método erakutsiOpariak_mostrarRegalos llamado.';
    ?>
        <form method="POST" action="controlador.php">
            <label><b>Queridos Olentzero y Mari Domingi me gustaría que me traerais lo siguiente:</b></label>
            <br><br>

            <?php
            foreach ($zerrenda_asoziatiboa as $oparia_regalo => $puntuazioa_puntuacion) {
                echo ($oparia_regalo . " " . $puntuazioa_puntuacion . " puntu/puntos");
            ?>
                <input type="radio" name="opariak[]" value="<?php echo ($oparia_regalo); ?>">

            <?php
            } ?>
            <br>
            <input type="submit" value="Ok" name="b_eskariak_peticiones" />
        </form>

    <?php 
    
    }
}
