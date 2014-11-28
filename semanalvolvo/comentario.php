<?php

header("Content-type: text/javascript; charset=iso-8859-1");
mysql_connect("localhost", "chechu");
mysql_select_db("pedidos");
$texto = UTF8_decode(strtoupper($_GET['salida']));
mysql_query("UPDATE semanalvolvo SET comentario = '" . $texto . "' WHERE id LIKE " . $_GET['id'] . ";");
?>

