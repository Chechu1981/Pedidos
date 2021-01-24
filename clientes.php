<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv=Content-Type content="text/html; charset=UTF-8" />
        <title>Clientes</title>
        <link rel="shortcut icon" href="favicon.ico" ></link>
        <?php include_once '../scripts/estilos.php'; ?>
        <link rel="stylesheet" href="../scripts/styles.css" type="text/css" />
        <?php include_once '../calendario/calcular_dia.php'; ?>
        <script src="script.js"></script>
    </head>
    <body onload="document.getElementById('cliente').focus();">
        <div class="contenedor">
            <?php include_once '../scripts/cabecera.php'; ?>
            <div class="principal">
                <?php include_once '../scripts/menu.php'; ?>
            </div>
            <div class="banda">
                <h2 style="padding:15px;">Clientes</h2>
                <?php if ($_SERVER['REMOTE_USER'] != "recepcion") { ?>
                    <div id="nuevo"  onclick="nuevo_cliente()">
                        Nuevo contacto
                    </div>
                <?php } ?>
            </div>
            <div class="cabecera">
                <table style="float: left">
                    <tr class="buscar">
                        <td>Nombre</td><td><input id="cliente" onkeyup="enviarc()" type="text" name="cliente" /></td>
                    </tr><tr class="buscar"><td>Denominación</td><td><input onkeyup="enviarc()" id="denominacion" type="text" name="denom" /></td>
                    </tr><tr class="buscar"><td></td><td></td></tr>
                </table>
                <fieldset style="float:right;font-size: 25px;padding: 10px" >
                    <legend>Filtro</legend>
                    <select onchange="todos()" id="tipo" style="float:right;font-size: 25px" >
                        <option></option>
                        <option> <!--onclick="todos('a')"-->Agentes</option>
                        <option> <!--onclick="todos('e')"-->Eurorepar</option>
                        <option> <!--onclick="todos('m')"-->Sensible</option>
                        <option> <!--onclick="todos()"-->Todos</option>
                    </select>
                </fieldset>
            <!--<span style="float:right;"><input onclick="todos('e')" type="button" name="todos" value="Ver Eurorepar" /></span>
            <span style="float:right;"><input onclick="todos('a')" type="button" name="todos" value="Ver agentes" /></span>
            <span style="float:right;"><input onclick="todos()" type="button" name="todos" value="Mostrar todos" /></span>
                -->
            </div>
            <?php
            include_once ('../estilos/conexion.php');
            if (@$_GET['id'] != "") {
                @$sen = mysql_query("SELECT * FROM hoja1 WHERE id_contacto = " . $_GET['id'] . ";");
                $fi = mysql_fetch_row($sen);
                ?>
                <div id="resalto" class="cli" >
                    <h1 style='text-align:center;'><?php echo utf8_encode($fi[1]) ?></h1>
                    N&uacute;mero de cliente:<b><?php echo utf8_encode($fi[0]) ?></b>
                    <table>
                        <tr>
                            <td>Denominaci&oacute;n:</td><td><?php echo utf8_encode($fi[2]) ?></td>
                            <td>Tel&eacute;fono:</td><td><?php echo utf8_encode($fi[3]) ?></td>
                        </tr>
                        <tr>
                            <td>Fax:</td><td><?php echo utf8_encode($fi[4]) ?></td>
                            <td>Contacto:</td><td><?php echo utf8_encode($fi[5]) ?></td>
                        </tr>
                        <tr>
                            <td>Poblaci&oacute;n:</td><td><?php echo utf8_encode($fi[6]) ?></td>
                            <td>Horario:</td><td><?php echo utf8_encode($fi[7]) ?></td>
                        </tr>
                        <tr>
                            <td>Correo electr&oacute;nico:</td>
                            <td><?php echo utf8_encode($fi[8]) ?></td>
                        </tr>
                    </table>
                    <a class='eliminar' target='_blank' onClick='confirmar(<?php echo utf8_encode($fi[9]) ?>,"<?php echo utf8_encode($fi[1]) ?>")' > </a> 
                </div>

            <?php
            }
            //$sentencia=mysql_query("SELECT * FROM hoja1 ORDER BY nombre;");
            if (@$_POST['cliente'] == "") {
                @$sentencia = mysql_query("SELECT * FROM hoja1 WHERE denominacion LIKE '%" . $_POST['denom'] . "%' ORDER BY nombre;");
            } elseif ($_POST['denom'] == "") {
                $sentencia = mysql_query("SELECT * FROM hoja1 WHERE Nombre LIKE '%" . $_POST['cliente'] . "%' ORDER BY nombre;");
            } else {
                $sentencia = mysql_query("SELECT * FROM hoja1 WHERE Nombre LIKE '%" . $_POST['cliente'] . "%' AND  denominacion LIKE '%" . $_POST['denom'] . "%' ORDER BY nombre;");
            }
            ?>
            <div id="tabla"></div>
<?php include_once '../scripts/pie.php'; ?>
        </div>
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
                if (!xmlhttp && typeof XMLHttpRequest != 'undefined') {
                    xmlhttp = new XMLHttpRequest();
                }
                return xmlhttp;
            }

            var ajax = objetoAjax();
            function enviarc() {
                var cli = document.getElementById('cliente').value;
                var denom = document.getElementById('denominacion').value;
                ajax.open('GET', 'buscar.php?cliente=' + cli + '&denom=' + denom, true);
                ajax.send(null);
                ajax.onreadystatechange = respuesta;
            }
            function todos() {
                var d = document.getElementById('tipo').value.toString();
                if (d === "Eurorepar") {
                    ajax.open('GET', 'buscar.php?todos=e', true);
                    ajax.send(null);
                    ajax.onreadystatechange = respuesta;
                } else if (d === "Agentes") {
                    ajax.open('GET', 'buscar.php?todos=a', true);
                    ajax.send(null);
                    ajax.onreadystatechange = respuesta;
                } else if (d === "Sensible") {
                    ajax.open('GET', 'buscar.php?todos=m', true);
                    ajax.send(null);
                    ajax.onreadystatechange = respuesta;
                } else  if(d === "Todos"){
                    ajax.open('GET', 'buscar.php?todos=si', true);
                    ajax.send(null);
                    ajax.onreadystatechange = respuesta;
                } else{
                    document.getElementById('tabla').innerHTML="<br/>";
                }
            }
            function respuesta() {
                var tabla = document.getElementById('tabla');
                if (ajax.readyState == 4) {
                    tabla.innerHTML = ajax.responseText;
                } else if(ajax.readyState == 1){
                    tabla.innerHTML = "<div style='clear:both;text-align:center;' ><img src='../imagenes/spinner.gif' title='spinner' /></div>";
                }else{
                    tabla.innerHTML="";
                }
            }
            function closeIframe()
            {
                $("#nven").dialog('destroy');
                return false;
            }
            $(function() {
                $("#resalto").dialog({modal: true, show: {effect: 'drop', direction: "up"}, width: 700, resizable: false});
            });
        </script>
    </body>
</html>