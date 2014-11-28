<link rel="stylesheet" href="../../scripts/jquery-ui.css" />
<link rel="stylesheet" type="text/css" href="../calendario/css/jquery.jdigiclock.css" />
<script src="../../scripts/jquery-1.9.1.js"></script>  
<script src="../../scripts/jquery-ui.js"></script>
<script>
    function objetoAjax() {
        var xmlhttp = false;
        try {
            xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (e) {
            try {
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            catch (E) {
                xmlhttp = false;
            }
        }
        if (!xmlhttp && typeof XMLHttpRequest != 'undefined') {
            xmlhttp = new XMLHttpRequest();
        }
        return xmlhttp;
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
        $("#ventanaRuta").dialog({
            resizable: false,
            autoOpen: false,
            width: 800,
            height: 600,
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
            $("#ventanaRuta").dialog("open");
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
    var seconds = parseInt(<?php echo date('s'); ?>);
    var minutes = parseInt(<?php echo date('i'); ?>);
    var hours = parseInt(<?php echo date('H'); ?>);
    $(document).ready(function() {
        // Create two variable with the names of the months and days in an array
        var monthNames = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
        var dayNames = ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"];
        // Create a newDate() object
        var newDate = new Date();
        // Extract the current date from Date object
        newDate.setDate(newDate.getDate());
        // Output the day, date, month and year   
        $('#Date').html(dayNames[newDate.getDay()] + " " + newDate.getDate() + ' ' + monthNames[newDate.getMonth()] + ' ' + newDate.getFullYear());
        /*setInterval(function() {
         var divaler = document.getElementById('alerta');
         if (valor === 1) {
         divaler.style.background = "trasparent";
         valor = 0;
         } else {
         divaler.style.background = "red";
         valor = 1;
         }
         }, 500);*/

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
<?php if ($_SERVER['REMOTE_USER'] == "chechu") { ?>
            var valor = 1;
<?php } ?>
    });</script>
<?php
mysql_connect("localhost", "chechu");
mysql_select_db("carrion");
$sen = mysql_query("SELECT * FROM nombres WHERE aplicacion = 'oferta'");
$oferta = '';
while ($mes = mysql_fetch_row($sen)) {
    $oferta = $mes[2];
}
?>
<table>
    <tr>
        <td>
            <?php
            if ((date('j') >= 25 and date('n') == 12) or ( date('j') <= 6 and date('n') == 1)) {
                ?> <img id="abrirdesuentos" style="cursor: pointer;left: 10px" src="../../imagenes/navidad.png" width="150px" /> <?php
            } else {
                ?> <img id="abrirdesuentos" style="cursor: pointer;left: 10px" src="../../imagenes/carrion.png" width="150px" /> <?php } ?>
        </td>
        <td style="height: 120px;width: 140px;">
            <ul class = "oferta" style = "display: inline-block;position:absolute;z-index:1;top:25px">
                <li>
                    <img title = "Campaña" src = "../imagenes/campana.png" width = "40px"/>
                    <ul>
                        <li><a href = "#" id = "abrircitroen" >Citroen</a></li>
                        <li><a href = "#" id = "abrirvolvo" >Volvo</a></li>
                        <li><a href = "#" id = "abrirneumaticos" >Neumáticos</a></li>
                    </ul>
                </li>
            </ul>
            <?php
            include '../estilos/conexion.php';
            $recurso = mysql_query("SELECT * FROM incidencias ORDER BY referencia ASC");
            if ($_SERVER['REMOTE_USER'] == "chechu" && mysql_num_rows($recurso) > 0) {
                ?>
                <a href="../incidencias/incidencias.php" style="color:black;" ><div id="alerta" ><?php echo mysql_num_rows($recurso); ?></div></a>
<?php } ?>
        </td>
        <td style="width: 300px;text-align: center">
            <h4 style="color: blue;margin-bottom: 0px;" >Próximo semanal: 
                <?php
                mysql_select_db("carrion");
                $fecha_semanal = mysql_query("SELECT cadena FROM nombres WHERE aplicacion = 'proximoSemanal'");
                $dia_semanal = mysql_fetch_row($fecha_semanal);
                echo utf8_encode($dia_semanal[0]);
                ?></h4>
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
        </td>
        <td style="text-align: center">
            <?php
            $saludo = getdate(time());
            if ($_SERVER['REMOTE_USER'] == "recepcion") {
                if ($saludo['hours'] < 12) {
                    ?><span class="saludo" >Buenos días recepción</span><?php
                } else {
                    ?><span class="saludo" >Buenas tardes recepción</span><?php
                }
            } else if ($_SERVER['REMOTE_USER'] == "medina") {
                if ($saludo['hours'] < 12) {
                    ?><span class="saludo" >Buenos días Medina del Campo</span><?php
                } else {
                    ?><span class="saludo" >Buenas tardes Medina del Campo</span><?php
                }
            } else {
                if ($saludo['hours'] < 12) {
                    ?><span class="saludo" >Buenos días Valladolid</span><?php
                } else {
                    ?><span class="saludo" >Buenas tardes Valladolid</span><?php
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
                            <a href="../../principal/configuracion.php" title="Configuración"><img src="../../imagenes/config.png" /></a> 
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
            <?php if ($_SERVER['REMOTE_USER'] == "medina") {
                ?> <!-- El tiempo --> <?php
            } else {
                ?> <!-- El tiempo --> <?php
            }
            ?>
        </td>
    </tr>
    <tr>
        <td colspan="5">
            <?php
            $aviso = mysql_query("SELECT * FROM nombres WHERE aplicacion = 'aviso';");
            $estado = mysql_query("SELECT * FROM nombres WHERE aplicacion = 'eaviso';");
            $texto = mysql_fetch_row($aviso);
            $sw = mysql_fetch_row($estado);
            ?>
            <div class="aviso" <?php if ($sw[2] == 'si') { ?> style="display: block" <?php } if ($sw[2] == 'no') { ?> style="display: none" <?php } ?> ><img src="../imagenes/peligro.png" style="margin: 0 8px 8px 0;" align="center" border="0" /><?php echo utf8_encode($texto[2]); ?><br/></div>
        </td>
    </tr>
</table>
<div id="ofertacitroen" title="<?php echo $oferta ?>" style="display: none;width: 600px;height: 500px;" >
    <img  src="../documentos/oferta.jpg?<?php echo $oferta ?>" width="100%" height="100%" />
</div>
<div id="ofertavolvo" title="Todo el año" style="display: none;width: 600px;height: 500px;" >
    <img  src="../imagenes/ofertavolvo.jpg" width="100%" height="100%" />
</div>
<div id="ofertaneumaticos" title="Neumáticos" style="display: none;width: 600px;height: 500px;" >
    <img  src="../imagenes/ofertaneumaticos.jpg" width="100%" height="100%" />
</div>
<div id="descuentos" title="Tabla" style="display: none;width: 100px;height: 200px;" >
<?php include_once '../scripts/descuentos.php'; ?>
</div>
<div id="ventanaRuta" title="Ruta" style="display: none;width: 100px;height: 200px;" >
<?php include_once '../reparto/destinos.php'; ?>
</div>