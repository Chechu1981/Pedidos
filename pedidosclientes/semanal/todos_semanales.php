<?php
mysql_select_db("pedidos");
$semanales_totales = mysql_query("SELECT pedido, count(referencia),fecha  FROM `semanal` WHERE cliente LIKE '%320122%' group by pedido order by pedido desc;");
$ftexto = "<span class='todos'><a href='todos.php?id=".session_id()."' >TODOS</a></span>Semanal. Todos";
?>
<div class="titulo">
    <?php echo $ftexto; ?>
</div>
<?php
$contador = 1;
if (@mysql_num_rows($semanales_totales) > 0) {
    ?>
    <table>
        <tr>
            <th>PEDIDO</th>
            <th>LINEAS</th>
            <th>FECHA</th>
        </tr>
        <?php
        while ($fila = @mysql_fetch_row($semanales_totales)) {
            $sentencia_fecha = mysql_query("SELECT fecha FROM listasemanal WHERE numero =".$fila[0]);
            $fsemanal = mysql_fetch_row($sentencia_fecha);
            ?>
            <tr>
                <td><a href="semanal.php?id=<?php echo session_id(); ?>&pedido=<?php echo $fila[0] ?>" >Pedido <?php echo $fila[0] ?></a></td>
                <td><?php echo $fila[1] ?></td>
                <td><?php echo utf8_encode($fsemanal[0]); ?></td>
            </tr>
        <?php } ?>
    </table>    
<?php } else { ?>
    <div class="mensaje">No hay lineas</div>
<?php } ?>
