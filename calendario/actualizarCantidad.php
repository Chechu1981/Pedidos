<?php
header("Content-type: text/javascript; charset=iso-8859-1");
include_once '../estilos/conexion.php';
$texto = UTF8_decode($_GET['cantidad']);
$mysqli->query("UPDATE lineas SET cantidad = '".$texto."' WHERE id LIKE ".$_GET['id'].";"); 
