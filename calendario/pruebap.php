<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;" charset="ISO-8859-1"></meta>
        <title><?php echo "Pedido del ".$_GET['dia']." de ".$_GET['mes']." de ".$_GET['ano'];?></title>
        <link rel="shortcut icon" href="../imagenes/chechu.ico" />
        <link rel="stylesheet" type="text/css" href="../estilos/style.css" />
        <link type="text/css" href="../scripts/jquery-ui-1.8.21.custom/css/ui-lightness/jquery-ui-1.8.21.custom.css" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="css/jquery.jdigiclock.css" />
        <script type="text/javascript" src="lib/jquery.jdigiclock.js"></script>
        <!--<script src="../scripts/jquery-ui-1.8.21.custom/js/jquery-1.7.2.min.js"></script>
        <script type="text/javascript" src="lib/jquery-1.3.2.min.js"></script>
        <script src="../scripts/jquery-ui-1.8.21.custom/js/jquery-ui-1.8.21.custom.min.js"></script>-->
        <script src="../scripts/jquery-1.9.0.js"></script>
        
    </head>
    <body>
    <div id="calendario">
        <?php
            $anoInicial = '2011';
            $anoFinal = '2030';
            $funcionTratarFecha = 'document.location = "?dia="+dia+"&mes="+mes+"&ano="+ano;';
        ?>
<form><table style="clear:both;font-size: 5px" border="0" cellpadding="5" cellspacing="0" bgcolor="#D4D0C8">
  <tr>
    <td width="20px">
<?php
$fecha1 = getdate(time());
if(isset($_GET["dia"]))$dia = $_GET["dia"];
else $dia = $fecha1['mday'];
if(isset($_GET["mes"]))$mes = $_GET["mes"];
else $mes = $fecha1['mon'];
if(isset($_GET["ano"]))$ano = $_GET["ano"];
else $ano = $fecha1['year'];
$fecha = mktime(0,0,0,$fecha1['mon'],$dia,$ano);
$fechaInicioMes = mktime(0,0,0,$fecha1['mon'],1,$ano);
$fechaInicioMes = date("w",$fechaInicioMes);

?>
    <select style="font-size:10px;" size="1" name="mes"  onChange="document.location = '?dia=<?=$dia?>&mes=' + document.forms[0].mes.value + '&ano=<?=$ano?>';">
<?php
$meses = Array ('enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre');
for($i = 1; $i <= 12; $i++){
  echo '      <option ';
  if($mes == $i)echo 'selected ';
  echo 'value="'.$i.'">'.$meses[$i-1]."\n";
}
?>
    </select>&nbsp;&nbsp;&nbsp;<select style="font-size:10px;" size="1" name="ano"  onChange="document.location = '?dia=<?=$dia?>&mes=<?=$mes?>&ano=' + document.forms[0].ano.value;">
<?php
for ($i = $anoInicial; $i <= $anoFinal; $i++){
  echo '      <option ';
  if($ano == $i)echo 'selected ';
  echo 'value="'.$i.'">'.$i."\n";
}
?>
    </select><br>
    <font size="1">&nbsp;</font><table border="0" cellpadding="2" cellspacing="0" width="20px" style="font-size: 15px"  bgcolor="#FFFFFF" height="20px">
<?php
$diasSem = Array ('L','M','M','J','V','S','D');
$ultimoDia = date('t',$fecha);
$numMes = 0;
for ($fila = 0; $fila < 7; $fila++){
  echo "      <tr>\n";
  for ($coln = 0; $coln < 7; $coln++){
    $posicion = Array (1,2,3,4,5,6,0);
    echo '        <td width="4%" height="19"';
    if($fila == 0)echo ' bgcolor="#808080"';
    if($dia-1 == $numMes)echo ' bgcolor="#0A246A"';
    echo " align=\"center\">\n";
    echo '        ';
    if($fila == 0)echo '<font color="#D4D0C8">'.$diasSem[$coln];
    elseif(($numMes && $numMes < $ultimoDia) || (!$numMes && $posicion[$coln] == $fechaInicioMes)){
      echo '<a href="pedidos.php?diasemana='.($coln+1).'&numes='.$mes.'&dia='.($numMes+1).'&mes='.$meses[$fecha1['mon']].'&ano='.$ano.'" onclick="tratarFecha('.(++$numMes).','.$mes.','.$ano.')">';
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
    </div>    
    
    </body>
</html>