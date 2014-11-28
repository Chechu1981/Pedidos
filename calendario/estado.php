<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
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
            function estado() {
                var ficha = document.getElementById('ruta');
                var ventimp = window.open('', 'imprimir');
                ventimp.document.write('<style>table, td, th{border:1px solid black;} </style><h2><?php echo "Ruta del " . $_GET['dia'] . " de " . $_GET['mes'] . " de " . $_GET['ano']; ?></h2>');
                ventimp.document.write(ficha.innerHTML);
                ventimp.document.close();
                ventimp.print();
                ventimp.close();
            }
        </script>
        <?php
        include '../calendario/calcular_dia.php';
        include '../estilos/conexion.php';
        mysql_select_db("pedidos");
        $lineasTaller = mysql_query("SELECT * FROM lineas WHERE fecha_pedido LIKE '" . $_GET['dia'] . $_GET['mes'] . $_GET['ano'] . "' AND destino LIKE 'T' ORDER BY pedido,destino,cliente,referencia;");
        $lineasMostrador = mysql_query("SELECT * FROM lineas WHERE fecha_pedido LIKE '" . $_GET['dia'] . $_GET['mes'] . $_GET['ano'] . "' AND destino LIKE 'M' ORDER BY pedido,destino,cliente,referencia;");
        $alldia = mysql_query("SELECT * FROM lineas WHERE fecha_pedido LIKE '" . $_GET['dia'] . $_GET['mes'] . $_GET['ano'] . "' ORDER BY pedido,destino,cliente,referencia;");
        $allmes = mysql_query("SELECT * FROM lineas WHERE  fecha_pedido LIKE '%" . $_GET['mes'] . $_GET['ano'] . "%' ORDER BY pedido,destino,cliente,referencia;");
        $todas = mysql_query("SELECT * FROM lineas;");
        $credito = mysql_query("SELECT * FROM lineas WHERE fecha_pedido LIKE '%" . $_GET['mes'] . $_GET['ano'] . "%' AND salida LIKE 'CREDITO' AND destino = 'M'");
        $contado = mysql_query("SELECT * FROM lineas WHERE fecha_pedido LIKE '%" . $_GET['mes'] . $_GET['ano'] . "%' AND salida LIKE 'CONTADO' AND destino = 'M'");
        $taller = mysql_query("SELECT * FROM lineas WHERE fecha_pedido LIKE '%" . $_GET['mes'] . $_GET['ano'] . "%' AND destino = 'T'");
        $soc = mysql_query("SELECT * FROM lineas WHERE fecha_pedido LIKE '%" . $_GET['mes'] . $_GET['ano'] . "%' AND salida LIKE 'SOC' AND destino = 'M'");
        $acumulado = mysql_query("SELECT ROUND(SUM((pvp*((100-dto)/100))*cantidad),2) FROM denominacion_precio,lineas WHERE denominacion_precio.referencia = lineas.referencia AND fecha_pedido LIKE '" . $_GET['dia'] . $_GET['mes'] . $_GET['ano'] . "';");
        $maxlineas = mysql_query("SELECT COUNT( REFERENCIA ) , FECHA_PEDIDO FROM LINEAS GROUP BY FECHA_PEDIDO ORDER BY COUNT( REFERENCIA )DESC LIMIT 0 , 1");
        ?>
    </head>
    <body>
        <?php
        
        if (isset($alldia)) {
            ?>
            <div id="estadisticas">
                <fieldset>
                    <legend><b><?php echo "Pedido del " . $_GET['dia'] . " de " . $_GET['mes'] . " de " . $_GET['ano']; ?></b></legend>
                    <div class="estadistica">MOSTRADOR <?php echo mysql_num_rows($lineasMostrador); ?> </div>
                    <div class="estadistica">TALLER <?php echo mysql_num_rows($lineasTaller); ?> </div>
                    <div class="estadistica">TOTAL <?php echo mysql_num_rows($alldia); ?> </div>
                </fieldset>
                <fieldset><legend><b><?php echo strtoupper($_GET['mes']) . " " . mysql_num_rows($allmes); ?></b> </legend>
                    <div class="estadistica">CREDITO: <?php echo mysql_num_rows($credito); ?></div>
                    <div class="estadistica">CONTADO: <?php echo mysql_num_rows($contado); ?></div>
                    <div class="estadistica">SOC: <?php echo mysql_num_rows($soc); ?></div>
                    <div class="estadistica">TALLER: <?php echo mysql_num_rows($taller); ?></div>
                </fieldset>
                <fieldset>
                    <legend><b>Lineas</b></legend>
                    <?php $max = mysql_fetch_row($maxlineas); ?>
                    <div class="estadistica">Record de lineas: <?php echo $max[1] . ' con ' . $max[0]; ?></div>
                    <div class="estadistica">Lineas totales <?php echo mysql_num_rows($todas); ?></div>
                </fieldset>
            </div>
        <?php } ?>
            <span class="enlace" onclick="estado()">Imprimir</span>
        </div>
    </body>
</html>