<div style='float:left;' id='tabla'>
    <?php $contador=1;
    $activo=true;
    if($_SERVER['REMOTE_USER']=="medina"){ 
        @$sentencia=$mysqli->query("SELECT * FROM lineasvolvo WHERE fecha_pedido LIKE '".$_GET['dia'].$_GET['mes'].$_GET['ano']."' AND cliente = 'MEDINA' ORDER BY pedido,destino,cliente,referencia;");
    }else{ 
        @$sentencia=$mysqli->query("SELECT * FROM lineasvolvo WHERE fecha_pedido LIKE '".$_GET['dia'].$_GET['mes'].$_GET['ano']."' ORDER BY pedido,destino,cliente,referencia;");
    }
    if(@mysql_num_rows($sentencia)>0){
    if($_SERVER['REMOTE_USER']!="recepcion"){ ?>
        <div class="lineas">
            <?php echo $sentencia->num_rows; ?> lineas.
        </div>
            <h2 align="center">Pedido de mostrador</h2>
            <table border='2' width='780px;' class='volvolinea'>
            <th></th><th>Referencia</th><th width='50px;'>C</th><th style="padding-left: 40px;padding-right: 40px">Denominaci�n</th>
         <?php }
        if($activo){
            ?><th style="padding: 0"><!--<button <?php if($_SERVER['REMOTE_USER']=='recepcion'){ ?> disabled="disabled" <?php } ?> onclick="comentarios()" title="Guardar comentario" class="boton_comentariov" >Matr�cula/Comentario</button>-->Matr�cula/Comentario</th><th>Cliente/OR</th><th style="padding-left: 45px;padding-right: 45px"> Hora </th><th></th><th><input title="Seleccionar todas las lineas" onclick="javascript:seleccionar();" type="checkbox"  class="caja" /></th><th>PS</th><?php
        }else{
            ?><th>Matr�cula/Comentario</th><th>Cliente/OR</th><th style="padding-left: 45px;padding-right: 45px"> Hora </th><th></th><th>PS</th><?php
        }
        $numero=0;
        //Escribo las lineas en la tabla

        @$sentencia=$mysqli->query("SELECT * FROM lineasvolvo WHERE destino LIKE 'M' AND fecha_pedido like '".$_GET['dia'].$_GET['mes'].$_GET['ano']."' ORDER BY pedido,destino,cliente,referencia;");
        while($fila = $sentencia->fetch_row()){
                $numero++;
                $imp_negr="";
                $encontrado="";
                if($fila[8]!='' && $fila[9]!=''){
                        $gris=" class=\"ps\" ";
                        $imp_negr="style='font-weight: bold;background-color:#ddd;'";
                        $ps="";
                }
                elseif($fila[8]!=''){					
                        $gris="class=\"sombra\"";
                        $ps="";
                }else{
                        $gris="";
                        $ps="disabled=\"disabled\"";
                }
                if(isset($_GET['ref'])){
                    if($_GET['ref']==$fila[1]){
                        $encontrado="style='background-color:green;color:white;font-style:bold;'";
                    }
                }
                ?> <tr <?php echo $encontrado.$gris.$imp_negr; ?> >
                <td><?php echo $contador++; ?></td>
                <td><?php echo $fila[1]; ?></td>
                <td style='text-align:center;'><?php echo$fila[2]; ?></td>
                <td><?php echo$fila[3]; ?></td>;
                <?php
                if($activo){
                    echo "<td><input onblur='comentarios(".$fila[0].")' id='comentario".$fila[0]."' size='40' type='text' name='comentario".$fila[0]."' value='".$fila[4]."'></td>";
                }else{
                    echo "<td>".$fila[4]."</td>";
                }
                echo "<td style='text-align:center;'>".$fila[5]."</td>
                <td style='font-size:12px;'>".$fila[6]."</td>";
                if($activo){
                        echo "<td>
                        <a title='ELIMINAR ".$fila[3]." ".$fila[1]."' onClick='javascript:confirmar_linea_pedido(".$fila[0].",\"".$fila[1]."\");document.forms[\"pedido\"].submit();' target='_blank'>
                        <img src='../imagenes/eliminar.png' style=\"cursor:pointer;\">
                        </a>
                        </td>";
                ?>
<td style="text-align:center;">
<input type="checkbox" name='<?php echo $fila[0];?>' <?php echo $fila[8]; ?> />
</td>
<td style='text-align:center;'>
<input type="checkbox" <?php echo $ps; ?> name='<?php echo "ps".$fila[0];?>' <?php echo $fila[9]; ?> />
</td>
<?php
        }else{
                ?>
<td style="text-align:center;"><input disabled="disabled" type="checkbox" name='<?php echo $numero;?>' <?php echo $fila[8]; ?> /></td>
<td style='text-align:center;'><input disabled="disabled" type="checkbox" name='<?php echo "ps".$numero;?>' <?php echo $fila[9]; ?> /></td>
<?php
    }
        }
        ?></tr></table>
            <?php }  ?>
</div>