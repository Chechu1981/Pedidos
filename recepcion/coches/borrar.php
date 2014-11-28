<?php
include '../../estilos/conexion.php';
mysql_query("DELETE FROM coches WHERE id = ".$_GET['id'].";");
?>