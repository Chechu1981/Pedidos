<?php
include '../estilos/conexion.php';
header("Cache-Control: no-store, no-cache, must-revalidate");
$mysqli->query("DELETE FROM cuaderno WHERE id = ".$_GET['id'].";");