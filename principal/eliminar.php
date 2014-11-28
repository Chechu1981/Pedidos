<?php
include '../estilos/conexion.php';
mysql_query("DELETE FROM soc WHERE id = ".$_GET['id'].";");
?>