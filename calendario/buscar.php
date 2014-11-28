<html>
    <head> 
        <meta http-equiv=Content-Type content="text/html; charset=UTF-8" />
        <script>
            function cerrar() {
                $(window.parent).dialog('close');
            }
        </script>
    </head>
    <body style="font-size: small">
        <link rel="stylesheet" type="text/css" href="../estilos/style.css" />
        <div style="padding:15px;" id="buscar" >
            <fieldset style="background-color: #ddd;padding: 10px;">
                <legend>Buscar</legend>
                <form action="#" class="find" method="post" name="busqueda">
                    <table>
                        <th>OR / Cliente</th><th>referencia</th><th>denominación</th><th>matrícula</th>
                        <tr>
                            <td><?php if ($_SERVER['REMOTE_USER'] == "medina") { ?> Cliente: Medina <?php } else { ?>   <?php } ?> <input type="text" <?php if ($_SERVER['REMOTE_USER'] == "medina") { ?> value="MEDINA" style="display:none" <?php } ?> name="cliente" /></td>
                            <td><input type="text" name="referencia" /></td>
                            <td><input type="text" name="denominacion" /></td>
                            <td><input type="text" name="matricula" /></td>
                        </tr>
                        <tr><td><input type="submit" value="Buscar" /></td></tr>
                    </table>
                </form>  
            </fieldset>
        </div>
        <?php
        mysql_connect("localhost", "chechu");
        mysql_select_db("pedidos");
        if ((isset($_POST['denominacion']) and $_POST['denominacion'] != '') or (isset($_POST['referencia']) and $_POST['referencia'] != '') or (isset($_POST['matricula']) and $_POST['matricula'] != '') or (isset($_POST['cliente']) and $_POST['cliente'] != '')) {
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
                    mysql_connect("localhost", "chechu");
                    mysql_select_db("pedidos");
                    $tablas = mysql_query("SHOW TABLES FROM pedidos");
                    if ($_SERVER['REMOTE_USER'] == "recepcion") {
                        $buscar = mysql_query("SELECT * 
				FROM lineas 
				WHERE referencia LIKE '%" . $_POST['referencia'] . "%' 
				AND matricula LIKE '%" . $_POST['matricula'] . "%' 
				AND cliente LIKE '%" . $_POST['cliente'] . "%'
                                AND denominacion LIKE '%" . $_POST['denominacion'] . "%'
                                AND destino LIKE 'T'
				ORDER BY fecha DESC;");
                        $maximo = 100;
                        $mss = Array('enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre');
                        while ($ref = @mysql_fetch_row($buscar) and $maximo >= 0) {
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
                            echo "<tr $pendiente>
					<td>" . $ref[1] . "</td>
					<td>" . $ref[2] . "</td>
					<td>" . $ref[3] . "</td>
					<td>" . $ref[4] . "</td>
					<td>" . $ref[5] . "</td>
					<td>" . $ref[6] . "</td>
					<td>" . $ref[7] . "</td>
                                        <td><a href='pedidos.php?ano=" . $anio . "&mes=" . $ms . "&numes=" . $n . "&dia=" . $dy . "&ref=" . $ref[1] . "'>" . $ref[10] . "</a></td>
					<td><input type='checkbox' disabled='disabled'" . $ref[9] . "></td>
                                        <td></td>
					</tr>";
                        }
                    }else {
                        $nbuscar = mysql_query("SELECT referencia,cantidad,denominacion,matricula,cliente,fecha,fecha_pedido 
                        FROM lineas  
                        WHERE referencia LIKE '%" . $_POST['referencia'] . "%' 
                            AND matricula LIKE '%" . $_POST['matricula'] . "%'
                                AND cliente LIKE '%" . $_POST['cliente'] . "%'
                                    AND denominacion LIKE '%" . $_POST['denominacion'] . "%'
                                        ORDER BY fecha DESC;
                        union all 
                        SELECT referencia,cantidad,denominacion,cliente,comentario,fecha,pedido 
                        FROM semanal 
                        WHERE referencia LIKE '%" . $_POST['referencia'] . "%'
                                AND comentario LIKE '%" . $_POST['matricula'] . "%'
                                AND cliente LIKE '%" . $_POST['cliente'] . "%'
                                    AND denominacion LIKE '%" . $_POST['denominacion'] . "%'
                                        ORDER BY fecha DESC; ");
                        $maximo = 100;
                        while ($ref = @mysql_fetch_row($nbuscar) and $maximo >= 0) {
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
                            echo "<tr $pendiente>
					<td>" . $ref[1] . "</td>
					<td>" . $ref[2] . "</td>
					<td>" . $ref[3] . "</td>
					<td>" . $ref[4] . "</td>
					<td>" . $ref[5] . "</td>
					<td>" . $ref[6] . "</td>
					<td>" . $ref[7] . "</td>
                                        <td><a href='pedidos.php?ano=" . $anio . "&mes=" . $ms . "&numes=" . $n . "&dia=" . $dy . "&ref=" . $ref[1] . "' onclick='cerrar()'>" . $ref[10] . "</a></td>
					<td><input type='checkbox' disabled='disabled'" . $ref[9] . "></td>
					</tr>";
                        }
                    }
                    ?></table></div><?php
            }else {
                
            }
            ?>
    </body>
</html>