<div style="clear: both"></div>
<?php
$cantidad=50;
header("Cache-Control: no-store, no-cache, must-revalidate");
include ('../estilos/conexion.php');
$result = $mysqli->query("SELECT * FROM o_proveedores WHERE fecha_recibido NOT LIKE '%000%' ORDER BY fecha_recibido DESC LIMIT ".$cantidad."");
if(isset($_GET['pagina'])){
    $result = $mysqli->query("SELECT * FROM o_proveedores WHERE fecha_recibido NOT LIKE '%000%' ORDER BY fecha_recibido DESC LIMIT ".$cantidad * ($_GET['pagina']-1).",".$cantidad."");
}
$senpaginas =  $mysqli->query("SELECT * FROM o_proveedores");
$paginas = $senpaginas->num_rows / 50;
if(isset($_GET['pagina'])){
    $pag=$_GET['pagina'];
}else{
    $pag=1;
}
for($i=1;$i<intval($paginas);$i++){ 
    if($i==$pag){
        ?><div style="padding: 8px;float: left;color:red;font-weight: bolder;font-size: 15px;"><a href="#" onclick="paginas(<?php echo $i?>)" ><?php echo $i?></a></div><?php
    }else{?><div style="padding: 8px;float: left;"><a href="#" onclick="paginas(<?php echo $i?>)" ><?php echo $i?></a></div><?php }    
}
?>
<table border="1" class="volvolinea">
    <th>Recibido</th><th>Fecha de pedido</th><th>Proveedor</th><th>Operario</th><th>Orden/Cliente</th><th>Comentario</th><th>Pedido</th><th>Recepcionado</th>
<?php
while($lineas = $result->fetch_row()){;
    ?> <tr> <?php
    for($i=1;$i<9;$i++){
        ?> <td style="text-align: center"> <?php
        if($i==2 || $i==1){
            $meses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
            $mes='';
            $date = date_create($lineas[$i]);
            for($m=0;$m<12;$m++){
                if(date_format($date,'m')==$m+1)
                        $mes=$meses[$m];
            }
            echo date_format($date,'d/').$mes.date_format($date,'/Y').' '.date_format($date,'H:i:s');
        }else{
            echo utf8_encode($lineas[$i]);
        }
        ?> </td> <?php } ?>
    <tr/> <?php } ?>
</table>
        <div style="clear:both"></div>
        <?php
        for($i=1;$i<intval($paginas);$i++){ 
            if($i==$pag){
                ?><div style="padding: 8px;float: left;color:red;font-weight: bolder;font-size: 15px;"><a href="#" onclick="paginas(<?php echo $i?>)" ><?php echo $i?></a></div><?php
            }else{?><div style="padding: 8px;float: left;"><a href="#" onclick="paginas(<?php echo $i?>)" ><?php echo $i?></a></div><?php }    
        }
        ?>