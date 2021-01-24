<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd" >
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Cuaderno</title>
        <link rel="shortcut icon" href="../imagenes/chechu.ico" />
        <link rel="stylesheet" href="../scripts/styles.css" type="text/css" />
        <link rel="stylesheet" href="../../scripts/jquery-ui.css" />
        <link rel="stylesheet" href="../../scripts/jquery.ui.theme.css" />
        <script src="../../scripts/jquery-1.9.1.js"></script>  
        <script src="../../scripts/jquery-ui.js"></script>
        <script src="funcionesC.js" type="text/javascript" ></script>
        <?php 
        include_once '../scripts/estilos.php'; 
        mysql_connect("localhost", "chechu");
        mysql_select_db("carrion");
        ?>
    </head>
    <body>
        <input class='calendario' type="text" id="calen" />
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
                    $(function () {
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
?>
                        ];
                        $("#cli").autocomplete({
                            source: availableTags
                        });
                    });
                </script>
                <div class="banda">
                    <h2 style="padding:15px;" id="titulo">Cuaderno de pedidos. César</h2>
                    <h2>Pedidos del <?php echo $_GET['dia']; ?></h2>
                    <div style="clear: both"></div>
                </div>
                <div style="clear: both"></div>

                <div style="clear: both"></div>
            </div>
        </div>
        <div id="tbl">
            <table border='2' width='780px' class='cuadernoTbl' style="margin:auto">
                <tr>
                    <th></th>
                    <th>Cliente</th>
                    <th style="width: 18px">Contacto</th>
                    <th>Datos del pedido</th>
                    <th>Vehiculo</th>
                    <th>N</th>
                    <th>Referencia</th>
                    <th>ubicacion</th>
                    <th>comentario</th>
                    <th>Servido</th>
                    <th>Pedido</th>
                    <th>fecha</th>
                    <th></th>
                </tr>
                <?php
                $contador = 1;
                $sentencia = mysql_query("SELECT * FROM `cuaderno` WHERE date_format(fecha,'%d-%c-%Y') = '".$_GET['dia']."' AND operario LIKE 'CESAR' ORDER BY fecha DESC,cliente,referencia ;");
                while ($fila = @mysql_fetch_row($sentencia)) {
                    if (utf8_encode($fila[10]) == '') {
                        $resalto = "style='background-color:green;color:yellow;font-style:bold;'";
                    } else {
                        $resalto = "";
                    }
                    $date = date_create($fila[12]);
                    ?>
                    <tr <?php echo $resalto; ?> class='abrirDialogo' >
                        <td onclick="abrirDialogo(<?php echo utf8_encode($fila[0]); ?>)"><?php echo $contador++ ?></td>
                        <td onclick="abrirDialogo(<?php echo utf8_encode($fila[0]); ?>)"><?php echo utf8_encode($fila[1]); ?></td>
                        <td style='text-align:center;' onclick="abrirDialogo(<?php echo utf8_encode($fila[0]); ?>)"><?php echo utf8_encode($fila[2]); ?></td>
                        <td onclick="abrirDialogo(<?php echo utf8_encode($fila[0]); ?>)"><?php echo utf8_encode($fila[3]); ?></td>
                        <td onclick="abrirDialogo(<?php echo utf8_encode($fila[0]); ?>)"><?php echo utf8_encode($fila[5]); ?></td>
                        <td style='text-align:center;' onclick="abrirDialogo(<?php echo utf8_encode($fila[0]); ?>)"><?php echo utf8_encode($fila[4]); ?></td>
                        <td style='text-align:center;' onclick="abrirDialogo(<?php echo utf8_encode($fila[0]); ?>)"><?php echo utf8_encode($fila[6]); ?></td>
                        <td style='text-align:center;' onclick="abrirDialogo(<?php echo utf8_encode($fila[0]); ?>)"><?php echo utf8_encode($fila[7]); ?></td>
                        <td style='text-align:center;' onclick="abrirDialogo(<?php echo utf8_encode($fila[0]); ?>)"><?php echo utf8_encode($fila[8]); ?></td>
                        <td style='text-align:center;' onclick="abrirDialogo(<?php echo utf8_encode($fila[0]); ?>)"><?php echo utf8_encode($fila[9]); ?></td>
                        <td style='text-align:center;' onclick="abrirDialogo(<?php echo utf8_encode($fila[0]); ?>)"><?php echo utf8_encode($fila[10]); ?></td>
                        <td style='text-align:center;' onclick="abrirDialogo(<?php echo utf8_encode($fila[0]); ?>)"><?php echo date_format($date, 'H:i:s'); ?></td>
                        <td><img id="borrar<?php echo utf8_encode($fila[0]) ?>" onclick="borrar(<?php echo utf8_encode($fila[0]) . ",'" . $fila[1] . "'" ?>)" src='../imagenes/eliminar.png' style="cursor:pointer;"/></td>
                    </tr>
                <?php } ?>
            </table>
        </div>
        <div style="width:1000px;margin:auto">
            <?php include_once '../scripts/pie.php'; ?>
        </div>
        <div id="calendario" style="position: fixed;top: 115px;left:7px;margin:47px 0px 0px 7px;display:none">
            <fieldset style="width: 100px;background-color: #ddd;padding: 10px;">
                <legend>Buscar</legend>
                <form action="buscar.php" class="find" method="post" name="busqueda">
                    Cliente: <input type="text" name="cliente" id="buscreferencia" /><br/><br/>
                    Pedido: <input type="text" name="pedido" /><br/><br/>
                    Referencia: <input type="text" name="referencia" /><br/><br/>
                    <?php if ($_SERVER['REMOTE_USER'] == "medina") { ?> Cliente: Medina <?php } else { ?>  VIN:  <?php } ?> <input type="text" <?php if ($_SERVER['REMOTE_USER'] == "medina") { ?> value="MEDINA" style="display:none" <?php } ?> name="vin" /><br/><br/>
                    <input type="submit" value="Buscar" />
                </form>  
            </fieldset>
        </div>
    </body>
</html>