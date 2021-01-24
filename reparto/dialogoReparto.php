<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv=Content-Type content="text/html; charset=UTF-8" />
        <link rel="shortcut icon" href="../imagenes/chechu.ico" />
        <link rel="stylesheet" type="text/css" href="../scripts/styles.css" />
        <?php include_once '../scripts/estilos.php'; ?>
        <title>Ruta</title>
        <link rel="shortcut icon" href="../imagenes/chechu.ico" />
        <script type="text/javascript">
            function objetoAjax() {
                var xmlhttp = false;
                try {
                    xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
                } catch (e) {
                    try {
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                    } catch (E) {
                        xmlhttp = false;
                    }
                }
                if (!xmlhttp && typeof XMLHttpRequest !== 'undefined') {
                    xmlhttp = new XMLHttpRequest();
                }
                return xmlhttp;
            }

            var actualizarrutas = new objetoAjax();

            function enviarConsulta() {
                var id = document.getElementById('id').value;
                var repartidor = document.getElementById('empleado').value;
                var furgona = document.getElementById('prio').value;
                actualizarrutas.open("GET", "salidaReparto.php?cod=" + cod + "&ordenante=" + ordenante + "&prio=" + prio + "&comentario=" + comentario, true);
                actualizarrutas.send(null);
                //document.writeln("../reparto/insertarRuta.php?cod=" + cod + "&ordenante=" + ordenante + "&prio=" + prio +"&comentario=" + comentario);
                window.opener.location.reload();
                this.window.close();
            }
        </script>
    </head>
    <body onload="document.getElementById('empleado').focus();">
        <h2 id="titulo"></h2>
        <form method="POST" action="dialogoNuevoCliente.php" style="text-align:center" onsubmit="enviarConsulta()" >
            <input type="hidden" id='cod' name="cod" value="<?php echo @$_GET['cod']; ?>" />
            <table>
                <tr>
                    <td><label>Nombre</label></td>
                    <td>
                        <select id="empleado">
                            <option></option>
                            <?php
                            include_once ('../estilos/conexion.php');
                            $empleados = mysql_query("SELECT * FROM empleados");
                            while ($usuario = mysql_fetch_row($empleados)) {
                                ?>
                                <option> <?php echo utf8_encode($usuario[1]); ?> </option>
<?php } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label>Furgona</label></td>
                    <td>
                        <select id="prio">
                            <option>Jumper</option>
                            <option>Berlingo</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" value="Cargar" /></td>
                </tr>
            </table>
        </form>
    </body>
</html>