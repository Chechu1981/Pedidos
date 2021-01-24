<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
	<!--<link rel="stylesheet" type="text/css" href="css/style.css" />-->
        <link rel="stylesheet" type="text/css" href="css/jquery.jdigiclock.css" />
        <script type="text/javascript" src="lib/jquery-1.3.2.min.js"></script>
        <script type="text/javascript" src="lib/jquery.jdigiclock.js"></script>
        <?php
		include '../calendario/calcular_dia.php';
		function activar(){
			$a=false;
			$fecha = getdate(time());
			$mes = $fecha['mon'];
			$hora = $fecha['hours'];
			$ano = $fecha['year'];
			$dia = $fecha['mday'];
                        if($_GET['ano']>$ano)
                            $a=true;
                        elseif($_GET['numes']>$mes)
                            $a=true;
                        elseif($_GET['dia']>$dia)
                            $a=true;
			elseif($_GET['ano']==$ano and $_GET['numes']==$mes and $_GET['dia']==$dia and $hora < 16)
                            $a=true;
		  return $a;
		}
		?>
        <meta http-equiv="Content-Type" content="text/html;" charset="ISO-8859-1"></meta>
        <title><?php echo "Pedido del ".$_GET['dia']." de ".$_GET['mes']." de ".$_GET['ano'];?></title>
        <link rel="shortcut icon" href="../cruze/favicon.ico" ></link>
        <link rel="stylesheet" type="text/css" href="../estilos/style.css" ></link>
        
        <script language="javascript" >
		var info;
		function cargar(){
			info=window.history.length;
		}
		function volver(){
			window.history.back(info);
		}
		function foco(){
			document.getElementById("referencia").focus();
		}
		function imprSelec(nombre)
			{
			  var ficha = document.getElementById(nombre);
			  var ventimp = window.open('','imprimir');
              ventimp.document.write('<h2><?php echo "Pedido del ".$_GET['dia']." de ".$_GET['mes']." de ".$_GET['ano'];?></h2>');
			  ventimp.document.write(ficha.innerHTML);
			  ventimp.document.close();
              ventimp.print();
			  ventimp.close();
			}
			function seleccionar(){
				if(document.caja.elements[0].checked == 1)
					seleccionar_todo();
				else
					deseleccionar_todo();
			}
		function seleccionar_todo(){ 
   			for (i=1;i<document.caja.elements.length;i++) 
                            if(document.caja.elements[i].type == "checkbox"){ 
                                document.caja.elements[i].checked=1;
				i++;
                            }
			}
		function deseleccionar_todo(){ 
		    for (i=1;i<document.caja.elements.length;i++) 
			if(document.caja.elements[i].type == "checkbox"){
         	document.caja.elements[i].checked=0;
			i++;
			}
			}
                function display_c(){
                    var refresh=1000; // Refresh rate in milli seconds
                    mytime=setTimeout('display_ct()',refresh)
                }
                function display_ct() {
                    var strcount;
                    var x = new Date();
                    document.getElementById('ct').innerHTML = x;
                    tt=display_c();
                }
                $(document).ready(function() {
// Create two variable with the names of the months and days in an array
var monthNames = [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ]; 
var dayNames= ["Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado"]

// Create a newDate() object
var newDate = new Date();
// Extract the current date from Date object
newDate.setDate(newDate.getDate());
// Output the day, date, month and year   
$('#Date').html(dayNames[newDate.getDay()] + " " + newDate.getDate() + ' ' + monthNames[newDate.getMonth()] + ' ' + newDate.getFullYear());

setInterval( function() {
	// Create a newDate() object and extract the seconds of the current time on the visitor's
	var seconds = new Date().getSeconds();
	// Add a leading zero to seconds value
	$("#sec").html(( seconds < 10 ? "0" : "" ) + seconds);
	},1000);
	
setInterval( function() {
	// Create a newDate() object and extract the minutes of the current time on the visitor's
	var minutes = new Date().getMinutes();
	// Add a leading zero to the minutes value
	$("#min").html(( minutes < 10 ? "0" : "" ) + minutes);
    },1000);
	
setInterval( function() {
	// Create a newDate() object and extract the hours of the current time on the visitor's
	var hours = new Date().getHours();
	// Add a leading zero to the hours value
	$("#hours").html(( hours < 10 ? "0" : "" ) + hours);
    }, 1000);	
});
        var cuenta=600;
        setInterval(function(){
            cuenta--;
            segundos = cuenta%60;
            minutos = parseInt(cuenta/60);
            if(segundos<10)
                segundos="0"+segundos;
            $("#cuenta").html("Próxima actualización: "+minutos+":"+segundos);
        },1000);
        
        setInterval(function(){
            tiempo=new Date();
            hora=tiempo.getHours();
            min=tiempo.getMinutes();
            seg = tiempo.getSeconds();
            if(hora==16 && min==0 && seg==30){
                alert("Pedido finalizado");
                document.location.href="../calendario/pedidos.php?numes=<?php echo calcular_numes(); ?>&dia=<?php echo calcular_dia(); ?>&mes=<?php echo calcular_mes(); ?>&ano=<?php echo calcular_ano();?>";
                }
       },1000);
		</script>
        <script type="text/javascript" src="script.js"></script>
        <?php
        $activo = activar();
        
		mysql_connect("localhost","chechu");
		mysql_select_db("pedidos");
		function actualizar(){
                    $sen=mysql_query("SELECT * FROM lineas WHERE fecha_pedido like '".$_GET['dia'].$_GET['mes'].$_GET['ano']."' ORDER BY pedido,destino,cliente;");
                    if(@mysql_num_rows($sen)>0){
			$numero=0;
			while($fila=mysql_fetch_row($sen)){
				$numero++;
                    if(isset($_GET['marcado']) and isset($_POST[$fila[0]])){
                        mysql_query("UPDATE  lineas SET pedido='checked=\"checked\"' WHERE id='".$fila[0]."'");
                    }elseif(isset($_GET['marcado'])){
                        mysql_query("UPDATE lineas SET pedido='' WHERE id='".$fila[0]."'");
                    }
                    if(isset($_GET['marcado']) and isset($_POST['ps'.$fila[0]]) ){
                    	mysql_query("UPDATE lineas SET ps='checked=\"checked\"' WHERE id='".$fila[0]."'");
                    }elseif(isset($_GET['marcado'])){
                    	mysql_query("UPDATE lineas SET ps='' WHERE id='".$fila[0]."'");
                    }
                }
              }
            }   
            ?>
 
    </head>
    <body onload="javascript:foco();cargar();">
        <div id="cuenta" style="position: fixed;right: 10px;font-weight: bold;"></div>
        <div class="clock">
            <div id="Date"></div>
                <ul>
                    <li id="hours"></li>
                    <li id="point">:</li>
                    <li id="min"></li>
                    <li id="point">:</li>
                    <li id="sec"></li>
                </ul>
            </div>

        <script>
            var t=setTimeout('document.location.href="../calendario/pedidos.php?numes=<?php echo calcular_numes(); ?>&dia=<?php echo calcular_dia(); ?>&mes=<?php echo calcular_mes(); ?>&ano=<?php echo calcular_ano();?>"',600000);
        </script>
		<!--<div id="digiclock" style="float:left;position:absolute;width:100px;"></div>-->
        <?php
        if((date('j')>=25 and date('n')==12)or(date('j')<=6 and date('n')==1)){?>
            <img style="float:left;margin: 10px;position:fixed;" src="../imagenes/navidad.jpg" width="150px" />
        <?php }else{ ?>
            <img style="float:left;margin: 10px;position:fixed;" src="../imagenes/carrion.jpg" width="150px" />
        <?php } ?>
        <div class="contenedor">
        <div id="c_e57fa2f6fac3f87fd870f0eebef7dbcc" class="ancho">
        	<h2 style="color: #000000; margin: 0 0 3px; padding: 2px; font: bold 13px/1.2 Verdana; text-align: center;"></h2>
            </div>
			<script type="text/javascript" src="http://www.eltiempo.es/widget/widget_loader/e57fa2f6fac3f87fd870f0eebef7dbcc">
            </script>
        	<div class="principal">
            <ul>
                <a href="../index.php" target="_self"><li>Inicio</li></a>
                <a href="../clientes/clientes.php" target="_self"><li>Clientes</li></a>
                <a href="../cruze/cruze.php" target="_self"><li>Referencias cruzadas</li></a>
                <a href="../enlaces/enlaces.php" target="_self"><li>Enlaces</li></a>
                <a href="../cambio/cambio.php"><li>Cambio</li></a>
                <a href="../calendario/pedidos.php?numes=<?php echo calcular_numes(); ?>&dia=<?php echo calcular_dia(); ?>&mes=<?php echo calcular_mes(); ?>&ano=<?php echo calcular_ano();?>"><li id="activo">Pedidos Citroen</li></a>
            </ul>
             </div>
            <div class="banda">
                <h2 style="padding:15px;"><?php echo "Pedido del ". $_GET['dia']." de ".$_GET['mes']." de ".$_GET['ano'];?></h2>
                 <a href="calendario.php" target="_self">
                <div id="nuevo">
                    Calendario
                </div>
                </a>
        </div>
        <div>
        <?php
        if(isset($_GET['diasemana']) and $_GET['diasemana']>5)
            $activo = false;   
		if($activo){
		?>
        <form action="pedidos.php?numes=<?php echo $_GET['numes'];?>&dia=<?php echo $_GET['dia']?>&mes=<?php echo $_GET['mes']?>&ano=<?php echo $_GET['ano']?>" method="post" name="pedido" >
        <table>
            <th>Referencia</th>
            <th width='10px;'>C</th>
            <th>Denominación</th>
            <th>Cliente/OR</th>
            <th>Matricula/Comentario</th>
            <th>Destino</th>
        <tr>
            <td><input type="text" name="referencia" id="referencia" /></td>
            <td><input width="10px;" style="text-align:right;width:30px;" type="text" name="cantidad"  /></td>
            <td><input type="text" name="denominacion"  /></td>
            <td><input type="text" name="cliente" style="text-align:center;"  /></td>
            <td><input style="text-align:center;" size="30" type="text" name="matricula" /></td>
            <td>
            <?php 
			if( $_SERVER['REMOTE_ADDR']=='10.159.64.47' or $_SERVER['REMOTE_ADDR']=='10.159.64.58'){
			?>
                <input type="radio" name="destino" value="T" checked="checked" ><span style="font-size:12px">Taller</span></input><br/>
                <input type="radio" name="destino" value="M" ><span style="font-size:12px">Mostrador</span></input><br/>
            <?php }else{ ?>
	            <input type="radio" name="destino" value="T"  ><span style="font-size:12px">Taller</span></input><br/>
                <input type="radio" name="destino" value="M" checked="checked"  ><span style="font-size:12px">Mostrador</span></input><br/>
           <?php } ?>
            </td>
        </tr>
        </table>
        <input type="submit" value="Añadir" />
        </form>
         <?php
		 actualizar();
		}else{
                    if(isset($_GET['diasemana']) and $_GET['diasemana']>5)
                        echo "";
                    else
			echo "<div class='resultado'>Pedido Realizado</div>";
		}
		 //Crear filas
		 if(isset($_POST['referencia']) and $_POST['referencia']!=""){
			mysql_query("INSERT INTO lineas 
                            (referencia,cantidad,denominacion,matricula,cliente,fecha,destino,fecha_pedido,pedido,ps)
                            VALUES('".strtoupper($_POST['referencia'])."',
                                '".strtoupper($_POST['cantidad'])."',
                                '".strtoupper($_POST['denominacion'])."',
                                '".strtoupper($_POST['matricula'])."',
                                '".strtoupper($_POST['cliente'])."',
                                NOW(),
                                '".$_POST['destino']."',
                                '".$_GET['dia'].$_GET['mes'].$_GET['ano']."',
                                '',
                                '');");
		 }
		 //ver las lineas que hay
			?><div style='float:left;' id='tabla'><?php
			actualizar();
                        $contador=1;
			@$sentencia=mysql_query("SELECT * FROM lineas WHERE fecha_pedido LIKE '".$_GET['dia'].$_GET['mes'].$_GET['ano']."' ORDER BY pedido,destino,cliente;");
			if(@mysql_num_rows($sentencia)>0){
				?> <div class="lineas"><?php echo mysql_num_rows($sentencia); ?> LINEAS.</div><?php
				//Formulario de lineas marcadas
				?>
                                    <form action="pedidos.php?numes=<?php echo $_GET['numes'];?>&dia=<?php echo $_GET['dia']?>&mes=<?php echo $_GET['mes']?>&ano=<?php echo $_GET['ano']?>&marcado=si" name="caja" method="POST">
                                        <div id="M">
                                            <h2 align="center">Pedido de mostrador</h2>
                                        <table border='2' width='780px;' class='listado'>
                                <?php
				//Cabecera de la tabla
				echo "<th></th><th>Referencia</th><th width='50px;'>C</th><th>Denominación</th><th>Matricula/Comentario</th><th>Cliente/OR</th><th> _Hora_ </th><th>D</th><th></th>";
				if($activo){
					?><th><input onclick="javascript:seleccionar();" type="checkbox" /></th><th>PS</th><?php
				}else{
					echo "<th>PS</th>";
				}
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
                        
                        </div><div id="T">
                            <h2 align="center">Pedido de taller</h2>
                        <table border='2' width='780px;' class='listado'>
                                <?php
				//Cabecera de la tabla
				echo "<th></th><th>Referencia</th><th width='50px;'>C</th><th>Denominación</th><th>Matricula/Comentario</th><th>Cliente/OR</th><th> _Hora_ </th><th>D</th><th></th>";
				if($activo){
					?><th></th><th>PS</th><?php
				}else{
					echo "<th>PS</th>";
				}
				$numero=0;
				//Escribo las lineas en la tabla
				@$sentencia=mysql_query("SELECT * FROM lineas WHERE destino LIKE 'T' AND fecha_pedido like '".$_GET['dia'].$_GET['mes'].$_GET['ano']."' ORDER BY pedido,destino,cliente;");
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
				?></tr></table></div>
                        
                        
                        
                        </div>
				<div class="impresion">
                                    <ul>
                                        <li><b>Imprimir</b></li>
                                        <ul>
                                        <li><a onclick="javascript:imprSelec('tabla');" style="cursor:pointer;"><img src="../imagenes/print.png" /><b> todo</b></a></li>
                                        <li><a onclick="javascript:imprSelec('T');" style="cursor:pointer;"><img src="../imagenes/print.png" /><b> taller</b></a></li>
                                        <li><a onclick="javascript:imprSelec('M');" style="cursor:pointer;"><img src="../imagenes/print.png" /><b> mostrador</b></a></li>
                                        </ul>
                                    </ul>
                        <?php if($activo){ ?>
                            <input type="submit" value="Marcar lineas pedidas" class="boton_marcar" />
                        <?php }else{ ?>
                            <input type="submit" value="Marcar lineas pedidas" style="display:none;" class="boton_marcar" />
                        <?php } ?>
                </div>
                </form>
				<?php
			}else{
				if(isset($_GET['diasemana']) and $_GET['diasemana']>5)
                                    echo "<div class='resultado'>Festivo</div>";
                                else
                                    echo "<div class='resultado'>No hay lineas</div>";}
		?>
        </div>
        <div class="pie">
            <hr>
            Empresa Carrión SA <span>Jesús Martín 2012 ©</span>
        </div>
        </div>
        <?php
            $_POST = Array();
        ?>
    </body>
</html>