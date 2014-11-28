<?php
mysql_connect("localhost", "chechu");
mysql_select_db("pedidos");
$psen = mysql_query("SELECT numero FROM listasemanal ORDER BY numero DESC;");
$pedido = mysql_fetch_row($psen);
mysql_query("UPDATE listasemanal SET fecha = '".$_GET['fecha']."' WHERE numero LIKE ".$pedido[0].";");
mysql_query("INSERT INTO listasemanal (numero, fecha) VALUES (".($pedido[0]+1).",'En curso');");
?>