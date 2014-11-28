<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv=Content-Type content="text/html;" charset=ISO-8859-1></meta>
        <title>Referencias cruzadas</title>
        <link rel="shortcut icon" href="../imagenes/chechu.ico" />
        <link rel="stylesheet" type="text/css" href="../estilos/style.css" ></link>
        <script src="script.js"></script>
        <?php
		include '../calendario/calcular_dia.php';?>
    </head>
    <body>
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
                <a href="../clientes/clientes.php" target="_self"><li>Clientes</li></a>
                <li id="activo">Referencias cruzadas</li>
                <a href="../enlaces/enlaces.php" target="_self"><li>Enlaces</li></a>
                <a href="../cambio/cambio.php"><li>Cambio</li></a>
                <a href="../calendario/pedidos.php?numes=<?php echo calcular_numes(); ?>&dia=<?php echo calcular_dia(); ?>&mes=<?php echo calcular_mes(); ?>&ano=<?php echo calcular_ano();?>"><li>Pedidos Citroen</li></a>
		<?php if($_SERVER['REMOTE_USER']!="medina"){ ?><a href="../pedidosv/pedidosv.php?numes=<?php echo calcular_numes(); ?>&dia=<?php echo calcular_dia(); ?>&mes=<?php echo calcular_mes(); ?>&ano=<?php echo calcular_ano();?>"><li>Pedidos Volvo</li></a> <?php } ?>
            </ul>
             </div>
            <div class="banda">
                <h2 style="padding:15px;">Referencias cruzadas</h2>
                </a>
        </div>
          <div class="cabecera">
        <form method="POST" name="cruzes" action="cruze.php"  >
            <input type="hidden" name="oculto" value="<?php echo $_POST['repere'] ?>"/>
            <table>
            <tr class="buscar">
            <td>Referencia</td><td> <input type="text" name="referencia" disabled="true"/></td>
            </tr><tr class="buscar"><td>Repere</td><td><input type="text" name="repere" /></td>
            </tr><tr class="buscar"><td><input TYPE="submit" value="Buscar" name="buscar"/></td><td></td></tr>
            </table>
        </form>
            </div>
        <?php
		include("../estilos/conexion.php");
        if(isset($_POST['repere'])){
            $sentencia=mysql_query("SELECT * FROM cruze WHERE repere LIKE '".$_POST['repere']."';");
            if(mysql_num_rows($sentencia)>0 ){
            if($_POST['repere']!=""){
                    while($fila=mysql_fetch_row($sentencia)){                        
                            echo "<div class='opaco'><span style='float:left;'>Repere: ".$_POST['repere']."</span><h1 style='z-index:1'> Referencia: <b>".$fila[1]."</b></h1></div>";
                    }
                }
            }else{
                 echo "<div class='opaco'><h1>El repere ".$_POST['repere']." es desconocido</h1></div>";
            }
        }
        ?>
        <div class="pie">
            <hr>
           Empresa Carrión SA <span>Jesús Martín 2012 ®</span>
        </div>
        </div>
    </body>
</html>