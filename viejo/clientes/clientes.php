<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv=Content-Type content="text/html;" charset=ISO-8859-1></meta>
        <title>Clientes</title>
        <link rel="shortcut icon" href="favicon.ico" ></link>
        <link rel="stylesheet" type="text/css" href="../estilos/style.css" ></link>
        <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>

        <script src="script.js"></script>
        <script>
            $(document).ready(function() {
            $("#dialog").dialog({modal: true,show: { effect: 'drop', direction: "up" },width:700,resizable:false});
            });
        </script>
        <script type="text/javascript">
             var ajax=new XMLHttpRequest();
	function enviar(){
		var cli=document.getElementById('cliente').value;
                var denom=document.getElementById('denominacion').value;
		ajax.open('GET','buscar.php?cliente='+cli+'&denom='+denom,true);
		ajax.send(null);
		ajax.onreadystatechange = respuesta;
	}
        function todos(){
		var cli=document.getElementById('cliente').value;
                var denom=document.getElementById('denominacion').value;
		ajax.open('GET','buscar.php?todos=si',true);
		ajax.send(null);
		ajax.onreadystatechange = respuesta;
	}
	function respuesta(){
		var tabla=document.getElementById('tabla');
		if(ajax.readyState==4){
			tabla.innerHTML = ajax.responseText;	
		}else{
			tabla.innerHTML = "";
		}
	}
        function nuevo(){
            $(function() {
                //$( "#dialog:ui-dialog" ).dialog( "destroy" );
                $( "#nuevo" ).dialog({
                    height: 500,
                    width: 950,
                    modal: true,
                    show: "fold",
                    hide: "explode",
                    title: 'Nuevo Contacto'
                    });
                 });
        }
            function closeIframe()
            {
                alert('va');
                $("#nuevo").dialog('destroy');
                return false;
            }
        </script>
        <?php
		include '../calendario/calcular_dia.php';?>
    </head>
    <body onload="document.getElementById('cliente').focus();">
        <div id="nuevo" style="display:none"><iframe style="padding: 20px" src="nuevo.php" height="400" width="900"></iframe></div>
        <!-- <iframe src="eliminar.php"  width="0" height="0"></iframe> -->
        <?php 
        $saludo=  getdate(time());
        if($_SERVER['REMOTE_USER']=='recepcion'){
             if($saludo['hours']<12){
            echo "<span class=\"saludo\">Buenos días recepción</span>";
             }else{
             echo "<span class=\"saludo\">Buenas tardes recepción</span>";
             }
         }else if($_SERVER['REMOTE_USER']=="medina"){
            if($saludo['hours']<12){
            echo "<span class=\"saludo\" >Buenos días Medina del Campo</span>";
             }else{
             echo "<span class=\"saludo\" >Buenas tardes Medina del Campo</span>";
             }
        }
        else{
            if($saludo['hours']<12){
            echo "<span class=\"saludo\" >Buenos días Valladolid</span>";
            }else{
                echo "<span class=\"saludo\" >Buenas tardes Valladolid</span>";
            }
        }
         if((date('j')>=25 and date('n')==12)or(date('j')<=6 and date('n')==1)){?>
            <img style=" margin: 10px;margin-top: 45px;left: 10px;position:fixed;" src="../imagenes/navidad.jpg" width="150px" />
        <?php }else{ ?>
            <img style=" margin: 10px; margin-top: 45px;left: 10px;position:fixed;" src="../imagenes/carrion.jpg" width="150px" />
        <?php } ?>
        <div class="contenedor">
        <?php if($_SERVER['REMOTE_USER']=="medina"){ ?>
<div id="c_ed6da3b0c2c5b38d1ae9a2fbb92eec48" class="ancho"></div><script type="text/javascript" src="http://www.eltiempo.es/widget/widget_loader/ed6da3b0c2c5b38d1ae9a2fbb92eec48"></script>
<?php }else{ ?>
        <div id="c_e57fa2f6fac3f87fd870f0eebef7dbcc" class="ancho">
        	<h2 style="color: #000000; margin: 0 0 3px; padding: 2px; font: bold 13px/1.2 Verdana; text-align: center;"></h2>
            </div>
			<script type="text/javascript" src="http://www.eltiempo.es/widget/widget_loader/e57fa2f6fac3f87fd870f0eebef7dbcc">
            </script>
<?php } ?>
        <div class="principal">
            <ul>
                <a href="../index.php" target="_self"><li>Inicio</li></a>
                <li id="activo">Clientes</li>
                <a href="../cruze/cruze.php" target="_self"><li>Referencias cruzadas</li></a>
                <a href="../enlaces/enlaces.php" target="_self"><li>Enlaces</li></a>
                <a href="../cambio/cambio.php"><li>Cambio</li></a>
                <a href="../calendario/pedidos.php?numes=<?php echo calcular_numes(); ?>&dia=<?php echo calcular_dia(); ?>&mes=<?php echo calcular_mes(); ?>&ano=<?php echo calcular_ano();?>"><li>Pedidos Citroen</li></a>
		<?php if($_SERVER['REMOTE_USER']!="medina"){ ?><a href="../pedidosv/pedidosv.php?numes=<?php echo calcular_numes(); ?>&dia=<?php echo calcular_dia(); ?>&mes=<?php echo calcular_mes(); ?>&ano=<?php echo calcular_ano();?>"><li>Pedidos Volvo</li></a> <?php } ?>
            </ul>
             </div>
            <div class="banda">
                <h2 style="padding:15px;">Clientes</h2>
                <span onclick="nuevo()" style="cursor:pointer" target="_blank"/>
                <div id="nuevo">
                    Nuevo contacto
                </div>
                </a>
        </div>
        <div class="cabecera">
            <table>
                <tr class="buscar">
                    <td>Nombre</td><td> <input id="cliente" onkeyup="enviar()" type="text" name="cliente" /></td>
            </tr><tr class="buscar"><td>Denominación</td><td> <input onkeyup="enviar()" id="denominacion" type="text" name="denom" /></td>
            </tr><tr class="buscar"><td></td><td></td></tr>
            </table>
            <span style="float:right;"><input onclick="todos()" type="button" name="todos" value="Mostrar todos" /></span>
            </div>
        <?php
        include_once ('../estilos/conexion.php');
        if(@$_GET['id']!=""){
            @$sen=mysql_query("SELECT * FROM hoja1 WHERE id_contacto = ".$_GET['id'].";");
            $fi=mysql_fetch_row($sen);
            echo "<div id=\"dialog\" class=\"cli\"><h1 style='text-align:center;'>".$fi[1]."</h1>";
            echo "Número de cliente:<b>".$fi[0]."</b>";
            echo "<table><tr><td>Denominación:</td><td>".$fi[2]."</td>";
            echo "<td>Télefono:</td><td>".$fi[3]."</td></tr>";
            echo "<tr><td>Fax:</td><td>".$fi[4]."</td>";
            echo "<td>Contacto:</td><td>".$fi[5]."</td></tr>";
            echo "<tr><td>Población:</td><td>".$fi[6]."</td>";
            echo "<td>Horario:</td><td>".$fi[7]."</td></tr>";
            echo "<tr><td>Correo electrónico:</td><td>".$fi[8]."</td></tr></table>";
            echo '<a class="eliminar" target="_blank" onClick=\'javascript:confirmar('.$fi[9].',"'.$fi[2].'");\'> </a> </div>';
        }
        //$sentencia=mysql_query("SELECT * FROM hoja1 ORDER BY nombre;");
        if(@$_POST['cliente']==""){
            @$sentencia=mysql_query("SELECT * FROM hoja1 WHERE denominacion LIKE '%".$_POST['denom']."%' ORDER BY nombre;");
        }elseif($_POST['denom']==""){
            $sentencia=mysql_query("SELECT * FROM hoja1 WHERE Nombre LIKE '%".$_POST['cliente']."%' ORDER BY nombre;");
        }else{
            $sentencia=mysql_query("SELECT * FROM hoja1 WHERE Nombre LIKE '%".$_POST['cliente']."%' AND  denominacion LIKE '%".$_POST['denom']."%' ORDER BY nombre;");
        }
        ?>
            <div id="tabla"></div>
        <div class="pie">
            <hr>
           Empresa Carrión SA <span>Jesús Martín 2012 ®</span>
        </div>
        </div>
    </body>
</html>