<?php 
header("Cache-Control: no-store, no-cache, must-revalidate");
$con=1; 
include ('../estilos/conexion.php');
$result= mysql_query("SELECT * FROM o_proveedores WHERE fecha_recibido LIKE '%0000%' ORDER BY fecha_pedido DESC;");
?>
<div style="clear: both"></div>
<table border="1" class="listado">
    <th style="width: 10px"><b style="font-size: large"><?php echo mysql_num_rows($result); ?></b></th><th>Fecha de pedido</th><th>Proveedor</th><th>Operario</th><th>Orden/Cliente</th><th>Comentario</th><th>Pedido</th><th>Recibido</th><th></th><th></th>
<?php
while($lineas=mysql_fetch_row($result)){
?> <tr><td style="text-align: center"><b><?php echo $con++; ?></b></td> <?php
    for($i=2;$i<8;$i++){
        ?> <td style="text-align: center"> <?php
        if($i==2){
            $meses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
            $mes='';
            $date = date_create($lineas[2]);
            for($m=0;$m<12;$m++){
                if(date_format($date,'m')==$m+1)
                        $mes=$meses[$m];
            }
            echo date_format($date,'d/').$mes.date_format($date,'/Y').' '.date_format($date,'H:i:s');
        }elseif($i==6){
            ?><div><textarea name="comenatrio" class="area" id="com<?php echo utf8_encode($lineas[0]) ?>" onclick="editar()" onblur="actualizar(<?php echo utf8_encode($lineas[0]) ?>);enviar()"><?php echo utf8_encode($lineas[$i]) ?></textarea></div><?php
        }elseif($i==7){        
            ?><div class="actualizarCantidad" style="font-size:13px;" onclick="modificar_pedido('<?php echo $lineas[0]; ?>','<?php echo utf8_encode($lineas[7]); ?>')" ><?php echo utf8_encode($lineas[7]); ?></div><?php
        }else{
            echo utf8_encode($lineas[$i]);
        }
        ?> </td> <?php }
        ?><td><div type="button" value="Recibido" class="recibido" onclick="recibido('<?php echo utf8_encode($lineas[0]); ?>','<?php echo utf8_encode($lineas[3]) ?>')">Recibido</div></td>
        <td><img id="img<?php echo $lineas[0] ?>" src="../imagenes/abajo.png" width="20px" onclick="avisarmail('<?php echo $lineas[0]; ?>')" title="Enviar aviso por e-mail" style="cursor: pointer" /></td>
        <td><img src="../imagenes/eliminar.png" title="Elimiar" style="cursor: pointer" onclick="confirmar_linea('<?php echo utf8_encode($lineas[0]); ?>','<?php echo utf8_encode($lineas[3]) ?>')"/></td>
    </tr>
    <tr id="<?php echo $lineas[0] ?>" style="display:none;background-color: aliceblue">
        <td colspan="10" style="padding: 18px">
            <h2>Avisar por correo de que ha venido el pedido de <?php echo $lineas[3]?> a:</h2>
            <button id="1<?php echo $lineas[0]; ?>" onclick="enviarmail(1,<?php echo $lineas[0]; ?>)" >Recepcion</button>
            <button id="2<?php echo $lineas[0]; ?>" onclick="enviarmail(2,<?php echo $lineas[0]; ?>)" >Chapa</button>
            <button id="3<?php echo $lineas[0]; ?>" onclick="enviarmail(3,<?php echo $lineas[0]; ?>)" >Marisa</button>
            <button id="4<?php echo $lineas[0]; ?>" onclick="enviarmail(4,<?php echo $lineas[0]; ?>)" >Volvo</button>
            <input id="hi<?php echo $lineas[0] ?>" type="hidden" value="0"/>
        </td>
    </tr>
<?php
}
?>
</table>