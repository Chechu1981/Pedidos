<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd" >
<html>
    <head>
        <meta http-equiv=Content-Type content="text/html; charset=UTF-8" />
        <title>Factura</title>
        <meta HTTP-EQUIV="Pragma" CONTENT="no-cache"></meta>
        <?php include_once '../scripts/estilos.php'; ?>
        <link rel="stylesheet" href="../scripts/styles.css" type="text/css" />
        <link rel="stylesheet" href="factura.css" type="text/css" />
        <?php include '../calendario/calcular_dia.php'; ?>
        <script>
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
                if (!xmlhttp && typeof XMLHttpRequest !== 'undefined') {
                    xmlhttp = new XMLHttpRequest();
                }
                return xmlhttp;
            }

            var buscarLinea = objetoAjax();

            function registro(id) {
                var ref = document.getElementById('ref' + id).value;
                var denom = document.getElementById('den' + id);
                var dto = document.getElementById('dto' + id);
                var pvp = document.getElementById('pvp' + id);
                var dtos = document.getElementById('dto'+id);
                if (ref !== "") {
                    buscarLinea.open('GET', 'buscarReferencia.php?ref=' + ref, true);
                    buscarLinea.send(null);
                    buscarLinea.onreadystatechange = function() {
                        if (buscarLinea.readyState === 4) {
                            var texto = buscarLinea.responseText;
                            var datos = texto.split("|");
                            denom.value = datos[0];
                            dto.title = datos[1];
                            pvp.value = datos[2] + "€";
                            dtos.value = 0;
                        }
                    }
                }else{
                    denom.value = "";
                    dto.value = "";
                    pvp.value = "";
                }
            }

            function calcularPrecio(id) {
                var cantidad = document.getElementById("can" + id).value;
                var subtotal = document.getElementById('subt' + id);
                var dtos = document.getElementById('dto'+id).value;
                var numDtos = 0.0;
                if(dtos !== ""){
                    numDtos = (100 - parseFloat(dtos.replace(",",".")))/100;
                }
                if (cantidad !== "") {
                    var pvp = document.getElementById('pvp' + id).value;
                    var calculo = parseFloat(pvp.replace(",", ".")) * parseFloat(cantidad);
                    subtotal.value = Math.round((calculo * numDtos) * 100) / 100;
                    totalFactura();
                } else {
                    subtotal.value = "";
                }
            }

            function closeIframe(){
                $("new").dialog('destroy');
                $("#nven").dialog('destroy');
                return false;
            }

            function ponerFecha() {
                var fecha = document.getElementById('fechaFactura');
                var date = new Date();
                var meses = ["enero", "febrero", "marzo", "abril", "mayo", "junio", "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre"];
                fecha.innerHTML = date.getDay() + " de " + meses[date.getMonth()] + " de " + date.getFullYear();
            }
            
            function totalFactura(){
                var bruto = document.getElementById('bruto');
                var totlaDto = document.getElementById('totlaDto');
                var bi = document.getElementById('bi');
                var iva = document.getElementById('iva');
                var totalFactura = document.getElementById('totalFactura');
                var acumulado = 0.0;
                var brutoAcumulado = 0.0;
                for(indice=0;indice<20;indice++){
                    var strPrecio = document.getElementById('subt'+indice).value;
                    if(strPrecio !== ""){
                        acumulado += parseFloat(strPrecio.replace(",", "."));
                    }
                }
                for(indice=0;indice<20;indice++){
                    var strPrecio = document.getElementById('pvp'+indice).value;
                    var strCantidad = document.getElementById('can'+indice).value;
                    if(strPrecio !== ""){
                        brutoAcumulado += parseFloat(strPrecio.replace(",", ".")) * parseFloat(strCantidad.replace(",", "."));
                    }
                }
                totlaDto.innerHTML = Math.round((brutoAcumulado - acumulado)*100)/100;
                bruto.innerHTML = Math.round((brutoAcumulado)*100)/100;
                bi.innerHTML = Math.round((acumulado)*100)/100;
                iva.innerHTML = Math.round(((acumulado*1.21)-acumulado)*100)/100;
                totalFactura.innerHTML = Math.round((acumulado*1.21)*100)/100;
            }

            function imprSelec() {
                var ficha = document.getElementById("factura");
                var ventimp = window.open('', 'imprimir');
                ventimp.document.write('<link rel="stylesheet" href="../scripts/styles.css" type="text/css" /><link rel="stylesheet" href="factura.css" type="text/css" />');
                ventimp.document.write(ficha.innerHTML);
                ventimp.document.close();
                ventimp.print();
                ventimp.close();
            }
        </script>
    </head>
    <body onload="ponerFecha()">
        <div class="contenedor">
            <header>
            <?php include_once '../scripts/cabecera.php'; ?>
                </header>
            <nav>
            <div class="principal" >
                <?php include_once '../scripts/menu.php'; ?>
            </div>
                </nav>
            <div style="clear: both"></div>
            <div class="banda" >
                <h2 style="padding:15px;">Factura provisional</h2>
            </div>
            <div style="clear:both;"></div>
            <div id="factura" class="factura" >
                <form method="post" name="form">
                <table>
                    <tr>
                        <td><img src="../imagenes/carrion.png" width="100"></td>
                        <td class="encabezado_factura" colspan="6"><h3>Factura provisional</h3></td>
                    </tr>
                    <tr>
                        <td colspan="6">Fecha de factura: <span id="fechaFactura"></span></td>
                    </tr>
                    <tr>
                        <td style="font-size: 15px;">NIF: </td>
                        <td><input type="text" /></td>
                        <td style="padding-left:15px;font-size: 15px;" />Calle: </td>
                        <td colspan="3"><input style="width: 100%" type="text" /></td>
                    </tr>
                    <tr>
                        <td style="font-size: 15px;">Nombre: </td>
                        <td><input type="text" /></td>
                        <td style="padding-left:15px;font-size: 15px;">CP:</td>
                        <td><input type="text" /></td>
                        <td style="font-size: 15px;">Población: </td>
                        <td><input type="text" /></td>
                    </tr>
                    <tr>
                        <td style="font-size: 15px;">Apellidos: </td>
                        <td><input type="text" /></td>
                        <td style="padding-left:15px;font-size: 15px;">Provincia: </td>
                        <td colspan="3"><input style="width: 100%" style="width: 100%" type="text" /></td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <th>referencia</th>
                        <th width="10" >cantidad</th>
                        <th>designación</th>
                        <th width="10" >PVP</th>
                        <th width="10" >dto</th>
                        <th width="10" >total</th>
                    </tr>
                    <?php for ($i = 0; $i < 20; $i++) { ?>
                        <tr>
                            <td><input name='ref<?php echo $i; ?>' onblur="registro(<?php echo $i; ?>)" id="ref<?php echo $i; ?>" /></td>
                            <td><input name='can<?php echo $i; ?>' onblur="calcularPrecio(<?php echo $i; ?>)" id="can<?php echo $i; ?>" style="width:55px;text-align: center;" /></td>
                            <td><input name='den<?php echo $i; ?>' id="den<?php echo $i; ?>" /></td>
                            <td><input name='pvp<?php echo $i; ?>' id="pvp<?php echo $i; ?>" style="width:75px;text-align:right" /></td>
                            <td><input name='dto<?php echo $i; ?>' onblur="calcularPrecio(<?php echo $i; ?>)" id="dto<?php echo $i; ?>" style="width:55px;text-align: center;" /></td>
                            <td><input name='subt<?php echo $i; ?>' id="subt<?php echo $i; ?>" style="width:75px;text-align:right" /></td> 
                        </tr>
                    <?php } ?>
                </table>
                    </form>
                <table style="float: right;margin-right: 290px;" class="tablaFactura" border="1">
                    <tr>
                        <td>Total Bruto:</td>
                        <td id="bruto"></td>
                    </tr>
                    <tr>
                        <td>Total descuentos:</td>
                        <td id="totlaDto"></td>
                    </tr>
                    <tr>
                        <td>Base imponible:</td>
                        <td id="bi"></td>
                    </tr>
                    <tr>
                        <td>IVA 21%:</td>
                        <td id="iva"></td>
                    </tr>
                    <tr>
                        <td><b>TOTAL FACTURA</b></td>
                        <td id="totalFactura" style="font-weight: bold;"></td>
                    </tr>
                </table>
            </div>
            <div>
                <a onclick="imprSelec()" style="cursor: pointer;font-weight: bold;color:#03C">Imprimir</a>
            </div>
            <?php include_once '../scripts/pie.php'; ?>
        </div>

    </body>
</html>