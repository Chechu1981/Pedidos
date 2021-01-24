<?php
include_once '../estilos/conexion.php';
$mysqli->query("DELETE FROM fiestas WHERE id = ".$_GET['id']."");