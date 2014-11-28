<?php
header("Content-type: text/javascript; charset=iso-8859-1");
mysql_connect("localhost","chechu");
mysql_select_db("carrion");
$texto = UTF8_decode($_GET['cantidad']);
mysql_query("UPDATE neumaticos SET disponibilidad = '".$texto."' WHERE id = ".$_GET['id'].";"); 
