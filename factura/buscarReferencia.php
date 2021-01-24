<?php
include '../estilos/conexion.php';

@$sentencia=$mysqli->query("Select * FROM denominacion WHERE referencia LIKE '".$_GET['ref']."'");
if($sentencia->num_rows > 0 ){
    while($fila = $sentencia->fetch_row()){
        echo $fila[1]."|".$fila[2]."|".$fila[3];
    }
}elseif($_GET['ref'] != ""){
    echo "DESCONOCIDO";
}else{
    echo "";
}
