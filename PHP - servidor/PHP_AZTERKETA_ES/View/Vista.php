<?php


class Vista {

    //Logina egin aurretik agertuko dena, formulario osoa.
    //Formulario completo con la parte del login.
    public function Login() {
        ?>
        
        <form method="POST" action="Controller/Controller.php">
            Nombre de usuario: <input type="text" name="username">
            <br>
            Contraseña: <input type="password" name="password">
            <br>
            <input type="submit" name="accion" value="Validar">
            <input type="submit" name="accion" value="Alta">
            <input type="submit" name="accion" value="Cambiar">
        </form>

        <?php
    }
    //Vista del ususario que no es admin.
    public function area_usuario($productos){
        ?>
        
        <h1>Comprar Productos</h1>
        <form method="POST" action="../Controller/Controller.php">
        <?php
        echo '<select name="productos">';
        foreach($productos as $producto){
            $id=$producto['id'];
            $nombre=$producto['nombre'];
            $precio=$producto['precio'];
            echo '<option value="'.$id.'">'.$nombre.' '.$precio. '€</option>';        
        }
        echo "</select>";
    
        echo '<select name="numeros">';
        for($i = 1; $i <= 10; $i++){
            echo "<option value='$i'>$i</option>";
        }
        echo '</select>';

        echo '<input type="submit" value="Comprar" name="Comprar"/> ';
        echo "</form>";
    }


    public function cambiarContra() {
        ?>
        <form method="POST" action="../Controller/Controller.php">
            <div>
                <div>
                    <label><b>Introduce la nueva contraseña</b></label>
                    <input type="text" name="contra"/>
                </div>
                
                <input type="submit" name="accion" value="cambiarpass"/> 
            </div>
        </form>
        <?php
    }



    //Behin logina agiaztatuta dagoenean agertuko dena, login gabeko formularioa.
    //Una vez que el login esté verificado, el fomulario sin la parte de login.
    public function darseDeAlta() {
        ?>
         <form method="POST" action="../Controller/Controller.php">
            <div >
                <div>
                <label><b> Id</b></label>
                <input type="text" name="id"/>
                </div>
                <div >
                    <label><b> Nombre</b></label>
                    <input type="text" name="nombre"/>
                </div>

                <div>
                    <label><b>Contraseña</b></label>
                    <input type="password"  name="contra"/>
                </div>
                <br>
                <div>
                    <label><b>Administrador:</b></label>
                    Si<input type="radio" name="admin" value='1'/>
                    No<input type="radio" name="admin" value='0'/>
                </div>
                <br>
                
                <input type="submit" value="Enviar" name="Darse_de_alta"/> 
            </div>
        </form>
        <?php
    }
    public function area_usuario_admin(){
        ?>
         <h1>Gestion Tienda</h1>
        <form method="POST" action="../Controller/Controller.php">
            <input type="submit" value="Crear Producto" name="Productos"/>
            <input type="submit" value="Mostrar Pedidos" name="Pedidos"/> 
        </form>
        
        <?php
    }
    //Dado un array de arrays asociativos se representan los pedidos en una tabla.
    public function generarTablaPedidos($pedidos){
        echo"<h1>Detalles Pedidos</h1>";
        echo' <form method="POST" action="../Controller/Controller.php">';
        echo"<table>";
        echo"       <thead>";
        echo"           <tr>";
        echo"               <th>Cliente</th>";
        echo"               <th>Producto</th>";
        echo"               <th>Cantidad</th>";
        echo"           </tr>";
        echo"       </thead>";
        echo"       <tbody>";
        foreach($pedidos as $pedido){
            echo "<tr>";
            foreach($pedido as $columna){
                echo "<td>$columna</td>";
            }
            echo "</tr>";
        }
        echo"       </tbody>";
        echo"   </table>";
        ?>
        </form>
        <?php
        

    }
    public function crearProducto(){
        ?>

        <h1>Crear Producto</h1>
        <form method="POST" action="../Controller/Controller.php">
        <div>
            <label><b> Id</b></label>
            <input type="text" name="id_producto"/>
            </div>
            <div >
                <label><b> Nombre</b></label>
                <input type="text" name="nombre"/>
            </div>

            <div>
                <label><b> Precio</b></label>
                <input type="text"  name="precio"/>
            </div>
            <input type="submit" value="Crear Producto" name="Crear_Producto"/> 
        
        <?php
    }
   
}
