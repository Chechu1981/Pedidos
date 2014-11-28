<?php

header('Content-type: text/html; charset=iso-8859-1');
mysql_connect("localhost", "chechu");
mysql_select_db("pedidos");
$comenta = $_GET['com'];
$id = $_GET['id'];
mysql_query("UPDATE lineas SET matricula='" . utf8_encode(strtoupper($comenta)) . "' WHERE id=" . $id . ";");
?>