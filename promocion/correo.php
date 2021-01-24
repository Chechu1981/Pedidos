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
                    <h2 style="padding:15px;" id="titulo">Mailing. Colectivo</h2>
                </div>
                <?php
                include '../estilos/conexion.php';

                $nombre = "";

                $fichero = $_FILES['archivo'];
                @rename($fichero, "archivo.csv");
                $destino = "C:\\xampp\htdocs\clientes\promocion\archivo.csv";
                unlink(getcwd() . "\archivo.csv");
                if ($_FILES['archivo']['type'] == "application/vnd.ms-excel") {
                    copy($fichero['tmp_name'], $destino);
                    ?><h3 class="lineas" style="width: 350px">Correos enviados con éxito.</h3><?php
                    mysql_connect("localhost", "chechu");
                    mysql_select_db("carrion");
                } else {
                    ?><div class="banda" style="margin-top: 80px;"><h3>Error. <br/>La extensión del archivo debe de ser "CSV" </h3></div><?php
                }
                echo "Nombre: " . $fichero['name'];
                ?>
                <br/>
                <?php echo "Tipo: " . $_FILES['archivo']['type']; ?>
                <br/>
                <?php echo "Tamaño: " . $_FILES['archivo']['size']; ?>
                <br/><br/><br/>
                <?php
                $fila = 0;
                if (($gestor = fopen("archivo.csv", "r")) !== FALSE) {
                    while (($datos = fgetcsv($gestor, 1000, "/")) !== FALSE) {
                        $fila++;
                        $campos = explode(";", $datos[0]);
                        $mensaje = '
<html>
    <head>
        <title>Cheque regalo</title>
        <style>
            body{
                background-image: url("http://www.empresacarrion.com/bg_red_line.gif");
                background-repeat: repeat-y;
                font-family:Arial;
                background-color: #eee;
            }

            div{
                margin: auto;
                padding: 8px;
            }
        </style>
    </head>
    <body>
        <div>

            Estimado/a  ' . $campos[1] . ':<br/><br/>
            En nombre del Equipo de Taller de Empresa Carrión SA, queríamos agradecerle de antemano su colaboración al contestar la encuesta de calidad recibida hace unos días en su correo electrónico.<p/>
            Tal y como nos habíamos comprometido con usted, le enviamos el <b>CUPÓN REGALO</b> para un <b><i>LAVADO EXTERIOR DE VEHÍCULO</i></b>, realizable de lunes a viernes, (en horario ininterrumpido de las 9.00h a 19.00h.) válido hasta final de 2014. No es necesario que realice ninguna reparación a su vehículo para utilizar el CUPÓN REGALO, podrá utilizarlo cuando usted quiera en el horario antes indicado.
            Deseamos que su grado de <b>Satisfación global</b> en sus próximas visitas a nuestro Taller siga siendo calificado de <b>10</b>.<p/>
            Gracias por confiar en nosotros.
        </div>
        <div>
            <img alt="cupon" src="http://www.empresacarrion.com/cupon.jpg" />
        </div><p/>
        <table width="100%" border="0" cellspacing="10" cellpadding="0" style="border-top-width:3px; border-top-style:solid; border-top-color:#a2c3e3;">
            <tr>
                <td>&nbsp;</td>  <td></td>
            </tr>
            <tr>
                <td width="200" align="right" valign="top"><img src="http://www.empresacarrion.com/logo_citroen.jpg" alt="Logo" hspace="5" /></td>  <td align="left" valign="top" style="padding:10px;">
                    <p><font face="Trebuchet MS, Arial, Helvetica, sans-serif" color="#05233d" style="font-size:18px;">Marisa González </font><br />    <font face="Trebuchet MS, Arial, Helvetica, sans-serif" color="#90a7b5" ><em  style="font-size:12px;">Responsable de atención al cliente</em></font><br />    <font face="Trebuchet MS, Arial, Helvetica, sans-serif" style="font-size:12px"><strong><font color="#1b4260">983.228.041</font></strong> &#8231;  <a href="mailto:marisa@empresacarrion.com">marisa@empresacarrion.com</a> </font><br />   </p>
                    <p><font face="Trebuchet MS, Arial, Helvetica, sans-serif" color="#05233d"  style="font-size:14px;">Empresa Carrión</font><br />    <font face="Trebuchet MS, Arial, Helvetica, sans-serif" color="#416886"  style="font-size:12px;">Calle del Nitr&oacute;geno, 37 &#8231; 47012 Valladolid</font><br /><font face="Trebuchet MS, Arial, Helvetica, sans-serif" color="#416886" size="-1">Tlf: <strong><font color="#1b4260">983.228.035</font></strong> &#8231; Fax: <strong><font color="#1b4260">983.470.569</font></strong></font><br />    <font face="Trebuchet MS, Arial, Helvetica, sans-serif" color="#1b4260" size="-1"><a href="http://www.empresacarrion.com">www.empresacarrion.com</a></font></p>
                    <table border="0" cellspacing="0" cellpadding="15" style="margin-top:10px;">
                        <tr>
                            &nbsp;&nbsp;<a href="http://www.youtube.com/user/CitroenEspana"><img src="http://www.firmasdecorreo.com/media/img-firmas/youtube.png" width="24" height="24" alt="YouTube" border="0" /></a>&nbsp;&nbsp;&nbsp;</td>
            </tr>
        </table>
    </td>
</tr>
</table>
</body>
</html>
';


                        $cabeceras = 'MIME-Version: 1.0' . "\n";
                        $cabeceras .= 'Content-type: text/html; charset=UTF-8' . "\n";
                        $cabeceras .= "From: Empresa Carrión <taller@empresacarrion.com>\n";

// __-- DESTINATARIOS --__

                        $destinatarios = "";
                        /* $destinatarios = "juan@empresacarrion.com";
                          $destinatarios = $destinatarios . ",recepcion@empresacarrion.com";
                          $destinatarios = $destinatarios . ",recepcion1@empresacarrion.com";
                          $destinatarios = $destinatarios . ",adolfo.lopez@empresacarrion.com";
                          $destinatarios = $destinatarios . ",raul@empresacarrion.com";
                          $destinatarios = $destinatarios . ",lolo@empresacarrion.com,";
                          $destinatarios = $destinatarios . ",marisa@empresacarrion.com";
                          $destinatarios = $destinatarios . ",postventa@empresacarrion.com";
                          $destinatarios = $destinatarios . ",f.barrientos@empresacarrion.com"; */

                        $fecha = getdate(time());
                        $fe = $fecha['mday'];
                        $enviado = mail($campos[2], utf8_decode("Cupón regalo. Empresa Carrión SA"), $mensaje, $cabeceras);
                        if($enviado){
                            echo $fila." - ".@$campos[2] . "<br/>";
                            mysql_query("INSERT  INTO mailing (matricula,nombre,correo,fecha)VALUES('" . $campos[0] . "','" . utf8_decode($campos[1]) . "','" . $campos[2] . "','". date('d/m/Y')."')");
                        }else{
                            echo "Error en el envío a ".@$campos[2];
                        }
                    }
                    fclose($gestor);
                }
                ?>
                <h3><?php echo $fila; ?> correos enviados.</h3>
            </div>
        </div>
    </body>
</html>