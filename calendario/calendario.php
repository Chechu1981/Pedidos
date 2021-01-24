<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv=Content-Type content="text/html; charset=UTF-8" />
        <title>Pedidos Citroen</title>
        <link rel="shortcut icon" href="../cruze/favicon.ico" />
        <?php include_once '../scripts/estilos.php'; ?>
        <link rel="stylesheet" href="../scripts/styles.css" type="text/css" />
        <script language="javascript">
            function tratarFecha(dia, mes, ano) {
<?php $funcionTratarFecha; ?>
            }
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
                if (!xmlhttp && typeof XMLHttpRequest != 'undefined') {
                    xmlhttp = new XMLHttpRequest();
                }
                return xmlhttp;
            }

            correo = objetoAjax();

            function enviarcorreo(id) {
                alert("Función deshabilitada. Tenemos que enviar el correo a pedal. /nLo estoy arreglando. Chechu");
                $.ajax({
                    url: 'http://www.empresacarrion.com/avisarmail.php?id=' + id,
                    dataType: 'jsonp',
                    data: data
                });


                /*
                 var env = confirm("¿Enviar correo a recepción?");
                 if (env) {
                 $.ajax({
                 url: 'http://www.empresacarrion.com/avisomail.php',
                 dataType: 'jsonp',
                 data: {'id':id}
                 });
                 /*
                 correo.open("GET", "http://www.empresacarrion.com/avisomail.php?id=" + id, true);
                 correo.send(null);
                 alert("Correo enviado a recepción con éxito.");*/
            }
        </script>
        <?php include './calcular_dia.php'; ?>
    </head>
    <body>
        <div class="contenedor">
            <header>
                <?php include_once '../scripts/cabecera.php'; ?>
            </header>
            <nav>
                <div class="principal">
                    <?php include_once '../scripts/menu.php'; ?>
                </div>
            </nav>
            <div class="banda">
                <img src="../imagenes/logo_Citroen.png" width="90" style="float: left;margin: 8px" />
                <h2 style="padding:15px;">Pedidos Citroen</h2>
                <a href="calendario.php" target="_self">
                    <div id="nuevo">
                        Calendario
                    </div>
                </a>
            </div>
            <?php
            if ((isset($_POST['denominacion']) and $_POST['denominacion'] != '') or ( isset($_POST['referencia']) and $_POST['referencia'] != '') or ( isset($_POST['matricula']) and $_POST['matricula'] != '') or ( isset($_POST['cliente']) and $_POST['cliente'] != '')) {
                ?><div style="clear:both">
                    <table border='2' class="listado">
                        <th>Referencia</th>
                        <th>C</th>
                        <th>Denominación</th>
                        <th>Matrícula</th>
                        <th>Cliente</th>
                        <th>Fecha</th>
                        <th>D</th>
                        <th>Pedido</th>
                        <th>PS</th>
                        <th></th>
                        <?php
                        include_once '../estilos/conexion.php';
                        $tablas = $mysqli->query("SHOW TABLES FROM pedidos");
                        if ($_SERVER['REMOTE_USER'] == "recepcion") {
                            $buscar = $mysqli->query("SELECT * 
				FROM lineas 
				WHERE referencia LIKE '%" . $_POST['referencia'] . "%' 
				AND matricula LIKE '%" . $_POST['matricula'] . "%' 
				AND cliente LIKE '%" . $_POST['cliente'] . "%'
                                AND denominacion LIKE '%" . $_POST['denominacion'] . "%'
                                AND destino LIKE 'T'
				ORDER BY fecha DESC;");
                            $maximo = 100;
                            $mss = Array('enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre');
                            while ($ref = @$buscar->fetch_row() and $maximo >= 0) {
                                $mss = Array('enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre');
                                $anio = substr($ref[10], -4);
                                $ms = "";
                                $n = 0;
                                for ($i = 0; $i < 12; $i++) {
                                    if (stristr($ref[10], $mss[$i]) == TRUE) {
                                        $ms = $mss[$i];
                                        $n = $i + 1;
                                    }
                                }
                                $dy = substr($ref[10], 0, -(strlen($ms) + 4));
                                $maximo--;
                                if ($ref[9] != '')
                                    $pendiente = "style=color:red";
                                else
                                    $pendiente = '';
                                $mes = '';
                                $date = date_create($ref[6]);
                                for ($m = 0; $m < 12; $m++) {
                                    if (date_format($date, 'm') == $m + 1)
                                        $mes = $mss[$m];
                                }
                                echo "<tr $pendiente>
					<td>" . $ref[1] . "</td>
					<td>" . $ref[2] . "</td>
					<td>" . $ref[3] . "</td>
					<td>" . $ref[4] . "</td>
					<td>" . $ref[5] . "</td>
					<td>" . date_format($date, 'd/') . $mes . date_format($date, '/Y') . ' ' . date_format($date, 'H:i:s') . "</td>
					<td>" . $ref[7] . "</td>
                                        <td><a href='../../calendario/pedidos.php?ano=" . $anio . "&mes=" . $ms . "&numes=" . $n . "&dia=" . $dy . "&ref=" . $ref[1] . "'>" . $ref[10] . "</a></td>
					<td><input type='checkbox' disabled='disabled'" . $ref[9] . "></td>
                                        <td></td>
					</tr>";
                            }
                        }else {
                            $nbuscar = $mysqli->query("SELECT id,referencia,cantidad,denominacion,matricula,cliente,fecha,destino,pedido,ps,fecha_pedido,salida 
                                FROM lineas  
                                WHERE referencia LIKE '%" . $_POST['referencia'] . "%' 
                                AND matricula LIKE '%" . $_POST['matricula'] . "%'
                                AND cliente LIKE '%" . $_POST['cliente'] . "%'
                                AND denominacion LIKE '%" . $_POST['denominacion'] . "%'
                                union all 
                                SELECT  id, referencia, cantidad, denominacion, comentario, cliente, fecha, 'S', pedido, 'semanal', pedido, 'tipo'
                                FROM semanal 
                                WHERE referencia LIKE '%" . $_POST['referencia'] . "%'
                                AND comentario LIKE '%" . $_POST['matricula'] . "%'
                                AND cliente LIKE '%" . $_POST['cliente'] . "%'
                                AND denominacion LIKE '%" . $_POST['denominacion'] . "%'
                                ORDER BY fecha DESC; ");
                            $maximo = 100;
                            while ($ref = $nbuscar->fetch_row() and $maximo >= 0) {
                                $mss = Array('enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre');
                                $anio = substr($ref[10], -4);
                                $ms = "";
                                $n = 0;
                                for ($i = 0; $i < 12; $i++) {
                                    if (stristr($ref[10], $mss[$i]) == TRUE) {
                                        $ms = $mss[$i];
                                        $n = $i + 1;
                                    }
                                }
                                $dy = substr($ref[10], 0, -(strlen($ms) + 4));
                                $maximo--;
                                $mes = '';
                                $date = date_create($ref[6]);
                                for ($m = 0; $m < 12; $m++) {
                                    if (date_format($date, 'm') == $m + 1)
                                        $mes = $mss[$m];
                                }
                                $ruta = "";
                                $identificador = $ref[10];
                                if ($ref[7] == 'S') {
                                    $pendiente = "style = color:green";
                                    $ruta = "../semanal/semanal.php?pedido=" . $ref[8] . "&id=" . $ref[0] . "'";
                                    $identificador = "Semanal " . $ref[10];
                                } elseif ($ref[9] != '') {
                                    $pendiente = "style=color:red";
                                    $ruta = "../calendario/pedidos.php?ano=" . $anio . "&mes=" . $ms . "&numes=" . $n . "&dia=" . $dy . "&ref=" . $ref[1] . "'";
                                } else {
                                    $pendiente = '';
                                    $ruta = "../calendario/pedidos.php?ano=" . $anio . "&mes=" . $ms . "&numes=" . $n . "&dia=" . $dy . "&ref=" . $ref[1] . "'";
                                }
                                echo "<tr $pendiente>
					<td>" . $ref[1] . "</td>
					<td>" . $ref[2] . "</td>
					<td>" . $ref[3] . "</td>
					<td>" . $ref[4] . "</td>
					<td>" . $ref[5] . "</td>
					<td>" . date_format($date, 'd/') . $mes . date_format($date, '/Y') . ' ' . date_format($date, 'H:i:s') . "</td>
					<td>" . $ref[7] . "</td>
                                        <td><a href='" . $ruta . "'>" . $identificador . "</a></td>
					<td><input type='checkbox' disabled='disabled'" . $ref[9] . "></td>
                                        <td>";
                                if ($ref[7] == "T") {
                                    echo "<span style='cursor:pointer' onclick='enviarcorreo(" . $ref[0] . ")' title='Avisar a recepción por correo.' ><img src='../imagenes/email.png' width='20px' /></span>";
                                }
                                echo "</td>
					</tr>";
                            }
                        }
                        ?></table></div><?php
                } else {
                    $anoInicial = '2011';
                    $anoFinal = '2030';
                    $funcionTratarFecha = 'document.location = "?dia="+dia+"&mes="+mes+"&ano="+ano;';
                    ?>
                <form><table style="clear:both;" border="0" cellpadding="5" cellspacing="0" bgcolor="#D4D0C8">
                        <tr>
                            <td width="740px">
                                <?php
                                $fecha = getdate(time());
                                if (isset($_GET["dia"]))
                                    $dia = $_GET["dia"];
                                else
                                    $dia = $fecha['mday'];
                                if (isset($_GET["mes"]))
                                    $mes = $_GET["mes"];
                                else
                                    $mes = $fecha['mon'];
                                if (isset($_GET["ano"]))
                                    $ano = $_GET["ano"];
                                else
                                    $ano = $fecha['year'];
                                $fecha = mktime(0, 0, 0, $mes, $dia, $ano);
                                $fechaInicioMes = mktime(0, 0, 0, $mes, 1, $ano);
                                $fechaInicioMes = date("w", $fechaInicioMes);
                                ?>
                                <select style="font-size:20px;" size="1" name="mes" class="m1" onChange="document.location = '?dia=<?= $dia ?>&mes=' + document.forms[0].mes.value + '&ano=<?= $ano ?>';">
                                    <?php
                                    $meses = Array('enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre');
                                    for ($i = 1; $i <= 12; $i++) {
                                        echo '      <option ';
                                        if ($mes == $i)
                                            echo 'selected ';
                                        echo 'value="' . $i . '">' . $meses[$i - 1] . "\n";
                                    }
                                    ?>
                                </select>&nbsp;&nbsp;&nbsp;<select style="font-size:20px;" size="1" name="ano" class="m1" onChange="document.location = '?dia=<?= $dia ?>&mes=<?= $mes ?>&ano=' + document.forms[0].ano.value;">
                                    <?php
                                    for ($i = $anoInicial; $i <= $anoFinal; $i++) {
                                        echo '      <option ';
                                        if ($ano == $i)
                                            echo 'selected ';
                                        echo 'value="' . $i . '">' . $i . "\n";
                                    }
                                    ?>
                                </select><br>
                                    <font size="1">&nbsp;</font><table border="0" cellpadding="2" cellspacing="0" width="100%" class="m1" bgcolor="#FFFFFF" height="100%">
                                        <?php
                                        $diasSem = Array('L', 'M', 'M', 'J', 'V', 'S', 'D');
                                        $ultimoDia = date('t', $fecha);
                                        $numMes = 0;
                                        for ($fila = 0; $fila < 7; $fila++) {
                                            echo "      <tr>\n";
                                            for ($coln = 0; $coln < 7; $coln++) {
                                                $posicion = Array(1, 2, 3, 4, 5, 6, 0);
                                                echo '        <td width="14%" height="19"';
                                                if ($fila == 0)
                                                    echo ' bgcolor="#808080"';
                                                if ($dia - 1 == $numMes)
                                                    echo ' bgcolor="#0A246A"';
                                                echo " align=\"center\">\n";
                                                echo '        ';
                                                if ($fila == 0)
                                                    echo '<font color="#D4D0C8">' . $diasSem[$coln];
                                                elseif (($numMes && $numMes < $ultimoDia) || (!$numMes && $posicion[$coln] == $fechaInicioMes)) {
                                                    echo '<a href="pedidos.php?diasemana=' . ($coln + 1) . '&numes=' . $mes . '&dia=' . ($numMes + 1) . '&mes=' . $meses[$mes - 1] . '&ano=' . $ano . '" onclick="tratarFecha(' . ( ++$numMes) . ',' . $mes . ',' . $ano . ')">';
                                                    if ($dia == $numMes)
                                                        echo '<font color="#FFFFFF">';
                                                    echo ($numMes) . '</a>';
                                                }
                                                echo "</td>\n";
                                            }
                                            echo "      </tr>\n";
                                        }
                                        ?>
                                    </table>
                            </td>
                        </tr>
                    </table>
                    </td>
                    </tr>
                    </table>
                </form>
            <?php } ?>
            <?php include_once '../scripts/pie.php'; ?>
        </div>
        <div style="position:fixed;top:150px;width:100px;padding:15px;">
            <fieldset style="width: 100px;background-color: #ddd;padding: 10px;">
                <legend>Buscar</legend>
                <form action="calendario.php" class="find" method="post" name="busqueda">
                    referencia: <input type="text" name="referencia" /><br/><br/>
                    denominación: <input type="text" name="denominacion" /><br/><br/>
                    matrícula: <input type="text" name="matricula" /><br/><br/>
                    <?php if ($_SERVER['REMOTE_USER'] == "medina") { ?> Cliente: Medina <?php } else { ?>  OR/Cliente:  <?php } ?> <input type="text" <?php if ($_SERVER['REMOTE_USER'] == "medina") { ?> value="MEDINA" style="display:none" <?php } ?> name="cliente" /><br/><br/>
                    <input type="submit" value="Buscar" />
                </form>  
            </fieldset>
        </div>
    </body>
</html>