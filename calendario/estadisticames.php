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
                width: 60px;
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
                $mss = Array('enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre');
                ?>
                <h2 style="padding:15px;">Lineas mensuales de VP. </h2>
                <div style="float: right;padding: 8px;">
                </div>
            </div>
            <div id="cabecera" >
                <div style="clear: both;"></div>
                <div style="background-color: antiquewhite"> <?php
                    $anio = 2012;
                    for ($anio; $anio < date('Y')+1; $anio++) {
                        ?><h2><?php echo $anio; ?></h2> 
                        <?php
                        if ($anio == 2012) {
                            for ($ajuste = 0; $ajuste < 4; $ajuste++) {
                                ?>
                                <div style="display: inline-block;">
                                    <div class="barra" style="font-weight: bold;height: 10px;background-color: rgb(100,100,100)" ></div>
                                    <span class="texto" ><?php echo $mss[$ajuste] ?></span>
                                </div> 
                                <?php
                            }
                        }
                        for ($i = 0; $i < (count($mss)); $i++) {
                            $totalmes = mysql_query("SELECT COUNT( * ) AS cantidad, fecha_pedido FROM lineas GROUP BY fecha_pedido HAVING fecha_pedido LIKE '%" . $mss[$i] . $anio . "' ORDER BY id DESC ");
                            $totalsoc = mysql_query("SELECT COUNT( * ) AS cantidad, fecha_pedido FROM lineas WHERE salida LIKE 'SOC' GROUP BY fecha_pedido HAVING fecha_pedido LIKE '%" . $mss[$i] . $anio . "' ORDER BY id DESC ");
                            $totalcon = mysql_query("SELECT COUNT( * ) AS cantidad, fecha_pedido FROM lineas WHERE salida LIKE 'CONTADO' GROUP BY fecha_pedido HAVING fecha_pedido LIKE '%" . $mss[$i] . $anio . "' ORDER BY id DESC ");
                            $totalcre = mysql_query("SELECT COUNT( * ) AS cantidad, fecha_pedido FROM lineas WHERE salida LIKE 'CREDITO' GROUP BY fecha_pedido HAVING fecha_pedido LIKE '%" . $mss[$i] . $anio . "' ORDER BY id DESC ");
                            $totaltaller = mysql_query("SELECT COUNT( * ) AS cantidad, fecha_pedido FROM lineas WHERE salida LIKE 'NULO' GROUP BY fecha_pedido HAVING fecha_pedido LIKE '%" . $mss[$i] . $anio . "' ORDER BY id DESC ");
                            
                            $suma = 0;
                            $sumasoc = 0;
                            $sumacon = 0;
                            $sumacre = 0;
                            $sumataller = 0;
                            
                            $contador = 0;
                            if (mysql_num_rows($totalmes) > 0) {
                                while ($row3 = mysql_fetch_row($totalmes)) {
                                    $suma = $suma + $row3[0];
                                    $contador = $contador + 1;
                                }
                                while ($row = mysql_fetch_row($totalsoc)) {
                                    $sumasoc = $sumasoc + $row[0];
                                }
                                while ($row = mysql_fetch_row($totalcon)) {
                                    $sumacon = $sumacon + $row[0];
                                }
                                while ($row = mysql_fetch_row($totalcre)) {
                                    $sumacre = $sumacre + $row[0];
                                }
                                while ($row = mysql_fetch_row($totaltaller)) {
                                    $sumataller = $sumataller + $row[0];
                                }
                                ?>
                                <div style="display: inline-block;">
                                    <div class="barra" style="font-weight: bold;height: <?php echo $suma / $contador; ?>px;background-color: rgb(<?php echo ((round($suma / $contador, 0)) + 170) . ',' . (126 - (round($suma / $contador, 0))) . ',' . (100 - (round($suma / $contador, 0))); ?>)"  title='<?php echo $sumacon.": Contado\n".$sumasoc.": SOC\n".$sumacre.": Crédito\n".$sumataller.": Taller\n".$suma . ": Lineas"; ?>' ><?php echo round($suma / $contador, 2); ?></div>
                                    <span class="texto" ><?php echo $mss[$i]; ?></span>
                                </div>
                                <?php
                            }
                        }
                    }
                    ?>
                </div>
            </div>
            <?php include_once '../scripts/pie.php'; ?>
        </div>
    </body>
</html>
