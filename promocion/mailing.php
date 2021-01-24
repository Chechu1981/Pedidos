<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv=Content-Type content="text/html; charset=UTF-8" />
        <title>Mailing</title>
        <link rel="shortcut icon" href="../imagenes/chechu.ico" />
        <link rel="stylesheet" href="../scripts/styles.css" type="text/css" />
        <?php include_once '../scripts/estilos.php'; ?>
        <script src="script.js"></script>
        <style>
            .muestra{
                background-image: url(http://www.empresacarrion.com/bg_red_line.gif);
                background-repeat: repeat-y;
                font-family:Arial;
                background-color: #eee;
            }

            .muestra div{
                margin: auto;
                padding: 8px;
            }
        </style>
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
                    <h2 style="padding:15px;" id="titulo">Muestra. Mailing</h2>
                </div>
                <div style="margin-top:80px;"></div>
                <div class="muestra">
                    <div>
                        Estimado/a  <i>"cliente"</i>:<br/><br/>
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
                                    <tr><td>
                                        &nbsp;&nbsp;<a href="http://www.youtube.com/user/CitroenEspana"><img src="http://www.firmasdecorreo.com/media/img-firmas/youtube.png" width="24" height="24" alt="YouTube" border="0" /></a>&nbsp;&nbsp;&nbsp;</td>
                        </tr></td>
                                </table></tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </div>
<?php include_once '../scripts/pie.php'; ?>
            </div>
        </div>
    </body>
</html>