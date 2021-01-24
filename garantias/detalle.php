<?php 
include ('../estilos/conexion.php');
header("Cache-Control: no-store, no-cache, must-revalidate");
$result=mysql_query("SELECT * FROM piezas WHERE envio =".$_GET['envio']); 
?>
<img src="../imagenes/logo_citroen.jpg" width="80" /><img src="../imagenes/carrion.jpg" width="100" />
<h2>Relación de envío de garantias</h2>
Empresa Carrión SA<br/>
C/ Nitrógeno, 37<br/>
Polígono Industrial San Crstóbal<br/>
47012 Valladolid<br/>
<h3>Nº de envío: <?php echo $_GET['envio'] ?> </h3>
<h3>Fecha: <?php echo $_GET['fecha'] ?></h3>
<table style="margin:auto" border="1" class="listbuscar">
    <th>Referencia</th><th>Cantidad</th><th>Denominación</th><th>Expediente</th><th>Orden</th>
<?php
while($lineas=mysql_fetch_row($result)){
    ?> <tr> <?php
	for($i=2;$i<7;$i++){
        ?> <td> <?php
                echo utf8_encode($lineas[$i]);
        ?> </td> <?php	} 
	 ?>	</tr> <?php } ?>
</table>
<p/>
<a href="#">Imprimir</a>