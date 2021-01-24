<?php
include '../estilos/conexion.php';
$mysqli->query("DELETE FROM incidencias WHERE id LIKE ".$_GET['id'].";"); 