<?php

include ('../estilos/conexion.php');
$fecha = $_GET['fecha'];
$mysqli->query("UPDATE nombres SET cadena = '" . $fecha . "' WHERE aplicacion = 'proximoSemanal';");