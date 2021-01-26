<?php
header("Cache-Control: no-store, no-cache, must-revalidate");
include_once '../estilos/conexion.php';

$texto;
$sentenciafiltro = "SELECT * FROM denominacion WHERE referencia = '".$_GET['f']."'";
$filtros = $mysqli->query($sentenciafiltro);
$filtro = $filtros->fetch_row();
$sentenciajunta = "SELECT * FROM denominacion WHERE referencia = '".$_GET['j']."'";
$juntas = $mysqli->query($sentenciajunta);
$junta = $juntas->fetch_row();
$texto = utf8_encode("<br/>Filtro: ".$filtro[3]."€");
$texto = $texto . utf8_encode("<br/>Junta:  ".$junta[3]."€");
echo utf8_decode($texto);