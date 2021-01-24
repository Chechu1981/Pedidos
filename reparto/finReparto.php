<?php
header("Cache-Control: no-store, no-cache, must-revalidate");
mysql_connect("localhost","chechu");
mysql_select_db("carrion");
mysql_query("UPDATE ruta SET entregado = 'SI', fechaReparto = NOW() WHERE entregado = 'EN CURSO';"); 
mysql_query("UPDATE nombres SET cadena = '' WHERE aplicacion = 'repartidor'");
mysql_query("UPDATE nombres SET cadena = '' WHERE aplicacion = 'hora'");
mysql_query("UPDATE nombres SET cadena = '' WHERE aplicacion = 'furgona'");