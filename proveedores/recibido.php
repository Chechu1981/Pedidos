<?php
header("Cache-Control: no-store, no-cache, must-revalidate");
include ('../estilos/conexion.php');
$mysqli->query("UPDATE o_proveedores SET fecha_recibido=NOW(), recepcionado = '".strtoupper($_GET['oper'])."' WHERE indice = ".$_GET['id'].";");
?>