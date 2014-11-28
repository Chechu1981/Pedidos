<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd" >
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Semanal</title>
        <link rel="shortcut icon" href="../imagenes/chechu.ico" />
        <link rel="stylesheet" href="../scripts/styles.css" type="text/css" />
        <?php include_once '../scripts/estilos.php'; ?>
        <?php
        mysql_connect("localhost", "chechu");
        mysql_select_db("pedidos");
        $contador = 1;
        mysql_select_db("pedidos");
        if (isset($_POST['incluir'])) {
            ?><script>alert(<?php echo $_POST['incluir'] ?>)</script><?php
            mysql_query("INSERT INTO semanal 
                (pedido, referencia, cantidad, denominacion, comentario, cliente, estado, fecha)
                VALUES 
                ('" . $_POST['pedido'] . "',
                '" . strtoupper($_POST['ref']) . "',
                " . $_POST['can'] . ",
                '" . utf8_decode(strtoupper($_POST['des'])) . "',
                '" . utf8_decode(strtoupper($_POST['com'])) . "',
                '" . utf8_decode(strtoupper($_POST['cli'])) . "',
                1, 
                NOW())");
        }
        ?>
        <script type="text/javascript">
            function verCalendario() {
                if (document.getElementById('calendario').style.display === "none") {
                    $('#calendario').show('blind', 200);
                } else {
                    $('#calendario').hide('slide');
                }
                $('#buscreferencia').focus();
            }
        </script>
    </head>
    <body onload="document.getElementById('ref').focus()" >
        <img id="imgcalendario" title="Buscar." onmouseout="this.src = '../imagenes/search.png'" onmouseover="this.src = '../imagenes/searcha.png'" style="position: fixed;top: 55px;left:0px;margin:7px;cursor:pointer" src="../imagenes/search.png" width="40" onclick="verCalendario()"  />
        <div class="contenedor">
            <?php include '../calendario/calcular_dia.php'; ?>
            <header>
                <?php include_once '../scripts/cabecera.php'; ?>
            </header>
            <nav>
                <?php include_once '../scripts/menu.php'; ?>
            </nav>
            <div class="principal">

                <script type="text/javascript" >
                    $(function() {
                        var availableTags = [
<?php
mysql_connect("localhost", "chechu");
mysql_select_db("carrion");
$clientes = mysql_query("SELECT * FROM hoja1;");
$cont = 0;
while ($nomcli = mysql_fetch_row($clientes)) {
    $imprime = '"' . $nomcli[1] . ' (' . $nomcli[0] . ')" ';
    if ($cont < (mysql_num_rows($clientes) - 1)) {
        $imprime = $imprime . ",";
        $cont++;
    }
    echo utf8_encode($imprime);
}
mysql_select_db("pedidos");
if (@isset($_GET['pedido'])) {
    $pedido = $_GET['pedido'];
} else {
    $psen = mysql_query("SELECT numero FROM listasemanal ORDER BY numero DESC;");
    $ped = mysql_fetch_row($psen);
    $pedido = $ped[0];
}
?>
                        ];
                        $("#cli").autocomplete({
                            source: availableTags
                        });
                    });
                    $(function() {
                        $("#fecha").datepicker({
                            firstDay: 1,
                            dateFormat: "DD dd/mm/yy",
                            dayNames: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"],
                            dayNamesMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
                            monthNames: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"]
                        });
                    });
                    $(function() {
                        $("#proximo").datepicker({
                            firstDay: 1,
                            dateFormat: "DD dd/mm/yy",
                            dayNames: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"],
                            dayNamesMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
                            monthNames: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"]
                        })
                    });
                </script>
                <script type="text/javascript" src="ajax.js" ></script>
                <div class="banda">
                    <h2 style="padding:15px;" id="titulo">Semanal Citroën</h2>
                    <a class="boton" href="listasemanal.php">Anteriores</a>
                    <div style="clear: both"></div>
                </div>
                <div style="clear: both"></div>
                <?php if (isset($_GET['encurso']) and $_GET['encurso'] == 'SI') { ?>
                    <div id="insertar" class="formulariopedido">
                        <fieldset title="Añadir"><legend>Añadir linea</legend>
                            <form action="semanal.php?encurso=SI" method="POST">
                                <table class="semanal">
                                    <tr style="background-color: white;">
                                        <th>Referencia</th>
                                        <th>Cantidad</th>
                                        <th>Denominación</th>
                                        <th>Cliente</th>
                                        <th>Comentario</th>
                                    </tr>
                                    <tr style="background-color: white;">
                                        <td><input type="hidden" name="pedido" value="<?php echo $pedido; ?>" /><input size="10" style="width:150px" type="text" id="ref" name="ref" value="" /></td>
                                        <td><input size="6" style="text-align: right"  type="text" id="can" name="can" value="" /></td>
                                        <td><input size="10" style="width:200px" type="text" id="des" name="des" value="" /></td>
                                        <td><input size="10" style="width:175px" type="text" id="cli" name="cli" value="" /></td>
                                        <td rowspan="2"><textarea size="10" style="width:170px;height: 80px;" name="com" value=""></textarea></td>
                                    </tr>
                                    <tr style="background-color: white;">
                                        <td colspan="5"><input name="incluir" type="submit" value="Añadir" style="border:1px solid black; border-width: 1px 3px 3px 1px;border-radius: 4px;background-color: gainsboro;box-shadow: black 1px ;padding:10px;" /></td>
                                    </tr>
                                </table>
                            </form>
                        </fieldset>
                    </div>
                    <?php
                }
                mysql_select_db("pedidos");
                $fechasemanal = mysql_query("SELECT * FROM listasemanal WHERE numero LIKE '" . $pedido . "';");
                if (isset($_GET['pedido'])) {
                    if ($pedido > 1) {
                        ?>
                        <a href="semanal.php?pedido=<?php echo $pedido - 1; ?>" title="Anterior" ><img src="../imagenes/carousel_previous_bg.gif" /></a>
                    <?php } ?><a href="semanal.php?pedido=<?php echo $_GET['pedido'] + 1; ?>" style="margin-left:20px" title="Siguiente" ><img src="../imagenes/carousel_next_bg.gif" /></a>
                <?php } else { ?>
                    <a href="semanal.php?pedido=<?php echo $pedido - 1; ?>" title="Anterior" ><img src="../imagenes/carousel_previous_bg.gif" /></a>
                    <?php
                }
                $grabado = mysql_fetch_row($fechasemanal)
                ?>
                <h1>Pedido <?php echo $pedido; ?></h1><h3><?php echo utf8_encode($grabado[1]); ?></h3><img src="../imagenes/print.png" title="Imprimir pedido." style="cursor:pointer;float: right" onclick="printsem(<?php echo $pedido; ?>)" />
                <?php if (isset($_GET['encurso']) and $_GET['encurso'] == 'SI') { ?>
                    <img src="../imagenes/ico_candado.jpg" id="candado" style="float: right;margin-right: 30px;cursor: pointer;" onclick="mostrarGuardar()" />
                    <div id="guardar" style="display: none;">
                        <input style="margin: 10px;" id="fecha" type="text" /><button onclick="nuevoPedido()" value="Guardar" >Guardar</button><br/>
                        <span id="texto" style="font-size: 18px;font-weight: bolder;">Fecha del próximo semanal:</span><input style="margin: 10px;" id="proximo" type="text" />
                    </div>
                <?php } ?>
                <div style="clear: both"></div>
                <hr/>
                <div id="tbl">
                    <table border='2' width='780px;' class='semanal'>
                        <tr><th></th><th><a href="semref.php?encurso=<?php echo @$_GET['encurso']; ?>&pedido=<?php echo $pedido; ?>" >Referencia</a></th><th style="width: 18px">C</th><th>Denominaci&oacute;n</th><th>Matr&iacute;cula/Comentario</th><th><a href="semcli.php?encurso=<?php echo @$_GET['encurso']; ?>&pedido=<?php echo $pedido; ?>" >Cliente/OR</a></th><th><a href="semanal.php?encurso=<?php echo @$_GET['encurso']; ?>&pedido=<?php echo $pedido; ?>"><b>Fecha</b></a></th><th></th></tr>
                        <?php
                        $sentencia = mysql_query("SELECT * FROM semanal WHERE pedido LIKE '" . $pedido . "' ORDER BY fecha DESC,cliente,referencia ;");
                        while ($fila = @mysql_fetch_row($sentencia)) {
                            if ($fila[0] == @$_GET['id']) {
                                $resalto = "style='background-color:green;color:yellow;font-style:bold;'";
                            } else {
                                $resalto = "";
                            }
                            ?>
                            <tr <?php echo $resalto; ?> >
                                <td><?php echo $contador++ ?></td>
                                <td><?php echo utf8_encode($fila[2]) ?></td>
                                <td style='text-align:center;'><?php echo utf8_encode($fila[3]) ?></td>
                                <td><?php echo utf8_encode($fila[4]) ?></td>
                                <td><?php if (isset($_GET['encurso']) and $_GET['encurso'] == 'SI') {
                                ?><textarea type="text" id="com<?php echo utf8_encode($fila[0]); ?>" value="" onblur="savecom(<?php echo utf8_encode($fila[0]); ?>)" ><?php echo utf8_encode($fila[5]); ?></textarea> <?php
                                    } else {
                                        echo utf8_encode($fila[5]);
                                    }
                                    ?>
                                </td>
                                <td style='text-align:center;'><?php echo utf8_encode($fila[6]) ?></td>
                                <td style='text-align:center;'><?php echo date("d-m-Y", strtotime(utf8_encode($fila[8]))) ?></td>
                                <td><?php if (isset($_GET['encurso']) and $_GET['encurso'] == 'SI') { ?><img id="eliminar<?php echo utf8_encode($fila[0]) ?>" onclick="eliminarLinea(<?php echo utf8_encode($fila[0]) . ",'" . $fila[2] . "'" ?>)" src='../imagenes/eliminar.png' style="cursor:pointer;"><?php } ?></td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
                <?php include_once '../scripts/pie.php'; ?>
            </div>
        </div>
        <div id="calendario" style="position: fixed;top: 115px;left:7px;margin:47px 0px 0px 7px;display:none">
            <fieldset style="width: 100px;background-color: #ddd;padding: 10px;">
                <legend>Buscar</legend>
                <form action="../calendario/calendario.php" class="find" method="post" name="busqueda">
                    referencia: <input type="text" name="referencia" id="buscreferencia" /><br/><br/>
                    denominación: <input type="text" name="denominacion" /><br/><br/>
                    matricula: <input type="text" name="matricula" /><br/><br/>
                    <?php if ($_SERVER['REMOTE_USER'] == "medina") { ?> Cliente: Medina <?php } else { ?>  OR/Cliente:  <?php } ?> <input type="text" <?php if ($_SERVER['REMOTE_USER'] == "medina") { ?> value="MEDINA" style="display:none" <?php } ?> name="cliente" /><br/><br/>
                    <input type="submit" value="Buscar" />
                </form>  
            </fieldset>
        </div>
    </body>
</html>