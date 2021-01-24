<!DOCTYPE html>
<html>
    <head>
        <title>Empresa Carrión</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=1024, user-scalable=yes" />
        <meta name="description" content="Empresa Carrión, concesionario oficial CITROEN y VOLVO en Valladolid" />
        <meta name="keywords" content="Carrión, CITROEN, VOLVO, Empresa Carrión, Valladolid, Inicio, Principal, Ocasión" />
        <meta name="Description" id="ctl00_mDescription" content="CITROËN, VALLADOLID, EMPRESA CARRION, S.A. :Bienvenido a la Red Oficial de Citroën. Te invitamos a descubrir las mejores ofertas y servicios.">
        <meta name="author" content="Jesús Martín" />
        <link href="./css/style.css" rel="stylesheet" />
        <?php
        // datos para la conexion a mysql
        include 'helper/conexion.php';
        mysql_select_db("carrion");
        $clientes = mysql_query("SELECT * FROM usuarios");
        ?>
    </head>
    <body style="color:black;" onload="document.getElementById('nombre').focus()">
        <div class="bienbenida">
            <img src="../imagenes/carrion.png" width="200" ><br/>
            Bienvenido al sistema de pedidos de Empresa Carrión
        </div>
        <div class="titulo_login">
            Identificación de usuario.
        </div>
        <div class="formulario">
            <form action="#" method="post">
                <table>
                    <tr>
                        <td>Nombre</td>
                        <td><input type="text" id="nombre" name="nombre" /></td>
                    </tr>
                    <tr>
                        <td>Contraseña</td>
                        <td><input type="password" id="pass" name="pass" /></td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="submit" value="ENTRAR"/></td>
                    </tr>
                </table>
            </form>
            <div class="alerta">
                <?php
                session_start();
                if (isset($_POST['nombre']) && isset($_POST['pass'])) {
                    $_SESSION['existe'] = false;
                    $_SESSION['cliente'] = "";
                    while ($cliente = mysql_fetch_row($clientes)) {
                        if (strtoupper($cliente[1]) == strtoupper($_POST['nombre']) && $cliente[2] == $_POST['pass']) {
                            $_SESSION['existe'] = true;
                            $_SESSION['codigo'] = $cliente[3];
                            $_SESSION['cliente'] = $cliente[2];
                            $_SESSION['razon'] = $cliente[4];
                            $_SESSION['nombre'] = $cliente[1];
                        }
                    }
                    if ($_SESSION['existe']) {
                        header("Location: ./inicio/inicio.php?id=".  session_id());
                    } else {
                        echo "Usuario o contraseña incorrecto.";
                    }
                }
                ?>
            </div>
        </div>
    </body>
</html>