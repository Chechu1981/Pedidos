<?php
include '../../estilos/conexion.php';
$mysqli->query("DELETE FROM coches WHERE id = ".$_GET['id'].";");
?>