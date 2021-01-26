<?php
include '../estilos/conexion.php';
@$sentencia=$mysqli->query("SELECT * FROM denominacionvolvo WHERE referencia LIKE '".$_GET['ref']."'");
while($fila = $sentencia->fetch_row()){
    echo $fila[1];
}
?>