<?php

mysql_connect("localhost", "chechu");
mysql_select_db("pedidos");
mysql_query("INSERT INTO semanalvolvo 
    (pedido, referencia, cantidad, denominacion, comentario, cliente, estado, fecha) 
    VALUES ('1','" . strtoupper($_GET['ref']) . "'," . $_GET['can'] . ",'" . strtoupper($_GET['des']) . "','" . strtoupper($_GET['com']) . "','" . strtoupper($_GET['cli']) . "',1, NOW())");
?>