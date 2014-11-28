<?php 
mysql_connect("localhost","chechu");
mysql_select_db("pedidos");
$num = $_GET['num'];
if($num == 0){
    if($_GET['id'] == "all")
        mysql_query("UPDATE semanalvolvo SET estado = 1 WHERE pedido = ".$_GET['pedido'].";"); 
    else
        mysql_query("UPDATE semanalvolvo SET estado = 1 WHERE id = ".$_GET['id']." AND pedido = ".$_GET['pedido'].";"); 
}elseif($num == 1){
    if($_GET['id'] == "all")
        mysql_query("UPDATE semanalvolvo SET estado = 0 WHERE pedido = ".$_GET['pedido'].";"); 
    else
        mysql_query("UPDATE semanalvolvo SET estado = 0 WHERE id = ".$_GET['id']." AND pedido = ".$_GET['pedido'].";"); 
}
?>