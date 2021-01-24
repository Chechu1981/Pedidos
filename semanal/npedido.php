<?php
include_once '../estilos/conexion.php';
$psen = $mysqli->query("SELECT numero FROM listasemanal ORDER BY numero DESC;");
$pedido = $psen->fetch_row();
$mysqli->query("UPDATE listasemanal SET fecha = '".$_GET['fecha']."' WHERE numero LIKE ".$pedido[0].";");
$mysqli->query("INSERT INTO listasemanal (numero, fecha) VALUES (".($pedido[0]+1).",'En curso');");
?>