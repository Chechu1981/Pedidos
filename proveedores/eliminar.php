<?php
include ('../estilos/conexion.php');
mysql_query("DELETE FROM o_proveedores WHERE indice = ".$_GET['id'].";");
?>