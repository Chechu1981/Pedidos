<?php
header("Cache-Control: no-store, no-cache, must-revalidate");
mysql_connect("localhost","chechu");
mysql_select_db("carrion");
mysql_query("UPDATE ruta SET entregado = 'NO', fechaReparto = '0000-00-00 00:00:00',repartidor = '',vehiculo = '' WHERE id = ".$_GET['id'].";"); 
echo "UPDATE ruta SET entregado = 'NO', fechaReparto = '0000-00-00 00:00:00',repartidor = '',vehiculo = '' WHERE id = ".$_GET['id'].";";
