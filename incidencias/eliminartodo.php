<?php
include '../estilos/conexion.php';
$result = mysql_query("DELETE FROM `incidencias` WHERE id > 0"); 
