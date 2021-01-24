<?php
mysql_connect("localhost","chechu");
mysql_select_db("pedidos");
$comenta=$_POST['com'];
$id=$_POST['id'];
mysql_query("UPDATE lineasvolvo SET matricula='".  utf8_decode(strtoupper($comenta))."' WHERE id=".$id.";"); 
?>