<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//ES" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd" >
<html>
    <head>
        <meta http-equiv=Content-Type content="text/html; charset=UTF-8" />
        <title>Estadística</title>
        <?php include_once '../scripts/estilos.php'; ?>
        <link rel="stylesheet" href="../scripts/styles.css" type="text/css" />
        <?php include '../calendario/calcular_dia.php'; ?>
        <style>
            .barra{
                color: black;
                margin-top: 20px;
                margin-bottom: 5px;
                width: 30px;
                background-color: yellowgreen;
                border: 1px black solid;
                box-shadow: 2px 2px black;
            }
            a:hover .barra{
                box-shadow: none;
                color: yellow;
                cursor: pointer;
            }
            a{
                color:black;
            }
            a:hover{
                color:darkorange;
            }
            .texto{
                font-size: 10px;
                font-weight: bold;
            }
        </style>
    </head>
    <body>
        <div class="contenedor">
            <?php include_once '../scripts/cabecera.php'; ?>
            <div class="principal">
                <?php include_once '../scripts/menu.php'; ?>
            </div>
            <div class="banda">
                <?php
                mysql_connect("localhost", "chechu");
                mysql_select_db("pedidos");
                $suma = 0;
                $sumames = 0;
                $media = mysql_query("SELECT COUNT(*) AS cantidad, fecha_pedido FROM pedidos.lineas GROUP BY fecha_pedido;");
                $pedidomes = calcular_mes() . calcular_ano();
                $mediames = mysql_query("SELECT COUNT(*) AS cantidad, fecha_pedido FROM pedidos.lineas WHERE fecha_pedido LIKE '%".$pedidomes."%' GROUP BY fecha_pedido;");
                while ($row1 = mysql_fetch_row($media)) {
                    $suma = $suma + $row1[0];
                }
                while ($row2 = mysql_fetch_row($mediames)) {
                    $sumames = $sumames + $row2[0];
                }
                ?>
                <h2 style="padding:15px;">Lineas diarias de VP. </h2>
                <div style="float: right;padding: 8px;">
                    <h4 style="margin: 0px;color: black;">Media: <?php echo round($suma / mysql_num_rows($media), 2); ?></h4>
                    <h4 style="float: right; color: black;">Media de <?php echo calcular_mes() . ': ' . round($sumames / mysql_num_rows($mediames), 2); ?></h4>
                </div>
            </div>
            <div id="cabecera" >
                <div style="clear: both;"></div>
                <div style="background-color: antiquewhite">
                    <?php
                    $totales = mysql_query("SELECT COUNT(id) AS cantidad, fecha_pedido FROM pedidos.lineas GROUP BY fecha_pedido ORDER BY id DESC LIMIT 100;")  or die("Error en búsqueda.".  mysql_error());
                    while ($row = mysql_fetch_row($totales)) {
                        $mss = Array('enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre');
                        $ms = "";
                        $n = 0;
                        $anio = substr($row[1], -4);
                        for ($i = 0; $i < 12; $i++) {
                            if (stristr($row[1], $mss[$i]) == TRUE) {
                                $ms = $mss[$i];
                                $n = $i + 1;
                            }
                        }
                        $dy = substr($row[1], 0, -(strlen($ms) + 4));
                        ?>
                        <a href="pedidos.php?ano=<?php echo $anio; ?>&mes=<?php echo $ms; ?>&numes=<?php echo $n; ?>&dia=<?php echo $dy ?>" title="Ver pedido del día <?php echo $dy; ?> de <?php echo $ms; ?> del <?php echo $anio; ?>" >    
                            <div style="display: inline-block;">
                                <div class="barra" style="font-weight: bold;height: <?php echo $row[0]; ?>px;background-color: rgb(<?php echo ($row[0] + 120) . ',' . (156 - $row[0]) . ',' . (200 - $row[0]); ?>)" ><?php echo $row[0]; ?></div>
                                <span class="texto" ><?php echo $dy . '/' . $n . '/' . substr($anio, 2); ?></span>
                            </div>
                        </a>
                    <?php } ?>
                </div>
            </div>
            <?php include_once '../scripts/pie.php'; ?>
        </div>
    </body>
</html>