<table border='2' width='780px;' class='listado'>
                                <?php
				//Cabecera de la tabla
				echo "<th></th><th>Referencia</th><th width='50px;'>C</th><th>Denominación</th><th>Matrícula/Comentario</th><th>Cliente/OR</th><th> _Hora_ </th><th>D</th><th></th>";
				
				$numero=0;
				//Escribo las lineas en la tabla
				@$sentencia=mysql_query("SELECT * FROM lineas WHERE destino LIKE 'M' AND fecha_pedido like '".$_GET['dia'].$_GET['mes'].$_GET['ano']."' ORDER BY pedido,destino,cliente;");
				while($fila=mysql_fetch_row($sentencia)){
					$numero++;
                                        $imp_negr="";
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
					echo "<tr ".$gris.$imp_negr.">
                                        <td>".$contador++."</td>
					<td>".$fila[1]."</td>
					<td style='text-align:center;'>".$fila[2]."</td>
					<td>".$fila[3]."</td>
					<td>".$fila[4]."</td>
					<td style='text-align:center;'>".$fila[5]."</td>
					<td style='font-size:12px;'>".$fila[6]."</td>
					<td style='text-align:center;'>".$fila[7]."</td>";
					if($activo){
						echo "<td>
						<a onClick='javascript:confirmar_linea(".$fila[0].",\"".$fila[1]."\");document.forms[\"pedido\"].submit();' target='_blank'>
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
                    </tr>
                    <?php
				}else{
					?>
                    <td style="text-align:center;"><input disabled="disabled" type="checkbox" name='<?php echo $numero;?>' <?php echo $fila[8]; ?> /></td>
   					<td style='text-align:center;'><input disabled="disabled" type="checkbox" name='<?php echo "ps".$numero;?>' <?php echo $fila[9]; ?> /></td>
                    </tr>
                    <?php
				}
				}
				?></tr></table>