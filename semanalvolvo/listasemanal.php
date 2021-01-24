<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd" >
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Semanal</title>
        <link rel="shortcut icon" href="../imagenes/chechu.ico" />
        <link rel="stylesheet" href="../scripts/styles.css" type="text/css" />
        <?php include_once '../scripts/estilos.php'; ?>
        <?php
        mysql_connect("localhost", "chechu");
        mysql_select_db("pedidos");
        $contador = 1;
        mysql_select_db("pedidos");
        if (isset($_POST['incluir'])) {
            ?><script>alert(<?php echo $_POST['incluir'] ?>)</script><?php
        mysql_query("INSERT INTO semanalvolvo 
                (pedido, referencia, cantidad, denominacion, comentario, cliente, estado, fecha)
                VALUES 
                ('" . $_POST['pedido'] . "',
                '" . strtoupper($_POST['ref']) . "',
                " . $_POST['can'] . ",
                '" . utf8_decode(strtoupper($_POST['des'])) . "',
                '" . utf8_decode(strtoupper($_POST['com'])) . "',
                '" . utf8_decode(strtoupper($_POST['cli'])) . "',
                1, 
                NOW())");
    }
        ?>
    </head>
    <body onload="document.getElementById('ref').focus()" >
        <div class="contenedor">
            <?php
            include_once '../scripts/cabecera.php';
            include '../calendario/calcular_dia.php';
            ?>
            <div class="principal">
                <?php include_once '../scripts/menu.php'; ?>
                <script type="text/javascript" src="ajax.js" ></script>
                <div class="banda">
                    <h2 style="padding:15px;color:#0055ff" id="titulo">Semanales anteriores Volvo</h2>
                    <div style="clear: both"></div>
                </div>
                <div style="clear: both"></div>

                <?php
                mysql_select_db("pedidos");
                $sentencia = mysql_query("SELECT * FROM listasemanalvolvo ORDER BY numero DESC;");
                ?>
                <hr/>
                <div>
                    <table border='2' width='780px;' class='semanalvolvo'>
                        <tr><th>Linea</th><th>Pedido</th><th>Fecha</th></tr>
                        <?php 
                        while ($fila = mysql_fetch_row($sentencia)) { 
                            $nlineas = mysql_query("SELECT COUNT(id),pedido FROM semanalvolvo WHERE pedido = ".$fila[0]." GROUP BY pedido;");
                            $cantidad = mysql_fetch_row($nlineas);
                            ?>
                            <tr>
                                <td style="text-align:center;"><?php echo $cantidad[0]; ?></td>
                                <td style="text-align:center;">Pedido <?php echo utf8_encode($fila[0]) ?></td>
                                <td style='text-align:center;'> <?php
                        if (utf8_encode($fila[1]) == 'En curso') {
                            ?> <a href="semanal.php?encurso=SI" style="color:green" ><?php echo utf8_encode($fila[1]); ?></a> <?php
                            } else {
                                ?> <a href="semanal.php?pedido=<?php echo utf8_encode($fila[0]); ?>" style="color:green" ><?php echo utf8_encode($fila[1]); ?> </a> <?php
                            }
                            ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
                <?php include_once '../scripts/pie.php'; ?>
            </div>
        </div>
    </body>
</html>