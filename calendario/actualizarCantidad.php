<?php
header("Content-type: text/javascript; charset=iso-8859-1");
mysql_connect("localhost","chechu");
mysql_select_db("pedidos");
$texto = UTF8_decode($_GET['cantidad']);
mysql_query("UPDATE lineas SET cantidad = '".$texto."' WHERE id LIKE ".$_GET['id'].";"); 
