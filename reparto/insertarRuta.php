<?php

header("Content-type: text/javascript; charset=iso-8859-1");
mysql_connect("localhost", "chechu");
mysql_select_db("carrion");
$ordenante = utf8_encode($_GET['ordenante']);
$cod = '';
$destino = '';
$clientes;
$cliente;
if (isset($_GET['clien'])) {
    $cod = substr($_GET['clien'], -7, -1);
    $destino = $_GET['clien'];
    $clientes = mysql_query("SELECT DISTINCT * FROM hoja1 WHERE codigo LIKE '%" . $cod . "%';");
    $cliente = mysql_fetch_array($clientes);
} else {
    $cod = @$_GET['cod'];
    $clientes = mysql_query("SELECT DISTINCT * FROM hoja1 WHERE codigo LIKE '%" . $cod . "%';");
    $cliente = mysql_fetch_array($clientes);
    $destino = $cliente[1]." (".$cod.")";
}
$prio = $_GET['prio'];
$comentario = utf8_encode($_GET['comentario']);

if (isset($_GET['ruta']) AND @$_GET['ruta'] == 'ruta') {
    mysql_query("INSERT INTO ruta (id,ordenante,fechaPedido,cliente,direccion,comentario,prioridad,entregado)VALUES('','" . utf8_decode($ordenante) . "',NOW(),'" . $destino ."','" . $cliente[6] . "','" . utf8_decode($comentario) . "','" . $prio . "','EN CURSO')");
    echo "SELECT DISTINCT * FROM hoja1 WHERE codigo LIKE '%" . $cod . "%';<BR/>INSERT INTO ruta (id,ordenante,fechaPedido,cliente,direccion,comentario,prioridad,entregado)VALUES('','" . utf8_decode($ordenante) . "',NOW(),'" . $destino . " (" . $cliente[0] . ")','" . $cliente[6] . "','" . utf8_decode($comentario) . "','" . $prio . "','EN CURSO')";
} else {
    mysql_query("INSERT INTO ruta (id,ordenante,fechaPedido,cliente,direccion,comentario,prioridad,entregado)VALUES('','" . utf8_decode($ordenante) . "',NOW(),'" . $destino . "','" . $cliente[6] . "','" . utf8_decode($comentario) . "','" . $prio . "','NO')");
    echo "SELECT DISTINCT * FROM hoja1 WHERE codigo LIKE '%" . $cod . "%';<BR/>INSERT INTO ruta (id,ordenante,fechaPedido,cliente,direccion,comentario,prioridad,entregado)VALUES('','" . utf8_decode($ordenante) . "',NOW(),'" . $destino . " (" . $cliente[0] . ")','" . $cliente[6] . "','" . utf8_decode($comentario) . "','" . $prio . "','NO')";
}
