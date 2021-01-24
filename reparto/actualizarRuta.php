<?php
header("Content-type: text/javascript; charset=iso-8859-1");
mysql_connect("localhost","chechu");
mysql_select_db("pedidos");
$texto = UTF8_decode($_GET['cantidad']);
$ordenante = $_GET['ordenante'];
$cod = $_GET['cod'];
$prio = $_GET['prio'];
$comentario = $_GET['comentario'];
mysql_query("INSERT INTO ruta (id,ordenante,fechaPedido,cliente,comentario,prioridad)VALUES('','$ordenante',NOW(),'$cod','$comentario','$prio')"); 
