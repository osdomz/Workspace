<?php
class VistaInicioSesion {

    // Formulario completo con la parte de inicio de sesión antes de iniciar sesión.
    public function FormularioInicioSesion() {
        ?>
        <form method="POST" action="controlador.php">
            <div >
                <div >
                    <label><b>Usuario</b></label>
                    <input type="text" placeholder="Ingrese el nombre de usuario" name="usuario"/>
                </div>

                <div>
                    <label><b>Contraseña</b></label>
                    <input type="password" placeholder="Ingrese la contraseña" name="contrasena"/>
                </div>
                <br>
                <div>
                    <label><b>¿Qué deseas hacer?</b></label> 
                </div>          
                <input type="radio" value="puntuacion" name="opcion"/>Lista de Puntuaciones
                <input type="radio" value="jugar" name="opcion"/> Jugar
                <br><br>
                <input type="submit" value="IR" name="boton"/>
            </div>
        </form>
        <?php
    }

    // Una vez que el inicio de sesión esté verificado, muestra el formulario sin la parte de inicio de sesión.
    public function MostrarOpcion() {
        ?>
        <form method="POST" action="controlador.php">
            <div>
                <div>
                    <label><b>¿Qué deseas hacer?</b></label> 
                </div>
                                          
                <input type="radio" value="puntuacion" name="opcion"/>Lista de Puntuaciones
                <input type="radio" value="jugar" name="opcion"/> Jugar
                <br>
                <br>
                <input type="submit" value="IR" name="boton"/>
            </div>
        </form>
        <?php
    }

    // Muestra en pantalla el array asociativo dado.
    public function Listar($lista_asociativa) {

        ?>
        <table border="1">
            <tr><th>Usuario</th><th>Puntuación</th></tr>
            <?php
            foreach ($lista_asociativa as $usuario => $puntuacion) {
            ?>
                <tr><td><?php echo($usuario); ?></td><td><?php echo($puntuacion); ?></td></tr>
                <?php
            }
            ?>
        </table>
        <?php
    }

    /* Dado un array asociativo (la clave es la pregunta y el valor es un array con las posibles respuestas),
    muestra en pantalla las preguntas y respuestas. */
    public function MostrarPreguntasRespuestas($preguntas_respuestas_array){
                
        echo '<form method="POST" action="controlador.php">';
        // Crear la etiqueta de la pregunta
        $contador=0;
        foreach($preguntas_respuestas_array as $pregunta => $respuestas){
            echo "<b>" . $pregunta . " &nbsp</b>";

            // Crear el menú desplegable de respuestas
            echo '<select name="pregunta'. $contador++. '">';
            
            foreach($respuestas as $respuesta ){
                echo "<option value='". $respuesta ."'>" . $respuesta . "</option>";
            }
            echo '</select><br><br>';    
            
        }
        
        echo '<input type="submit" value="ENVIAR" name="boton_jugar"/>';
        echo '</form>';
       
    }
}


