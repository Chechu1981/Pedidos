<?php
include_once '../estilos/conexion.php';
$comenta=$_POST['com'];
$id=$_POST['id'];
$mysqli->query("UPDATE lineasvolvo SET matricula='".  utf8_decode(strtoupper($comenta))."' WHERE id=".$id.";"); 
?>