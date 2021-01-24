<?php

include ('../estilos/conexion.php');

function saltoLinea($str) {
    return str_replace(array("\r\n", "\r", "\n"), " <br />", $str);
}

$texto = $_GET['com'];
$mysqli->query("UPDATE o_proveedores SET comentario ='" . strtoupper(saltoLinea($texto)) . "' WHERE indice=" . $_GET['id'] . ";");
echo "UPDATE o_proveedores SET comentario ='" . strtoupper(saltoLinea($texto)) . "' WHERE indice=" . $_GET['id'] . ";";
?>