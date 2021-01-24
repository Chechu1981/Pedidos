<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd" >
<html>
    <head>
        <meta http-equiv=Content-Type content="text/html; charset=UTF-8" />
        <link rel="stylesheet" href="../scripts/jquery-ui.css" />
        <link rel="stylesheet" href="../scripts/jquery.ui.theme.css" /> 
        <script src="../scripts/jquery-1.9.1.js"></script>  
        <script src="../scripts/jquery-ui.js"></script>
        <script src="script.js"></script>
        <title>Pedidos Volvo</title>
        <link rel="shortcut icon" href="../imagenes/chechu.ico" />
        <?php include_once '../scripts/estilos.php'; ?>
        <link rel="stylesheet" href="../scripts/styles.css" type="text/css" />
        <link rel="stylesheet" type="text/css" href="css/jquery.jdigiclock.css" />
        <?php
        include '../calendario/calcular_dia.php';

        function activar() {
            $a = false;
            $fecha = getdate(time());
            $mes = $fecha['mon'];
            $hora = $fecha['hours'];
            $min = $fecha['minutes'];
            $ano = $fecha['year'];
            $dia = $fecha['mday'];
            if ($_GET['ano'] > $ano)
                $a = true;
            elseif ($_GET['numes'] > $mes and $_GET['ano'] >= $ano)
                $a = true;
            elseif ($_GET['dia'] > $dia and $_GET['numes'] >= $mes and $_GET['ano'] >= $ano)
                $a = true;
            elseif ($_GET['ano'] == $ano and $_GET['numes'] == $mes and $_GET['dia'] == $dia and $hora <= 17) {
                $a = true;
                if ($hora == 17 and $min > 31) {
                    $a = false;
                }
            }
            if ($_GET['numes'] == 11 and $_GET['dia'] == 1)// dia de los santos
                $a = false;
            else if ($_GET['numes'] == 12 and $_GET['dia'] == 24)// nochebuena
                $a = false;
            else if ($_GET['numes'] == 12 and $_GET['dia'] == 25)// navidad
                $a = false;
            else if ($_GET['numes'] == 1 and $_GET['dia'] == 1)// año nuevo
                $a = false;
            elseif ($_GET['numes'] == 10 and $_GET['dia'] == 12)
                $a = false;
            elseif ($_GET['numes'] == 12 and $_GET['dia'] == 6)
                $a = false;
            elseif ($_GET['numes'] == 5 and $_GET['dia'] == 1)//Día del trabajo
                $a = false;
            elseif ($_GET['numes'] == 1 and $_GET['dia'] == 6)
                $a = false;
            elseif ($_GET['numes'] == 12 and $_GET['dia'] == 31)
                $a = false;
            return $a;
        }

        $activo = activar();


        function actualizar() {
            $sen = $mysqli->query("SELECT * FROM lineasvolvo WHERE fecha_pedido like '" . $_GET['dia'] . $_GET['mes'] . $_GET['ano'] . "' ORDER BY pedido,destino,cliente;");
            if (@mysql_num_rows($sen) > 0) {
                while ($fila = mysql_fetch_row($sen)) {
                    if (isset($_GET['marcado']) and isset($_POST[$fila[0]])) {
                        $mysqli->query("UPDATE  lineasvolvo SET pedido='checked=\"checked\"' WHERE id='" . $fila[0] . "'");
                    } elseif (isset($_GET['marcado'])) {
                        $mysqli->query("UPDATE lineasvolvo SET pedido='' WHERE id='" . $fila[0] . "'");
                    }
                    if (isset($_GET['marcado']) and isset($_POST['ps' . $fila[0]])) {
                        $mysqli->query("UPDATE lineasvolvo SET ps='checked=\"checked\"' WHERE id='" . $fila[0] . "'");
                    } elseif (isset($_GET['marcado'])) {
                        $mysqli->query("UPDATE lineasvolvo SET ps='' WHERE id='" . $fila[0] . "'");
                    }
                }
            }
        }

        $sen = $mysqli->query("SELECT * FROM lineasvolvo WHERE fecha_pedido like '" . $_GET['dia'] . $_GET['mes'] . $_GET['ano'] . "';");
        if (@$sen->num_rows > 0) {
            while ($fila = $sen->fetch_row()) {
                if (isset($_POST['comentario' . $fila[0]])) {
                    $mysqli->query("UPDATE  lineasvolvo SET matricula='" . strtoupper($_POST['comentario' . $fila[0]]) . "' WHERE id='" . $fila[0] . "'");
                }
            }
        }
        
        $clientes = $mysqli->query("SELECT * FROM hoja1;");
        ?>
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
                if (!xmlhttp && typeof XMLHttpRequest != 'undefined') {
                    xmlhttp = new XMLHttpRequest();
                }
                return xmlhttp;
            }
            var ajax = objetoAjax();

            function enviard() {
                var ref = document.getElementById('referencia').value;
                ajax.open('GET', 'denominacion.php?ref=' + ref, true);
                ajax.send(null);
                ajax.onreadystatechange = respuestad;
            }
            function respuestad() {
                var div = document.getElementById('deno');
                if (ajax.readyState == 4) {
                    div.value = ajax.responseText;
                } else {
                    div.value = "DESCONOCIDO";
                }
            }
            // increase the default animation speed to exaggerate the effect
            $.fx.speeds._default = 1000;
            $(function() {
                $("#dialog").dialog({
                    autoOpen: false,
                    show: "blind",
                    hide: "explode"
                });

                $("#opener").click(function() {
                    $("#dialog").dialog("open");
                    return false;
                });
            });
            var info;
            function cargar() {
                info = window.history.length;
            }
            function volver() {
                window.history.back(info);
            }
            function foco() {
                document.getElementById("referencia").focus();
            }
            function display_c() {
                var refresh = 1000; // Refresh rate in milli seconds
                mytime = setTimeout('display_ct()', refresh)
            }
            function display_ct() {
                var strcount;
                var x = new Date();
                document.getElementById('ct').innerHTML = x;
                tt = display_c();
            }
            $(document).ready(function() {
<?php if ($_SERVER['REMOTE_USER'] == "chechu") { ?>
                    var valor = 1;
                    setInterval(function() {
                        if (valor === 1) {
                            var divaler = document.getElementById('alerta').style.backgroundColor = "transparent";
                            valor = 0;
                        } else {
                            var divaler = document.getElementById('alerta').style.backgroundColor = "red";
                            valor = 1;
                        }
                    }, 200);
<?php } ?>
                // Create two variable with the names of the months and days in an array
                var monthNames = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
                var dayNames = ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"]

                // Create a newDate() object
                var newDate = new Date();
                // Extract the current date from Date object
                newDate.setDate(newDate.getDate());
                // Output the day, date, month and year   
                $('#Date').html(dayNames[newDate.getDay()] + " " + newDate.getDate() + ' ' + monthNames[newDate.getMonth()] + ' ' + newDate.getFullYear());

                setInterval(function() {
                    // Create a newDate() object and extract the seconds of the current time on the visitor's
                    var seconds = new Date().getSeconds();
                    // Add a leading zero to seconds value
                    $("#sec").html((seconds < 10 ? "0" : "") + seconds);
                }, 1000);

                setInterval(function() {
                    // Create a newDate() object and extract the minutes of the current time on the visitor's
                    var minutes = new Date().getMinutes();
                    // Add a leading zero to the minutes value
                    $("#min").html((minutes < 10 ? "0" : "") + minutes);
                }, 1000);

                setInterval(function() {
                    // Create a newDate() object and extract the hours of the current time on the visitor's
                    var hours = new Date().getHours();
                    // Add a leading zero to the hours value
                    $("#hours").html((hours < 10 ? "0" : "") + hours);
                }, 1000);
            });
            var cuenta = 600;
            setInterval(function() {
                cuenta--;
                segundos = cuenta % 60;
                minutos = parseInt(cuenta / 60);
                if (segundos < 10)
                    segundos = "0" + segundos;
                $("#cuenta").html("Próxima actualización: " + minutos + ":" + segundos);
            }, 1000);

            setInterval(function() {
                var tiempo = new Date();
                var hora = tiempo.getHours();
                var min = tiempo.getMinutes();
                var seg = tiempo.getSeconds();
                if (hora == 17 && min == 31 && seg == 30) {
                    alert("Pedido finalizado");
                    document.location.href = "../pedidosv/pedidosv.php?numes=<?php echo calcular_numesv(); ?>&dia=<?php echo calcular_diav(); ?>&mes=<?php echo calcular_mesv(); ?>&ano=<?php echo calcular_anov(); ?>";
                }
            }, 1000);

            $(function() {
                $("#dialog:ui-dialog").dialog("destroy");
                var name = $("#name"),
                        tips = $(".validateTips");

                function updateTips(t) {
                    tips
                            .text(t)
                            .addClass("ui-state-highlight");
                    setTimeout(function() {
                        tips.removeClass("ui-state-highlight", 1500);
                    }, 500);
                }

                function checkLength(o, n, min, max) {
                    if (o.val().length > max || o.val().length < min) {
                        o.addClass("ui-state-error");
                        updateTips("Length of " + n + " must be between " +
                                min + " and " + max + ".");
                        return false;
                    } else {
                        return true;
                    }
                }

                function checkRegexp(o, regexp, n) {
                    if (!(regexp.test(o.val()))) {
                        o.addClass("ui-state-error");
                        updateTips(n);
                        return false;
                    } else {
                        return true;
                    }
                }

                $("#dialog-form").dialog({
                    autoOpen: false,
                    height: 300,
                    width: 350,
                    modal: true,
                    buttons: {
                        "Aceptar": function() {
                            var bValid = true;
                            allFields.removeClass("ui-state-error");
                            $(this).dialog("close");
                        },
                        Cancelar: function() {
                            $(this).dialog("close");
                        }
                    },
                    close: function() {
                        allFields.val("").removeClass("ui-state-error");
                    }
                });

                $("#create-user")
                        .button()
                        .click(function() {
                            $("#dialog-form").dialog("open");
                        });
            });
            var t = setTimeout('document.location.href="../pedidosv/pedidosv.php?numes=<?php echo calcular_numesv(); ?>&dia=<?php echo calcular_diav(); ?>&mes=<?php echo calcular_mesv(); ?>&ano=<?php echo calcular_anov(); ?>"', 600000);
            function imprSelec(nombre) {
                var ficha = document.getElementById(nombre);
                var ventimp = window.open('', 'imprimir');
                ventimp.document.write('<img src="../imagenes/logo_Volvo.png" width="45" style="float: left;margin: 8px" /><h2><?php echo "Pedido del " . $_GET['dia'] . " de " . $_GET['mes'] . " de " . $_GET['ano']; ?></h2>');
                ventimp.document.write(ficha.innerHTML);
                ventimp.document.close();
                ventimp.print();
                ventimp.close();
            }
            function seleccionar() {
                if (document.caja.elements[0].checked == 1)
                    seleccionar_todo();
                else
                    deseleccionar_todo();
            }
            function seleccionar_todo() {
                for (i = 1; i < document.caja.elements.length; i++) {
                    if (document.caja.elements[i].type === "checkbox") {
                        document.caja.elements[i].checked = 1;
                        i++;
                    }
                }
            }
            function deseleccionar_todo() {
                for (i = 1; i < document.caja.elements.length; i++)
                    if (document.caja.elements[i].type == "checkbox") {
                        document.caja.elements[i].checked = 0;
                        i++;
                    }
            }
            $(document).ready(function() {
                $("#guardarComentario").click(function() {
                    $ajax({
                        data: {comentario: comment, id: id},
                        type: "POST",
                        url: "actualizar.php",
                        success: function(data) {
                        }
                    });
                });
            });
            function mostrarMarcar() {
                marc = document.getElementById('marcar');
                cand = document.getElementById('candado');
                if (marc.style.display == "none") {
                    marc.style.display = "block";
                    cand.src = "../imagenes/lock.png";
                } else {
                    marc.style.display = "none";
                    cand.src = "../imagenes/lock1.png";
                }
            }
            var comen = objetoAjax();
            function comentarios(id) {
                var cadena = document.getElementById("comentario" + id).value;
                $parametros = {id: id, com: cadena};
                $.ajax({
                    type: 'POST',
                    url: "comentarios.php",
                    data: $parametros
                });
            }
            function verCalendario() {
                if (document.getElementById('calendario').style.display == "none") {
                    $('#calendario').show('slide', 200);
                    setTimeout('$("#buscarreferencia").focus()', 300);
                    document.getElementById('imgcalendario').src = "../imagenes/searcha.png";
                } else {
                    $('#calendario').hide('blind');
                    document.getElementById('imgcalendario').src = "../imagenes/search.png";
                }
            }
            var mail = objetoAjax();
            $(function() {
                var availableTags = [
<?php
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
                $("#cliente").autocomplete({
                    source: availableTags
                });
            });
            $(function() {
                $("#ofertacitroen").dialog({
                    resizable: false,
                    autoOpen: false,
                    width: 950,
                    height: 1250,
                    modal: true,
                    zindex: 3999,
                    show: {
                        effect: "fold",
                        duration: 1000
                    },
                    hide: {
                        effect: "fold",
                        duration: 1000
                    }
                });
                $("#ofertavolvo").dialog({
                    resizable: false,
                    autoOpen: false,
                    width: 700,
                    height: 750,
                    modal: true,
                    zindex: 3999,
                    show: {
                        effect: "fold",
                        duration: 1000
                    },
                    hide: {
                        effect: "fold",
                        duration: 1000
                    }
                });
                $("#ofertaneumaticos").dialog({
                    resizable: false,
                    autoOpen: false,
                    width: 390,
                    height: 463,
                    modal: true,
                    zindex: 3999,
                    show: {
                        effect: "fold",
                        duration: 1000
                    },
                    hide: {
                        effect: "fold",
                        duration: 1000
                    }
                });
                $("#descuentos").dialog({
                    resizable: false,
                    autoOpen: false,
                    width: 200,
                    height: 400,
                    modal: true,
                    zindex: 3999,
                    show: {
                        effect: "fold",
                        duration: 500
                    },
                    hide: {
                        effect: "fold",
                        duration: 500
                    }
                });
                $("#ruta").click(function() {
                    var posicion_x = (screen.width / 2) - (1200 / 2);
                    var posicion_y = (screen.height / 2) - (600 / 2);
                    window.open('../reparto/destinos.php', '_blank', "width=1200, height=600,scrollbars=1,left=" + posicion_x + ",top=" + posicion_y);
                });
                $("#abrirdesuentos").click(function() {
                    $("#descuentos").dialog("open");
                });
                $("#abrircitroen").click(function() {
                    $("#ofertacitroen").dialog("open");
                });
                $("#abrirvolvo").click(function() {
                    $("#ofertavolvo").dialog("open");
                });
                $("#abrirneumaticos").click(function() {
                    $("#ofertaneumaticos").dialog("open");
                });
            });
            $(function() {
                $("#calen").datepicker({
                    changeMonth: true,
                    changeYear: true,
                    monthNames: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
                    monthNamesShort: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
                    firstDay: 1,
                    dayNamesMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
                    dayNames: ["Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo"],
                    dateFormat: "d-MM-mm-yy",
                    onSelect: function(datos) {
                        var fecha = datos.split("-");
                        window.location.href = "pedidosv.php?ano=" + fecha[3] + "&mes=" + fecha[1] + "&numes=" + fecha[2] + "&dia=" + fecha[0];
                    }
                });
            });
        </script>
    </head>
    <body onload="javascript:foco();">
        <?php
        mysql_select_db("carrion");
        $sen = $mysqli->query("SELECT * FROM nombres WHERE aplicacion = 'oferta'");
        $oferta = '';
        while ($mes = mysql_fetch_row($sen))
            $oferta = $mes[2];
        mysql_select_db("pedidos");
        ?>   
        <div class="contenedor">
            <header>
                <table>
                    <tr>
                        <td>
                            <?php
                            $activo = activar();
                            if ((date('j') >= 25 and date('n') == 12) or ( date('j') <= 6 and date('n') == 1)) {
                                ?>
                                <img id="abrirdesuentos" style="cursor: pointer;left: 10px" src="../imagenes/navidad.png" width="150px" />
                            <?php } else { ?>
                                <img id="abrirdesuentos" style="cursor: pointer;left: 10px" src="../imagenes/carrion.png" width="150px" />
                            <?php } ?>
                        </td>
                        <td style="height: 120px;width: 140px;">
                            <ul class="oferta" style="display: inline-block;position: absolute; top:25px;z-index:1;">
                                <li>
                                    <img title="Campaña" src="../imagenes/campana.png" width="40px"/>
                                    <ul>
                                        <li><a href="#" id="abrircitroen" >Citroen</a></li>
                                        <li><a href="#" id="abrirvolvo" >Volvo</a></li>
                                        <li><a href = "#" id = "abrirneumaticos" >Neumáticos</a></li>
                                    </ul>
                                </li>
                            </ul>
                            <?php
                            include '../estilos/conexion.php';
                            $recurso = $mysqli->query("SELECT * FROM incidencias ORDER BY referencia ASC");
                            if ($_SERVER['REMOTE_USER'] == "chechu" && mysql_num_rows($recurso) > 0) {
                                ?>
                                <div id="alerta" ><?php echo mysql_num_rows($recurso); ?></div>
                            <?php } ?>
                        </td>
                        <td style="width: 300px;text-align: center">
                            <?php
                            $furgonarsc = $mysqli->query("SELECT * FROM nombres WHERE aplicacion = 'furgona' ");
                            $furgona = mysql_fetch_row($furgonarsc);
                            $repartidorrsc = $mysqli->query("SELECT * FROM nombres WHERE aplicacion = 'repartidor' ");
                            $repartidor = mysql_fetch_row($repartidorrsc);
                            $horarsc = $mysqli->query("SELECT * FROM nombres WHERE aplicacion = 'hora' ");
                            $horaReparto = mysql_fetch_row($horarsc);
                            $hora = date_create($horaReparto[2]);
                            $lista = $mysqli->query("SELECT * FROM ruta WHERE entregado = 'EN CURSO' ORDER BY prioridad,cliente ASC");
                            $nrepartos = mysql_num_rows($lista);
                            $tiempo = $nrepartos * 11;
                            $horas = (int) ($tiempo / 60);
                            $minutos = (int) ($tiempo - ($horas * 60));
                            if ($minutos < 10) {
                                $minutos = "0" . $minutos;
                            }
                            if ($nrepartos > 0) {
                                ?>
                                <table>
                                    <tr>
                                        <td><h4>Repartidor: <?php echo utf8_encode($repartidor[2]); ?> </h4></td>
                                        <td><h4>Furgona: <?php echo $furgona[2]; ?></h4></td>
                                        <td><h4>Hora: <?php echo date_format($hora, 'H:i:s'); ?></h4></td>
                                        <td><h4>Estimado: <?php echo $horas . ":" . $minutos; ?> horas</h4></td>
                                        <td><h4>Repartos: <?php echo $nrepartos; ?></h4></td>
                                    </tr>
                                </table>
                            <?php } ?>
                            <h4 style="color: blue;margin-bottom: 0px;">Próximo semanal: 
                                <?php
                                mysql_select_db("carrion");
                                $fecha_semanal = $mysqli->query("SELECT cadena FROM nombres WHERE aplicacion = 'proximoSemanal'");
                                $dia_semanal = mysql_fetch_row($fecha_semanal);
                                echo utf8_encode($dia_semanal[0]);
                                ?></h4>
                            <div style="margin: 8px;width: 200px;float: right;">
                                <div id="cuenta" style="right: 10px;font-weight: bold;"></div>
                                <div class="clock">
                                    <div id="Date"></div>
                                    <ul>
                                        <li id="hours"></li>
                                        <li id="point">:</li>
                                        <li id="min"></li>
                                        <li id="point">:</li>
                                        <li id="sec"></li>
                                    </ul>
                                </div>
                            </div>
                        </td>
                        <td style="text-align:center">
                            <?php
                            mysql_select_db("pedidos");
                            $saludo = getdate(time());
                            if ($_SERVER['REMOTE_USER'] == "medina") {
                                if ($saludo['hours'] < 12) {
                                    echo "<span class=\"saludo\" >Buenos días Medina del Campo</span>";
                                } else {
                                    echo "<span class=\"saludo\" >Buenas tardes Medina del Campo</span>";
                                }
                            } else if ($_SERVER['REMOTE_USER'] == "recepcion") {
                                if ($saludo['hours'] < 12) {
                                    echo "<span class=\"saludo\" >Buenos días recepción</span>";
                                } else
                                    echo "<span class=\"saludo\" >Buenas tardes recepción</span>";
                            }else {
                                if ($saludo['hours'] < 12) {
                                    echo "<span class=\"saludo\" >Buenos días Valladolid</span>";
                                } else {
                                    echo "<span class=\"saludo\" >Buenas tardes Valladolid</span>";
                                }
                            }
                            ?>
                            Semanal Volvo:<br/>J V L (Miércoles)<br/>M X (Viernes)<br/>    
                        </td>
                        <td>
                            <table>
                                <tr>    
                                    <td>
                                        <?php if ($_SERVER['REMOTE_USER'] != "medina" AND $_SERVER['REMOTE_USER'] != "recepcion") { ?>
                                            <a href="../../principal/configuracion.php" title="Configuración"><img src="../../imagenes/config.png" height="20" /></a> 
                                        <?php } ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding-top: 15px;">
                                        <div><img src="../imagenes/ruta.png" alt="Ruta" id='ruta' style="cursor:pointer" ></div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="7">
                            <?php if ($_SERVER['REMOTE_USER'] == "medina") { ?>
                                <!-- El tiempo --> 
                            <?php } else { ?>
                                <!-- El tiempo --> 
                            <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5">
                            <?php
                            mysql_select_db("carrion");
                            $aviso = $mysqli->query("SELECT * FROM nombres WHERE aplicacion = 'aviso';");
                            $estado = $mysqli->query("SELECT * FROM nombres WHERE aplicacion = 'eaviso';");
                            $texto = mysql_fetch_row($aviso);
                            $sw = mysql_fetch_row($estado);
                            ?>
                            <div class="aviso" <?php if ($sw[2] == 'si') { ?> style="display: block" <?php } if ($sw[2] == 'no') { ?> style="display: none" <?php } ?> ><img src="../imagenes/peligro.png" style="margin: 0 8px 8px 0;" align="center" border="0" /><?php echo utf8_encode($texto[2]); ?><br/></div>
                        </td>
                    </tr>
                </table>
            </header>
            <nav>
                <?php include_once '../scripts/menu.php'; ?>
            </nav>
            <div id="ofertacitroen" title="<?php echo $oferta ?>" style="display: none;width: 600px;height: 500px;" >
                <img  src="../documentos/oferta.jpg?<?php echo $oferta ?>" width="100%" height="100%" />
            </div>
            <div id="ofertavolvo" title="Todo el año" style="display: none;width: 600px;height: 500px;" >
                <img  src="../imagenes/ofertavolvo.jpg" width="100%" height="100%" />
            </div>
            <div id="ofertaneumaticos" title="Neumáticos" style="display: none;width: 600px;height: 500px;" >
                <img  src="../imagenes/ofertaneumaticos.jpg" width="100%" height="100%" />
            </div>
            <div id="descuentos" title="Tabla" style="display: none;width: 100px;height: 200px;">
                <?php include_once '../scripts/descuentos.php'; ?>
            </div>
            <div class="principal">

                <?php
                mysql_select_db("pedidos");
                ?>
            </div>
            <div class="banda">
                <img src="../imagenes/logo_Volvo.png" width="45" style="float: left;margin: 8px" /><h2 style="color:blue;padding:15px;"><?php echo "Pedido del " . $_GET['dia'] . " de " . $_GET['mes'] . " de " . $_GET['ano']; ?></h2>
                <a href="calendario.php" target="_self">
                    <div id="nuevo">
                        Calendario
                    </div>
                </a>
            </div>
            <?php
            if (isset($_GET['diasemana']) and $_GET['diasemana'] > 5)
                $activo = false;
            if ($activo) {
                ?>
                <?php if ($_SERVER['REMOTE_USER'] != "recepcion") { ?>
                    <form style="clear:both;" class="formulariopedido" action="pedidosv.php?numes=<?php echo $_GET['numes']; ?>&dia=<?php echo $_GET['dia'] ?>&mes=<?php echo $_GET['mes'] ?>&ano=<?php echo $_GET['ano'] ?>" method="post" name="pedido" >
                        <table class="volvo">
                            <th>Referencia</th>
                            <th width='10px;'>C</th>
                            <th>Denominación</th>
                            <th>Cliente/OR</th>
                            <th>Matrícula/Comentario</th>
                            <th style="padding-left: 20px;padding-right: 20px">Destino</th>
                            <tr>
                                <td><input onblur="enviard()" style="width:110px;" type="text" name="referencia" id="referencia" /></td>
                                <td><input width="10px;" style="text-align:right;width:30px;" type="text" name="cantidad"  /></td>
                                <td><input type="text" id="deno" name="denominacion"  /></td>
                                <td><input type="text" id="cliente" name="cliente" style="text-align:center;width:100px" <?php if ($_SERVER['REMOTE_USER'] == "medina") { ?>value="MEDINA" disabled="true" <?php } ?> /></td>
                                <td><textarea rows="3" name="matricula" ></textarea></td>
                                <td>
                                    <?php
                                    if ($_SERVER['REMOTE_ADDR'] == '10.159.64.47' or $_SERVER['REMOTE_ADDR'] == '10.159.64.58') {
                                        ?>
                                        <input type="radio"  name="destino" value="T" checked="checked" onclick="javascript:mostrarsalida();" ><span style="font-size:12px">Taller</span></input><br/>
                                        <input type="radio" name="destino" value="M" onclick="javascript:ocultarsalida();" ><span style="font-size:12px">Mostrador</span></input><br/>
                                    <?php } else { ?>
                                        <?php if ($_SERVER['REMOTE_USER'] != "medina") { ?>
                                            <input type="radio" name="destino" value="T" onclick="javascript:mostrarsalida();" ><span style="font-size:12px">Taller</span></input><br/>
                                        <?php } ?>
                                        <input type="radio" name="destino" value="M" checked="checked" onclick="javascript:ocultarsalida();" ><span style="font-size:12px">Mostrador</span></input><br/>
                                    <?php } ?>
                                </td>
                            </tr>
                        </table><br/>
                        <input style="border:1px solid black;border-width: 1px 3px 3px 1px;border-radius: 4px;background-color: gainsboro;box-shadow: black 1px ;padding:10px;" type="submit" value="Añadir" />
                    </form>
                    <?php
                    actualizar();
                }
            } else {
                if (isset($_GET['diasemana']) and $_GET['diasemana'] > 5) {
                    echo "";
                } elseif (
                        ($_GET['numes'] == 12 and $_GET['dia'] == 6) ||
                        ($_GET['numes'] == 10 and $_GET['dia'] == 12) ||
                        ($_GET['numes'] == 12 and $_GET['dia'] == 31) ||
                        ($_GET['numes'] == 11 and $_GET['dia'] == 1) ||
                        ($_GET['numes'] == 12 and $_GET['dia'] == 24) ||
                        ($_GET['numes'] == 12 and $_GET['dia'] == 25) ||
                        ($_GET['numes'] == 1 and $_GET['dia'] == 1) ||
                        ($_GET['numes'] == 5 and $_GET['dia'] == 1) ||
                        ($_GET['numes'] == 1 and $_GET['dia'] == 6)) {
                    echo "";
                } else {
                    ?><div class='resultado'>Pedido Realizado</div><?php
                }
            }
            //Crear filas
            if (isset($_POST['referencia']) and $_POST['referencia'] != "") {
                if ($_SERVER['REMOTE_USER'] == "medina") {
                    $mysqli->query("INSERT INTO lineasvolvo 
                            (referencia,cantidad,denominacion,matricula,cliente,fecha,destino,fecha_pedido,pedido,ps)
                            VALUES('" . strtoupper($_POST['referencia']) . "',
                                '" . strtoupper($_POST['cantidad']) . "',
                                '" . strtoupper($_POST['denominacion']) . "',
                                '" . strtoupper($_POST['matricula']) . "',
                                'MEDINA',
                                NOW(),
                                '" . $_POST['destino'] . "',
                                '" . $_GET['dia'] . $_GET['mes'] . $_GET['ano'] . "',
                                '',
                                '');");
                } else {
                    $mysqli->query("INSERT INTO lineasvolvo 
                            (referencia,cantidad,denominacion,matricula,cliente,fecha,destino,fecha_pedido,pedido,ps)
                            VALUES('" . strtoupper($_POST['referencia']) . "',
                                '" . strtoupper($_POST['cantidad']) . "',
                                '" . strtoupper($_POST['denominacion']) . "',
                                '" . strtoupper($_POST['matricula']) . "',
                                '" . strtoupper($_POST['cliente']) . "',
                                NOW(),
                                '" . $_POST['destino'] . "',
                                '" . $_GET['dia'] . $_GET['mes'] . $_GET['ano'] . "',
                                '',
                                '');");
                }
            }
            //ver las lineas que hay
            ?><div style='float:left;' id='tabla'><?php
            actualizar();
            $contador = 1;
            if ($_SERVER['REMOTE_USER'] == "medina") {
                @$sentencia = $mysqli->query("SELECT * FROM lineasvolvo WHERE fecha_pedido LIKE '" . $_GET['dia'] . $_GET['mes'] . $_GET['ano'] . "' AND cliente = 'MEDINA' ORDER BY pedido,destino,cliente,referencia;");
            } else {
                @$sentencia = $mysqli->query("SELECT * FROM lineasvolvo WHERE fecha_pedido LIKE '" . $_GET['dia'] . $_GET['mes'] . $_GET['ano'] . "' ORDER BY pedido,destino,cliente,referencia;");
            }
            if (@mysql_num_rows($sentencia) > 0) {
                $lineasTaller = $mysqli->query("SELECT * FROM lineasvolvo WHERE fecha_pedido LIKE '" . $_GET['dia'] . $_GET['mes'] . $_GET['ano'] . "' AND destino LIKE 'T' ORDER BY pedido,destino,cliente,referencia;");
                $lineasMostrador = $mysqli->query("SELECT * FROM lineasvolvo WHERE fecha_pedido LIKE '" . $_GET['dia'] . $_GET['mes'] . $_GET['ano'] . "' AND destino LIKE 'M' ORDER BY pedido,destino,cliente,referencia;");
                $alldia = $mysqli->query("SELECT * FROM lineasvolvo WHERE fecha_pedido LIKE '" . $_GET['dia'] . $_GET['mes'] . $_GET['ano'] . "' ORDER BY pedido,destino,cliente,referencia;");
                $allmes = $mysqli->query("SELECT * FROM lineasvolvo WHERE " . $_GET['numes'] . " = MONTH(fecha) ORDER BY pedido,destino,cliente,referencia;");
                $todas = $mysqli->query("SELECT * FROM lineasvolvo;");
                if ($_SERVER['REMOTE_USER'] != "recepcion") {
                    ?>
                        <div class="lineas"><?php echo mysql_num_rows($sentencia); ?> lineas.</div>
                        <?php
                    }
                    //Formulario de lineas marcadas
                    if ($_SERVER['REMOTE_USER'] != "recepcion") {
                        ?>
                        <form action="pedidosv.php?numes=<?php echo $_GET['numes']; ?>&dia=<?php echo $_GET['dia'] ?>&mes=<?php echo $_GET['mes'] ?>&ano=<?php echo $_GET['ano'] ?>&marcado=si" name="caja" method="POST">
                            <div id="M">
                                <h2 align="center">Pedido de mostrador</h2>
                                <table border='2' width='100%;' class='volvolinea'>
                                    <th style='border-right: 1px solid white;'></th><th>Referencia</th><th width='50px;'>C</th><th style="padding-left: 40px;padding-right: 40px">Denominación</th>
                                    <?php
                                    if ($activo) {
                                        ?><th style="padding: 0"><!--<button <?php if ($_SERVER['REMOTE_USER'] == 'recepcion') { ?> disabled="disabled" <?php } ?> onclick="comentarios()" title="Guardar comentario" class="boton_comentariov" >Matrícula/Comentario</button>-->Matrícula/Comentario</th><th>Cliente/OR</th><th style="padding-left: 45px;padding-right: 45px"> Hora </th><th></th><th><input title="Seleccionar todas las lineas" onclick="javascript:seleccionar();" type="checkbox"  class="caja" /></th><th>PS</th><?php
                                                    } else {
                                                        ?><th>Matrícula/Comentario</th><th>Cliente/OR</th><th style="padding-left: 45px;padding-right: 45px"> Hora </th><th></th><th>PS</th><?php
                                                            }
                                                            $numero = 0;
                                                            //Escribo las lineas en la tabla
                                                            if ($_SERVER['REMOTE_USER'] == "medina") {
                                                                @$sentencia = $mysqli->query("SELECT * FROM lineasvolvo WHERE destino LIKE 'M' AND fecha_pedido like '" . $_GET['dia'] . $_GET['mes'] . $_GET['ano'] . "' AND cliente LIKE 'MEDINA' ORDER BY pedido,destino,cliente,referencia;");
                                                            } else {
                                                                @$sentencia = $mysqli->query("SELECT * FROM lineasvolvo WHERE destino LIKE 'M' AND fecha_pedido like '" . $_GET['dia'] . $_GET['mes'] . $_GET['ano'] . "' ORDER BY pedido,destino,cliente,referencia;");
                                                            }
                                                            while ($fila = mysql_fetch_row($sentencia)) {
                                                                $numero++;
                                                                $imp_negr = "";
                                                                $encontrado = "";
                                                                if ($fila[8] != '' && $fila[9] != '') {
                                                                    $gris = " class=\"ps\" ";
                                                                    $imp_negr = "style='font-weight: bold;background-color:#ddd;'";
                                                                    $ps = "";
                                                                } elseif ($fila[8] != '') {
                                                                    $gris = "class=\"sombra\"";
                                                                    $ps = "";
                                                                } else {
                                                                    $gris = "";
                                                                    $ps = "disabled=\"disabled\"";
                                                                }
                                                                if (isset($_GET['ref'])) {
                                                                    if ($_GET['ref'] == $fila[1]) {
                                                                        $encontrado = "style='background-color:green;color:white;font-style:bold;'";
                                                                    }
                                                                }
                                                                echo "<tr " . $encontrado . $gris . $imp_negr . ">
                                        <td class='numero' style='border-right: 1px solid black;'>" . $contador++ . "</td>
					<td>" . $fila[1] . "</td>
					<td style='text-align:center;'>" . $fila[2] . "</td>
					<td>" . $fila[3] . "</td>";
                                                                if ($activo) {
                                                                    echo "<td><input onblur='comentarios(" . $fila[0] . ")' id='comentario" . $fila[0] . "' size='40' type='text' name='comentario" . $fila[0] . "' value='" . $fila[4] . "'></td>";
                                                                } else {
                                                                    echo "<td>" . $fila[4] . "</td>";
                                                                }
                                                                $meses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
                                                                $mes = '';
                                                                $date = date_create($fila[6]);
                                                                for ($m = 0; $m < 12; $m++) {
                                                                    if (date_format($date, 'm') == $m + 1)
                                                                        $mes = $meses[$m];
                                                                }
                                                                echo "<td style='text-align:center;'>" . $fila[5] . "</td>
					<td style='font-size:12px;'>" . date_format($date, 'd/') . $mes . date_format($date, '/Y') . ' ' . date_format($date, 'H:i:s') . "</td>";
                                                                if ($activo) {
                                                                    echo "<td>
						<a title='ELIMINAR " . $fila[3] . " " . $fila[1] . "' onClick='javascript:confirmar_linea_pedido(" . $fila[0] . ",\"" . $fila[1] . "\");document.forms[\"pedido\"].submit();' target='_blank'>
                                                <img src='../imagenes/eliminar.png' style=\"cursor:pointer;\">
						</a>
						</td>";
                                                                    ?>
                                            <td style="text-align:center;">
                                                <input type="checkbox" name='<?php echo $fila[0]; ?>' <?php echo $fila[8]; ?> />
                                            </td>
                                            <td style='text-align:center;'>
                                                <input type="checkbox" <?php echo $ps; ?> name='<?php echo "ps" . $fila[0]; ?>' <?php echo $fila[9]; ?> />
                                            </td>
                                            </tr>
                                            <?php
                                        } else {
                                            ?>
                                            <td style="text-align:center;"><input disabled="disabled" type="checkbox" name='<?php echo $numero; ?>' <?php echo $fila[8]; ?> /></td>
                                            <td style='text-align:center;'><input disabled="disabled" type="checkbox" name='<?php echo "ps" . $numero; ?>' <?php echo $fila[9]; ?> /></td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?></tr></table>

                            </div>
                        <?php } if ($_SERVER['REMOTE_USER'] != "medina") { ?>
                            <div id="T">
                                <h2 align="center">Pedido de taller</h2>
                                <table border='2' width='100%;' class='volvolinea'>
                                    <?php
                                    //Cabecera de la tabla
                                    ?><th></th><th>Referencia</th><th width='50px;'>C</th><th style="padding-left: 40px;padding-right: 40px">Denominación</th><th>Matrícula/Comentario</th><th>Cliente/OR</th><th style="padding-left: 45px;padding-right: 45px"> Hora </th><th></th><?php
                                    if ($activo) {
                                        ?><th></th><th>PS</th><?php
                                                                    } else {
                                                                        echo "<th>PS</th>";
                                                                    }
                                                                    $numero = 0;
                                                                    //Escribo las lineas en la tabla
                                                                    @$sentencia = $mysqli->query("SELECT * FROM lineasvolvo WHERE destino LIKE 'T' AND fecha_pedido like '" . $_GET['dia'] . $_GET['mes'] . $_GET['ano'] . "' ORDER BY pedido,destino,cliente,referencia;");
                                                                    while ($fila = mysql_fetch_row($sentencia)) {
                                                                        $numero++;
                                                                        $imp_negr = "";
                                                                        $encontrado = "";
                                                                        if ($fila[8] != '' && $fila[9] != '') {
                                                                            $gris = " class=\"ps\" ";
                                                                            $imp_negr = "style='font-weight: bold;background-color:#ddd;'";
                                                                            $ps = "";
                                                                        } elseif ($fila[8] != '') {
                                                                            $gris = "class=\"sombra\"";
                                                                            $ps = "";
                                                                        } else {
                                                                            $gris = "";
                                                                            $ps = "disabled=\"disabled\"";
                                                                        }
                                                                        if (isset($_GET['ref'])) {
                                                                            if ($_GET['ref'] == $fila[1]) {
                                                                                $encontrado = "style='background-color:green;color:white;font-style:bold;'";
                                                                            }
                                                                        }
                                                                        echo "<tr " . $encontrado . $gris . $imp_negr . ">
                                        <td class='numero' style='border-right: 1px solid black;'>" . $contador++ . "</td>
					<td>" . $fila[1] . "</td>
					<td style='text-align:center;'>" . $fila[2] . "</td>
					<td>" . $fila[3] . "</td>";
                                                                        if ($activo) {
                                                                            if ($_SERVER['REMOTE_USER'] == 'recepcion')
                                                                                echo "<td><input disabled='disabled' onblur='comentarios(" . $fila[0] . ")' id='comentario" . $fila[0] . "' size='40' type='text' name='comentario" . $fila[0] . "' value='" . $fila[4] . "'></td>";
                                                                            else
                                                                                echo "<td><input onblur='comentarios(" . $fila[0] . ")' id='comentario" . $fila[0] . "' size='40' type='text' name='comentario" . $fila[0] . "' value='" . $fila[4] . "'></td>";
                                                                        }else {
                                                                            echo "<td>" . $fila[4] . "</td>";
                                                                        }
                                                                        $meses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
                                                                        $mes = '';
                                                                        $date = date_create($fila[6]);
                                                                        for ($m = 0; $m < 12; $m++) {
                                                                            if (date_format($date, 'm') == $m + 1)
                                                                                $mes = $meses[$m];
                                                                        }
                                                                        echo "<td style='text-align:center;'>" . $fila[5] . "</td>
					<td style='font-size:12px;'>" . date_format($date, 'd/') . $mes . date_format($date, '/Y') . ' ' . date_format($date, 'H:i:s') . "</td>";
                                                                        if ($activo) {
                                                                            if ($_SERVER['REMOTE_USER'] == 'recepcion') {
                                                                                ?> <td></td> <?php
                                                    } else {
                                                        echo "<td>
						<a title='ELIMINAR " . $fila[3] . " " . $fila[1] . "' onClick='javascript:confirmar_linea_pedido(" . $fila[0] . ",\"" . $fila[1] . "\");document.forms[\"pedido\"].submit();' target='_blank'>
                                                <img src='../imagenes/eliminar.png' style=\"cursor:pointer;\">
						</a>
						</td>";
                                                    }
                                                    ?>
                                            <td style="text-align:center;">
                                                <input <?php if ($_SERVER['REMOTE_USER'] == 'recepcion') { ?> disabled="disabled" <?php } ?> type="checkbox" name='<?php echo $fila[0]; ?>' <?php echo $fila[8]; ?> />
                                            </td>
                                            <td style='text-align:center;'>
                                                <input <?php if ($_SERVER['REMOTE_USER'] == 'recepcion') { ?> disabled="disabled" <?php } ?> type="checkbox" <?php echo $ps; ?> name='<?php echo "ps" . $fila[0]; ?>' <?php echo $fila[9]; ?> />
                                            </td>
                                            </tr>
                                            <?php
                                        } else {
                                            ?>
                                            <td style="text-align:center;"><input disabled="disabled" type="checkbox" name='<?php echo $numero; ?>' <?php echo $fila[8]; ?> /></td>
                                            <td style='text-align:center;'><input disabled="disabled" type="checkbox" name='<?php echo "ps" . $numero; ?>' <?php echo $fila[9]; ?> /></td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?></tr></table></div>
                        <?php } ?>
                </div>
                <div class="impresion">
                    <?php if ($_SERVER['REMOTE_USER'] == "medina") { ?>
                        <a onclick="javascript:imprSelec('M');" style="cursor:pointer;"><img src="../imagenes/print.png" /><b> Imprimir</b></a>
                    <?php } else if ($_SERVER['REMOTE_USER'] == "recepcion") { ?>
                        <a onclick="javascript:imprSelec('T');" style="cursor:pointer;"><img src="../imagenes/print.png" /><b> Imprimir</b></a>
                    <?php } else { ?>
                        <ul>
                            <li><b>Imprimir</b></li>
                            <ul>
                                <li><a onclick="
                                                javascript:imprSelec('tabla');" style="cursor:pointer;"><img src="../imagenes/print.png" /><b> todo</b></a></li>
                                <li><a onclick="javascript:imprSelec('T');" style="cursor:pointer;"><img src="../imagenes/print.png" /><b> taller</b></a></li>
                                <li><a onclick="javascript:imprSelec('M');" style="cursor:pointer;"><img src="../imagenes/print.png" /><b> mostrador</b></a></li>
                            </ul>
                        </ul>
                    </div>
                    <div class="impresion" style="position: fixed;top:10px;">
                        <?php if ($_SERVER['REMOTE_USER'] == "medina") { ?>
                            <a onclick="javascript:imprSelec('M');" style="cursor:pointer;"><img src="../imagenes/print.png" /><b> Imprimir</b></a>
                        <?php } else if ($_SERVER['REMOTE_USER'] == "recepcion") { ?>
                            <a onclick="javascript:imprSelec('T');" style="cursor:pointer;"><img src="../imagenes/print.png" /><b> Imprimir</b></a>
                        <?php } else { ?>
                            <ul>
                                <li><b>Imprimir</b></li>
                                <ul>
                                    <li><a onclick="
                                                        javascript:imprSelec('tabla');" style="cursor:pointer;"><img src="../imagenes/print.png" /><b> todo</b></a></li>
                                    <li><a onclick="javascript:imprSelec('T');" style="cursor:pointer;"><img src="../imagenes/print.png" /><b> taller</b></a></li>
                                    <li><a onclick="javascript:imprSelec('M');" style="cursor:pointer;"><img src="../imagenes/print.png" /><b> mostrador</b></a></li>
                                </ul>
                            </ul>
                        </div>
                        <?php
                    }
                }
                ?>
                <?php if ($activo && $_SERVER['REMOTE_USER'] != 'recepcion') { ?>
                    <img src="../imagenes/lock1.png" class="candado" onclick="mostrarMarcar()" id="candado"/>
                    <input <?php if ($_SERVER['REMOTE_USER'] == 'recepcion') { ?> style="display: none" <?php } ?> type="submit" value="Marcar" class="boton_marcar" id="marcar" style="display:none" />
                <?php } else { ?>
                    <input type="submit" value="Marcar" style="display:none;" class="boton_marcar" id="marcar" />
                <?php } ?>
                <a href="../pedidosv/pedidosv.php?numes=<?php echo calcular_numesv(); ?>&dia=<?php echo calcular_diav(); ?>&mes=<?php echo calcular_mesv(); ?>&ano=<?php echo calcular_anov(); ?>" class="boton_act" >Actualizar</a>
                </form>
                <?php
            } else {
                if (isset($_GET['diasemana']) and $_GET['diasemana'] > 5)
                    echo "<div class='resultado'>Festivo</div>";
                elseif ($_GET['numes'] == 11 and $_GET['dia'] == 1)
                    echo "<div class='resultado'>Dia de los santos</div>";
                elseif ($_GET['numes'] == 12 and $_GET['dia'] == 24)
                    echo "<div class='resultado'>Nochebuena</div>";
                elseif ($_GET['numes'] == 12 and $_GET['dia'] == 25)
                    echo "<div class='resultado'>Navidad</div>";
                elseif ($_GET['numes'] == 1 and $_GET['dia'] == 1)
                    echo "<div class='resultado'>Año nuevo</div>";
                elseif ($_GET['numes'] == 5 and $_GET['dia'] == 1)
                    echo "<div class='resultado'>Día del trabajo</div>";
                elseif ($_GET['numes'] == 10 and $_GET['dia'] == 12)
                    echo "<div class='resultado'>Fiesta nacional de España</div>";
                elseif ($_GET['numes'] == 12 and $_GET['dia'] == 6)
                    echo "<div class='resultado'>Día de la Constitución Española</div>";
                elseif ($_GET['numes'] == 1 and $_GET['dia'] == 6)
                    echo "<div class='resultado'>Dia de Reyes</div>";
                elseif ($_GET['numes'] == 12 and $_GET['dia'] == 31)
                    echo "<div class='resultado'>Noche Vieja</div>";
                else
                    echo "<div class='resultado'>No hay lineas</div>";
            }
            include_once '../scripts/pie.php';
            ?>
        </div>
        <?php
        $_POST = Array();
        if (isset($alldia)) {
            ?>
            <!--<div style="position: fixed; top: 140px; left: 20px;">    
                    <div class="lineas">MOSTRADOR <?php echo mysql_num_rows($lineasMostrador); ?> </div>
                    <div class="lineas">TALLER <?php echo mysql_num_rows($lineasTaller); ?> </div>
                    <div class="lineas">TOTAL <?php echo mysql_num_rows($alldia); ?> </div>
                    <div class="lineas"><?php echo strtoupper($_GET['mes']) . " " . mysql_num_rows($allmes); ?> </div>
                    <div class="lineas"><?php echo mysql_num_rows($todas); ?> lineas EN TOTAL.</div>
                </div>-->
        <?php } ?>
        <input class='calendario' type="text" id="calen" />
        <img id="imgcalendario" title="Buscar." onmouseout="this.src = '../imagenes/search.png'" onmouseover="this.src = '../imagenes/searcha.png'" style="position: fixed;top: 55px;left:0px;margin:7px;cursor:pointer" src="../imagenes/search.png" width="40" onclick="verCalendario()"  />
        <div id="calendario" style="position: fixed;top: 115px;left:7px;margin:47px 0px 0 px 7px;display:none">    
            <div>
                <fieldset style="width: 100px;background-color: #ddd;padding: 10px;">
                    <legend>Buscar</legend>
                    <form action="calendario.php" class="find" method="post" name="busqueda">
                        referencia: <input type="text" name="referencia" id="buscarreferencia" /><br/><br/>
                        denominación: <input type="text" name="denominacion" /><br/><br/>
                        matricula: <input type="text" name="matricula" /><br/><br/>
                        <?php if ($_SERVER['REMOTE_USER'] == "medina") { ?> Cliente: Medina <?php } else { ?>  OR/Cliente:  <?php } ?> <input type="text" <?php if ($_SERVER['REMOTE_USER'] == "medina") { ?> value="MEDINA" style="display:none" <?php } ?> name="cliente" /><br/><br/>
                        <input type="submit" value="Buscar" />
                    </form>  
                </fieldset>
            </div>
        </div>
    </body>
</html>