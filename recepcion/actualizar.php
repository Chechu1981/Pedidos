<?php
include ('../estilos/conexion.php');
mysql_query("UPDATE recepcion SET entregado = 'SI' WHERE id = ".$_GET['id'].";");
echo "UPDATE recepcion SET entregado = 'SI' WHERE id = ".$_GET['id'].";";
?>