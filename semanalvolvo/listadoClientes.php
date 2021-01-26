<?php 
$numero=0;
$contador=1;
include_once '../estilos/conexion.php   ';
@$sentencia=$mysqli->query("SELECT * FROM semanalvolvo WHERE pedido = 1 ORDER BY cliente ASC, referencia DESC;");
$pedido = $sentencia->fetch_row();
?>
<script>
$(function() {
    $("#fecha").datepicker({
        firstDay: 1,
        dateFormat: "DD dd/mm/yy",
        dayNames: ["Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado"],
        dayNamesMin: ["Do","Lu","Ma","Mi","Ju","Vi","Sa"],
        monthNames: ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"]
    });
});
</script>
<h1>Pedido <?php echo $pedido[1]; ?></h1>
<input style="margin: 10px;" id="fecha" type="text" /><button value="Guardar">Guardar</button>
<hr/>
<table border='2' width='780px;' class='semanal'>
    <th>Linea</th><th><span class="enlace" onclick="listarReferencia()">Referencia</span></th><th style="width: 18px">C</th><th>Denominaci&oacute;n</th><th>Matr&iacute;cula/Comentario</th><th><span class="enlace" onclick="listarCliente()"><b>Cliente/OR</b></span></th><th>Estado</th><th><span class="enlace" onclick="verLineasSemanal()">Fecha</span></th><th><input type="checkbox" id="all" onchange="todos()"/></th><th></th>
<?php
while($fila = $sentencia->fetch_row()){
        $numero++;
        $chk="";
        if($fila[7]==0){					
                $gris="class=\"sombra\"";
                $chk="checked='checked'";
        }else{
                $gris="";
                $chk="";
        }
        ?>
        <tr <?php echo $gris; ?> >
            <td><?php echo $contador++?></td>
            <td><?php echo utf8_encode($fila[2]) ?></td>
            <td style='text-align:center;'><?php echo utf8_encode($fila[3]) ?></td>
            <td><?php echo utf8_encode($fila[4]) ?></td>
            <td><?php echo utf8_encode($fila[5]) ?></td>
            <td style='text-align:center;'><?php echo utf8_encode($fila[6]) ?></td>
            <td style='font-size:12px;'><?php echo utf8_encode($fila[7]) ?></td>
            <td style='text-align:center;'><?php echo utf8_encode($fila[8]) ?></td>
            <td style="text-align:center;"><input enabled="enabled" type="checkbox" <?php echo $chk ?> id='<?php echo utf8_encode($fila[0]);?>' onchange="pedir('<?php echo $fila[0];?>','<?php echo $fila[1];?>','<?php echo $fila[7] ?>')" /></td>
            <td><img id="eliminar<?php echo utf8_encode($fila[0]) ?>" onclick="eliminarLinea(<?php echo utf8_encode($fila[0]).",'".$fila[2]."'" ?>)" src='../imagenes/eliminar.png' style="cursor:pointer;"></td>
        </tr>
    <?php } ?>
</table>