<?php
include '../estilos/conexion.php';
mysql_query("DELETE FROM usuarios WHERE id = ".$_GET['id'].";");
?>