<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv=Content-Type content="text/html; charset=UTF-8" />
        <link rel="shortcut icon" href="../imagenes/chechu.ico" />
        <link rel="stylesheet" type="text/css" href="../scripts/styles.css" />
        <?php include_once '../scripts/estilos.php'; ?>
        <title>Fiestas</title>
        <link rel="shortcut icon" href="../imagenes/chechu.ico" />
        <?php

        function vermes($numero) {
            switch ($numero) {
                case 1:
                    echo "Enero";
                    break;
                case 2:
                    echo "Febrero";
                    break;
                case 3:
                    echo "Marzo";
                    break;
                case 4:
                    echo "Abril";
                    break;
                case 5:
                    echo "Mayo";
                    break;
                case 6:
                    echo "Junio";
                    break;
                case 7:
                    echo "Julio";
                    break;
                case 8:
                    echo "Agosto";
                    break;
                case 9:
                    echo "Septiembre";
                    break;
                case 10:
                    echo "Octubre";
                    break;
                case 11:
                    echo "Noviembre";
                    break;
                case 12:
                    echo "Diciembre";
                    break;
            }
        }

        include_once '../estilos/conexion.php';
        if (isset($_POST['mes'])) {
            $mysqli->query("INSERT INTO fiestas (dia,mes,nombre)VALUES('" . $_POST['dia'] . "','" . $_POST['mes'] . "','" . utf8_decode($_POST['nombre']) . "')");
        }
        $fechas = $mysqli->query("SELECT * FROM fiestas ORDER BY mes, dia ASC");
        ?>
        <script type="text/javascript">
            function objetoAjax() {
                var xmlhttp = false;
                try {
                    xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
                } catch (e) {
                    try {
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                    } catch (E) {
                        xmlhttp = false;
                    }
                }
                if (!xmlhttp && typeof XMLHttpRequest != 'undefined') {
                    xmlhttp = new XMLHttpRequest();
                }
                return xmlhttp;
            }
            
            var eliminar = new objetoAjax();
            
            function borrarFiesta(id) {
                var env = confirm("¿Eliminar esta fiesta?");
                if (env) {
                    eliminar.open("GET", "quitarfiesta.php?id=" + id, true);
                    eliminar.send(null);
                    document.location.href = "fiestas.php";
                }
            }
        </script>
    </head>
    <body>    
        <div class="contenedor">
            <?php
            include_once '../scripts/cabecera.php';
            include '../calendario/calcular_dia.php';
            ?>
            <div class="principal">
                <?php include_once '../scripts/menu.php'; ?>
                <div class="banda">
                    <h2 style="padding:15px;">Configuración.<br/>Fiestas.</h2>
                    <a style="margin-left: 500px;padding-top: 10px" href="configuracion.php" title="Volver"><img src="../imagenes/atras.png"></a>
                </div>
                <div style="clear:both"></div>
                <form action="#" method="post">
                    <table>
                        <tr>
                            <td>Día: </td>
                            <td><input name="dia"></input></td>
                            <td rowspan="4" style="width:50px;"></td>
                            <td rowspan="4" >
                                <div id="actuales">
                                    <table>
                                        <?php
                                        while ($campo = $fechas->fetch_row()) {
                                            ?>
                                            <tr>
                                                <td><?php echo utf8_encode($campo[1]) . " de "; ?></td>
                                                <td><?php echo utf8_encode(vermes($campo[2])) ?></td>
                                                <td><b><?php echo "(" . utf8_encode($campo[3]) . ")"; ?></b></td>
                                                <td><img src="../imagenes/eliminar.png" style="cursor:pointer" onclick="borrarFiesta('<?php echo $campo[0] ?>')" /></td>
                                            </tr>
                                        <?php } ?>
                                    </table>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Mes: </td>
                            <td>
                                <select name="mes">
                                    <option value="00">--- Elige un mes ---</option>
                                    <option value="01">Enero</option>
                                    <option value="02">Febrero</option>
                                    <option value="03">Marzo</option>
                                    <option value="04">Abril</option>
                                    <option value="05">Mayo</option>
                                    <option value="06">Junio</option>
                                    <option value="07">Julio</option>
                                    <option value="08">Agosto</option>
                                    <option value="09">Septiembre</option>
                                    <option value="10">Octubre</option>
                                    <option value="11">Noviembre</option>
                                    <option value="12">Diciembre</option>
                                </select>
                            </td>  
                        </tr>
                        <tr>
                            <td>Nombre de la fiesta: </td>
                            <td><input type="text" name="nombre"></input></td>
                        </tr>
                        <tr>
                            <td colspan="3"><input type="submit" value="Incluir" ></input></td>
                        </tr>
                    </table>
                </form>
            </div>
            <?php include_once '../scripts/pie.php'; ?>
        </div>
    </body>
</html>