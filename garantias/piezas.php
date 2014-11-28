<?php
    include ('../estilos/conexion.php');
    header("Cache-Control: no-store, no-cache, must-revalidate");
    @$sentencia=mysql_query("SELECT * FROM piezas WHERE denominacion LIKE '%".$_GET['envio']."%' ORDER BY orden;");
    
    echo utf8_encode("<table width='800px' class='listado'><th>Código</th><th>Nombre</th><th>Denominación</th><th>Teléfono</th><th>Fax</th><th></th>");
    if(@$_GET['cliente']!="" or @$_GET['denom']!="" or isset($_GET['todos'])){ 
        while($fila=mysql_fetch_row($sentencia)){
            echo utf8_encode("<tr>
                <td>".$fila[0]."</td>
                <td><a href='clientes.php?id=".$fila[9]."'>".$fila[1]."</a></td>
                <td>".$fila[2]."</td>
                <td>".$fila[3]."</td>
                <td>".$fila[4]."</td>
                <td><a href='editar.php?id=".$fila[9]."' target='_blank'><img src='../imagenes/editar.png' width='20px'/></a></td>");
            echo utf8_encode("</tr>");
     }
    }
echo utf8_encode("</table>");
