<?php
    include ('../estilos/conexion.php');
    if(@$_GET['cliente']==""){
        @$sentencia=mysql_query("SELECT * FROM hoja1 WHERE denominacion LIKE '%".$_GET['denom']."%' ORDER BY nombre;");
    }elseif($_GET['denom']==""){
        $sentencia=mysql_query("SELECT * FROM hoja1 WHERE Nombre LIKE '%".$_GET['cliente']."%' ORDER BY nombre;");
    }else{
        $sentencia=mysql_query("SELECT * FROM hoja1 WHERE Nombre LIKE '%".$_GET['cliente']."%' AND  denominacion LIKE '%".$_GET['denom']."%' ORDER BY nombre;");
    }
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
