<?php

include '../calendario/calcular_dia.php';
include '../estilos/conexion.php';
$senruta = mysql_query("SELECT CODIGO,NOMBRE,POBLACION,RUTA FROM CARRION.HOJA1 WHERE RUTA = 1 AND CODIGO IN (SELECT DISTINCT SUBSTR(cliente,-7,6) AS CODIGO FROM PEDIDOS.LINEAS WHERE fecha_pedido LIKE '" . $_GET['dia'] . $_GET['mes'] . $_GET['ano'] . "' AND destino LIKE 'M') OR RUTA = 1 AND CODIGO IN  (SELECT DISTINCT SUBSTR(cliente,-7,6) AS CODIGO FROM PEDIDOS.LINEASVOLVO WHERE fecha_pedido LIKE '" . $_GET['dia'] . $_GET['mes'] . $_GET['ano'] . "' AND destino LIKE 'M')");

while ($lineasR = mysql_fetch_row($senruta)) {
    mysql_query("INSERT INTO carrion.ruta (cliente,ordenante,fechaPedido,direccion,prioridad,entregado)VALUES('" . $lineasR[1] . "(" . $lineasR[0] . ")','AUTOMATICO',NOW(),'" . $lineasR[2] . "','NORMAL','NO')");
}