<?php
include_once '../estilos/conexion.php   ';
$psen = $mysqli->query("SELECT numero FROM listasemanalvolvo ORDER BY numero DESC;");
$pedido = $psen->fetch_row();
$mysqli->query("UPDATE listasemanalvolvo SET fecha = '".$_GET['fecha']."' WHERE numero LIKE ".$pedido[0].";");
$mysqli->query("INSERT INTO listasemanalvolvo (numero, fecha) VALUES (".($pedido[0]+1).",'En curso');");
?>