<?php
include '../estilos/conexion.php';
@$sentencia=mysql_query("SELECT * FROM denominacionvolvo WHERE referencia LIKE '".$_GET['ref']."'");
while($fila=mysql_fetch_row($sentencia)){
    echo $fila[1];
}
?>