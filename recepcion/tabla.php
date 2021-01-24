<div style="clear: both"></div>
<h1>En curso</h1>
<table border='2' width='780px;' class='listado'>
    <th></th>
    <th>Orden</th>
    <th>Matr&iacute;cula</th>
    <th>Entrada</th>
    <th>Peritaci&oacute;n</th>
    <th>Compromiso</th>
    <th>Pendiente PR</th>
    <th>Entrega</th>
    <th>Cortes&iacute;a</th>
    <th>Control Calidad</th>
    <th>Observaciones</th>
    <th></th>
    <th></th>
    <?php
    include '../estilos/conexion.php';
    $numero=0;
    //Escribo las lineas en la tabla
    @$sentencia=mysql_query("SELECT * FROM recepcion WHERE entregado LIKE 'NO';");
    while($fila=mysql_fetch_row($sentencia)){
            $numero++;
            $date1 = date_create($fila[3]);
            $date2 = date_create($fila[4]);
            $date3 = date_create($fila[7]);
            ?> <tr>
                <td style="text-align: center"><?php echo $numero; ?></td>
                <td style="text-align: center;cursor:pointer;text-decoration: underline"><a onclick="ptepr(<?php echo $fila[1]; ?>)" ><?php echo $fila[1]; ?></a></td>
                <td style="text-align: center"><?php echo $fila[2]; ?></td>
                <td style="text-align: center"><?php echo date_format($date1,'d/m/Y'); ?></td>
                <td style="text-align: center"><?php echo date_format($date2,'d/m/Y'); ?></td>
                <td style="text-align: center"><?php echo $fila[5]; ?></td>
                <td style="text-align: center"><?php echo $fila[6]; ?></td>
                <td style="text-align: center"><?php echo date_format($date3,'d/m/Y'); ?></td>
                <td style="text-align: center"><?php echo $fila[8]; ?></td>
                <td style="text-align: center"><?php echo $fila[9]; ?></td>
                <td style="text-align: center"><?php echo $fila[10]; ?></td>
                <td style="text-align: center;width: 10px"><img src="../imagenes/eliminar.png" style="cursor: pointer" onclick="borrar('<?php echo $fila[0]; ?>','<?php echo $fila[1]; ?>')" title="Eliminar"/></td>
                <td><button title="Listado de piezas pedidas por urgente." onclick="entregado('<?php echo $fila[0]; ?>','<?php echo $fila[2]; ?>');tabla();">Entregado</button></td>
            </tr> <?php
    }
    ?>
</table>