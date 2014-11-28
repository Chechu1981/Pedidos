<?php
include '../../estilos/conexion.php';
mysql_query("INSERT INTO coches (matricula,marca,modelo,kms)
    VALUES('".strtoupper($_POST['matricula'])."',
        '".strtoupper($_POST['marca'])."',
        '".strtoupper($_POST['modelo'])."',
        '".strtoupper($_POST['kms'])."')");
?>