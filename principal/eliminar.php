<?php
include '../estilos/conexion.php';
$mysqli->query("DELETE FROM soc WHERE id = ".$_GET['id'].";");
?>