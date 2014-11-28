<?php

include ('../estilos/conexion.php');

function saltoLinea($str) {
    return str_replace(array("\r\n", "\r", "\n"), "<br />", $str);
}

$texto = $_GET['asesor'];
mysql_query("UPDATE mailing SET asesor ='" . $texto . "',fcanjeo=NOW() WHERE id=" . $_GET['id'] . ";");
echo "UPDATE mailing SET comentario ='" . $texto . "',fcanjeo=NOW() WHERE id=" . $_GET['id'] . ";";