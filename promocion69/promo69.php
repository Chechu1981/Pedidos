<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv=Content-Type content="text/html; charset=UTF-8" />
        <title>Promocion</title>
        <?php include_once '../scripts/estilos.php'; ?>
        <link rel="stylesheet" href="../scripts/styles.css" type="text/css" /> 
        <script src="promo69.js" type="text/javascript" ></script>
        <style type="text/css">
            .calculadordtos td{
                padding: 5px;
            }
            .calculadordtos th{
                padding: 5px;
                background-color: #009900;
            }
            .calculadordtos{
                margin-top:15px;
                border: 5px solid #AA3333;
                border-radius: 9px;
                margin-left: 110px;
            }
            .titulocalc{
                background-color: #ccffcc;
                font-size: 30px;
                text-align: center;
            }
        </style>
        <?php include '../calendario/calcular_dia.php'; ?>
    </head>
    <body onload="document.getElementById('f').focus();">
        <div class="contenedor">
            <header>
                <?php include_once '../scripts/cabecera.php'; ?>
            </header>
            <nav>
                <?php include_once '../scripts/menu.php'; ?>
            </nav>
            <div class="principal">
                <div class="banda">
                    <h2 style="padding:15px;">Calculador</h2>
                    <br/><br/><br/>Última atualización: Noviembre 2014
                </div>
            </div>
            <div style="clear: both"></div>
            <div class="contenido">
                <form>
                    <table class="calculadordtos" border="1">
                        <tr>
                            <td colspan="6" class="titulocalc">Calculador de descuentos</td>
                        </tr>
                        <tr>
                            <th>Mano de obra</th>
                            <th>Dto MO</th>
                            <th>IVA</th>
                            <th>DTO Filtro</th>
                            <td rowspan="8" style="width:200px;" id="texto">
                                
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center"><input id="mo" onkeyup="calcular()" style="width:70px;text-align: right;" value="47,5" ></input></td>
                            <td><input id="dmo" onkeyup="calcular()" style="width:70px;text-align: right;" value="25" ></input></td>
                            <td><input id="iva" onkeyup="calcular()" style="width:70px;text-align: right;" value="21" ></input></td>
                            <td><input id="df" onkeyup="calcular()" style="width:70px;text-align: center;" value="30" ></input></td>
                        </tr>
                        <tr>
                            <th>Baremo MO</th>
                            <th>Filtro</th>
                            <th>Junta</th>
                            <th >Cantidad (L)</th>
                        </tr>
                        <tr>
                            <td style="text-align: center"><input id="bmo"  style="width:70px;text-align: center;" onkeyup="calcular()" value="0.50" ></input></td>
                            <td><input id="foculto" type="hidden" ></input><input id="f" onkeyup="getfiltro()" style="width:70px;text-align:center" ></input></td>
                            <td><input id="joculto" type="hidden" ></input><input id="j" onkeyup="getjunta()" style="width:70px;text-align:center" ></input></td>
                            <td><input id="c"  style="width:70px;text-align: center;" onkeyup="calcular()" value="4.0" ></input></td>
                        </tr>
                        <tr>
                            <th>Oferta</th>
                            <th>7000 10W-40</th>
                            <th>9000 5W-40</th>
                            <th>INEO 5W-30</th>
                        </tr>
                        <tr>
                            <td>PVP kit</td>
                            <td><input id="7k"  style="width:70px;text-align:center" disabled ></input></td>
                            <td><input id="9k"  style="width:70px;text-align:center" disabled ></input></td>
                            <td><input id="ik"  style="width:70px;text-align:center" disabled ></input></td>
                        </tr>
                        <tr>
                            <td>PVP promo</td>
                            <td><input id="7p" onkeyup="calcular()" style="width:70px;text-align:center"  value="59,00" ></input></td>
                            <td><input id="9p" onkeyup="calcular()" style="width:70px;text-align:center" value="69,00" ></input></td>
                            <td><input id="ip" onkeyup="calcular()" style="width:70px;text-align:center" value="79,00" ></input></td>
                        </tr>
                        <tr>
                            <td>DTO en el aceite</td>
                            <td><input id="7d"  style="width:70px;text-align:center;font-size:20px;color: #0033cc;font-weight:bold" disabled ></input></td>
                            <td><input id="9d"  style="width:70px;text-align:center;font-size:20px;color: #0033cc;font-weight:bold" disabled ></input></td>
                            <td><input id="id"  style="width:70px;text-align:center;font-size:20px;color: #0033cc;font-weight:bold" disabled ></input></td>
                        </tr>
                    </table>
                </form>
                <div id="tablaneumatics"></div>
            </div>
            <p>&nbsp;</p>
            <?php include_once '../scripts/pie.php'; ?>
        </div>
    </body>
</html>