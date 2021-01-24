<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//ES "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd" >
<html>
    <head>
        <meta content="text/html; charset=iso-8859-1" http-equiv="content-type"/>
        <link rel="shortcut icon" href="./imagenes/chechu.ico" />
        <link rel="stylesheet" type="text/css" media="all" href="css/reset.css" />
	<link rel="stylesheet" type="text/css" media="all" href="css/clearfix.css" />
	<link rel="stylesheet" type="text/css" media="all" href="css/style.css" />
	<link rel="stylesheet" type="text/css" media="all" href="css/fonts.css"  />
	<link rel="stylesheet" type="text/css" media="all" href="css/jquery.dualSlider.0.2.css" />

	<script src="scripts/jquery-1.3.2.min.js" type="text/javascript"></script>
	<script src="scripts/jquery.easing.1.3.js" type="text/javascript"></script>
	<script src="scripts/jquery.timers-1.2.js" type="text/javascript"></script>
	<script src="scripts/jquery.dualSlider.0.3.min.js" type="text/javascript"></script>
        
        <title>Carrión</title>
        <link rel="shortcut icon" href="favicon.ico" />
        <link rel="stylesheet" type="text/css" href="./estilos/style.css" />
        <script src=".calendario/script.js"></script>
        
        <script type="text/javascript">
		
		$(document).ready(function() {
			
			$(".carousel").dualSlider({
				auto:true,
				autoDelay: 6000,
				easingCarousel: "swing",
				easingDetails: "easeOutBack",
				durationCarousel: 1000,
				durationDetails: 600
			});
			
		});
		
		
	</script>
    </head>
    <body>
        <?php
        $saludo=  getdate(time());
        if($_SERVER['REMOTE_USER']=="recepcion"){ 
            if($saludo['hours']<12){
            echo "<span class=\"saludo\" >Buenos d�as recepci�n</span>";
             }else{
             echo "<span class=\"saludo\" >Buenas tardes recepci�n</span>";
             }
        }
        else if($_SERVER['REMOTE_USER']=="medina"){
            if($saludo['hours']<12){
            echo "<span class=\"saludo\" >Buenos d�as Medina del Campo</span>";
             }else{
             echo "<span class=\"saludo\" >Buenas tardes Medina del Campo</span>";
             }
        }
        else{
            if($saludo['hours']<12){
            echo "<span class=\"saludo\" >Buenos d�as Valladolid</span>";
            }else{
                echo "<span class=\"saludo\" >Buenas tardes Valladolid</span>";
            }
        }
         if((date('j')>=25 and date('n')==12)or(date('j')<=6 and date('n')==1)){?>
            <img style=" margin: 10px;margin-top: 45px;left: 10px;position:fixed;" src="./imagenes/navidad.jpg" width="150px" />
        <?php }else{ ?>
            <img style=" margin: 10px; margin-top: 45px;left: 10px;position:fixed;" src="./imagenes/carrion.jpg" width="150px" />
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
<?php } 
include 'calendario/calcular_dia.php'; ?>
        <div class="principal">
            <ul>
                <li id="activo">Inicio</li>
                <a href="./clientes/clientes.php" target="_self"><li>Clientes</li></a>
                <a href="./cruze/cruze.php" target="_self"><li>Referencias cruzadas</li></a>
                <a href="./enlaces/enlaces.php" target="_self"><li>Enlaces</li></a>
                <a href="./cambio/cambio.php"><li>Cambio</li></a>
                <a href="./calendario/pedidos.php?numes=<?php echo calcular_numes(); ?>&dia=<?php echo calcular_dia(); ?>&mes=<?php echo calcular_mes(); ?>&ano=<?php echo calcular_ano();?>"><li>Pedidos Citroen</li></a>
		<?php if($_SERVER['REMOTE_USER']!="medina"){ ?><a href="./pedidosv/pedidosv.php?numes=<?php echo calcular_numes(); ?>&dia=<?php echo calcular_dia(); ?>&mes=<?php echo calcular_mes(); ?>&ano=<?php echo calcular_ano();?>"><li>Pedidos Volvo</li></a>
                <?php if($_SERVER['REMOTE_USER']!="recepcion"){ ?><a href="./proveedores/proveedores.php" ><li>Otros proveedores</li></a> <?php } } ?>
            </ul>
        </div>
            <div class="banda">
            <marquee behavior="alternate" scrollamount="2" scrolldelay="10"><h2 style="padding:15px;">Empresa Carri�n S.A.</h2></marquee> 
            </div>
             <?php
            require_once "rss/rss_fetch.inc";
            define('MAGPIE_INPUT_ENCODING', 'UTF-8');
            $citroen = 'http://citronoticias.com/?feed=rss2';
            $volvo ='http://www.volvo4life.es/foros/external.php?do=rss&type=newcontent&sectionid=1&days=220&count=10';
            $num_items = 4;
            $rssv = fetch_rss($volvo);
            $rssc = fetch_rss($citroen);
            $items = array_slice($rssc->items,0,$num_items);
            $itemsv = array_slice($rssv->items,0,$num_items);
           ?>
	<div class="wrapper clearfix">
		
		<div class="carousel clearfix">

			<div class="panel">
				
				<div class="details_wrapper">
					
					<div class="details">
                                                <?php for($i=0;$i<4;$i++){?>
						<div class="detail">
							<h2 class="titulo"></h2>
							<a href="<?php echo $items[$i]['link'] ?>" target="_blank"><?php echo $items[$i]['title'] ?></a>
						</div>
                                                <!--<div class="detail">
							<h2 class="titulo"></h2>
							<a href="<?php echo $itemsv[$i]['link'] ?>" target="_blank"><?php echo $itemsv[$i]['title'] ?></a>
						</div>-->
                                                <?php
                                                }
                                                ?>
			
					</div><!-- /details -->
					
				</div><!-- /details_wrapper -->
				
				<div class="paging">
					<div id="numbers"></div>
					<a href="javascript:void(0);" class="previous" title="Previous" >Previous</a>
					<a href="javascript:void(0);" class="next" title="Next">Next</a>
				</div><!-- /paging -->
				
				<a href="javascript:void(0);" class="play" title="Turn on autoplay">Play</a>
				<a href="javascript:void(0);" class="pause" title="Turn off autoplay">Pause</a>
				
			</div><!-- /panel -->
	
			<div class="backgrounds">
				<?php for($i=0;$i<4;$i++){?>
				<div class="item item_1">
					<?php echo $items[$i]['content']['encoded']; ?>
				</div>
                                <!--<div class="item item_1">
					<?php echo $itemsv[$i]['description']; ?>
				</div>-->
                                <?php
                                  }
                                 ?>
                            
			</div><!-- /backgrounds -->
					
		</div><!-- /carousel --> 
	
		</div><!-- /documentation -->
			
            

        <div class="pie">
            <hr>
           Empresa Carri�n SA <span>Jes�s Mart�n 2012 �</span>
        </div>
        </div>
    </body>
</html>