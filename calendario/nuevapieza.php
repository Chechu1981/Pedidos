<?php
header("Content-type: text/javascript; charset=iso-8859-1");
mysql_connect("localhost","chechu");
mysql_select_db("pedidos");
$sentenciaRef=mysql_query("SELECT * FROM denominacion_precio WHERE referencia LIKE '%".$_GET['ref']."%';");
if(!$sentenciaRef){
    mysql_query("INSERT INTO denominacion_precio (referencia,nombre,dto,pvp) VALUES ('".$_GET['ref']."','".$_GET['den']."','0','0');");
} ?>