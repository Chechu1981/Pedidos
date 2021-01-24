<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd" >
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Semanal</title>
        <link rel="shortcut icon" href="../imagenes/chechu.ico" />
        <link rel="stylesheet" href="../scripts/styles.css" type="text/css" />
        <link rel="stylesheet" type="text/css" href="../estilos/style.css" />
        <?php
        mysql_connect("localhost", "chechu");
        $numero = 0;
        $contador = 1;
        mysql_select_db("pedidos");
        if (isset($_POST['ref']) and $_POST['ref'] != "") {
            mysql_query("INSERT INTO semanal 
                (pedido, referencia, cantidad, denominacion, comentario, cliente, estado, fecha)
                VALUES 
                ('1',
                '" . strtoupper($_POST['ref']) . "',
                " . $_POST['can'] . ",
                '" . utf8_encode(strtoupper($_POST['des'])) . "',
                '" . utf8_encode(strtoupper($_POST['com'])) . "',
                '" . utf8_encode(strtoupper($_POST['cli'])) . "',
                1, 
                NOW())");
        }
        ?>
    </head>
    <body onload="document.getElementById('ref').focus()" >
        <div class="contenedor">
            <div class="banda">
                <h2 style="padding:15px;" id="titulo">Semanal</h2>
                <div style="clear: both"></div>
            </div>
            <div style="clear: both"></div>
            <div id="insertar" class="formulariopedido">
                <fieldset title="Añadir"><legend>Añadir linea</legend>
                    <form action="semanal_1.php" method="POST">
                        <table class="semanal">
                            <tr>
                                <th>Referencia</th>
                                <th>Cantidad</th>
                                <th>Denominación</th>
                                <th>Cliente</th>
                                <th>Comentario</th>
                            </tr>
                            <tr>
                                <td><input size="10" style="width:150px" type="text" id="ref" name="ref" value="" /></td>
                                <td><input size="6" style="text-align: right"  type="text" id="can" name="can" value="" /></td>
                                <td><input size="10" style="width:200px" type="text" id="des" name="des" value="" /></td>
                                <td><input size="10" style="width:175px" type="text" id="cli" name="cli" value="" /></td>
                                <td rowspan="2"><textarea size="10" style="width:170px;height: 80px;" id="com" name="com" value=""></textarea></td>
                            </tr>
                            <tr>
                                <td colspan="5"><input name="incluir" type="submit" value="Añadir" style="border:1px solid black; border-width: 1px 3px 3px 1px;border-radius: 4px;background-color: gainsboro;box-shadow: black 1px ;padding:10px;" /></td>
                            </tr>
                        </table>
                    </form>
                </fieldset>
            </div>
            <?php
            $sentencia = mysql_query("SELECT * FROM semanal WHERE pedido = 1 ORDER BY id DESC;");
            $pedido = mysql_fetch_row($sentencia);
            ?>
            <h1>Pedido <?php echo $pedido[1]; ?></h1>
            <input style="margin: 10px;" id="fecha" type="text" /><button value="Guardar">Guardar</button>
            <hr/>
            <div id="t-pedido">
                <table border='2' width='780px;' class='semanal'>
                    <tr><th>Linea</th><th><span class="enlace" >Referencia</span></th><th style="width: 18px">C</th><th>Denominaci&oacute;n</th><th>Matr&iacute;cula/Comentario</th><th><span class="enlace" >Cliente/OR</span></th><th>Estado</th><th><span class="enlace" ><b>Fecha</b></span></th><th></th></tr>
                    <?php
                    while ($fila = mysql_fetch_row($sentencia)) {
                        $numero++;
                        $chk = "";
                        if ($fila[7] == 0) {
                            $gris = "class=\"sombra\"";
                            $chk = "checked='checked'";
                        } else {
                            $gris = "";
                            $chk = "";
                        }
                        ?>
                        <tr <?php echo $gris; ?> >
                            <td><?php echo $contador++ ?></td>
                            <td><?php echo utf8_encode($fila[2]) ?></td>
                            <td style='text-align:center;'><?php echo utf8_encode($fila[3]) ?></td>
                            <td><?php echo utf8_encode($fila[4]) ?></td>
                            <td><?php echo utf8_encode($fila[5]) ?></td>
                            <td style='text-align:center;'><?php echo utf8_encode($fila[6]) ?></td>
                            <td style='font-size:12px;'><?php echo utf8_encode($fila[7]) ?></td>
                            <td style='text-align:center;'><?php echo utf8_encode($fila[8]) ?></td>
                            <td><img id="eliminar<?php echo utf8_encode($fila[0]) ?>" onclick="eliminarLinea(<?php echo utf8_encode($fila[0]) . ",'" . $fila[2] . "'" ?>)" src='../imagenes/eliminar.png' style="cursor:pointer;"></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
            <?php include_once '../scripts/pie.php'; ?>
        </div>
    </body>
</html>