<?php

header('Content-type: text/html; charset=iso-8859-1');
include_once '../estilos/conexion.php';
$comenta = $_POST['com'];
$id = $_POST['id'];
$mysqli->query("UPDATE lineas SET matricula='" . utf8_encode(strtoupper($comenta)) . "' WHERE id=" . $id . ";");
?>