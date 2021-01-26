<?php 
include_once '../estilos/conexion.php   ';
$num = $_GET['num'];
if($num == 0){
    if($_GET['id'] == "all")
        $mysqli->query("UPDATE semanalvolvo SET estado = 1 WHERE pedido = ".$_GET['pedido'].";"); 
    else
        $mysqli->query("UPDATE semanalvolvo SET estado = 1 WHERE id = ".$_GET['id']." AND pedido = ".$_GET['pedido'].";"); 
}elseif($num == 1){
    if($_GET['id'] == "all")
        $mysqli->query("UPDATE semanalvolvo SET estado = 0 WHERE pedido = ".$_GET['pedido'].";"); 
    else
        $mysqli->query("UPDATE semanalvolvo SET estado = 0 WHERE id = ".$_GET['id']." AND pedido = ".$_GET['pedido'].";"); 
}
?>