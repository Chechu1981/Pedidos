<?php 
include_once '../estilos/conexion.php   ';
$mysqli->query("DELETE FROM semanalvolvo WHERE id = ".$_GET['id'].";"); 
?>