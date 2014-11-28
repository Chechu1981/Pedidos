<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv=Content-Type content="text/html; charset=UTF-8" />
        <title>Mailing</title>
        <link rel="shortcut icon" href="../imagenes/chechu.ico" />
        <link rel="stylesheet" href="../scripts/styles.css" type="text/css" />
        <?php include_once '../scripts/estilos.php'; ?>
        <script src="script.js"></script>
    </head>
    <body>
        <div class="contenedor">
            <?php include '../calendario/calcular_dia.php'; ?>
            <header>
                <?php include_once '../scripts/cabecera.php'; ?>
            </header>
            <nav>
                <?php include_once '../scripts/menu.php'; ?>
            </nav>
            <div class="principal">
                <div class="banda">
                    <h2 style="padding:15px;" id="titulo">Histórico</h2>
                </div>
                <?php
                include '../estilos/conexion.php';
                $correos = mysql_query("SELECT * FROM mailing GROUP BY fecha ORDER BY id DESC");
                $numero = 1;
                ?>
                <div style="clear: both"></div>
                <?php while ($fila = mysql_fetch_row($correos)) { ?>
                    <a href="enviados.php?date=<?php echo $fila[4]; ?>"><h2>Correos envíados el <?php echo $fila[4]; ?></h2></a>
                <?php } ?>
            </div>
            <?php include_once '../scripts/pie.php'; ?>
        </div>
    </body>
</html>