<?php
header("Cache-Control: no-store, no-cache, must-revalidate");
include_once '../estilos/conexion.php';
$texto;
$sentenciafiltro = "SELECT * FROM denominacion WHERE referencia = '".$_GET['f']."'";
$filtros = $mysqli->query($sentenciafiltro);
$filtro = $filtros->fetch_row();
echo $filtro[3];