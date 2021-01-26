<table class="listado">
    <th>Nombre</th>
    <th>Contraseña</th>
    <th>Código</th>
    <th>Razón social</th>
    <th></th>
<?php 
include '../estilos/conexion.php';
$agentes = $mysqli->query("SELECT * FROM usuarios;");
while($nom = $agentes->fetch_row()){ ?>
    <tr>
        <td><?php echo utf8_encode(strtoupper($nom[1])); ?></td>
        <td><?php echo $nom[2]; ?></td>
        <td><?php echo $nom[3]; ?></td>
        <td><?php echo $nom[4]; ?></td>
        <td><img src="../imagenes/eliminar.png" onclick="eraser(<?php echo $nom[0]; ?>)" title="Eliminar <?php echo $nom[1]; ?>" style="cursor:pointer"/></td>
    </tr>
<?php } ?>
</table>