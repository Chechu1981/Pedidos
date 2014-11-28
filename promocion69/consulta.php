<?php
header("Cache-Control: no-store, no-cache, must-revalidate");
mysql_connect("localhost", "chechu");
mysql_select_db("carrion");
$texto;
$sentenciafiltro = "SELECT * FROM denominacion WHERE referencia = '".$_GET['f']."'";
$filtros = mysql_query($sentenciafiltro);
$filtro = mysql_fetch_row($filtros);
$sentenciajunta = "SELECT * FROM denominacion WHERE referencia = '".$_GET['j']."'";
$juntas = mysql_query($sentenciajunta);
$junta = mysql_fetch_row($juntas);
$texto = utf8_encode("<br/>Filtro: ".$filtro[3]."€");
$texto = $texto . utf8_encode("<br/>Junta:  ".$junta[3]."€");
echo utf8_decode($texto);