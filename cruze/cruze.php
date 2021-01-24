<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv=Content-Type content="text/html; charset=UTF-8" />
        <title>Referencias cruzadas</title>
        <?php include_once '../scripts/estilos.php'; ?>
        <link rel="shortcut icon" href="../imagenes/chechu.ico" />
        <link rel="stylesheet" href="../scripts/styles.css" type="text/css" />
        <?php include '../calendario/calcular_dia.php'; ?>
        <script>
            function prueba(){
                //var ret=interroStockDpr('1357811901750', '00007410P0', '010036R');
                //alert(ret);
            }
            function objetoAjax(){
                var xmlhttp=false;
                try {
                    xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
                } catch (e) {
                    try {
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                    } catch (E) {
                        xmlhttp = false;
                    }
                }
                if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
                    xmlhttp = new XMLHttpRequest();
                }
                return xmlhttp;
            }
            var mail=objetoAjax();

            var ajax=objetoAjax();
        </script>
    </head>
    <body onload="prueba()">
        <div id="pb"></div>
        <div class="contenedor">
            <header>
            <?php include_once '../scripts/cabecera.php'; ?>
                </header>
            <nav>
            <div class="principal">
                <?php include_once '../scripts/menu.php'; ?>
            </div>
                </nav>
            <div style="clear: both"></div>
            <div class="banda">
                <h2 style="padding:15px;">Referencias cruzadas</h2>
                </a>
            </div>
            <div class="cabecera">
                <form method="POST" name="cruzes" action="cruze.php"  >
                    <input type="hidden" name="oculto" value="<?php echo $_POST['repere'] ?>"/>
                    <input type="hidden" name="oculto" value="<?php echo $_POST['referencia'] ?>"/>
                    <table>
                        <tr class="buscar">
                            <td>Referencia</td><td> <input type="text" name="referencia" /></td>
                        </tr>
                        <tr class="buscar"><td>Repere</td><td><input type="text" name="repere" /></td>
                        </tr>
                        <tr class="buscar"><td><input TYPE="submit" value="Buscar" name="buscar"/></td><td></td></tr>
                    </table>
                </form>
            </div>
            <?php
            include("../estilos/conexion.php");
            if (isset($_POST['repere']) and $_POST['repere'] != '') {
                $sentencia = $mysqli->query("SELECT * FROM cruze WHERE repere LIKE '" . $_POST['repere'] . "';");
                if ($sentencia->num_rows() > 0) {
                    if ($_POST['repere'] != "") {
                        while ($fila = $sentencia->fetch_row()) {
                            echo "<div class='opaco'><span style='float:left;'>Repere: " . $_POST['repere'] . "</span><h1 style='z-index:1'> Referencia: <b>" . $fila[1] . "</b></h1></div>";
                        }
                    }
                } else {
                    echo "<div class='opaco'><h1>El repere " . $_POST['repere'] . " es desconocido</h1></div>";
                }
            } elseif (isset($_POST['referencia']) and $_POST['referencia'] != '') {
                $sentencia = $mysqli->query("SELECT * FROM cruze WHERE referencia LIKE '" . $_POST['referencia'] . "%';");
                if ($sentencia->num_rows > 0) {
                    if ($_POST['referencia'] != "") {
                        ?><span style='font-size: 30px;color: brown;'>Referencia: " <?php echo $_POST['referencia'] ?>"</span><?php
                        while ($fila = $sentencia->fetch_row()) {
                            echo "<div class='opaco'><h1 style='z-index:1'> Repere: <b>" . $fila[0] . "</b></h1><h2>Referencia: " . $fila[1] . "</h2></div>";
                        }
                    }
                } else {
                    echo "<div class='opaco'><h1>La referencia " . $_POST['referencia'] . " es desconocida</h1></div>";
                }
            }
            include_once '../scripts/pie.php';
            ?>
        </div>
    </body>
</html>