<?php 
include '../estilos/conexion.php';
mysql_query("INSERT INTO soc (id,agente,cuenta)VALUES(NULL,'".$_POST['ag']."','".$_POST['cu']."') ;");
?>
