<?php
header("Content-type: text/javascript; charset=iso-8859-1");
include_once '../estilos/conexion.php';
$texto = UTF8_decode($_GET['cantidad']);
$mysqli->query("UPDATE neumaticos SET disponibilidad = '".$texto."' WHERE id = ".$_GET['id'].";"); 
