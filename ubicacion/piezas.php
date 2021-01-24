<?php
include_once '../estilos/conexion.php';
$sentenciaRef = $mysqli->query("SELECT DISTINCT * FROM denominacion WHERE referencia LIKE '".$_GET['ref']."%' AND nombre LIKE '%".$_GET['den']."%' ORDER BY referencia;");
if(@$sentenciaRef->num_rows > 0){
    ?><h2 class="lineas" style="width: 300px;"><?php echo $sentenciaRef->num_rows ?> coincidencias.</h2><?php
while($fila = $sentenciaRef->fetch_row()){ ?>
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

