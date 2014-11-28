<?php

include ('../estilos/conexion.php');
header("Cache-Control: no-store, no-cache, must-revalidate");
if (@$_GET['cliente'] == "") {
    @$sentencia = mysql_query("SELECT * FROM hoja1 WHERE denominacion LIKE '%" . $_GET['denom'] . "%' ORDER BY nombre;");
} elseif ($_GET['denom'] == "") {
    $sentencia = mysql_query("SELECT * FROM hoja1 WHERE Nombre LIKE '%" . $_GET['cliente'] . "%' ORDER BY nombre;");
} else {
    $sentencia = mysql_query("SELECT * FROM hoja1 WHERE Nombre LIKE '%" . $_GET['cliente'] . "%' AND  denominacion LIKE '%" . $_GET['denom'] . "%' ORDER BY nombre;");
}
if (@$_GET['cliente'] != "" || @$_GET['denom'] != "") {
    if (mysql_num_rows($sentencia) == 1) {
        echo "<div style='color:grey;float:right;font-size:18px;margin-right:100px;margin-top:20px;' >" . mysql_num_rows($sentencia) . " resultado</div>";
    } else {
        echo "<div style='color:grey;float:right;font-size:18px;margin-right:100px;margin-top:20px;' >" . mysql_num_rows($sentencia) . " resultados</div>";
    }
}
echo utf8_encode("<table width='800px' class='listado'><th></th><th>C&oacute;digo</th><th>Nombre</th><th>Denominaci&oacute;n</th><th>Tel&eacute;fono</th><th>Fax</th><th></th><th></th>");
$numero = 1;
if (@$_GET['cliente'] != "" or @ $_GET['denom'] != "" or isset($_GET['todos'])) {
    if (isset($_GET['todos'])) {
        if ($_GET['todos'] == "a") {
            $sentencia = mysql_query("SELECT * FROM hoja1 WHERE tipo = 'A' ORDER BY nombre;");
        } elseif ($_GET['todos'] == "e") {
            $sentencia = mysql_query("SELECT * FROM hoja1 WHERE tipo = 'E' ORDER BY nombre;");
        } elseif ($_GET['todos'] == "m") {
            $sentencia = mysql_query("SELECT * FROM hoja1 WHERE tipo = 'M' ORDER BY nombre;");
        }
    }
    while ($fila = mysql_fetch_row($sentencia)) {
        $estilo = "";
        if ($fila[10] == "A") {
            $estilo = "class='agente'";
        } elseif ($fila[10] == "E") {
            $estilo = "class='eurorepar'";
        } elseif ($fila[10] == "M") {
            $estilo = "class='moroso'";
        }
        echo "<tr " . $estilo . ">
                <td>" . $numero++ . "</td>
                <td";
        if ($fila[10] != "E") {
            echo " class='codigo' ";
        } else {
            echo " class='codigoe' ";
        }
        echo utf8_encode("> " . strtoupper($fila[0]) . "</td>
                <td><a href='clientes.php?id=" . strtoupper($fila[9]) . "'>" . strtoupper($fila[1]) . "</a></td>
                <td>" . strtoupper($fila[2]) . "</td>
                <td>" . strtoupper($fila[3]) . "</td>
                <td>" . strtoupper($fila[4]) . "</td>
                <td><a href='editar.php?id=" . strtoupper($fila[9]) . "' target='_blank'><img src='../imagenes/editar.png' width='20px'/></a></td>");
        ?><td style="padding-left:15px;cursor:pointer"><img src="../imagenes/ruta.png" alt="ruta" id="rutacliente" width="15px" title="Incluir este cliente a una ruta" ></td><?php
        echo utf8_encode("</tr>");
    }
}
echo utf8_encode("</table>");
