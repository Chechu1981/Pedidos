<?php
include ('../estilos/conexion.php');
        mysql_select_db("pedidos");
        $tabla = "";
        $pendiente=  mysql_query("SELECT * FROM lineas WHERE destino LIKE 'T' AND ps NOT LIKE '' AND fecha_pedido = '".$_GET[pedido]."';");
        while($fila=mysql_fetch_row($pendiente)){
            $tabla=$tabla."\n ".$fila[2]." ".$fila[3]." con la referencia ".$fila[1]." pedido para el cliente ".$fila[5]." (".$fila[4].")";
        }
        mail("chechu@empresacarrion.com","Pendiente de servir","Buenos días: 
            \nEste es el listado pendiente de servir del día ".date('d')." de ".date('m')." de ".date('Y')."
            \n".$tabla);
?>