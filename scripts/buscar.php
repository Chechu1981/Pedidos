<?php
include '../estilos/conexion.php';
$result=mysql_query("SELECT * FROM denominacion WHERE referencia LIKE '".$_POST['ref']."';");
while($fila=mysql_fetch_row($result)){
    echo $fila[1];
}
?>