
<table border="1" class="listbuscar">
    <th>Fecha recibido</th><th>Fecha de pedido</th><th>Proveedor</th><th>Operario</th><th>Orden/Cliente</th><th>Comentario</th><th>Pedido</th><th>Recepcionado</th>
<?php
header("Cache-Control: no-store, no-cache, must-revalidate");
include ('../estilos/conexion.php');
//if(isset($_GET['oper']) and isset($_GET['ord']) and isset($_GET['prove']))
$result=$mysqli->query("SELECT * FROM o_proveedores  WHERE proveedor LIKE '%".$_GET['prove']."%'AND pedido LIKE '%".$_GET['pedido']."%' AND orden LIKE '%".$_GET['ord']."%' AND operario LIKE '%".$_GET['operario']."%' AND comentario LIKE '%".$_GET['comentario']."%' ORDER BY fecha_recibido DESC;");
while($lineas = $result->fetch_row()){;
    ?> <tr> <?php
    for($i=1;$i<9;$i++){
        ?> <td> <?php  
        if($i==2 || $i==1){
            $meses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
            $mes='';
            $date = date_create($lineas[$i]);
            for($m=0;$m<12;$m++){
                if(date_format($date,'m')==$m+1)
                        $mes=$meses[$m];
            }
            echo date_format($date,'d/').$mes.date_format($date,'/Y').' '.date_format($date,'H:m:s');
        }else{
            echo utf8_encode($lineas[$i]);
        } ?> </td> <?php } ?>
    <tr/> <?php } ?>
</table>