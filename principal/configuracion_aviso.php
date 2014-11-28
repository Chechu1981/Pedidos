<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv=Content-Type content="text/html; charset=UTF-8" />
        <link rel="shortcut icon" href="../imagenes/chechu.ico" />
        <link rel="stylesheet" type="text/css" href="../scripts/styles.css" />
        <?php include_once '../scripts/estilos.php'; ?>
        <title>Configuracion</title>
        <link rel="shortcut icon" href="../imagenes/chechu.ico" />
        <?php
        mysql_connect("localhost", "chechu");
        mysql_select_db("carrion");
        ?>
    </head>
    <body onload="cargar()">    
        <div class="contenedor">
            <?php
            if (isset($_POST['texto'])) {

                function saltoLinea($str) {
                    return str_replace(array("\r\n", "\r", "\n"), "<br />", $str);
                }

                mysql_query("UPDATE nombres SET cadena = '" . utf8_decode(saltoLinea($_POST['texto'])) . "' WHERE aplicacion = 'aviso'");
                mysql_query("UPDATE nombres SET cadena = '" . $_POST['estado'] . "' WHERE aplicacion = 'eaviso'");
            }

            function saltoLineaInverso($str) {
                return str_replace(array("<br />"), "\n", $str);
            }

            $aviso = mysql_query("SELECT * FROM nombres WHERE aplicacion = 'aviso';");
            $estado = mysql_query("SELECT * FROM nombres WHERE aplicacion = 'eaviso';");
            $texto = mysql_fetch_row($aviso);
            $sw = mysql_fetch_row($estado);
            include_once '../scripts/cabecera.php';
            include '../calendario/calcular_dia.php';
            ?>
            <div class="principal">
<?php include_once '../scripts/menu.php'; ?>
                <div class="banda">
                    <h2 style="padding:15px;">Configuración.<br/>Gestión de avisos.</h2>
                    <a style="margin-left: 500px;padding-top: 10px" href="configuracion.php" title="Volver"><img src="../imagenes/atras.png"></a>
                </div>
                <div style="clear:both"></div>
                <div style="margin: 30px 0px 0px 50px;width: 200px">
                    <form action="configuracion_aviso.php" method="post">
                        <table>
                            <tr>
                                <td>
                                    <table>
                                        <tr>
                                            <td>
                                                Activado
                                            </td>
                                            <td>
                                                <input <?php if ($sw[2] == 'si') { ?> checked <?php } ?> name="estado" type="radio" value="si" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Desactivado
                                            </td>
                                            <td>
                                                <input <?php if ($sw[2] == 'no') { ?> checked <?php } ?> name="estado" type="radio" value="no" />
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <textarea style="width: 733px;height: 144px;" name="texto" value="<?php echo utf8_encode(saltoLineaInverso($texto[2])) ?>"  ><?php echo utf8_encode(saltoLineaInverso($texto[2])) ?></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: center;font-size: 20px;">
                                    <input type="submit" value="Actualizar" />
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
