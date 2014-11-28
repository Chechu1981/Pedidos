<?php
header("Cache-Control: no-store, no-cache, must-revalidate");
mysql_connect("localhost", "chechu");
mysql_select_db("carrion");
$texto;
$sentenciafiltro = "SELECT * FROM denominacion WHERE referencia = '".$_GET['f']."'";
$filtros = mysql_query($sentenciafiltro);
$filtro = mysql_fetch_row($filtros);
echo $filtro[3];