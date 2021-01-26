<?php
include '../estilos/conexion.php';
$mysqli->query("DELETE FROM recepcion WHERE id = ".$_GET['id'].";");
?>