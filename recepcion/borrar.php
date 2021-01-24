<?php
include '../estilos/conexion.php';
mysql_query("DELETE FROM recepcion WHERE id = ".$_GET['id'].";");
?>