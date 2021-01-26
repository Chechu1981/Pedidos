<table border='2' width='780px;' class='listado'>
    <th></th><th>Matr&iacute;cula</th><th>Marca</th><th>Modelo</th><th>Kil&oacute;metros</th><th></th>
    <?php
    include '../../estilos/conexion.php';
    $numero=0;
    //Escribo las lineas en la tabla
    @$sentencia = $mysqli->query("SELECT * FROM coches;");
    while($fila = $SENTENCIA->fetch_row()){
            $numero++;
            ?> <tr>
                <td style="text-align: center"><?php echo $numero; ?></td>
                <td style="text-align: center"><?php echo $fila[1]; ?></td>
                <td style="text-align: center"><?php echo $fila[2]; ?></td>
                <td style="text-align: center"><?php echo $fila[3]; ?></td>
                <td style="text-align: right"><?php echo number_format($fila[4],0,',','.'); ?></td>
                <td style="text-align: center;width: 10px"><img src="../../imagenes/eliminar.png" style="cursor: pointer" onclick="borrar('<?php echo $fila[0]; ?>','<?php echo $fila[1]; ?>')" /></td>
            </tr> <?php
    }
    ?>
</table>