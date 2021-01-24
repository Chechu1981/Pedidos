<?php
include '../estilos/conexion.php';
$mysqli->query("DELETE FROM usuarios WHERE id = ".$_GET['id'].";");
?>