<?php 
mysql_connect("localhost","chechu");
mysql_select_db("pedidos");
mysql_query("DELETE FROM semanal WHERE id = ".$_GET['id'].";"); 
?>