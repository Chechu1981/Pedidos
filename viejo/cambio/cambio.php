<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//ES"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd" >
<html>
    <head>
        <meta content="text/html; charset=iso-8859-1" http-equiv="content-type"/>
        <title>Cambio</title>
        <link rel="shortcut icon" href="../imagenes/chechu.ico" />
        <link rel="stylesheet" type="text/css" href="../estilos/style.css" >
        <script src="../script.js"></script>
        <?php
		include '../calendario/calcular_dia.php';?>
    </head>
    <body>
        <?php
         $saludo=  getdate(time());
         if($_SERVER['REMOTE_USER']=="medina"){
            if($saludo['hours']<12){
            echo "<span class=\"saludo\">Buenos días Medina del Campo</span>";
             }else{
             echo "<span class=\"saludo\">Buenas tardes Medina del Campo</span>";
             }
        }
        else{
            if($saludo['hours']<12){
            echo "<span class=\"saludo\">Buenos días Valladolid</span>";
            }else{
                echo "<span class=\"saludo\">Buenas tardes Valladolid</span>";
            }
        }
         if((date('j')>=25 and date('n')==12)or(date('j')<=6 and date('n')==1)){?>
            <img style=" margin: 10px;margin-top: 45px;left: 10px;position:fixed;" src="../imagenes/navidad.jpg" width="150px" />
        <?php }else{ ?>
            <img style=" margin: 10px; margin-top: 45px;left: 10px;position:fixed;" src="../imagenes/carrion.jpg" width="150px" />
        <?php } ?>
        <div class="contenedor">
        <?php
 if($_SERVER['REMOTE_USER']=="medina"){ ?>
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
                <a href="../index.php"><li>Inicio</li></a>
                <a href="../clientes/clientes.php" target="_self"><li>Clientes</li></a>
                <a href="../cruze/cruze.php" target="_self"><li>Referencias cruzadas</li></a>
                <a href="../enlaces/enlaces.php" target="_self"><li>Enlaces</li></a>
                <li id="activo">Cambio</li>
                <a href="../calendario/pedidos.php?numes=<?php echo calcular_numes(); ?>&dia=<?php echo calcular_dia(); ?>&mes=<?php echo calcular_mes(); ?>&ano=<?php echo calcular_ano();?>"><li>Pedidos Citroen</li></a>
                <a href="../pedidosv/pedidosv.php"><li>Pedidos Volvo</li></a>
            </ul>
        </div>
            <div class="banda">
				<h2 style="padding:15px;">Cambio</h2>
            </div>
            <div id="cabecera" class="cambio" >
            
            </br>
            <div style="clear:both;text-align:center;color:#03C;font-size:16px; height:10px;">
			</div>
            <div style="float:left">
                <iframe style="border:none" width="420" height="600" src="change.php" ></iframe>
            </div>
            <div>
                <iframe style="border:none" width="420" height="600" src="iva.php" ></iframe>
            </div>
            </div>
            <div class="pie">
            <hr>
           Empresa Carrión SA <span>Jesús Martín 2012 ®</span>
        </div>
            </div>
        
    </body>
</html>