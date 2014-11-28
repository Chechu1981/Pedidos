<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv=Content-Type content="text/html; charset=UTF-8" />
        <title><?php echo "Pedido del " . $_GET['dia'] . " de " . $_GET['mes'] . " de " . $_GET['ano']; ?></title>  
        <link rel="stylesheet" href="../../scripts/jquery-ui.css" />
        <link rel="stylesheet" href="../../scripts/jquery.ui.theme.css" /> 
        <script src="../../scripts/jquery-1.9.1.js"></script>  
        <script src="../../scripts/jquery-ui.js"></script>
        <link rel="shortcut icon" href="../imagenes/chechu.ico" />
        <style>
            #ruta td{
                padding: 3px;
            }
            .enlace{
                padding: 5px;
                color: red;
                cursor: pointer;
            }

            .enlace:hover{
                color: yellow;
            }
        </style>
        <?php include_once '../scripts/estilos.php'; ?>
        <link rel="stylesheet" type="text/css" href="css/jquery.jdigiclock.css" />
        <link rel="stylesheet" href="../scripts/styles.css" type="text/css" />
        <?php
        include '../calendario/calcular_dia.php';
        include '../estilos/conexion.php';

        function activar() {
            $a = false;
            $fecha = getdate(time());
            $mes = $fecha['mon'];
            $hora = $fecha['hours'];
            $ano = $fecha['year'];
            $dia = $fecha['mday'];
            if ($_GET['ano'] > $ano) {
                $a = true;
            } elseif ($_GET['numes'] > $mes and $_GET['ano'] >= $ano) {
                $a = true;
            } elseif ($_GET['dia'] > $dia and $_GET['numes'] >= $mes and $_GET['ano'] >= $ano) {
                $a = true;
            } elseif ($_GET['ano'] == $ano and $_GET['numes'] == $mes and $_GET['dia'] == $dia and $hora < 16) {
                $a = true;
            }
            if ($_GET['numes'] == 11 and $_GET['dia'] == 1) {// dia de los santos
                $a = false;
            } elseif ($_GET['numes'] == 12 and $_GET['dia'] == 24) {// nochebuena
                $a = false;
            } elseif ($_GET['numes'] == 12 and $_GET['dia'] == 25) {// navidad
                $a = false;
            } elseif ($_GET['numes'] == 1 and $_GET['dia'] == 1) {// año nuevo
                $a = false;
            } elseif ($_GET['numes'] == 10 and $_GET['dia'] == 12) {
                $a = false;
            } elseif ($_GET['numes'] == 5 and $_GET['dia'] == 1) {//Dia del trabajador
                $a = false;
            } elseif ($_GET['numes'] == 12 and $_GET['dia'] == 6) {
                $a = false;
            } elseif ($_GET['numes'] == 1 and $_GET['dia'] == 6) {
                $a = false;
            } elseif ($_GET['numes'] == 4 and $_GET['dia'] == 17) { //Jueves Santo
                $a = false;
            } elseif ($_GET['numes'] == 4 and $_GET['dia'] == 18) { //Viernes Santo
                $a = false;
            } elseif ($_GET['numes'] == 12 and $_GET['dia'] == 31) {
                $a = false;
            }
            return $a;
        }

        $activo = activar();

        mysql_connect("localhost", "chechu");
        mysql_select_db("pedidos");

        function actualizar() {
            $sen = mysql_query("SELECT * FROM lineas WHERE fecha_pedido like '" . $_GET['dia'] . $_GET['mes'] . $_GET['ano'] . "' ORDER BY pedido,destino,cliente;");
            if (@mysql_num_rows($sen) > 0) {
                while ($fila = mysql_fetch_row($sen)) {
                    if (isset($_GET['marcado']) and isset($_POST[$fila[0]])) {
                        mysql_query("UPDATE  lineas SET pedido='checked=\"checked\"' WHERE id='" . $fila[0] . "'");
                    } elseif (isset($_GET['marcado'])) {
                        mysql_query("UPDATE lineas SET pedido='' WHERE id='" . $fila[0] . "'");
                    }
                    if (isset($_GET['marcado']) and isset($_POST['ps' . $fila[0]])) {
                        mysql_query("UPDATE lineas SET ps='checked=\"checked\"' WHERE id='" . $fila[0] . "'");
                    } elseif (isset($_GET['marcado'])) {
                        mysql_query("UPDATE lineas SET ps='' WHERE id='" . $fila[0] . "'");
                    }
                }
            }
        }

        mysql_select_db("carrion");
        $clientes = mysql_query("SELECT * FROM hoja1;");
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
                if (!xmlhttp && typeof XMLHttpRequest !== 'undefined') {
                    xmlhttp = new XMLHttpRequest();
                }
                return xmlhttp;
            }
            var n_pieza = objetoAjax();
            var mail = objetoAjax();
            var ajax = new XMLHttpRequest();
            var fondo = objetoAjax();

            function cambiarfondo(color) {
                fondo.open('GET', '../principal/cambiarfondo.php?color=' + color, true);
                fondo.send(null);
                document.body.style.backgroundColor = color;
            }
            function enviard() {
                var ref = document.getElementById('referencia').value;
                ajax.open('GET', 'denominacion.php?ref=' + ref, true);
                ajax.send(null);
                ajax.onreadystatechange = respuestad;
            }
            function respuestad() {
                var div = document.getElementById('deno');
                if (ajax.readyState === 4) {
                    div.value = ajax.responseText;
                } else {
                    div.value = "";
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
            var seconds = parseInt(<?php echo date('s'); ?>);
            var minutes = parseInt(<?php echo date('i'); ?>);
            var hours = parseInt(<?php echo date('H'); ?>);
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
                    seconds++;
                    if (seconds >= 60) {
                        seconds = 0;
                        minutes++;
                    }
                    if (minutes >= 60) {
                        minutes = 0;
                        hours++;
                    }
                    if (hours >= 24) {
                        hours = 0;
                    }
                    // Add a leading zero to seconds value
                    $("#sec").html((seconds < 10 ? "0" : "") + seconds);
                    $("#min").html((minutes < 10 ? "0" : "") + minutes);
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
                if (hora == 16 && min == 0 && seg == 30) {
                    alert("Pedido finalizado");
                    document.location.href = "../calendario/pedidos.php?numes=<?php echo calcular_numes(); ?>&dia=<?php echo calcular_dia(); ?>&mes=<?php echo calcular_mes(); ?>&ano=<?php echo calcular_ano(); ?>";
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
            var t = setTimeout('document.location.href="../calendario/pedidos.php?numes=<?php echo calcular_numes(); ?>&dia=<?php echo calcular_dia(); ?>&mes=<?php echo calcular_mes(); ?>&ano=<?php echo calcular_ano(); ?>"', 600000);
            function imprSelec(nombre) {
                var ficha = document.getElementById(nombre);
                var ventimp = window.open('', 'imprimir');
                ventimp.document.write('<style>table, td, th{border:1px solid black;} </style><img src="../imagenes/logo_Citroen.png" width="90" style="float: left;margin: 8px" /><h2><?php echo "Pedido del " . $_GET['dia'] . " de " . $_GET['mes'] . " de " . $_GET['ano']; ?></h2>');
                ventimp.document.write(ficha.innerHTML);
                ventimp.document.close();
                ventimp.print();
                ventimp.close();
            }
            function imprRuta() {
                var ficha = document.getElementById('ruta');
                var ventimp = window.open('', 'imprimir');
                ventimp.document.write('<style>table, td, th{border:1px solid black;} </style><h2><?php echo "Ruta del " . $_GET['dia'] . " de " . $_GET['mes'] . " de " . $_GET['ano']; ?></h2>');
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
                    if (document.caja.elements[i].type === "checkbox") {
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
            function mostrarsalida() {
                selecionar = document.getElementById("salida");
                th = document.getElementById("salidat");
                th.style.display = "none";
                selecionar.style.display = "none";
                var age = document.getElementById('agente');
                var ref = document.getElementById('cliente');
                ref.disabled = false;
                ref.style.display = "block";
                age.disabled = true;
                age.style.display = "none";
                ref.focus();
            }
            function ocultarsalida() {
                selecionar = document.getElementById("salida");
                selecionar.style.display = "table-cell";
                th = document.getElementById("salidat");
                th.style.display = "block";
            }
            function comprobar() {
                var salida = document.getElementById("tipo");
                //var dial=document.getElementById("tipo1");
                var tipo = document.getElementsByName("destino");
                if ((salida.value === "NULO" && tipo.item(1).checked)) {//||(dial.value == "nulo" && tipo.item(1).checked)){
                    $(function() {
                        $("#dialog:ui-dialog").dialog("destroy");
                        $("#miVentana").dialog({
                            height: 140,
                            width: 350,
                            modal: true
                        });
                    });
                    /*var ventana = document.getElementById('miVentana');
                     ventana.style.marginTop = "100px";
                     ventana.style.left = ((document.body.clientWidth-350) / 2) +  "px";
                     ventana.style.display = 'block';
                     dial.focus();*/
                } else {
                    document.pedido.submit();
                }
            }
            function comprobar2() {
                var seleccion = document.getElementById('tipo');
                var emergente = document.getElementById('tipo1');
                emergente.disabled = true;
                seleccion.selectedIndex = emergente.selectedIndex;
                document.pedido.submit();
            }
            function intro(tecla) {
                if (window.event.keyCode === 13) {
                    comprobar();
                }
            }
            function ver() {
                $(function() {
                    $("#dialog:ui-dialog").dialog("destroy");
                    $("#estadisticas").dialog({
                        height: 580,
                        width: 450,
                        modal: true,
                        show: "fold",
                        hide: "explode",
                        title: 'Estadísticas'
                    });
                });
            }
            function cambio_salida(id) {
                $respuesta = confirm("¿Quieres cambiar el tipo de salida?");
                if ($respuesta) {
                    var salida = document.getElementById(id).innerHTML;
                    var frame = window.document.createElement('iframe');
                    if (salida === "CREDITO") {
                        frame.setAttribute('src', 'actualizar.php?id=' + id + '&salida=CONTADO');
                        frame.setAttribute('width', 500);
                        frame.setAttribute('heigth', 500);
                        document.body.appendChild(frame);
                        alert("Tipo de salida cambiado a contado");
                    } else if (salida === "CONTADO") {
                        frame.setAttribute('src', 'actualizar.php?id=' + id + '&salida=SOC');
                        frame.setAttribute('width', 500);
                        frame.setAttribute('heigth', 500);
                        document.body.appendChild(frame);
                        alert("Tipo de salida cambiado a SOC");
                    } else {
                        frame.setAttribute('src', 'actualizar.php?id=' + id + '&salida=CREDITO');
                        frame.setAttribute('width', 500);
                        frame.setAttribute('heigth', 500);
                        document.body.appendChild(frame);
                        alert("Tipo de salida cambiado a Crédito");
                    }
                    document.location.href = "../calendario/pedidos.php?numes=<?php echo calcular_numes(); ?>&dia=<?php echo calcular_dia(); ?>&mes=<?php echo calcular_mes(); ?>&ano=<?php echo calcular_ano(); ?>";
                }
            }
            function eliminarlinea(id) {
                var frame = window.document.createElement('iframe');
                frame.setAttribute('src', 'eliminar.php?id=' + id);
                frame.setAttribute('width', 0);
                frame.setAttribute('heigth', 0);
                document.body.appendChild(frame);
            }
            function comprobar1(salida, id) {
                window.open('salida.php?id=' + id + '?salida=' + salida);
            }
            function confirmar_linea_pedido(id, referencia) {
                $respuesta = confirm("¿Quieres eliminar la referencia " + referencia + "?");
                if ($respuesta) {
                    eliminarlinea(id);
                    alert(referencia + " eliminada.");
                    document.location.href = "../calendario/pedidos.php?numes=<?php echo calcular_numes(); ?>&dia=<?php echo calcular_dia(); ?>&mes=<?php echo calcular_mes(); ?>&ano=<?php echo calcular_ano(); ?>";
                }
            }
            function soc() {
                var age = document.getElementById('agente');
                var salida = document.getElementById('tipo');
                var ref = document.getElementById('cliente');
                if (salida.value === "SOC") {
                    ref.disabled = true;
                    ref.style.display = "none";
                    age.disabled = false;
                    age.style.display = "block";
                    age.focus();
                } else {
                    ref.disabled = false;
                    ref.style.display = "block";
                    age.disabled = true;
                    age.style.display = "none";
                    age.focus();
                }
            }
            function mostrarMarcar() {
                marc = document.getElementById('marcar');
                cand = document.getElementById('candado');
                if (marc.style.display === "none") {
                    marc.style.display = "block";
                    cand.src = "../imagenes/lock.png";
                } else {
                    marc.style.display = "none";
                    cand.src = "../imagenes/lock1.png";
                }
            }

            var comen = new XMLHttpRequest();
            function comentarios(id) {
                var cadena = document.getElementById("comentario" + id).value;
                comen.open('GET', 'comentarios.php?id=' + id + '&com=' + cadena, true);
                comen.send(null);
            }

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
            function mostrar_buscar() {
                $(function() {
                    $("#dialog:ui-dialog").dialog("destroy");
                    $("#find").dialog({
                        height: 850,
                        width: 950,
                        modal: true,
                        show: "fold",
                        hide: "explode",
                        title: 'Buscar'
                    });
                });
            }
            function tratarFecha(dia, mes, ano) {
<?php $funcionTratarFecha; ?>
            }
            function verCalendario() {
                if (document.getElementById('calendario').style.display == "none") {
                    $('#calendario').show('blind', 200);
                    document.getElementById('imgcalendario').src = "../imagenes/searcha.png";
                } else {
                    $('#calendario').hide('slide');
                    document.getElementById('imgcalendario').src = "../imagenes/search.png";
                }
            }
            function dale() {
                var btn = document.getElementById('act');
                document.getElementById('result').innerHTML = btn;
            }
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
                $("#ruta").dialog({
                    resizable: false,
                    autoOpen: false,
                    width: 500,
                    height: 700,
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
                $("#abrirruta").click(function() {
                    $("#ruta").dialog("open");
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
            
            /*function nueva_pieza() {
                var ref = document.getElementById('referencia').value;
                var den = document.getElementById('deno').value;
                n_pieza.open('GET', 'nuevapieza.php?ref=' + ref + '&den=' + den, true);
                n_pieza.send(null);
            }*/

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
                        window.location.href = "pedidos.php?ano=" + fecha[3] + "&mes=" + fecha[1] + "&numes=" + fecha[2] + "&dia=" + fecha[0];
                    }
                });
            });
        </script>
    </head>
    <body onload="javascript:foco();
                  cargar();" >
        <span style="margin: 200px 0 0 200px" onclick="dale()"></span>
        <sup id="result"></sup>
        <div id="hora" ></div>
        <div id="miVentana" style="display: none;" >
            Salida:
            <select onchange="comprobar2()" style="font-size:36px;margin:auto" id="tipo1" name="tipo" >
                <option value="NULO">Salida</option>
                <option value="CONTADO">0 Contado</option>
                <option value="CREDITO">1 Crédito</option>
                <option value="SOC">2 SOC</option>
            </select>
        </div>
        <div id="cambio" style="display: none;" >
            Salida:
            <select onchange="actualizar()" style="font-size:36px;margin:auto" id="tipo2" name="tipo" >
                <option value="NULO">Salida</option>
                <option value="CONTADO">0 Contado</option>
                <option value="CREDITO">1 Crédito</option>
                <option value="SOC">2 SOC</option>
            </select>
        </div>
        <div class="contenedor">
            <table>
                <tr>
                    <td>
                        <?php
                        $activo = activar();
                        if ((date('j') >= 25 and date('n') == 12) or (date('j') <= 6 and date('n') == 1)) {
                            ?>
                            <img id="abrirdesuentos" style="cursor: pointer;left: 10px" src="../imagenes/navidad.png" width="150" /><div style="clear: both"></div>
                        <?php } else { ?>
                            <img id="abrirdesuentos" style="cursor: pointer;left: 10px" src="../imagenes/carrion.png" width="150" /><div style="clear: both"></div>
                        <?php } ?>
                    </td>
                    <td style="height: 120px;width: 140px;">
                        <ul class="oferta" style="display: inline-block;position: absolute; top:25px;z-index:1;">
                            <li>
                                <img title="Campaña" src="../imagenes/campana.png" width="40"/>
                                <ul>
                                    <li><a href="#" id="abrircitroen" >Citroen</a></li>
                                    <li><a href="#" id="abrirvolvo" >Volvo</a></li>
                                    <li><a href = "#" id = "abrirneumaticos" >Neumáticos</a></li>
                                </ul>
                            </li>
                        </ul>
                        <?php
                        include '../estilos/conexion.php';
                        $recurso = mysql_query("SELECT * FROM incidencias ORDER BY referencia ASC");
                        if ($_SERVER['REMOTE_USER'] == "chechu" && mysql_num_rows($recurso) > 0) {
                            ?>
                            <div id="alerta" ><?php echo mysql_num_rows($recurso); ?></div>
                        <?php } ?>
                    </td>
                    <td style="width: 300px;text-align: center">
                        <h4 style="color: blue;margin-bottom: 0.5px;">Próximo semanal: 
                            <?php
                            mysql_select_db("carrion");
                            $fecha_semanal = mysql_query("SELECT cadena FROM nombres WHERE aplicacion = 'proximoSemanal'");
                            $dia_semanal = mysql_fetch_row($fecha_semanal);
                            echo utf8_encode($dia_semanal[0]);
                            ?></h4>
                        <div style="margin: 8px;width: 200px;float: right;">
                            <div id="cuenta" style="float:left;right: 10px;font-weight: bold;"></div>
                            <div class="clock" >
                                <div id="Date" ></div>
                                <ul >
                                    <li id="hours">00</li>
                                    <li id="point">:</li>
                                    <li id="min">00</li>
                                    <li id="point">:</li>
                                    <li id="sec">00</li>
                                </ul>
                            </div>
                        </div>
                    </td>
                    <td>
                        <table>
                            <tr>
                                <td style="text-align: center;">
                                    <?php
                                    mysql_select_db("carrion");
                                    $sen = mysql_query("SELECT * FROM nombres WHERE aplicacion = 'oferta'");
                                    $oferta = '';
                                    while ($mes = mysql_fetch_row($sen))
                                        $oferta = $mes[2];
                                    mysql_select_db("pedidos");
                                    $saludo = getdate(time());
                                    if ($_SERVER['REMOTE_USER'] == "medina") {
                                        if ($saludo['hours'] < 12) {
                                            ?><span class="saludo" >Buenos días <br/> Medina del Campo</span><?php
                                        } else {
                                            ?><span class="saludo" >Buenas tardes <br/>Medina del Campo</span><?php
                                        }
                                    } else if ($_SERVER['REMOTE_USER'] == "recepcion") {
                                        if ($saludo['hours'] < 12) {
                                            ?><span class="saludo" >Buenos días recepción</span><?php
                                        } else {
                                            ?><span class="saludo" >Buenas tardes recepción</span><?php
                                        }
                                    } else {
                                        if ($saludo['hours'] < 12) {
                                            ?><span class="saludo" >Buenos días Valladolid</span><?php
                                        } else {
                                            ?><span class="saludo" >Buenas tardes Valladolid</span><?php
                                        }
                                    }
                                    ?>  
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: center;">
                                    <?php
                                    if ($_SERVER['REMOTE_USER'] != "medina") {
                                        ?>
                                        <span class="estadisticas" onclick="ver()">Mostrar estadísticas</span>
                                    <?php } ?> 
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:center">Semanal Volvo:<br/>J V L (Miércoles)<br/>M X (Viernes)<br/> </td>
                            </tr>
                        </table>
                    </td>
                    <td>
                        <table>
                            <tr>
                                <td>
                                    <?php if ($_SERVER['REMOTE_USER'] == "chechu") {
                                        ?> <a href="../../principal/configuracion.php" title="Configuración"><img src="../../imagenes/config.png" height="20" /></a> <?php }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-top: 15px;">
                                    <div style="display: inline-block; width: 10px;height: 10px; background-color: #ABABAB;cursor: pointer;" onclick="cambiarfondo('#ABABAB')" ></div>
                                    <div style="display: inline-block; width: 10px;height: 10px; background-color: #00907D;cursor: pointer;" onclick="cambiarfondo('#00907D')" ></div>
                                    <div style="display: inline-block; width: 10px;height: 10px; background-color: #CD928E;cursor: pointer;" onclick="cambiarfondo('#CD928E')" ></div>
                                    <div style="display: inline-block; width: 10px;height: 10px; background-color: #f0f0f0;cursor: pointer;" onclick="cambiarfondo('#ffffff')" ></div>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="7">
                        <?php
                        if ($_SERVER['REMOTE_USER'] == "medina") {
                            ?>
                            <!-- El tiempo --> 
                        <?php } else { ?>
                            <!-- El tiempo --> 
                        <?php } ?>
                    </td>
                </tr>
            </table>
            <div class="principal">
                <?php
                mysql_select_db("carrion");
                $aviso = mysql_query("SELECT * FROM nombres WHERE aplicacion = 'aviso';");
                $estado = mysql_query("SELECT * FROM nombres WHERE aplicacion = 'eaviso';");
                $texto = mysql_fetch_row($aviso);
                $sw = mysql_fetch_row($estado);
                ?>
                <div class="aviso" <?php if ($sw[2] == 'si') { ?> style="display: block" <?php } if ($sw[2] == 'no') { ?> style="display: none" <?php } ?> ><img src="../imagenes/peligro.png" style="margin: 0 8px 8px 0;" align="center" border="0" /><?php echo utf8_encode($texto[2]); ?><br/></div>
                <?php
                include_once '../scripts/menu.php';
                mysql_select_db("pedidos");
                ?>
                <div class="banda">
                    <img src="../imagenes/logo_Citroen.png" width="90" style="float: left;margin: 8px" /><h2 style="padding:15px;"><?php echo "Pedido del " . $_GET['dia'] . " de " . $_GET['mes'] . " de " . $_GET['ano']; ?></h2>
                    <a href="calendario.php" target="_self">
                        <div id="nuevo">
                            Calendario
                        </div>
                    </a>
                    <a href="#" id="abrirruta">
                        <div id="nuevo">Ruta</div>
                    </a>
                    <a href="<?php echo "./ficheros/" . $_GET['dia'] . $_GET['mes'] . $_GET['ano']; ?>.csv" target="_blank" >
                        <div id="nuevo">Fichero</div>
                    </a>
                </div>

                <?php
                if (isset($_GET['diasemana']) and $_GET['diasemana'] > 5)
                    $activo = false;
                if ($activo) {
                    ?>
                    <?php if ($_SERVER['REMOTE_USER'] != "recepcion") { ?>
                        <form style="clear:both;" class="formulariopedido" action="pedidos.php?numes=<?php echo $_GET['numes']; ?>&dia=<?php echo $_GET['dia'] ?>&mes=<?php echo $_GET['mes'] ?>&ano=<?php echo $_GET['ano'] ?>" method="post" name="pedido" >
                            <table>
                                <th>Referencia</th>
                                <th width='10px;'>C</th>
                                <th>Denominación</th>
                                <th style="padding-left: 20px;padding-right: 20px">Destino</th>
                                <th <?php if ($_SERVER['REMOTE_ADDR'] == '10.159.64.47' or $_SERVER['REMOTE_ADDR'] == '10.159.64.58' or $_SERVER['REMOTE_USER'] == "medina") { ?> style="display: none;" <?php } ?> id="salidat">Salida</th>
                                <th>Cliente/OR</th>
                                <th>Matrícula/Comentario</th>
                                <tr>
                                    <td><input onblur="enviard()" style="width:110px;" type="text" name="referencia" id="referencia" /></td>
                                    <td><input onkeyup="intro(event)" width="10px;" style="text-align:right;width:30px;" type="text" name="cantidad"  /></td>
                                    <td><input onkeyup="intro(event)" onkeypress="nueva_pieza()" type="text" id="deno" name="denominacion"  /></td>
                                    <td>
                                        <?php
                                        if ($_SERVER['REMOTE_ADDR'] == '10.159.64.47' or $_SERVER['REMOTE_ADDR'] == '10.159.64.58') {
                                            ?>
                                            <input onkeyup="intro(event)" type="radio"  name="destino" value="T" checked="checked" onclick="javascript:mostrarsalida();" ><span style="font-size:12px">Taller</span></input><br/>
                                            <input onkeyup="intro(event)" type="radio" name="destino" value="M" onclick="javascript:ocultarsalida();" ><span style="font-size:12px">Mostrador</span></input><br/>
                                        <?php } else { ?>
                                            <?php if ($_SERVER['REMOTE_USER'] != "medina") { ?>
                                                <input onkeyup="intro(event)" type="radio" name="destino" value="T" onclick="javascript:mostrarsalida();" ><span style="font-size:12px">Taller</span></input><br/>
                                            <?php } ?>
                                            <input onkeyup="intro(event)" type="radio" name="destino" value="M" checked="checked" <?php if ($_SERVER['REMOTE_USER'] != "medina") { ?> onclick="javascript:ocultarsalida();" <?php } ?> ><span style="font-size:12px">Mostrador</span></input><br/>
                                        <?php } ?>
                                    </td>
                                    <?php if ($_SERVER['REMOTE_USER'] == "medina") { ?>
                                        <td style="display:none;" id="salida">
                                            <select disabled="true" id="tipo" name="tipo" >
                                                <option value="NULO">Salida</option>
                                                <option value="CONTADO">0 Contado</option>
                                                <option value="CREDITO">1 Crédito</option>
                                                <option selected="selected" value="SOC">2 SOC</option>
                                            </select>
                                        </td>
                                    <?php } else { ?>
                                        <td <?php if ($_SERVER['REMOTE_ADDR'] == '10.159.64.47' or $_SERVER['REMOTE_ADDR'] == '10.159.64.58') { ?>style="display: none;" <?php } ?> id="salida">
                                            <select onblur="soc()" id="tipo" name="tipo" style="width:88px;" >
                                                <option value="NULO">Salida</option>
                                                <option value="CONTADO">0 Contado</option>
                                                <option value="CREDITO">1 Crédito</option>
                                                <option value="SOC">2 SOC</option>
                                            </select>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <input onkeyup="intro(event)" type="text" name="cliente" id="cliente" style="text-align:center;width: 100px;" <?php if ($_SERVER['REMOTE_ADDR'] == '10.159.64.47' or $_SERVER['REMOTE_ADDR'] == '10.159.64.58') { ?> style="display: none;" <?php } ?>  <?php if ($_SERVER['REMOTE_USER'] == "medina") { ?>value="MEDINA" disabled="true" <?php } ?> />
                                        <select onkeyup="intro(event)" style="display:none" disabled="true" id="agente" name="cliente" >
                                            <?php
                                            include_once 'agentes.php';
                                            mysql_select_db("pedidos");
                                            ?>
                                        </select>
                                    </td>
                                    <td><textarea onkeyup="intro(event)"  name="matricula" rows="3" ></textarea></td>
                                </tr>
                            </table>
                            <input style="border:1px solid black; border-width: 1px 3px 3px 1px;border-radius: 4px;background-color: gainsboro;box-shadow: black 1px ;padding:10px;" onfocus="comprobar()" type="button" value="Añadir" />
                        </form>

                        <?php
                    }
                    actualizar();
                } else {
                    if (isset($_GET['diasemana']) and $_GET['diasemana'] > 5) {
                        echo "";
                    } elseif (
                            ($_GET['numes'] == 12 and $_GET['dia'] == 6) ||
                            ($_GET['numes'] == 12 and $_GET['dia'] == 31) ||
                            ($_GET['numes'] == 10 and $_GET['dia'] == 12) ||
                            ($_GET['numes'] == 11 and $_GET['dia'] == 1) ||
                            ($_GET['numes'] == 12 and $_GET['dia'] == 24) ||
                            ($_GET['numes'] == 12 and $_GET['dia'] == 25) ||
                            ($_GET['numes'] == 1 and $_GET['dia'] == 1) ||
                            ($_GET['numes'] == 1 and $_GET['dia'] == 6) ||
                            ($_GET['numes'] == 4 and $_GET['dia'] == 17) ||
                            ($_GET['numes'] == 4 and $_GET['dia'] == 18) ||
                            ($_GET['numes'] == 5 and $_GET['dia'] == 1)) {
                        echo "";
                    } else {
                        ?><div class='resultado'>Pedido Realizado</div><?php
                    }
                }

                //Crear filas
                if (isset($_POST['referencia']) and $_POST['referencia'] != "") {
                    if ($_SERVER['REMOTE_USER'] == "medina") {
                        mysql_query("INSERT INTO lineas 
                            (referencia,cantidad,denominacion,matricula,cliente,fecha,destino,fecha_pedido,pedido,ps,salida)
                            VALUES('" . strtoupper($_POST['referencia']) . "',
                                '" . strtoupper($_POST['cantidad']) . "',
                                '" . strtoupper($_POST['denominacion']) . "',
                                '" . strtoupper($_POST['matricula']) . "',
                                'MEDINA (300511)',
                                NOW(),
                                '" . $_POST['destino'] . "',
                                '" . $_GET['dia'] . $_GET['mes'] . $_GET['ano'] . "',
                                '',
                                '',
                                'SOC');");
                    } else {
                        mysql_query("INSERT INTO lineas 
                            (referencia,cantidad,denominacion,matricula,cliente,fecha,destino,fecha_pedido,pedido,ps,salida)
                            VALUES('" . strtoupper($_POST['referencia']) . "',
                                '" . strtoupper($_POST['cantidad']) . "',
                                '" . strtoupper($_POST['denominacion']) . "',
                                '" . strtoupper($_POST['matricula']) . "',
                                '" . strtoupper($_POST['cliente']) . "',
                                NOW(),
                                '" . $_POST['destino'] . "',
                                '" . $_GET['dia'] . $_GET['mes'] . $_GET['ano'] . "',
                                '',
                                '',
                                '" . $_POST['tipo'] . "');");
                    }
                }
                //ver las lineas que hay
                ?></div><div style='float:left;' id='tabla'><?php
                actualizar();
                $contador = 1;
                if ($_SERVER['REMOTE_USER'] == "medina") {
                    @$sentencia = mysql_query("SELECT * FROM lineas WHERE fecha_pedido LIKE '" . $_GET['dia'] . $_GET['mes'] . $_GET['ano'] . "' AND cliente LIKE '%MEDINA%' ORDER BY pedido,destino,cliente,referencia;");
                } else {
                    @$sentencia = mysql_query("SELECT * FROM lineas WHERE fecha_pedido LIKE '" . $_GET['dia'] . $_GET['mes'] . $_GET['ano'] . "' ORDER BY pedido,destino,cliente,referencia;");
                }
                if (@mysql_num_rows($sentencia) > 0) {
                    $senruta = mysql_query("SELECT CODIGO,NOMBRE,POBLACION,RUTA FROM CARRION.HOJA1 WHERE RUTA = 1 AND CODIGO IN (SELECT DISTINCT SUBSTR(cliente,-7,6) AS CODIGO FROM PEDIDOS.LINEAS WHERE fecha_pedido LIKE '" . $_GET['dia'] . $_GET['mes'] . $_GET['ano'] . "' AND destino LIKE 'M') OR RUTA = 1 AND CODIGO IN  (SELECT DISTINCT SUBSTR(cliente,-7,6) AS CODIGO FROM PEDIDOS.LINEASVOLVO WHERE fecha_pedido LIKE '" . $_GET['dia'] . $_GET['mes'] . $_GET['ano'] . "' AND destino LIKE 'M')");
                    $lineasTaller = mysql_query("SELECT * FROM lineas WHERE fecha_pedido LIKE '" . $_GET['dia'] . $_GET['mes'] . $_GET['ano'] . "' AND destino LIKE 'T' ORDER BY pedido,destino,cliente,referencia;");
                    $lineasMostrador = mysql_query("SELECT * FROM lineas WHERE fecha_pedido LIKE '" . $_GET['dia'] . $_GET['mes'] . $_GET['ano'] . "' AND destino LIKE 'M' ORDER BY pedido,destino,cliente,referencia;");
                    $alldia = mysql_query("SELECT * FROM lineas WHERE fecha_pedido LIKE '" . $_GET['dia'] . $_GET['mes'] . $_GET['ano'] . "' ORDER BY pedido,destino,cliente,referencia;");
                    $allmes = mysql_query("SELECT * FROM lineas WHERE  fecha_pedido LIKE '%" . $_GET['mes'] . $_GET['ano'] . "%' ORDER BY pedido,destino,cliente,referencia;");
                    $todas = mysql_query("SELECT * FROM lineas;");
                    $credito = mysql_query("SELECT * FROM lineas WHERE fecha_pedido LIKE '%" . $_GET['mes'] . $_GET['ano'] . "%' AND salida LIKE 'CREDITO' AND destino = 'M'");
                    $contado = mysql_query("SELECT * FROM lineas WHERE fecha_pedido LIKE '%" . $_GET['mes'] . $_GET['ano'] . "%' AND salida LIKE 'CONTADO' AND destino = 'M'");
                    $taller = mysql_query("SELECT * FROM lineas WHERE fecha_pedido LIKE '%" . $_GET['mes'] . $_GET['ano'] . "%' AND destino = 'T'");
                    $soc = mysql_query("SELECT * FROM lineas WHERE fecha_pedido LIKE '%" . $_GET['mes'] . $_GET['ano'] . "%' AND salida LIKE 'SOC' AND destino = 'M'");
                    $acumulado = mysql_query("SELECT ROUND(SUM((pvp*((100-dto)/100))*cantidad),2) FROM denominacion_precio,lineas WHERE denominacion_precio.referencia = lineas.referencia AND fecha_pedido LIKE '" . $_GET['dia'] . $_GET['mes'] . $_GET['ano'] . "';");
                    $maxlineas = mysql_query("SELECT COUNT( REFERENCIA ) , FECHA_PEDIDO FROM LINEAS GROUP BY FECHA_PEDIDO ORDER BY COUNT( REFERENCIA )DESC LIMIT 0 , 1");

                    if ($_SERVER['REMOTE_USER'] != "recepcion") {
                        ?>
                        <div class="lineas"><?php echo mysql_num_rows($sentencia); ?> LINEAS.</div>
                        <?php
                    }
                    //Formulario de lineas marcadas
                    ?>
                    <?php
                    $precio = mysql_fetch_row($acumulado);
                    if ($_SERVER['REMOTE_USER'] != "medina" or $_SERVER['REMOTE_USER'] != "recepcion") {
                        ?>
                            <!--<div class="pvp"><?php echo $precio[0] . " €"; ?></div>-->
                    <?php } if ($_SERVER['REMOTE_USER'] != "recepcion") { ?>
                        <form action="pedidos.php?numes=<?php echo $_GET['numes']; ?>&dia=<?php echo $_GET['dia'] ?>&mes=<?php echo $_GET['mes'] ?>&ano=<?php echo $_GET['ano'] ?>&marcado=si" name="caja" method="POST">
                            <div id="M">
                                <h2 align="center">Pedido de mostrador</h2>
                                <table width='780px;' class='listado'>
                                    <tr>
                                        <th style='border-right: 1px solid windowtext;'></th>
                                        <th>Referencia</th>
                                        <th width='50px;'>C</th>
                                        <th style="padding-left: 40px;padding-right: 40px">Denominación</th>
                                        <?php
                                        if ($activo) {
                                            ?><th style="padding: 0"><!--<button <?php if ($_SERVER['REMOTE_USER'] == 'recepcion') { ?> disabled="disabled" <?php } ?> onclick="comentarios()" title="Guardar comentario" class="boton_comentario" >Matrícula/Comentario</button>-->Matrícula/Comentario</th><th>Cliente/OR</th><th style="padding-left: 45px;padding-right: 45px"> Hora </th><th></th><th>SALIDA</th><th><input<?php if ($_SERVER['REMOTE_USER'] == 'recepcion') { ?> disabled="disabled" <?php } ?> title="Seleccionar todas las lineas" onclick="javascript:seleccionar();" type="checkbox"  class="caja" /></th><th>PS</th><?php
                                            } else {
                                                ?><th>Matrícula/Comentario</th><th>Cliente/OR</th><th style="padding-left: 45px;padding-right: 45px"> Hora </th><th></th><th>SALIDA</th><th>PS</th><?php
                                                                    }
                                                                    ?><tr><?php
                                                                $numero = 0;
                                                                //Escribo las lineas en la tabla
                                                                if ($_SERVER['REMOTE_USER'] == "medina") {
                                                                    @$sentencia = mysql_query("SELECT * FROM lineas WHERE destino LIKE 'M' AND fecha_pedido like '" . $_GET['dia'] . $_GET['mes'] . $_GET['ano'] . "' AND cliente LIKE '%MEDINA%' ORDER BY pedido,destino,cliente,referencia;");
                                                                } else {
                                                                    @$sentencia = mysql_query("SELECT * FROM lineas WHERE destino LIKE 'M' AND fecha_pedido like '" . $_GET['dia'] . $_GET['mes'] . $_GET['ano'] . "' ORDER BY pedido,destino,cliente,referencia;");
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
                                        <td class='numero' style='border-right: 1px solid windowtext;'>" . $contador++ . "</td>
					<td>" . $fila[1] . "</td>
					<td style='text-align:center;'>" . $fila[2] . "</td>
					<td>" . $fila[3] . "</td>";
                                                                    if ($activo) {
                                                                        if ($_SERVER['REMOTE_USER'] == 'recepcion') {
                                                                            echo "<td><textarea size='50' disabled='disbaled' type='text' name='comentario" . $fila[0] . "' value='" . $fila[4] . "'>" . $fila[4] . "</textarea></td>";
                                                                        } else {
                                                                            echo "<td><textarea size='50' type='text' onblur='comentarios(" . $fila[0] . ")' title='El comentario se grabar cuando se actualice el pedido.' id='comentario" . $fila[0] . "' name='comentario" . $fila[0] . "' value='" . $fila[4] . "'>" . $fila[4] . "</textarea></td>";
                                                                        }
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
                                                                        if ($_SERVER['REMOTE_USER'] == 'recepcion') {
                                                                            echo "<td>
                                                    </td>";
                                                                        } else {
                                                                            echo "<td>
						<a title='ELIMINAR " . $fila[3] . " " . $fila[1] . "' onClick='javascript:confirmar_linea_pedido(" . $fila[0] . ",\"" . $fila[1] . "\");' target='_blank'>
                                                <img src='../imagenes/eliminar.png' style=\"cursor:pointer;\">
						</a>
						</td>";
                                                                        }
                                                                        ?>
                                                    <td <?php
                                                            if ($activo && $_SERVER['REMOTE_USER'] != 'recepcion') {
                                                                echo "onclick='cambio_salida(" . $fila[0] . ")' id='" . $fila[0] . "' style='cursor:pointer'>";
                                                            } else {
                                                                echo ">";
                                                            } echo $fila[11]
                                                                        ?></td>
                                                    <td style="text-align:center;">
                                                        <input type="checkbox" <?php if ($_SERVER['REMOTE_USER'] == 'recepcion') { ?> disabled="disabled" <?php } ?> name='<?php echo $fila[0]; ?>' <?php echo $fila[8]; ?> />
                                                    </td>
                                                    <td style='text-align:center;'>
                                                        <input type="checkbox" <?php if ($_SERVER['REMOTE_USER'] == 'recepcion') { ?> disabled="disabled" <?php } ?> <?php echo $ps; ?> name='<?php echo "ps" . $fila[0]; ?>' <?php echo $fila[9]; ?> />
                                                    </td>
                                                </tr>
                                                <?php
                                            } else {
                                                ?>
                                                <td style="text-align:center;"><input disabled="disabled" type="checkbox" name='<?php echo $numero; ?>' <?php echo $fila[8]; ?> /></td>
                                                <td><?php echo $fila[11]; ?></td>
                                                <td style='text-align:center;'><input disabled="disabled" type="checkbox" name='<?php echo "ps" . $numero; ?>' <?php echo $fila[9]; ?> /></td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?></tr></table>

                            </div>
                            <?php
                        }
                        if ($_SERVER['REMOTE_USER'] != "medina") {
                            ?>
                            <div id="T">
                                <h2 align="center">Pedido de taller</h2>
                                <table width='100%;' class='listado'>
                                    <?php
                                    //Cabecera de la tabla
                                    ?><th style='border-right: 1px solid windowtext;'></th><th>Referencia</th><th width='50px;'>C</th><th style="padding-left: 40px;padding-right: 40px">Denominación</th><th>Matrícula/Comentario</th><th>Cliente/OR</th><th style="padding-left: 45px;padding-right: 45px"> Hora </th><th></th><?php
                                    if ($activo) {
                                        ?><th></th><th>PS</th><?php
                                                                    } else {
                                                                        echo "<th>PS</th>";
                                                                    }
                                                                    $numero = 0;
                                                                    //Escribo las lineas en la tabla
                                                                    @$sentencia = mysql_query("SELECT * FROM lineas WHERE destino LIKE 'T' AND fecha_pedido like '" . $_GET['dia'] . $_GET['mes'] . $_GET['ano'] . "' ORDER BY pedido,destino,cliente,referencia;");
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
                                        <td class='numero' style='border-right: 1px solid windowtext;'>" . $contador++ . "</td>
					<td>" . $fila[1] . "</td>
					<td style='text-align:center;'>" . $fila[2] . "</td>
					<td>" . $fila[3] . "</td>";
                                                                        if ($activo) {
                                                                            if ($_SERVER['REMOTE_USER'] == 'recepcion') {
                                                                                echo "<td><textarea disabled='disabled' size='50' type='text' name='comentario" . $fila[0] . "' value='" . $fila[4] . "'>" . $fila[4] . "</textarea></td>";
                                                                            } else {
                                                                                echo "<td><textarea size='50' type='text' onblur='comentarios(" . $fila[0] . ")' title='El comentario se grabar cuando se actualice el pedido.' id='comentario" . $fila[0] . "' name='comentario" . $fila[0] . "' value='" . $fila[4] . "'>" . $fila[4] . "</textarea></td>";
                                                                            }
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
                                                                            if ($_SERVER['REMOTE_USER'] == 'recepcion') {
                                                                                echo "<td></td>";
                                                                            } else {
                                                                                echo "<td>
						<a title='ELIMINAR " . $fila[3] . " " . $fila[1] . "' onClick='javascript:confirmar_linea_pedido(" . $fila[0] . ",\"" . $fila[1] . "\");' target='_blank'>
                                                <img src='../imagenes/eliminar.png' style=\"cursor:pointer;\">
						</a>
						</td>";
                                                                            }
                                                                            ?>
                                            <td style="text-align:center;">
                                                <input <?php if ($_SERVER['REMOTE_USER'] == 'recepcion') { ?> disabled="disabled" <?php } ?> type="checkbox" name='<?php echo $fila[0]; ?>' <?php echo $fila[8]; ?> />
                                            </td>
                                            <td style='text-align:center;'>
                                                <input<?php if ($_SERVER['REMOTE_USER'] == 'recepcion') { ?> disabled="disabled" <?php } ?> type="checkbox" <?php echo $ps; ?> name='<?php echo "ps" . $fila[0]; ?>' <?php echo $fila[9]; ?> />
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
                <div id="ruta" title="Ruta" style="display:none">
                    <table style="font-size:20px">
                        <tr>
                            <th></th>
                            <th>Taller</th>
                            <th>Poblacion</th>
                        </tr> 
                        <?php
                        $numeros = 1;
                        while ($filruta = mysql_fetch_row($senruta)) {
                            ?>                   
                            <tr>
                                <td><?php echo $numeros++; ?></td>
                                <td><?php echo strtoupper(utf8_encode($filruta[1])); ?></td>
                                <td><?php echo strtoupper(utf8_encode($filruta[2])); ?></td>
                            </tr>
                        <?php } ?>
                    </table>
                    <?php
                    $tiempo = $numeros * 9.5;
                    $horas = (int) ($tiempo / 60);
                    $minutos = (int) ($tiempo - ($horas * 60));
                    if ($minutos < 10) {
                        $minutos = "0" . $minutos;
                    }
                    echo "<h3>Tiempo estimado: " . $horas . ":" . $minutos . "</h3>";
                    ?>
                    <span class="enlace" onclick="imprRuta()">Imprimir</span>
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
                                <li><a onclick="javascript:imprSelec('tabla');" style="cursor:pointer;"><img src="../imagenes/print.png" /><b> todo</b></a></li>
                                <li><a onclick="javascript:imprSelec('T');" style="cursor:pointer;"><img src="../imagenes/print.png" /><b> taller</b></a></li>
                                <li><a onclick="javascript:imprSelec('M');" style="cursor:pointer;"><img src="../imagenes/print.png" /><b> mostrador</b></a></li>
                            </ul>
                        </ul>
                    <?php } ?>
                </div>
                <div class="impresion" style="position: fixed; top: 10px">
                    <?php if ($_SERVER['REMOTE_USER'] == "medina") { ?>
                        <a onclick="javascript:imprSelec('M');" style="cursor:pointer;"><img src="../imagenes/print.png" /><b> Imprimir</b></a>
                    <?php } else if ($_SERVER['REMOTE_USER'] == "recepcion") { ?>
                        <a onclick="javascript:imprSelec('T');" style="cursor:pointer;"><img src="../imagenes/print.png" /><b> Imprimir</b></a>
                    <?php } else { ?>
                        <ul>
                            <li><b>Imprimir</b></li>
                            <ul>
                                <li><a onclick="javascript:imprSelec('tabla');" style="cursor:pointer;"><img src="../imagenes/print.png" /><b> todo</b></a></li>
                                <li><a onclick="javascript:imprSelec('T');" style="cursor:pointer;"><img src="../imagenes/print.png" /><b> taller</b></a></li>
                                <li><a onclick="javascript:imprSelec('M');" style="cursor:pointer;"><img src="../imagenes/print.png" /><b> mostrador</b></a></li>
                            </ul>
                        </ul>
                    <?php } ?>
                </div>
                <?php if ($activo && $_SERVER['REMOTE_USER'] != 'recepcion') { ?>
                    <img src="../imagenes/lock1.png" class="candado" onclick="mostrarMarcar()" id="candado"/>
                    <input type="submit" value="Marcar" style="display: none" class="boton_marcar"  id="marcar"/>
                <?php } ?>
                </form>
                <a id="act" href="../calendario/pedidos.php?numes=<?php echo calcular_numes(); ?>&dia=<?php echo calcular_dia(); ?>&mes=<?php echo calcular_mes(); ?>&ano=<?php echo calcular_ano(); ?>" class="boton_act" style="position:fixed;" >Actualizar</a>
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
                elseif ($_GET['numes'] == 10 and $_GET['dia'] == 12)
                    echo "<div class='resultado'>Fiesta nacional de España</div>";
                elseif ($_GET['numes'] == 12 and $_GET['dia'] == 6)
                    echo "<div class='resultado'>Día de la Constitución Española</div>";
                elseif ($_GET['numes'] == 1 and $_GET['dia'] == 6)
                    echo "<div class='resultado'>Dia de Reyes</div>";
                elseif ($_GET['numes'] == 4 and $_GET['dia'] == 17)
                    echo "<div class='resultado'>Jueves Santo</div>";
                elseif ($_GET['numes'] == 4 and $_GET['dia'] == 18)
                    echo "<div class='resultado'>Viernes Santo</div>";
                elseif ($_GET['numes'] == 5 and $_GET['dia'] == 1)
                    echo "<div class='resultado'>Día del trabajo</div>";
                elseif ($_GET['numes'] == 12 and $_GET['dia'] == 31)
                    echo "<div class='resultado'>Noche Vieja</div>";
                else
                    echo "<div class='resultado'>No hay lineas</div>";
            }
            ?>

            <?php include_once '../scripts/pie.php'; ?>
        </div>
        </div>
        <?php
        $_POST = Array();
        if (isset($alldia)) {
            ?>
            <div id="estadisticas" style="display: none">
                <fieldset>
                    <legend><b><?php echo "Pedido del " . $_GET['dia'] . " de " . $_GET['mes'] . " de " . $_GET['ano']; ?></b></legend>
                    <div class="estadistica">MOSTRADOR <?php echo mysql_num_rows($lineasMostrador); ?> </div>
                    <div class="estadistica">TALLER <?php echo mysql_num_rows($lineasTaller); ?> </div>
                    <div class="estadistica">TOTAL <?php echo mysql_num_rows($alldia); ?> </div>
                </fieldset>
                <fieldset><legend><b><?php echo strtoupper($_GET['mes']) . " " . mysql_num_rows($allmes); ?></b> </legend>
                    <div class="estadistica">CRÉDITO: <?php echo mysql_num_rows($credito); ?></div>
                    <div class="estadistica">CONTADO: <?php echo mysql_num_rows($contado); ?></div>
                    <div class="estadistica">SOC: <?php echo mysql_num_rows($soc); ?></div>
                    <div class="estadistica">TALLER: <?php echo mysql_num_rows($taller); ?></div>
                </fieldset>
                <fieldset>
                    <legend><b>Lineas</b></legend>
                    <?php $max = mysql_fetch_row($maxlineas); ?>
                    <div class="estadistica">Record de lineas: <?php echo $max[1] . ' con ' . $max[0]; ?></div>
                    <div class="estadistica">Lineas totales <?php echo mysql_num_rows($todas); ?></div>
                </fieldset>
            </div>
        <?php } ?>
        <div style="display: none" >
            <iframe src="buscar.php" id="find" width="100%" height="100%" frameborder="0" scrolling="no" style="min-width: 95%;height:100%;" ></iframe>
        </div>
        <input class='calendario' type="text" id="calen" />
        <img id="imgcalendario" title="Buscar." onmouseout="this.src = '../imagenes/search.png'" onmouseover="this.src = '../imagenes/searcha.png'" style="position: fixed;top: 55px;left:0px;margin:7px;cursor:pointer" src="../imagenes/search.png" width="40" onclick="verCalendario()"  />
        <div id="ofertacitroen" title="<?php echo $oferta ?>" style="display: none;width: 600px;height: 500px; margin-top:100px;" >
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
        <div id="calendario" style="position: fixed;top: 115px;left:7px;margin:47px 0px 0px 7px;display:none">
            <fieldset style="width: 100px;background-color: #ddd;padding: 10px;">
                <legend>Buscar</legend>
                <form action="calendario.php" class="find" method="post" name="busqueda">
                    referencia: <input type="text" name="referencia" /><br/><br/>
                    denominación: <input type="text" name="denominacion" /><br/><br/>
                    matricula: <input type="text" name="matricula" /><br/><br/>
                    <?php if ($_SERVER['REMOTE_USER'] == "medina") { ?> Cliente: Medina <?php } else { ?>  OR/Cliente:  <?php } ?> <input type="text" <?php if ($_SERVER['REMOTE_USER'] == "medina") { ?> value="MEDINA" style="display:none" <?php } ?> name="cliente" /><br/><br/>
                    <input type="submit" value="Buscar" />
                </form>  
            </fieldset>
        </div>
        <?php
        $nombre = ".\\ficheros\\" . $_GET['dia'] . $_GET['mes'] . $_GET['ano'] . ".csv";
        mysql_select_db("pedidos");
        @unlink($nombre);
        $fichero = mysql_query("SELECT * FROM lineas WHERE fecha_pedido LIKE '" . $_GET['dia'] . $_GET['mes'] . $_GET['ano'] . "' ORDER BY pedido,destino,cliente,referencia;");
        $ped = fopen($nombre, "w");
        while ($pieza = mysql_fetch_row($fichero)) {
            if ($pieza[8] == "") {
                fputs($ped, $pieza[1]);
                fputs($ped, ";");
                fputs($ped, $pieza[2]);
                fputs($ped, ";");
                fputs($ped, substr($pieza[5], 0, 19));
                fputs($ped, "\n");
            }
        }
        fclose($ped);
        ?>
    </body>
</html>