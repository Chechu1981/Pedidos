<?php

include ('../estilos/conexion.php');
$fecha = $_GET['fecha'];
mysql_query("UPDATE nombres SET cadena = '" . $fecha . "' WHERE aplicacion = 'proximoSemanal';");