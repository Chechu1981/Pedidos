<?php
mysql_connect("localhost", "chechu");
mysql_select_db("pedidos");
$psen = mysql_query("SELECT numero FROM listasemanalvolvo ORDER BY numero DESC;");
$pedido = mysql_fetch_row($psen);
mysql_query("UPDATE listasemanalvolvo SET fecha = '".$_GET['fecha']."' WHERE numero LIKE ".$pedido[0].";");
mysql_query("INSERT INTO listasemanalvolvo (numero, fecha) VALUES (".($pedido[0]+1).",'En curso');");
?>