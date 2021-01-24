<table class="listado">
    <th>Nombre</th>
    <th></th>
<?php 
include '../estilos/conexion.php';
$compys=mysql_query("SELECT * FROM empleados;");
while($nom=mysql_fetch_row($compys)){ ?>
    <tr>
        <td><?php echo utf8_encode(strtoupper($nom[1])); ?></td>
        <td><img src="../imagenes/eliminar.png" onclick="eraser(<?php echo $nom[0]; ?>)" title="Eliminar <?php echo $nom[1]; ?>" style="cursor:pointer"/></td>
    </tr>
<?php } ?>
</table>