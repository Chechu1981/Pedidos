<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;" charset="ISO-8859-1"></meta>
        <title><?php echo "Pedido del " . $_GET['dia'] . " de " . $_GET['mes'] . " de " . $_GET['ano']; ?></title>
        <link rel="shortcut icon" href="../imagenes/chechu.ico" />
        <link rel="stylesheet" type="text/css" href="../estilos/style.css" />
        <link type="text/css" href="../scripts/jquery-ui-1.8.21.custom/css/redmond/jquery-ui-1.8.24.custom.css" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="css/jquery.jdigiclock.css" />
        <script type="text/javascript" src="lib/jquery-1.3.2.min.js"></script>
        <script type="text/javascript" src="lib/jquery.jdigiclock.js"></script>
        <script src="../scripts/jquery-ui-1.8.21.custom/js/jquery-1.7.2.min.js"></script>
        <script src="../scripts/jquery-ui-1.8.21.custom/js/jquery-ui-1.8.21.custom.min.js"></script>
        <script>
            function imprRuta() {
                var ficha = document.getElementById('ruta');
                var ventimp = window.open('', 'imprimir');
                ventimp.document.write('<style>table, td, th{border:1px solid black;} </style><h2><?php echo "Ruta del " . $_GET['dia'] . " de " . $_GET['mes'] . " de " . $_GET['ano']; ?></h2>');
                ventimp.document.write(ficha.innerHTML);
                ventimp.document.close();
                ventimp.print();
                ventimp.close();
            }
            
            function cargarVP() {
                $("#carga").html("<h2>Insertando VP a la ruta de hoy... <img src='../imagenes/spinner.gif' title='spinner' /></h2>");
                $.ajax({
                    url: "../reparto/vp.php?dia=<?php echo $_GET['dia']; ?>&mes=<?php echo $_GET['mes']; ?>&ano=<?php echo $_GET['ano']; ?>"
                });
                setTimeout('this.window.close()', 2500);
            }

        </script>
        <?php
        include '../calendario/calcular_dia.php';
        include '../estilos/conexion.php';
        $senruta = mysql_query("SELECT CODIGO,NOMBRE,POBLACION,RUTA FROM CARRION.HOJA1 WHERE RUTA = 1 AND CODIGO IN (SELECT DISTINCT SUBSTR(cliente,-7,6) AS CODIGO FROM PEDIDOS.LINEAS WHERE fecha_pedido LIKE '" . $_GET['dia'] . $_GET['mes'] . $_GET['ano'] . "' AND destino LIKE 'M') OR RUTA = 1 AND CODIGO IN  (SELECT DISTINCT SUBSTR(cliente,-7,6) AS CODIGO FROM PEDIDOS.LINEASVOLVO WHERE fecha_pedido LIKE '" . $_GET['dia'] . $_GET['mes'] . $_GET['ano'] . "' AND destino LIKE 'M')");
        ?>
    </head>
    <body>
        <div id="ruta" title="Ruta" >
            <table style="font-size:20px">
                <tr>
                    <th></th>
                    <th>Taller</th>
                    <th>Poblacion</th>
                </tr> 
                <?php
                $numeros = 1;
                while ($filruta = mysql_fetch_row($senruta)) {
                    ?>                   
                    <tr>
                        <td><?php echo $numeros++; ?></td>
                        <td><?php echo strtoupper(utf8_encode($filruta[1]." (".$filruta[0].")")); ?></td>
                        <td><?php echo strtoupper(utf8_encode($filruta[2])); ?></td>
                    </tr>
                <?php } ?>
            </table>
            <?php
            $tiempo = $numeros * 9.5;
            $horas = (int) ($tiempo / 60);
            $minutos = (int) ($tiempo - ($horas * 60));
            if ($minutos < 10) {
                $minutos = "0" . $minutos;
            }
            echo "<h3>Tiempo estimado: " . $horas . ":" . $minutos . "</h3>";
            ?>
            <button onclick="cargarVP()">Cargar a la ruta</button><br/><br/><br/>
            <span class="enlace" onclick="imprRuta()">Imprimir</span><br/>
        </div>
        <div id="carga"></div>
    </body>
</html>