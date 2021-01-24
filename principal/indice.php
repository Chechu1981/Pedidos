<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link rel="shortcut icon" href="../imagenes/chechu.ico" />
        <link rel="stylesheet" type="text/css" href="../scripts/styles.css" />
        <?php include_once '../scripts/estilos.php'; ?>
        <title>Carrión</title>
    </head>
    <body>    
        <div class="contenedor">
            <?php include '../calendario/calcular_dia.php'; ?>
            <header>
            <?php include '../scripts/cabecera.php'; ?>
                </header>
            <nav>
            <div class="principal">
                <?php include_once '../scripts/menu.php'; ?>
            </div>
                </nav>
            <div style="clear: both"></div>
            <div class="banda">
                <marquee behavior="alternate" scrollamount="2" scrolldelay="10"><h2 style="padding:15px;">Empresa Carrión S.A.</h2></marquee> 
            </div>
            <div style="clear:both"></div>
            <?php
            require_once "../rss/rss_fetch.inc";
            define('MAGPIE_OUTPUT_ENCODING', 'UTF-8');
            $citroen = 'http://www.autoblog.com/category/citroen/rss.xml';
            $volvo = 'http://www.volvo4life.es/foros/external.php?do=rss&type=newcontent&sectionid=1&days=120&count=10';
            $carrion = 'http://www.facebook.com/feeds/page.php?format=rss20&id=117555732935';
            $num_items = 8;
            $ran = rand(0, 7);
            $marca = rand(0, 1);
            @$rssv = fetch_rss($volvo);
            @$rssc = fetch_rss($citroen);
            @$rsscar = fetch_rss($carrion);
            @$items = array_slice($rssc->items, 0, $num_items);
            @$itemsv = array_slice($rssv->items, 0, $num_items);
            @$itemsc = array_slice($rsscar->items, 0, $num_items);
            ?>
            <div id="page-wrap">									
                <div class="slider-wrap">
                    <div id="main-photo-slider" class="csw">
                        <div class="panelContainer">
                            <?php
                            //for($i=0;$i<1;$i++){ 
                            if ($marca == 0) {
                                ?>
                                <div class="panel" title="Panel 1">
                                    <h2><a href="<?php echo $items[$ran]['link'] ?>" target="_blank"><?php echo $items[$ran]['title'] ?></a></h2>
                                    <div class="wrapper">
                                        <div class="photo-meta-data">
                                            <?php echo $items[$ran]['description'] ?>
                                            <span></span>
                                        </div>
                                    </div>
                                </div>
                            <?php } elseif($marca == 1) { ?>
                                <div class="panel" title="Panel 1">
                                    <h2><a href="<?php echo $itemsv[$ran]['link'] ?>" target="_blank"><?php echo $itemsv[$ran]['title'] ?></a></h2>
                                    <div class="wrapper">
                                        <div class="photo-meta-data">
                                            <?php echo $itemsv[$ran]['description'] ?>
                                            <span></span>
                                        </div>
                                    </div>
                                </div>
                            <?php }else{ ?>
                                <div class="panel" title="Panel 1">
                                    <h2><a href="<?php echo $itemsc[$ran]['link'] ?>" target="_blank"><?php echo $itemsc[$ran]['title'] ?></a></h2>
                                    <div class="wrapper">
                                        <div class="photo-meta-data">
                                            <?php echo $itemsc[$ran]['description'] ?>
                                            <span></span>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?> 
                        </div>
                    </div>
                </div>
            </div>
            <?php include_once '../scripts/pie.php'; ?>
        </div>
    </body>
</html>