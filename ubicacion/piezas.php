<?php
mysql_connect("localhost","chechu");
mysql_select_db("carrion");
$sentenciaRef = mysql_query("SELECT * FROM denominacion WHERE referencia LIKE '".$_GET['ref']."%' AND nombre LIKE '%".$_GET['den']."%' ORDER BY referencia;");
if(@mysql_num_rows($sentenciaRef ) > 0){
    ?><h2 class="lineas" style="width: 300px;"><?php echo mysql_num_rows($sentenciaRef) ?> coincidencias.</h2><?php
while($fila = mysql_fetch_row($sentenciaRef)){ ?>
    <hr/>
    <table class="consulta">
        <tr><td>Referencia</td><td><?php echo $fila[0]; ?></td></tr>
        <tr><td>Designaci&oacute;n</td><td><?php echo $fila[1]; ?></td></tr>
        <tr><td>C&oacute;d. Descuento</td><td><?php echo $fila[2]; ?></td></tr>
        <tr><td>PVP</td><td><?php echo $fila[3]; ?> &euro;</td></tr>
        <tr><td>Ubicaci&oacute;n</td><td><?php echo $fila[4]; ?></td></tr>
    </table>
<?php } ?>
<?php }else{ ?>
    <hr/>
    <div class="lineas" style="width: 300px;margin: auto;font-size: 40px;">No encontrado</div>
<?php } ?>

