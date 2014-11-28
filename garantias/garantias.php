<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta content="text/html; charset=iso-8859-1" http-equiv="content-type"/>
        <title>Garantias</title>
        <link rel="shortcut icon" href="../imagenes/chechu.ico" />
        <link rel="stylesheet" type="text/css" href="../estilos/style.css" />
        <link rel="stylesheet" href="../scripts/styles.css" type="text/css" />
        <link type="text/css" href="../scripts/jquery-ui-1.8.21.custom/css/ui-lightness/jquery-ui-1.8.21.custom.css" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="css/jquery.jdigiclock.css" />
        <script type="text/javascript" src="lib/jquery.jdigiclock.js"></script>
        <script src="../scripts/jquery-ui-1.8.21.custom/js/jquery-1.7.2.min.js"></script>
        <script type="text/javascript" src="lib/jquery-1.3.2.min.js"></script>
        <script src="../scripts/jquery-ui-1.8.21.custom/js/jquery-ui-1.8.21.custom.min.js"></script>
        <script src="../scripts/jquery-1.9.0.js"></script>
        <script src="http://code.jquery.com/ui/1.10.0/jquery-ui.js"></script>
        <script>
		function objetoAjax(){
            var xmlhttp=false;
            try {
				xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
            } catch (e) {
				try {
				   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
				} catch (E) {
					xmlhttp = false;
				}
			}
			if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
				xmlhttp = new XMLHttpRequest();
			}
			return xmlhttp;
		}
		var listado=objetoAjax();
		function listar(){
			listado.open('GET','tabla.php',true);
			listado.send(null);
			listado.onreadystatechange = datos;
		}
		function datos(){
			var div = document.getElementById('tabla');
			if(listado.readyState==4){
				div.innerHTML = listado.responseText;	
			}else{
				div.value = "";
			}
		}
		function detalle(envio , anio , mes , dia){
			window.open('detalle.php?envio='+envio+'&fecha='+dia+' / '+mes+' / '+anio, envio , "width=500, height=800");
		}
                var mail=objetoAjax();
        </script>
    </head>
    <body onload="listar()">
        <?php include '../calendario/calcular_dia.php'; ?>
	<div class="contenedor">
        <?php
         $saludo=  getdate(time());
         if($_SERVER['REMOTE_USER']=="medina"){
            if($saludo['hours']<12){
                echo "<span class=\"saludo\">Buenos días Medina del Campo</span>";
            }else{
                echo "<span class=\"saludo\">Buenas tardes Medina del Campo</span>";
            }
        }else{
            if($saludo['hours']<12){
                echo "<span class=\"saludo\">Buenos días Valladolid</span>";
            }else{
                echo "<span class=\"saludo\">Buenas tardes Valladolid</span>";
            }
        }
        if((date('j')>=25 and date('n')==12)or(date('j')<=6 and date('n')==1)){?>
            <img style=" margin: 10px;" src="../imagenes/navidad.jpg" width="150px" />
        <?php }else{ ?>
            <img style=" margin: 10px;" src="../imagenes/carrion.jpg" width="150px" />
        <?php }
        if($_SERVER['REMOTE_USER']=="medina"){ ?>
            <div id="c_ed6da3b0c2c5b38d1ae9a2fbb92eec48" class="ancho"></div><script type="text/javascript" src="http://www.eltiempo.es/widget/widget_loader/ed6da3b0c2c5b38d1ae9a2fbb92eec48"></script>
        <?php }else{ ?>
            <div id="c_e57fa2f6fac3f87fd870f0eebef7dbcc" class="ancho"></div><script type="text/javascript" src="http://www.eltiempo.es/widget/widget_loader/e57fa2f6fac3f87fd870f0eebef7dbcc"></script>
        <?php } ?>
        <div class="principal">
            <?php include_once '../scripts/menu.php'; ?>
        </div>
        <div class="banda">
            <h2 style="padding:15px;">Garantías</h2>
                <a class="antig" href="#">Buscar</a>
                <a class="antig" href="#">Enviados</a>
                <a class="antig" href="nuevo.php" target="_blank">Nuevo</a>
        </div>
        <div style="clear:both;" id="tabla"></div>
        <?php include_once '../scripts/pie.php'; ?>
        </div>
    </body>
</html>