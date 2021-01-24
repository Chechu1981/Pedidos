<?php
include '../estilos/conexion.php';

@$sentencia = $mysqli->query("Select distinct * FROM denominacion WHERE referencia LIKE '".$_GET['ref']."'");
if(@$sentencia->num_rows > 0 ){
    while($fila = $sentencia->fetch_row()){
        echo utf8_encode($fila[1]);
    }
}elseif($_GET['ref'] != ""){
    echo "DESCONOCIDO";
}else{
    echo "";
}
?>