<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;" charset="ISO-8859-1"></meta>
        <title>Otros proveedores</title>
        <link rel="shortcut icon" href="../imagenes/chechu.ico" />
        <link rel="stylesheet" type="text/css" href="../estilos/style.css" />
        <link type="text/css" href="../scripts/jquery-ui-1.8.21.custom/css/redmond/jquery-ui-1.8.24.custom.css" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="css/jquery.jdigiclock.css" />
        <script type="text/javascript" src="lib/jquery-1.3.2.min.js"></script>
        <script type="text/javascript" src="lib/jquery.jdigiclock.js"></script>
        <script src="../scripts/jquery-ui-1.8.21.custom/js/jquery-1.7.2.min.js"></script>
        <script src="../scripts/jquery-ui-1.8.21.custom/js/jquery-ui-1.8.21.custom.min.js"></script>
        
        <script>
             var ajax=new XMLHttpRequest();
            function enviar(){
		var ref=document.getElementById('referencia').value;
		ajax.open('GET','denominacion.php?ref='+ref,true);
		ajax.send(null);
		ajax.onreadystatechange = respuesta;
            }
            function respuesta(){
		var div=document.getElementById('den');
		if(ajax.readyState==4){
			div.value = ajax.responseText;	
		}else{
			div.value = "";
		}
	}
	</script>
    </head>
    <body onload="javascript:foco();cargar();">
        <?php 
        $saludo=  getdate(time());
         if($_SERVER['REMOTE_USER']=="medina"){
            if($saludo['hours']<12){
            echo "<span class=\"saludo\" >Buenos días Medina del Campo</span>";
             }else{
             echo "<span class=\"saludo\" >Buenas tardes Medina del Campo</span>";
             }
        }else if($_SERVER['REMOTE_USER']=="recepcion"){
            if($saludo['hours']<12){
            echo "<span class=\"saludo\" >Buenos días recepción</span>";
            }else{
                echo "<span class=\"saludo\" >Buenas tardes recepción</span>";
            }
        }else{
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
<?php } include '../calendario/calcular_dia.php'; ?> ?>
<div class="aviso" ><img src="../imagenes/peligro.png" style="margin: 0 8px 8px 0;" align="center" border="0" />Atención: Las piezas introducidas a partir de las 13:30, probablemente no lleguen. Hay que anotarlas en el pedido del día siguente.</div>
        	<div class="principal">
            <ul>
                <a href="../index.php" target="_self"><li>Inicio</li></a>
                <a href="../clientes/clientes.php" target="_self"><li>Clientes</li></a>
                <a href="../cruze/cruze.php" target="_self"><li>Referencias cruzadas</li></a>
                <a href="../enlaces/enlaces.php" target="_self"><li>Enlaces</li></a>
                <a href="../cambio/cambio.php"><li>Cambio</li></a>
                <a href="../calendario/pedidos.php?numes=<?php echo calcular_numes(); ?>&dia=<?php echo calcular_dia(); ?>&mes=<?php echo calcular_mes(); ?>&ano=<?php echo calcular_ano();?>"><li>Pedidos Citroen</li></a>
		<?php if($_SERVER['REMOTE_USER']!="medina"){ ?><a href="../pedidosv/pedidosv.php?numes=<?php echo calcular_numes(); ?>&dia=<?php echo calcular_dia(); ?>&mes=<?php echo calcular_mes(); ?>&ano=<?php echo calcular_ano();?>"><li>Pedidos Volvo</li></a> <?php } ?>
                <a href="proveedores.php"><li>Otros proveedores</li></a>
            </ul>
                    
             </div>
                        
            <div class="pie">
            <hr/>
            Empresa Carrión SA <span>Jesús Martín 2012 ©</span>
            </div>
    </div>
    </body>
</html>