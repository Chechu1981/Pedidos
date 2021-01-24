<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Gestor de pedidos de Empresa Carrión</title>
        <link href="../css/style.css" rel="stylesheet" />
        <script src="../jquery-ui-1.10.4.custom/js/jquery-1.10.2.js" type="text/javascript" ></script>
        <script src="../jquery-ui-1.10.4.custom/js/jquery-ui-1.10.4.custom.js" type="text/javascript" ></script>
        <script src="../jquery-ui-1.10.4.custom/js/jquery-ui-1.10.4.custom.min.js" type="text/javascript" ></script>
        <link rel="stylesheet" href="../jquery-ui-1.10.4.custom/css/cupertino/jquery-ui-1.10.4.custom.css" />
        <?php
            session_start();
        ?>
    </head>
    <body>
        <?php
        include_once '../calcular_dia.php';
        if (session_id() === @$_GET['id']) {
            ?>
            <div id="contenedor">
                <?php include '../helper/cabecera.php'; ?>
                <div id="menu"><?php include_once '../helper/menu.php'; ?></div>
                <div id="tabla"><?php include_once '../buscar/tablabuscar.php'; ?></div>
                <div id="pie"><?php include_once '../helper/pie.php'; ?></div>
            </div>
        <?php
        } else {
            echo "<a href='../pedidosclientes.php' >Debe iniciar sesion</a>";
        }
        ?>
    </body>
</html>
