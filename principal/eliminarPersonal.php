<?php
include '../estilos/conexion.php';
$mysqli->query("DELETE FROM empleados WHERE id = ".$_GET['id'].";");