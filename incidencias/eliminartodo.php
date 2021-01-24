<?php
include '../estilos/conexion.php';
$result = $mysqli->query("DELETE FROM `incidencias` WHERE id > 0"); 
