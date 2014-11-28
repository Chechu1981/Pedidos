<?php
include '../estilos/conexion.php';
mysql_query("DELETE FROM incidencias WHERE id LIKE ".$_GET['id'].";"); 