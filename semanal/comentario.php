<?php

header("Content-type: text/javascript; charset=iso-8859-1");
include_once '../estilos/conexion.php';
$texto = UTF8_decode(strtoupper($_GET['salida']));
$mysqli->query("UPDATE semanal SET comentario = '" . $texto . "' WHERE id LIKE " . $_GET['id'] . ";");
?>

