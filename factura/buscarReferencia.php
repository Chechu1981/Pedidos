<?php
include '../estilos/conexion.php';
//mysql_select_db("pedidos");
@$sentencia=mysql_query("Select * FROM denominacion WHERE referencia LIKE '".$_GET['ref']."'");
if(mysql_num_rows($sentencia) > 0 ){
    while($fila=mysql_fetch_row($sentencia)){
        echo $fila[1]."|".$fila[2]."|".$fila[3];
    }
}elseif($_GET['ref'] != ""){
    echo "DESCONOCIDO";
}else{
    echo "";
}
