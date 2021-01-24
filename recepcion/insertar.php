<?php
include '../estilos/conexion.php';
mysql_query("INSERT INTO recepcion (orden,matricula,f_entrada,f_peritacion,compromiso,pte_pr,f_entrega,cortesia,c_calidad,observaciones,entregado)
    VALUES('".strtoupper($_POST['orden'])."',
        '".strtoupper($_POST['matricula'])."',
        '".strtoupper($_POST['fentrada'])."',
        '".strtoupper($_POST['fperitacion'])."',
        '".strtoupper($_POST['compromiso'])."',
        '".strtoupper($_POST['pr'])."',
        '".strtoupper($_POST['fentrega'])."',
        '".strtoupper($_POST['cortesia'])."',
        '".strtoupper($_POST['calidad'])."',
        '".strtoupper($_POST['observaciones'])."','NO')");
?>