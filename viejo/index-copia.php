<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//ES"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd" >
<html>
    <head>
        <meta content="text/html; charset=iso-8859-1" http-equiv="content-type"/>
        <title>Carrión</title>
        <link rel="shortcut icon" href="favicon.ico" ></link>
        <link rel="stylesheet" type="text/css" href="./estilos/style.css" ></link>
        <script src="script.js"></script>
    </head>
    <body>
        <?php
        if((date('j')>=25 and date('n')==12)or(date('j')<=6 and date('n')==1)){?>
            <img style="float:left;margin: 10px;position:fixed;" src="../imagenes/navidad.jpg" width="150px" />
        <?php }else{ ?>
            <img style="float:left;margin: 10px;position:fixed;" src="../imagenes/carrion.jpg" width="150px" />
        <?php } ?>
        <div class="contenedor">
        <div id="c_e57fa2f6fac3f87fd870f0eebef7dbcc" class="ancho">
        	<h2 style="color: #000000; margin: 0 0 3px; padding: 2px; font: bold 13px/1.2 Verdana; text-align: center;"></h2>
            </div>
			<script type="text/javascript" src="http://www.eltiempo.es/widget/widget_loader/e57fa2f6fac3f87fd870f0eebef7dbcc">
            </script>
            <?php include 'calendario/calcular_dia.php'; ?>
        <div class="principal">
            <ul>
                <li id="activo">Inicio</li>
                <a href="./clientes/clientes.php" target="_self"><li>Clientes</li></a>
                <a href="./cruze/cruze.php" target="_self"><li>Referencias cruzadas</li></a>
                <a href="./enlaces/enlaces.php" target="_self"><li>Enlaces</li></a>
                <a href="../cambio/cambio.php"><li>Cambio</li></a>
                <a href="../calendario/pedidos.php?numes=<?php echo calcular_numes(); ?>&dia=<?php echo calcular_dia(); ?>&mes=<?php echo calcular_mes(); ?>&ano=<?php echo calcular_ano();?>"><li>Pedidos Citroen</li></a>
            </ul>
        </div>
            <div class="banda">
            <marquee behavior="alternate" scrollamount="2" scrolldelay="10"><h2 style="padding:15px;">Empresa Carrión S.A.</h2></marquee> 
            </div>
            <?php
            require_once "rss/rss_fetch.inc";
            define('MAGPIE_INPUT_ENCODING', 'UTF-8');
            $url = 'http://citronoticias.com/?feed=rss2';
            $num_items = 8;
            $rss = fetch_rss($url);
            $items = array_slice($rss->items, 0, $num_items);
            foreach ( $items as $item ) { 
                echo '<div class="noticia"><p><h3 class="titulo"><a href="'.$item['link'].' target="_blank">'.$item['title'].'</a></h3><br/>';
                echo $item['content']['encoded'];
                echo '</p></div>';
                }
            ?>

        <div class="pie">
            <hr>
           Empresa Carrión SA <span>Jesús Martín 2012 ©</span>
        </div>
        </div>
    </body>
</html>