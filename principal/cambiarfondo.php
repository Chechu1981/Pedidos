<?php

include ('../estilos/conexion.php');
$color = $_GET['color'];
$equipos = $mysqli->query("SELECT * FROM nombres WHERE aplicacion = '" . $_SERVER['REMOTE_ADDR'] . "';");
$puesto = $equipos->fetch_row();
if ($puesto[0] == "") {
    $mysqli->query("INSERT INTO nombres (cadena,aplicacion) VALUES ('" . $color . "','" . $_SERVER['REMOTE_ADDR'] . "')");
} else {
    $mysqli->query("UPDATE nombres SET cadena = '" . $color . "' WHERE aplicacion = '" . $_SERVER['REMOTE_ADDR'] . "';");
}
?>
