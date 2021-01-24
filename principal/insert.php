<?php 
include '../estilos/conexion.php';
$mysqli->query("INSERT INTO soc (id,agente,cuenta)VALUES(NULL,'".$_POST['ag']."','".$_POST['cu']."') ;");
?>
