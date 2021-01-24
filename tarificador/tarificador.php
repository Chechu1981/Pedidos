<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv=Content-Type content="text/html; charset=UTF-8" />
        <title>Enlaces</title>
        <style>
            .inaceptable{
                font-weight: bold;
                color:#ff3333;
            }
        </style>
        <?php include_once '../scripts/estilos.php'; ?>
        <link rel="stylesheet" href="../scripts/styles.css" type="text/css" /> 
        <?php
        include '../calendario/calcular_dia.php';
        include_once '../estilos/conexion.php';
        $nombres = $mysqli->query("SELECT cadena FROM nombres WHERE aplicacion = 'tarificador'");
        while ($tarificador = $nombres->fetch_row())
            $linea = $tarificador[0];
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
                if (!xmlhttp && typeof XMLHttpRequest !== 'undefined') {
                    xmlhttp = new XMLHttpRequest();
                }
                return xmlhttp;
            }
            var ajax = objetoAjax();
            
            function enviarc() {
                var marca = document.getElementById('marca').value;
                var ancho = document.getElementById('ancho').value;
                var alto = document.getElementById('alto').value;
                var diam = document.getElementById('diam').value;
                var ic = document.getElementById('ic').value;
                var cv = document.getElementById('cv').value;
                var modelo = document.getElementById('modelo').value;
                var cantidad = document.getElementById('cantidad').value;
                var dto = document.getElementById('dto').value;
                //var alto = document.getElementById('alto').value;
                
                ajax.open('GET', 'tablaneumaticos.php?dto=' + dto + '&ancho=' + ancho + '&alto=' + alto + '&diam=' + diam + '&ic=' + ic + '&cv=' + cv + '&marca=' + marca + '&modelo=' + modelo + '&cantidad=' + cantidad, true);
                ajax.send(null);
                ajax.onreadystatechange = respuesta;
            }
            
            function cambioDto(){
                var marca = document.getElementById('marca').value;
                if (marca === "MICHELIN" || marca === "DUNLOP" || marca === "GOODYEAR" || marca === "BRIDGESTONE" || marca === "CONTINENTAL" || marca === "PIRELLI") {
                   document.getElementById('dto').value = "35";
                }else{
                    document.getElementById('dto').value = "21";
                }
                enviarc();
            }

            function respuesta() {
                var tabla = document.getElementById('tablaneumatics');
                if (ajax.readyState === 1) {
                    tabla.innerHTML = "<div style='clear:both;text-align:center;' >Buscando...<img src='../imagenes/spinner.gif' title='spinner' /></div>";
                }
                else if (ajax.readyState === 4) {
                    tabla.innerHTML = ajax.responseText;
                } else {
                    tabla.innerHTML = "";
                }
            }
            function imprSelec(id) {
                var ficha = document.getElementById(id);
                var ventimp = window.open('', 'Imprimir');
                ventimp.document.write(ficha.innerHTML);
                ventimp.document.close();
                ventimp.print();
                ventimp.close();
            }
            function abrircantidad(id, cantidad) {
                var posicion_x = (screen.width / 2) - (150 / 2);
                var posicion_y = (screen.height / 2) - (100 / 2);
                window.open("cantidad.php?cantidad=" + cantidad + "&id=" + id, this.target, 'width=150,height=100,left=' + posicion_x + ',top=' + posicion_y);
            }
        </script>
    </head>
    <body onload="document.getElementById('ancho').focus();">
        <div class="contenedor">
            <header>
                <?php include_once '../scripts/cabecera.php'; ?>
            </header>
            <nav>
                <?php include_once '../scripts/menu.php'; ?>
            </nav>
            <div class="principal">
                <div class="banda">
                    <h2 style="padding:15px;">Tarificador</h2>
                    <br/><b>-- OJO, DESACTUALIZADO. El PVP del neumático está incremenatdo un 3% que fue la última subida de precios para que los precios no salgan tan dispares. Os avisaré cuando esté actualizado --</b> Última atualización: Febrero 2015
                </div>
            </div>
            <div style="clear: both"></div>
            <div class="contenido">
                <form>
                    <table>
                        <tr>
                            <th>ANCHO</th>
                            <th>ALTO</th>
                            <th>DMTR</th>
                            <th>IC</th>
                            <th>CV</th>
                            <th>MARCA</th>
                            <th>MODELO</th>
                            <th>CANTIDAD</th>
                            <th>DTO</th>
                        </tr>
                        <tr>
                            <td><input id="ancho" onkeyup="enviarc()" style="width:60px;text-align: right;" ></input></td>
                            <td><input id="alto" onkeyup="enviarc()" style="width:60px;text-align: right;" ></input></td>
                            <td><input id="diam" onkeyup="enviarc()" style="width:60px;text-align: right;" ></input></td>
                            <td><input id="ic" onkeyup="enviarc()" style="width:60px;text-align: right;" ></input></td>
                            <td><input id="cv" onkeyup="enviarc()" style="width:60px;text-align: center;" ></input></td>
                            <td>
                                <select id="marca" onchange="cambioDto()" style="width:160px;" >
                                    <option>MICHELIN</option>
                                    <option>KLEBER</option>
                                    <option>KORMORAN</option>
                                    <option>DUNLOP</option>
                                    <option>GOODYEAR</option>
                                    <option>PIRELLI</option>
                                    <option>BRIDGESTONE</option>
                                    <option>FIRESTONE</option>
                                    <option>CONTINENTAL</option>
                                    <option>BARUM</option>
                                    <option>FULDA</option>
                                    <option>SAVA</option>
                                    <option>GT RADIAL</option>
                                </select>
                            </td>
                            <td><input id="modelo" onkeyup="enviarc()" style="width:160px;" ></input></td>
                            <td><input id="cantidad" onkeyup="enviarc()" style="width:70px;text-align:center" value="2" ></input></td>
                            <td><input id="dto" onkeyup="enviarc()" style="width:70px;text-align:center" value="35" ></input></td>
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