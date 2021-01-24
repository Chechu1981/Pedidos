<?php
include '../estilos/conexion.php';
header("Cache-Control: no-store, no-cache, must-revalidate");
mysql_query("DELETE FROM ruta WHERE id = ".$_GET['id'].";");