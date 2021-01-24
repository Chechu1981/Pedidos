<?php

header("Cache-Control: no-store, no-cache, must-revalidate");
mysql_connect("localhost", "chechu");
mysql_select_db("carrion");

//mysql_query("INSERT INTO reparto (id,repartidor,fecha,vehiculo,reparto  )VALUES('','" . $_GET['repartidor'] . "',NOW(),'" . $_GET['furgona'] . "'," . $_GET['nReparto'] . ");");
mysql_query("UPDATE ruta SET entregado = 'EN CURSO', repartidor = '" . $_GET['repartidor'] . "', vehiculo = '" . $_GET['furgona'] . "',fechaReparto = NOW() WHERE id = " . $_GET['id'] . ";");
mysql_query("UPDATE nombres SET cadena = '" . $_GET['repartidor'] . "' WHERE aplicacion = 'repartidor'");
mysql_query("UPDATE nombres SET cadena = NOW() WHERE aplicacion = 'hora'");
mysql_query("UPDATE nombres SET cadena = '" . $_GET['furgona'] . "' WHERE aplicacion = 'furgona'");
//echo "INSERT INTO reparto (id,repartidor,fecha,vehiculo,reaparto)VALUES('','" . $_GET['repartidor'] . "',NOW(),'" . $_GET['furgona'] . "'," . $nReparto . ");";