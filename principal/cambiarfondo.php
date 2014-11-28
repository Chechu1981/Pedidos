<?php

include ('../estilos/conexion.php');
$color = $_GET['color'];
$equipos = mysql_query("SELECT * FROM nombres WHERE aplicacion = '" . $_SERVER['REMOTE_ADDR'] . "';");
$puesto = mysql_fetch_row($equipos);
if ($puesto[0] == "") {
    mysql_query("INSERT INTO nombres (cadena,aplicacion) VALUES ('" . $color . "','" . $_SERVER['REMOTE_ADDR'] . "')");
} else {
    mysql_query("UPDATE nombres SET cadena = '" . $color . "' WHERE aplicacion = '" . $_SERVER['REMOTE_ADDR'] . "';");
}
?>
