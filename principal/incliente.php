<?php 
include '../estilos/conexion.php';
$mysqli->query("INSERT INTO usuarios (id,nombre,pass,codigo,razon)VALUES(NULL,'".$_POST['nombre']."','".$_POST['pass']."','".$_POST['codigo']."','".$_POST['razon']."') ;");
?>