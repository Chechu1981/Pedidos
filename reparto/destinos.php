<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv=Content-Type content="text/html; charset=UTF-8" />
        <link rel="shortcut icon" href="../imagenes/chechu.ico" />
        <link rel="stylesheet" type="text/css" href="../scripts/styles.css" />
        <link rel="stylesheet" href="../../scripts/jquery-ui.css" />
        <link rel="stylesheet" href="../../scripts/jquery.ui.theme.css" /> 
        <?php
        include_once '../scripts/estilos.php';
        include '../calendario/calcular_dia.php';
        include '../estilos/conexion.php';
        ?>
        <title>Ruta</title>
        <script src="../../scripts/jquery-1.9.1.js"></script>  
        <script src="../../scripts/jquery-ui.js"></script>
        <link rel="shortcut icon" href="../imagenes/chechu.ico" />
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

            function envioConIntro(e) {
                var esIE = (document.all);
                var esNS = (document.layers);
                tecla = (esIE) ? event.keyCode : e.which;
                if (tecla === 13) {
                    insertarRuta();
                    return false;
                }
            }

            function insertarRuta() {
                var cliente = document.getElementById('clien').value;
                var prioridad = document.getElementById('prio').value;
                var ordenante = document.getElementById('ordenante').value;
                var comentario = document.getElementById('comentario').value;
                var ruta = document.getElementById('ruta');
                var repartos = "";
                if (ruta.checked) {
                    repartos = "ruta";
                } else {
                    repartos = "espera";
                }
                if (cliente !== "") {
                    $("#carga").html("<div style='position:fixed;width: 250px;margin-left: 450px;margin-top: 250px;background-color: rgba(233, 232, 226, 0.5);text-align: center;'><h2>Añadiendo a la ruta...</h2><img src='../imagenes/MnyxU.gif' width='50px' /></div>");
                    $.ajax({
                        url: "insertarRuta.php?ordenante=" + ordenante + "&clien=" + cliente + "&prio=" + prioridad + "&comentario=" + comentario + "&ruta=" + repartos
                    });
                    document.getElementById('nuevoDestino').reset();
                    setTimeout('location="destinos.php"', 500);
                }
                //$("#carga").html("insertarRuta.php?ordenante=" + ordenante + "&clien=" + cliente + "&prio=" + prioridad + "&comentario=" + comentario + "&ruta=" + ruta);
            }

            function finReparto() {
                $("#carga").html("<div style='position:fixed;width: 250px;margin-left: 450px;margin-top: 250px;background-color: rgba(233, 232, 226, 0.5);text-align: center;'><h2>Fin del reparto...</h2><img src='../imagenes/MnyxU.gif' width='50px' /></div>");
                $.ajax({
                    url: "finReparto.php"
                });
                document.getElementById('nuevoDestino').reset();
                setTimeout('location="destinos.php"', 500);
            }

            function deshacer(id) {
                $("#carga").html("<div style='position:fixed;width: 250px;margin-left: 450px;margin-top: 250px;background-color: rgba(233, 232, 226, 0.5);text-align: center;'><h2>Descargar...</h2><img src='../imagenes/MnyxU.gif' width='50px' /></div>");
                deshacerAjax = new objetoAjax();
                deshacerAjax.open("GET", "descargar.php?id=" + id, true);
                deshacerAjax.send(null);
                //$("#carga").html("descargar.php?id=" + id);
                setTimeout('location="destinos.php"', 500);
                //$("#carga").html("descargar.php?id=" + id);
            }

            function eraser(id) {
                $("#carga").html("<div style='position:fixed;width: 250px;margin-left: 450px;margin-top: 250px;background-color: rgba(233, 232, 226, 0.5);text-align: center;'><h2>Eliminando...</h2><img src='../imagenes/MnyxU.gif' width='50px' /></div>");
                borrar = new objetoAjax();
                borrar.open("GET", "eliminarRuta.php?id=" + id, true);
                borrar.send(null);
                setTimeout('location="destinos.php"', 500);
            }

            function deseleccionar_todo() {
                if (document.getElementById('switch').alt === 'off') {
                    document.getElementById('switch').alt = 'on';
                    for (i = 0; i < document.f1.elements.length; i++)
                        if (document.f1.elements[i].type === "checkbox")
                            document.f1.elements[i].checked = 1;
                } else {
                    document.getElementById('switch').alt = 'off';
                    for (i = 0; i < document.f1.elements.length; i++) {
                        if (document.f1.elements[i].type === "checkbox")
                            document.f1.elements[i].checked = 0;
                    }
                }
            }

            function cargar() {
                var id;
                var furgona = document.getElementById('furgona').value;
                var repartidor = document.getElementById('repartidor').value;
                if (repartidor === "") {
                    $("#fallo").html("Falta el nombre del repartidor");
                    document.getElementById('repartidor').style.backgroundColor = "red";
                    document.getElementById('repartidor').focus();
                } else {
                    $("#carga").html("<div style='position:fixed;width: 250px;margin-left: 450px;margin-top: 250px;background-color: rgba(233, 232, 226, 0.5);text-align: center;'><h2>Cargando...</h2><img src='../imagenes/MnyxU.gif' width='50px' /></div>");
                    for (i = 0; i < document.f1.elements.length; i++) {
                        if (document.f1.elements[i].checked === true) {
                            id = document.f1.elements[i].name;
                            $.ajax({
                                url: "cargar.php?id=" + id + "&repartidor=" + repartidor + "&furgona=" + furgona
                            });
                        }
                    }
                    //$("#carga").html("cargar.php?id=" + id + "&repartidor=" + repartidor + "&furgona=" + furgona    );
                  setTimeout('location.reload()', 1000);
                }
            }

            $(function () {
                var availableTags = [
<?php
$clientes = mysql_query("SELECT * FROM hoja1;");
$contador = 0;
while ($nomcli = mysql_fetch_row($clientes)) {
    $imprime = '"' . $nomcli[1] . ' (' . $nomcli[0] . ')" ';
    if ($contador < (mysql_num_rows($clientes) - 1)) {
        $imprime = $imprime . ",";
        $contador++;
    }
    echo utf8_encode($imprime);
}
?>
                ];
                $("#clien").autocomplete({
                    source: availableTags
                });
            });
        </script>
    </head>
    <body onload="document.getElementById('clien').focus();">   
        <style>
            .tablaruta{
                top:0px;
            }
            .tablaruta tr{
                background-color: #ccffff;
            }
            .tablaruta tr{
                background-color: #ffffcc;
            }
            .tablaruta tr:hover{
                background-color: #00cccc;
            }
            .urgente td{
                background-color: #ff9999;
            }
        </style>
        <?php
        $furgonarsc = mysql_query("SELECT * FROM nombres WHERE aplicacion = 'furgona' ");
        $furgona = mysql_fetch_row($furgonarsc);
        $repartidorrsc = mysql_query("SELECT * FROM nombres WHERE aplicacion = 'repartidor' ");
        $repartidor = mysql_fetch_row($repartidorrsc);
        $horarsc = mysql_query("SELECT * FROM nombres WHERE aplicacion = 'hora' ");
        $horaReparto = mysql_fetch_row($horarsc);
        //$senruta = mysql_query("SELECT CODIGO,NOMBRE,POBLACION,RUTA FROM CARRION.HOJA1 WHERE RUTA = 1 AND CODIGO IN (SELECT DISTINCT SUBSTR(cliente,-7,6) AS CODIGO FROM PEDIDOS.LINEAS WHERE fecha_pedido LIKE '" . calcular_dia() . calcular_mes() . calcular_ano() . "' AND destino LIKE 'M') OR RUTA = 1 AND CODIGO IN  (SELECT DISTINCT SUBSTR(cliente,-7,6) AS CODIGO FROM PEDIDOS.LINEASVOLVO WHERE fecha_pedido LIKE '" . calcular_dia() . calcular_mes() . calcular_ano() . "' AND destino LIKE 'M')");
        ?>
        <div id="carga" style="float:left;height:20px;width:100px;position: absolute;"></div>
        <table width="380" style="float: left">
            <tr>
                <td>
                    <div style="width: 600px">
                        <form action="" method="GET" id="nuevoDestino">
                            <table>
                                <tr>
                                    <th>Destino</th>
                                    <th>Ordenante</th>
                                    <th>Prioridad</th>
                                    <th>Comentario</th>
                                    <th>En espera</th>
                                    <th>En ruta</th>
                                </tr>
                                <tr>
                                    <td>
                                        <input name="clien" id="clien" onkeyup="envioConIntro(event)" ></input>
                                    </td>
                                    <td>
                                        <select name="ordenante" id="ordenante" onkeyup="envioConIntro(event)" >
                                            <option></option>
                                            <?php
                                            $empleados = mysql_query("SELECT * FROM empleados");
                                            while ($usuario = mysql_fetch_row($empleados)) {
                                                ?>
                                                <option value="<?php echo utf8_encode($usuario[1]); ?>" > <?php echo utf8_encode($usuario[1]); ?> </option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="prio" id="prio" onkeyup="envioConIntro(event)" >
                                            <option>Normal</option>
                                            <option>Alta</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input name="comentario" id="comentario" onkeyup="envioConIntro(event)" ></input>
                                    </td>
                                    <td>
                                        <input type="radio" id="espera" name="ruta" value="espera" checked="true" onkeyup="envioConIntro(event)" ></input>
                                    </td>
                                    <td>
                                        <input type="radio" id="ruta" name="ruta" value="ruta" onkeyup="envioConIntro(event)" ></input>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4" style="text-align:center"><input type="button" value="Añadir" onclick="insertarRuta()"></input></td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="padding: 20px">
                    <h3>En espera</h3><div id="fallo" style="color:red;font-weight: bold"></div>
                    <form name="f1" style="float:right" >
                        <table class="tablaruta">
                            <tr>
                                <td colspan="3" style="text-align:center;background-color:white" >
                                    <label>Repartidor</label>
                                    <select id="repartidor">
                                        <option value=""></option>
                                        <?php
                                        $empleados1 = mysql_query("SELECT * FROM empleados");
                                        while ($usuario = mysql_fetch_row($empleados1)) {
                                            ?>
                                            <option value="<?php echo utf8_encode($usuario[1]); ?>"> <?php echo utf8_encode($usuario[1]); ?> </option>
                                        <?php } ?>
                                    </select>
                                </td>
                                <td colspan="2" style="text-align:center;background-color:white" >
                                    <label>Furgona</label>
                                    <select id="furgona">
                                        <option value="Jumper">Jumper</option>
                                        <option value="Berlingo">Berlingo</option>
                                    </select>
                                </td>
                                <td colspan="2" style="text-align:center;background-color:white">
                                    <div onclick="cargar()" class="boton" >Cargar</div>
                                </td>
                            </tr>
                            <tr>
                                <th></th>
                                <th><img src="../imagenes/abajo.png" onclick="deseleccionar_todo()" id="switch" alt="off" style="cursor:pointer" /></th>
                                <th>Cliente</th>
                                <th>Dirección</th>
                                <th>Comentario</th>
                                <th>Ordenante</th>
                                <th>Dia</th>
                                <th>Prioridad</th>
                                <th></th>
                            </tr>
                            <?php
                            $numeros = 1;
                            $lista = mysql_query("SELECT * FROM ruta WHERE entregado = 'NO' AND fechaReparto = '0000-00-00 00:00:00' ORDER BY prioridad,fechaPedido,cliente ASC");
                            while ($filruta = mysql_fetch_row($lista)) {
                                $urgente = "";
                                if (strnatcasecmp($filruta[6], 'Alta') == 0) {
                                    $urgente = "class='urgente'";
                                }
                                $date = date_create($filruta[2]);
                                ?>                   
                                <tr <?php echo $urgente; ?> >
                                    <td><?php echo $numeros++; ?></td>
                                    <td><input type="checkbox" id="selec" name="<?php echo $filruta[0]; ?>" /></td>
                                    <td><?php echo strtoupper(utf8_encode($filruta[3])); ?></td>
                                    <td><?php echo strtoupper(utf8_encode($filruta[4])); ?></td>
                                    <td><?php echo strtoupper(utf8_encode($filruta[5])); ?></td>
                                    <td><?php echo strtoupper(utf8_encode($filruta[1])); ?></td>
                                    <td><?php echo date_format($date, 'd/m/Y H:i:s'); ?></td>
                                    <td><?php echo strtoupper(utf8_encode($filruta[6])); ?></td>
                                    <td><img src='../imagenes/eliminar.png' style="cursor:pointer;" onclick="eraser(<?php echo $filruta[0]; ?>)" ></img></td>
                                </tr>
                            <?php } ?>
                        </table>
                    </form>
                </td>
            </tr>
        </table>
        <table width="280" style="float: right">
            <tr>
                <td>
                    <h3 style="float:left">Furgona 1</h3><div class="boton"  onclick="finReparto()">Fin del reparto 1</div>
                    <table class="tablaruta">
                        <tr style="background-color:white">
                            <td colspan="2">
                                <h4>Repartidor: <?php echo utf8_encode($repartidor[2]); ?> </h4>
                                <h4>Furgona: <?php echo $furgona[2]; ?></h4>
                            </td>
                            <td></td>
                            <td colspan="5">
                                <?php
                                $horaR = "";
                                if ($horaReparto[2] != '') {
                                    $hora = date_create($horaReparto[2]);
                                    $horaR = date_format($hora, 'H:i:s d/m/Y');
                                }
                                ?>
                                <h4>Hora: <?php echo $horaR; ?></h4>
                                <?php
                                $lista = mysql_query("SELECT * FROM ruta WHERE entregado = 'EN CURSO' ORDER BY prioridad,fechaPedido,cliente ASC");
                                $nrepartos = mysql_num_rows($lista);
                                $tiempo = $nrepartos * 11;
                                $horas = (int) ($tiempo / 60);
                                $minutos = (int) ($tiempo - ($horas * 60));
                                if ($minutos < 10) {
                                    $minutos = "0" . $minutos;
                                }
                                ?>
                                <h4>Estimado: <?php echo $horas . ":" . $minutos; ?> horas</h4>
                            </td>

                        </tr>
                        <tr>
                            <th></th>
                            <th>Cliente</th>
                            <th>Dirección</th>
                            <th>Comentario</th>
                            <th>Ordenante</th>
                            <th>Dia</th>
                            <th>Prioridad</th>
                            <th></th>
                        </tr>
                        <?php
                        $numeros = 1;
                        while ($filruta = mysql_fetch_row($lista)) {
                            $urgente = "";
                            if (strnatcasecmp($filruta[6], 'Alta') == 0) {
                                $urgente = "class='urgente'";
                            }
                            $date = date_create($filruta[2]);
                            ?>                   
                            <tr <?php echo $urgente; ?>>
                                <td><?php echo $numeros++; ?></td>
                                <td><?php echo strtoupper(utf8_encode($filruta[3])); ?></td>
                                <td><?php echo strtoupper(utf8_encode($filruta[4])); ?></td>
                                <td><?php echo strtoupper(utf8_encode($filruta[5])); ?></td>
                                <td><?php echo strtoupper(utf8_encode($filruta[1])); ?></td>
                                <td><?php echo date_format($date, 'd/m/Y H:i:s'); ?></td>
                                <td><?php echo strtoupper(utf8_encode($filruta[6])); ?></td>
                                <td><img src='../imagenes/atras.png' style="cursor:pointer;" onclick="deshacer(<?php echo $filruta[0]; ?>)" ></img></td>
                            </tr>
                        <?php } ?>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="padding: 20px;border-top:3px solid #ff9999"  >
                    <h3 style="float:left">Furgona 2</h3><div class="boton" >Fin del reparto 2</div>
                    <table class="tablaruta">
                        <tr style="background-color:white">
                            <td colspan="2">
                                <h4>Repartidor: <?php echo utf8_encode($repartidor[2]); ?> </h4>
                                <h4>Furgona: <?php echo $furgona[2]; ?></h4>
                            </td>
                            <td></td>
                            <td colspan="5">
                                <?php
                                $horaR = "";
                                if ($horaReparto[2] != '') {
                                    $hora = date_create($horaReparto[2]);
                                    $horaR = date_format($hora, 'H:i:s d/m/Y');
                                }
                                ?>
                                <h4>Hora: <?php echo $horaR; ?></h4>
                                <?php
                                $lista = mysql_query("SELECT * FROM ruta WHERE entregado = 'NO FUENCIONA' ORDER BY prioridad,fechaPedido,cliente ASC");
                                $nrepartos = mysql_num_rows($lista);
                                $tiempo = $nrepartos * 11;
                                $horas = (int) ($tiempo / 60);
                                $minutos = (int) ($tiempo - ($horas * 60));
                                if ($minutos < 10) {
                                    $minutos = "0" . $minutos;
                                }
                                ?>
                                <h4>Estimado: <?php echo $horas . ":" . $minutos; ?> horas</h4>
                            </td>

                        </tr>
                        <tr>
                            <th></th>
                            <th>Cliente</th>
                            <th>Dirección</th>
                            <th>Comentario</th>
                            <th>Ordenante</th>
                            <th>Dia</th>
                            <th>Prioridad</th>
                            <th></th>
                        </tr>
                        <?php
                        $numeros = 1;
                        while ($filruta = mysql_fetch_row($lista)) {
                            $urgente = "";
                            if (strnatcasecmp($filruta[6], 'Alta') == 0) {
                                $urgente = "class='urgente'";
                            }
                            $date = date_create($filruta[2]);
                            ?>                   
                            <tr <?php echo $urgente; ?>>
                                <td><?php echo $numeros++; ?></td>
                                <td><?php echo strtoupper(utf8_encode($filruta[3])); ?></td>
                                <td><?php echo strtoupper(utf8_encode($filruta[4])); ?></td>
                                <td><?php echo strtoupper(utf8_encode($filruta[5])); ?></td>
                                <td><?php echo strtoupper(utf8_encode($filruta[1])); ?></td>
                                <td><?php echo date_format($date, 'd/m/Y H:i:s'); ?></td>
                                <td><?php echo strtoupper(utf8_encode($filruta[6])); ?></td>
                                <td><img src='../imagenes/atras.png' style="cursor:pointer;" onclick="deshacer(<?php echo $filruta[0]; ?>)" ></img></td>
                            </tr>
                        <?php } ?>
                    </table>
                </td>
            </tr>
        </table>
    </body>
</html>

