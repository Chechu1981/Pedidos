<link rel="stylesheet" type="text/css" href="../estilos/style.css" />
<?php
include '../estilos/conexion.php';
mysql_select_db("pedidos");
$buscar=mysql_query("SELECT * 
FROM lineas 
WHERE cliente LIKE '%".$_GET['cliente']."%'
AND destino LIKE 'T'
ORDER BY fecha DESC;");
$maximo = 100;
if(mysql_num_rows($buscar)>0){
?>
<table class="listado">
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
while($ref=@mysql_fetch_row($buscar) and $maximo>=0){
    $mss = Array ('enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre');
    $anio=substr($ref[10],-4);
    $ms="";
    $n=0;
    for($i=0;$i<12;$i++){
        if(stristr($ref[10],$mss[$i])==TRUE){
           $ms=$mss[$i];
           $n=$i+1;
        }
    }
    $dy = substr($ref[10], 0, -(strlen($ms)+4));
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
        <td><a href='../calendario/pedidos.php?ano=".$anio."&mes=".$ms."&numes=".$n."&dia=".$dy."&ref=".$ref[1]."'>".$ref[10]."</a></td>
        <td><input type='checkbox' disabled='disabled'".$ref[9]."></td>
        </tr>";
}
?> 
</table> 
<?php
} else {
    ?><span style="font-size: 30px;color: brown">No hay piezas pedidas por urgente para la orden <?php echo $_GET['cliente']?>.</span><?php
}
?>
