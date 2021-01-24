<?php 
include '../estilos/conexion.php';
$mysqli->query("INSERT INTO empleados (id,Nombre)VALUES(NULL,'".$_POST['nom']."') ;");
