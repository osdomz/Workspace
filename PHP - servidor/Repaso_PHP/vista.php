<?php

class vista_Tienda
{
    public function Login()
    {
?>
        <form method="POST" action="controlador.php">
            <div>
                <div>
                    <label><b>Usuario</b></label>
                    <input type="text" placeholder="Ingrese su usuario" name="login_usuario" />
                </div>

                <div>
                    <label><b>Contraseña</b></label>
                    <input type="password" placeholder="Ingrese su contraseña" name="login_contrasena" />
                </div>
                <br>

                <input type="submit" name="accion" value="iniciar" />

                <!-- <input type="submit" name="accion" value="entrar">
                <input type="submit" name="accion" value="cambiar">
                <input type="submit" name="accion" value="registrar"> -->

            </div>
        </form>
    <?php
    }

    public function opcionesCliente()
    {
?>
        <form method="POST" action="controlador.php">
            <div>
                <label><b>Opciones para Cliente</b></label><br>

                <input type="radio" id="listar_productos" name="opcion_cliente" value="listar_productos">
                <label for="listar_productos">Listar Productos</label><br>

                <input type="radio" id="comprar_productos" name="opcion_cliente" value="comprar_productos">
                <label for="comprar_productos">Comprar Productos</label><br>

                <input type="radio" id="aplicar_descuento" name="opcion_cliente" value="aplicar_descuento">
                <label for="aplicar_descuento">Aplicar Descuento</label><br>

                <input type="radio" id="ver_ticket" name="opcion_cliente" value="ver_ticket">
                <label for="ver_ticket">Ver Ticket de Compra</label><br>
            </div>
            <br>
            <input type="submit" name="accion" value="opciones_cliente" />
        </form>
<?php
    }
    public function opcionesAdmin()
{
?>
    <form method="POST" action="controlador.php">
        <div>
            <label><b>Opciones para Administrador</b></label><br>

            <label for="opcion_usuarios"><b>Seleccione la opción para Usuarios:</b></label>
            <select id="opcion_usuarios" name="opcion_usuarios">
                <option value="crear_usuario">Crear Usuario</option>
                <option value="ver_usuarios">Ver Usuarios Clientes</option>
                <option value="actualizar_usuario">Actualizar Datos de Usuario</option>
                <option value="eliminar_usuario">Eliminar Usuario</option>
            </select>

            <br>

            <label for="opcion_productos"><b>Seleccione la opción para Productos:</b></label>
            <select id="opcion_productos" name="opcion_productos">
                <option value="crear_producto">Crear Producto</option>
                <option value="ver_productos">Ver Productos</option>
                <option value="actualizar_producto">Actualizar Datos de Producto</option>
                <option value="eliminar_producto">Eliminar Producto</option>
            </select>
        </div>
        <br>
        <input type="submit" name="accion" value="opciones_admin" />
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

                <input type="submit" name="accion" value="reponer" />
            </div>
        </form>
<?php
    }
}
