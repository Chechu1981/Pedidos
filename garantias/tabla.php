<table style="margin:auto" border="1" class="listbuscar">
    <th>N Envio</th><th>Envio Gefco</th><th>Fecha de envio</th>
<?php
header("Cache-Control: no-store, no-cache, must-revalidate");
include ('../estilos/conexion.php');
$result=mysql_query("SELECT * FROM garantia");
while($lineas=mysql_fetch_row($result)){
    $fech = new DateTime($lineas[3]);
    $ano =  date_format($fech,'Y');
    $mes = date_format($fech,'m');
    $dia = date_format($fech,'d')
    ?> <tr> <?php
        ?> <td> <?php
                echo "<span style='text-decoration:underline;color:red;cursor:pointer' onclick='detalle(".$lineas[1].",".$ano.",".$mes.",".$dia.")' >".utf8_encode($lineas[1])."</span>";
        ?> </td> <?php
        ?> <td> <?php
                echo utf8_encode($lineas[2]);
        ?> </td> <?php
        ?> <td> <?php
                echo utf8_encode($lineas[3]);
        ?> </td> <?php	} ?>
</table>