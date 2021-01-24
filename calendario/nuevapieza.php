<?php
header("Content-type: text/javascript; charset=iso-8859-1");
include_once '../estilos/conexion.php';
$sentenciaRef=$mysqli->query("SELECT * FROM denominacion WHERE referencia LIKE '%".$_GET['ref']."%';");
if(!$sentenciaRef){
    $mysqli->query("INSERT INTO denominacion (referencia,nombre,dto,pvp) VALUES ('".$_GET['ref']."','".$_GET['den']."','0','0');");
} ?>