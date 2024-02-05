<?php
include_once('./Controller/controlador.php');

class Vista_Tienda
{
    public function Login()
    {
?>
        <form method="POST" action="controlador.php">
            <div>
                <div>
                    <label><b>Usuario</b></label>
                    <input type="text" placeholder="Ingrese su usuario" name="usuario" />
                </div>

                <div>
                    <label><b>Contraseña</b></label>
                    <input type="password" placeholder="Ingrese su contraseña" name="contrasena" />
                </div>
                <br>

                <input type="submit" name="iniciar" value="iniciar sesion" />

                <!-- <input type="submit" name="accion" value="entrar">
                <input type="submit" name="accion" value="cambiar">
                <input type="submit" name="accion" value="registrar"> -->

            </div>
        </form>
    <?php
    }

    public function Reponer()
    {
    ?>
        <form method="POST" action="controlador.php">
            <div>
                <div>
                    <label><b>Nombre del Producto</b></label>
                    <input type="text" placeholder="Ingrese el nombre del producto" name="nombre_producto" />
                </div>

                <div>
                    <label><b>Precio del Producto</b></label>
                    <input type="text" placeholder="Ingrese el precio del producto" name="precio_producto" />
                </div>

                <div>
                    <label><b>Cantidad</b></label>
                    <input type="text" placeholder="Ingrese la cantidad del producto" name="cantidad_producto" />
                </div>
                <br>

                <input type="submit" name="reponer" value="reponer producto" />
            </div>
        </form>
<?php
    }
}
?>