<?php
include ('../estilos/conexion.php');
$mysqli->query("DELETE FROM o_proveedores WHERE indice = ".$_GET['id'].";");
?>