
<img src="../imagenes/print.png" title="imprimir" alt="imprimir" style="cursor:pointer;padding: 10px;" onclick="imprimir()" />
<div id="tbl">    
<table class="incidencias" style="margin: auto" >
    <tr>
        <th></th>
        <th>Referencia</th>
        <th>Designación</th>
        <th>Ubicación</th>
        <th>Hay</th>
        <th>Marca</th>
        <th>Fecha</th>
        <th>Comentario</th><th><img src="../imagenes/eliminar.png" title="Eliminar todo" style="cursor: pointer" onclick="eliminartabla()" /></th>
    </tr>
<?php
include '../estilos/conexion.php';
$recurso = mysql_query("SELECT * FROM incidencias ORDER BY referencia ASC");
$numero = 1;
while($row=  mysql_fetch_row($recurso)){
    if($row[5] < $row[6]){
        ?><tr class="falta"><?php
    }else{
        ?><tr class="sobra"><?php
    }
    ?><td><?php echo $numero++ ?></td><?php
    ?><td><?php echo strtoupper($row[1]) ?></td><?php
    ?><td><?php echo $row[2] ?></td><?php
    ?><td><?php echo $row[3] ?></td><?php
    ?><td><?php echo $row[5] ?></td><?php
    ?><td><?php echo $row[6] ?></td><?php
    ?><td><?php echo $row[7] ?></td>
    <td><?php echo $row[4] ?></td>
    <td><img src="../imagenes/eliminar.png" style="cursor: pointer" onclick="eliminarLinea('<?php echo $row[0] ?>','<?php echo $row[1] ?>')" title="Eliminar la referencia <?php echo $row[1] ?>" /></td></tr><?php
}
?>
</table>
</div>