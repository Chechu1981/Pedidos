<?php

include ('../estilos/conexion.php');

function saltoLinea($str) {
    return str_replace(array("\r\n", "\r", "\n"), " <br />", $str);
}

$texto = $_GET['pedido'];
$mysqli->query("UPDATE o_proveedores SET pedido ='" . strtoupper(saltoLinea($texto)) . "' WHERE indice=" . $_GET['id'] . ";");