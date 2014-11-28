<?php 
include '../estilos/conexion.php';
mysql_query("INSERT INTO empleados (id,Nombre)VALUES(NULL,'".$_POST['nom']."') ;");
