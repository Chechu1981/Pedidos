<?php
$fpedido = "";
$ftexto = "";
if (isset($_GET['pedido'])) {
    $fpedido = $_GET['pedido'];
    $cadena = $_GET['pedido'];
    $mes = "";
    $dia = "";
    for ($i = 0; $i < strlen(substr($cadena, 0, -4)); $i++) {
        if (is_numeric($cadena[$i])) {
            $dia = $dia . $cadena[$i];
        } else {
            $mes = $mes . $cadena[$i];
        }
    }
    $ftexto = "Urgente<br/>Pedido del " . $dia . " de " . $mes . " del " . substr($cadena, -4);
} else {
    $fpedido = calcular_dia() . calcular_mes() . calcular_ano();
    $ftexto = "Urgente<br/>Pedido del " . calcular_dia() . " de " . calcular_mes() . " del " . calcular_ano();
}
?>
<div class="titulo">
    <?php echo $ftexto; ?>
</div>
<?php
mysql_select_db("pedidos");
$sentencia = mysql_query("SELECT * FROM lineas WHERE cliente LIKE '%" . $_SESSION['codigo'] . "%' AND fecha_pedido = '" . $fpedido . "' ORDER BY fecha DESC");
$contador = 1;
if (@mysql_num_rows($sentencia) > 0) {
    ?>
    <table>
        <tr>
            <th>Nº</th>
            <th>REFERENCIA</th>
            <th>C</th>
            <th>DESIGNACION</th>
            <th>COMENTARIO</th>
            <th>PEDIDO</th>
            <th>PS</th>
            <th>FECHA</th>
        </tr>
        <?php
        while ($fila = @mysql_fetch_row($sentencia)) {
            $p = "";
            $ps = "";
            $clase_pedido = "";
            if ($fila[8] != "") {
                $p = "SI";
                $clase_pedido = "class='pedido'";
            } else {
                $p = "NO";
            }
            if ($fila[9] != "") {
                $ps = "SI";
                $clase_pedido = "class='ps'";
            } else {
                $ps = "";
            }
            $fecha_pedido = date_create($fila[6]);
            $id = "";
            if (isset($_GET['idref'])) {
                if ($_GET['idref'] === $fila[0]) {
                    $id = "style='background-color:green;'";
                }
            }
            ?>
            <tr <?php echo $clase_pedido." ".$id; ?>  >
                <td><?php echo $contador++; ?></td>
                <td><?php echo $fila[1] ?></td>
                <td><?php echo $fila[2] ?></td>
                <td><?php echo $fila[3] ?></td>
                <td><?php echo $fila[4] ?></td>
                <td><?php echo $p ?></td>
                <td><?php echo $ps ?></td>
                <td><?php echo date_format($fecha_pedido, "d/m/Y H:i:s"); ?></td>
            </tr>
        <?php } ?>
    </table>    
<?php } else { ?>
    <div class="mensaje">No hay lineas</div>
<?php } ?>
