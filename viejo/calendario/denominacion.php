<?php
include '../estilos/conexion.php';
mysql_select_db("pedidos");
@$sentencia=mysql_query("Select * FROM denominacion_precio WHERE referencia LIKE '".$_GET['ref']."'");
if(mysql_num_rows($sentencia) > 0 ){
    while($fila=mysql_fetch_row($sentencia)){
        echo $fila[1];
    }
}elseif($_GET['ref'] != ""){
    echo "DESCONOCIDO";
}else{
    echo "";
}
?>