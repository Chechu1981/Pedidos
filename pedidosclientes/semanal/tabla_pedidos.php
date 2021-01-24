<?php
$fpedido = "";
if (isset($_GET['pedido'])) {
    $fpedido = $_GET['pedido'];
} else {
    $semanales_totales = mysql_query("SELECT * FROM semanal GROUP BY pedido;");
    $fpedido = mysql_num_rows($semanales_totales);
}
if (isset($_POST['ref'])) {
    if ($_POST['ref'] != "") {
        $designacion_sentencia = mysql_query("SELECT * FROM tarifacitroen WHERE referencia LIKE '" . $_POST['ref'] . "'");
        $designacion = mysql_fetch_row($designacion_sentencia);
        mysql_query("INSERT INTO semanal 
                (pedido, referencia, cantidad, denominacion, comentario, cliente, estado, fecha)
                VALUES 
                ('" . $fpedido . "',
                '" . strtoupper($_POST['ref']) . "',
                " . $_POST['can'] . ",
                '" . utf8_decode($designacion[1]) . "',
                '" . utf8_decode(strtoupper($_POST['com'])) . "',
                '" . $_SESSION['nombre'] . " (" . $_SESSION['codigo'] . ")',
                1, 
                NOW())");
    }
}
$ftexto = "<span class='todos'><a href='todos.php?id=" . session_id() . "' >TODOS</a></span>Semanal. Pedido " . $fpedido;
?>
<div class="titulo">
    <?php echo $ftexto; ?>
</div>
<?php
$sentencia;
if (isset($_GET['pedido'])) {
    $sentencia = mysql_query("SELECT * FROM semanal WHERE cliente LIKE '%" . $_SESSION['codigo'] . "%' AND pedido = '" . $_GET['pedido'] . "' ORDER BY referencia;");
} else {
    $sentencia = mysql_query("SELECT * FROM semanal WHERE cliente LIKE '%" . $_SESSION['codigo'] . "%' AND pedido = '" . $fpedido . "' ORDER BY referencia;");
}

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
            <th>FECHA</th>
            <th></th>
        </tr>
        <?php
        while ($fila = @mysql_fetch_row($sentencia)) {
            $fecha_pedido = date_create($fila[8]);
            ?>
            <tr>
                <td><?php echo $contador++; ?></td>
                <td><?php echo $fila[2] ?></td>
                <td><?php echo $fila[3] ?></td>
                <td><?php echo $fila[4] ?></td>
                <td><?php echo $fila[5] ?></td>
                <td><?php echo date_format($fecha_pedido, "d/m/Y H:i:s"); ?></td>
                <td><?php if ($ultimo) { ?><img src="../../imagenes/eliminar.png" style="cursor: pointer;" onclick="eliminarlinea(<?php echo $fila[0] ?>)" ><?php } ?></td>
            </tr>
        <?php } ?>
    </table>    
<?php } else { ?>
    <div class="mensaje">No hay lineas</div>
<?php
}
