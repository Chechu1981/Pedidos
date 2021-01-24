<?php 
include_once '../estilos/conexion.php';
$mysqli->query("DELETE FROM semanal WHERE id = ".$_GET['id'].";"); 
?>