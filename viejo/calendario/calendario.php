<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv=Content-Type content="text/html;" charset=ISO-8859-1></meta>
        <title>Pedidos Citroen</title>
        <link rel="shortcut icon" href="../cruze/favicon.ico" ></link>
        <link rel="stylesheet" type="text/css" href="../estilos/style.css" ></link>
        <script language="javascript">
			function tratarFecha(dia,mes,ano){
			  <?php $funcionTratarFecha?>
			}
		</script>
<?php
		include './calcular_dia.php';
		?>
    </head>
    <body>
        <?php
        if((date('j')>=25 and date('n')==12)or(date('j')<=6 and date('n')==1)){?>
            <img style="float:left;margin: 10px;position:fixed;" src="../imagenes/navidad.jpg" width="150px" />
        <?php }else{ ?>
            <img style="float:left;margin: 10px;position:fixed;" src="../imagenes/carrion.jpg" width="150px" />
        <?php } ?>
        <div class="contenedor">
        <?php if($_SERVER['REMOTE_USER']=="medina"){ ?>
<div id="c_ed6da3b0c2c5b38d1ae9a2fbb92eec48" class="ancho"></div><script type="text/javascript" src="http://www.eltiempo.es/widget/widget_loader/ed6da3b0c2c5b38d1ae9a2fbb92eec48"></script>
<?php }else{ ?>
        <div id="c_e57fa2f6fac3f87fd870f0eebef7dbcc" class="ancho">
        	<h2 style="color: #000000; margin: 0 0 3px; padding: 2px; font: bold 13px/1.2 Verdana; text-align: center;"></h2>
            </div>
			<script type="text/javascript" src="http://www.eltiempo.es/widget/widget_loader/e57fa2f6fac3f87fd870f0eebef7dbcc">
            </script>
<?php } ?>
        <div class="principal">
            <ul>
                <a href="../index.php" target="_self"><li>Inicio</li></a>
                <a href="../clientes/clientes.php" target="_self"><li>Clientes</li></a>
                <a href="../cruze/cruze.php" target="_self"><li>Referencias cruzadas</li></a>
                <a href="../enlaces/enlaces.php" target="_self"><li>Enlaces</li></a>
                <a href="../cambio/cambio.php"><li>Cambio</li></a>
		<a href="../calendario/pedidos.php?numes=<?php echo calcular_numes(); ?>&dia=<?php echo calcular_dia(); ?>&mes=<?php echo calcular_mes(); ?>&ano=<?php echo calcular_ano();?>"><li id="activo">Pedidos Citroen</li></a>
		<?php if($_SERVER['REMOTE_USER']!="medina"){ ?><a href="../pedidosv/pedidosv.php?numes=<?php echo calcular_numes(); ?>&dia=<?php echo calcular_dia(); ?>&mes=<?php echo calcular_mes(); ?>&ano=<?php echo calcular_ano();?>"><li>Pedidos Volvo</li></a> <?php } ?>
            </ul>
             </div>
            <div class="banda">
                <h2 style="padding:15px;">Pedidos citroen</h2>
                 <a href="calendario.php" target="_self">
                <div id="nuevo">
                    Calendario
                </div>
                </a>
        </div>
        <?php
	if((isset($_POST['denominacion'])and $_POST['denominacion']!='') or (isset($_POST['referencia']) and $_POST['referencia']!='') or (isset($_POST['matricula']) and $_POST['matricula']!='') or (isset($_POST['cliente']) and $_POST['cliente']!='')){
		?><div style="clear:both">
		<table border='2' class="listado">
	    <th>Referencia</th>
        <th>C</th>
        <th>Denominación</th>
        <th>Matrícula</th>
        <th>Cliente</th>
        <th>Fecha</th>
        <th>D</th>
        <th>Pedido</th>
        <th>PS</th>
		<?php
	mysql_connect("localhost","chechu");
	mysql_select_db("pedidos");
	$tablas=mysql_query("SHOW TABLES FROM pedidos");
        if($_SERVER['REMOTE_USER']=="recepcion"){
            while($row = mysql_fetch_row($tablas)){
				$buscar=mysql_query("SELECT * 
				FROM ".$row[0]." 
				WHERE referencia LIKE '%".$_POST['referencia']."%' 
				AND matricula LIKE '%".$_POST['matricula']."%' 
				AND cliente LIKE '%".$_POST['cliente']."%'
                                AND denominacion LIKE '%".$_POST['denominacion']."%'
                                AND destino LIKE 'T'
				ORDER BY fecha DESC;");
				$maximo = 100;
				while($ref=mysql_fetch_row($buscar) and $maximo>=0){
					$maximo--;
					if($ref[9]!='')
						$pendiente="style=color:red";
					else
						$pendiente='';
					echo "<tr $pendiente>
					<td>".$ref[1]."</td>
					<td>".$ref[2]."</td>
					<td>".$ref[3]."</td>
					<td>".$ref[4]."</td>
					<td>".$ref[5]."</td>
					<td>".$ref[6]."</td>
					<td>".$ref[7]."</td>
                                        <td>".$ref[10]."</td>
					<td><input type='checkbox' disabled='disabled'".$ref[9]."></td>
					</tr>";
				}
			}
        }else{
                                while($row = mysql_fetch_row($tablas)){
				$buscar=mysql_query("SELECT * 
				FROM ".$row[0]." 
				WHERE referencia LIKE '%".$_POST['referencia']."%' 
				AND matricula LIKE '%".$_POST['matricula']."%' 
				AND cliente LIKE '%".$_POST['cliente']."%'
                                AND denominacion LIKE '%".$_POST['denominacion']."%'
				ORDER BY fecha DESC;");
				$maximo = 100;
				while($ref=mysql_fetch_row($buscar) and $maximo>=0){
					$maximo--;
					if($ref[9]!='')
						$pendiente="style=color:red";
					else
						$pendiente='';
					echo "<tr $pendiente>
					<td>".$ref[1]."</td>
					<td>".$ref[2]."</td>
					<td>".$ref[3]."</td>
					<td>".$ref[4]."</td>
					<td>".$ref[5]."</td>
					<td>".$ref[6]."</td>
					<td>".$ref[7]."</td>
                                        <td>".$ref[10]."</td>
					<td><input type='checkbox' disabled='disabled'".$ref[9]."></td>
					</tr>";
				}
			}
        }
			?></table></div><?php
	}else{
	?>
        <?php
            $anoInicial = '2011';
			$anoFinal = '2030';
			$funcionTratarFecha = 'document.location = "?dia="+dia+"&mes="+mes+"&ano="+ano;';
		?>
<form><table style="clear:both;" border="0" cellpadding="5" cellspacing="0" bgcolor="#D4D0C8">
  <tr>
    <td width="740px">
<?php
$fecha = getdate(time());
if(isset($_GET["dia"]))$dia = $_GET["dia"];
else $dia = $fecha['mday'];
if(isset($_GET["mes"]))$mes = $_GET["mes"];
else $mes = $fecha['mon'];
if(isset($_GET["ano"]))$ano = $_GET["ano"];
else $ano = $fecha['year'];
$fecha = mktime(0,0,0,$mes,$dia,$ano);
$fechaInicioMes = mktime(0,0,0,$mes,1,$ano);
$fechaInicioMes = date("w",$fechaInicioMes);
?>
    <select style="font-size:20px;" size="1" name="mes" class="m1" onChange="document.location = '?dia=<?=$dia?>&mes=' + document.forms[0].mes.value + '&ano=<?=$ano?>';">
<?php
$meses = Array ('enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre');
for($i = 1; $i <= 12; $i++){
  echo '      <option ';
  if($mes == $i)echo 'selected ';
  echo 'value="'.$i.'">'.$meses[$i-1]."\n";
}
?>
    </select>&nbsp;&nbsp;&nbsp;<select style="font-size:20px;" size="1" name="ano" class="m1" onChange="document.location = '?dia=<?=$dia?>&mes=<?=$mes?>&ano=' + document.forms[0].ano.value;">
<?php
for ($i = $anoInicial; $i <= $anoFinal; $i++){
  echo '      <option ';
  if($ano == $i)echo 'selected ';
  echo 'value="'.$i.'">'.$i."\n";
}
?>
    </select><br>
    <font size="1">&nbsp;</font><table border="0" cellpadding="2" cellspacing="0" width="100%" class="m1" bgcolor="#FFFFFF" height="100%">
<?php
$diasSem = Array ('L','M','M','J','V','S','D');
$ultimoDia = date('t',$fecha);
$numMes = 0;
for ($fila = 0; $fila < 7; $fila++){
  echo "      <tr>\n";
  for ($coln = 0; $coln < 7; $coln++){
    $posicion = Array (1,2,3,4,5,6,0);
    echo '        <td width="14%" height="19"';
    if($fila == 0)echo ' bgcolor="#808080"';
    if($dia-1 == $numMes)echo ' bgcolor="#0A246A"';
    echo " align=\"center\">\n";
    echo '        ';
    if($fila == 0)echo '<font color="#D4D0C8">'.$diasSem[$coln];
    elseif(($numMes && $numMes < $ultimoDia) || (!$numMes && $posicion[$coln] == $fechaInicioMes)){
      echo '<a href="pedidos.php?diasemana='.($coln+1).'&numes='.$mes.'&dia='.($numMes+1).'&mes='.$meses[$mes-1].'&ano='.$ano.'" onclick="tratarFecha('.(++$numMes).','.$mes.','.$ano.')">';
      if($dia == $numMes)echo '<font color="#FFFFFF">';
      echo ($numMes).'</a>';
    }
    echo "</td>\n";
  }
  echo "      </tr>\n";
}
?>
    </table>
    </td>
  </tr>
</table>
</td>
</tr>
</table>
</form>
<?php } ?>
        <div class="pie">
            <hr>
            Empresa Carrión SA <span>Jesús Martín 2012 ®</span>
        </div>
        </div>
    <div style="position:fixed;top:150px;width:150px;padding:15px;">
        <fieldset style="width: 160px;background-color: #ddd;padding: 10px;">
            <legend>Buscar</legend>
    <form action="#" method="post" name="busqueda">
    referencia: <input type="text" name="referencia" /><br/><br/>
    denominación: <input type="text" name="denominacion" /><br/><br/>
    matricula: <input type="text" name="matricula" /><br/><br/>
    <?php if($_SERVER['REMOTE_USER']=="medina"){ ?> Cliente: Medina <?php }else{ ?>  OR/Cliente:  <?php } ?> <input type="text" <?php if($_SERVER['REMOTE_USER']=="medina"){ ?> value="MEDINA" style="display:none" <?php } ?> name="cliente" /><br/><br/>
    <input type="submit" value="Buscar" />
    </form>  
        </fieldset>
    </div>
    </body>
</html>