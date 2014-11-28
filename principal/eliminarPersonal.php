<?php
include '../estilos/conexion.php';
mysql_query("DELETE FROM empleados WHERE id = ".$_GET['id'].";");