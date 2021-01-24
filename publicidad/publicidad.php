<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta content="text/html; charset=iso-8859-1" http-equiv="content-type"/>
        <meta content="900" http-equiv="REFRESH"> </meta>
        <link rel="shortcut icon" href="../imagenes/chechu.ico" />
        <link rel="stylesheet" type="text/css" href="styles.css" />
        <script type="text/javascript" src="script.js" ></script>
        <script type="text/javascript" src="../scripts/jquery-1.9.1.js"></script>
        <script type="text/javascript" src="../scripts/jquery.tinycarousel.min.js" ></script>
        <script type="text/javascript" src="js/coin-slider.js"></script>
        <script type="text/javascript" src="js/coin-slider.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $('#slider-code').tinycarousel({
                    axis: 'y',
                    interval: true,
                    intervaltime: 10000
                });
            });
            
            $(document).ready(function() {
	        $('#coin-slider').coinslider({ width: 950, height: 671, navigation: false, delay: 15000 });
	    });
        </script> 
        <title>Marquesina</title>
    </head>
    <body>
        <?php 
            $mes = '';
            $dsemana = '';
            switch (Date('m')){
            case 1: 
                $mes = "Enero";
                break;
            case 2:
                $mes = "Febrero";
                break;
            case 3:
                $mes = "Marzo";
                break;
            case 4:
                $mes = "Abril";
                break;
            case 5:
                $mes = "Mayo";
                break;
            case 6:
                $mes = "Junio";
                break;
            case 7:
                $mes = "Julio";
                break;
            case 8:
                $mes = "Agosto";
                break;
            case 9:
                $mes = "Septiembre";
                break;
            case 10:
                $mes = "Octubre";
                break;
            case 11:
                $mes = "Noviembre";
                break;
            case 12:
                $mes = "Diciembre";
                break;
            }
            switch (Date('w')) {
                case 0:
                    $dsemana = "Domingo";
                    break;
                case 1:
                    $dsemana = "Lunes";
                    break;
                case 2:
                    $dsemana = "Martes";
                    break;
                case 3:
                    $dsemana = "Miércoles";
                    break;
                case 4:
                    $dsemana = "Jueves";
                    break;
                case 5:
                    $dsemana = "Viernes";
                    break;
                case 6:
                    $dsemana = "Sábado";
                    break;
            }
            require_once "../rss/rss_fetch.inc";
            define('MAGPIE_INPUT_ENCODING', 'UTF-8');
            $portada = 'http://elmundo.feedsportal.com/elmundo/rss/portada.xml';
            $valladolid = 'http://www.elnortedecastilla.es/portada.xml';
            $num_items = 5;
            $rss = @fetch_rss($portada);
            $items = @array_slice($rss->items,0,$num_items);
            $rssv = @fetch_rss($valladolid);
            $itemsv = @array_slice($rssv->items,0,$num_items);
            ?>
        <div class="cabecera">
            <table style="float: left;" border="0">
                <tr>
                    <td>
                        <embed style="" src="http://www.relojesflash.com/swf/clock82.swf" wmode="transparent" type="application/x-shockwave-flash" height="200" width="250"><param name=wmode value=transparent></embed>
                    </td>
                    <td width="100%">
                        <h1 class="titulo"><marquee behavior="alternate" SCROLLAMOUNT="1">Empresa Carrión SA</marquee></h1>
                        <div style="clear: both;margin-left: 20px;"><div id="c_4ab76da0966d535b0552cf7381084b51" class="ancho" style="font-size: 40px"></div><script type="text/javascript" src="http://www.eltiempo.es/widget/widget_loader/4ab76da0966d535b0552cf7381084b51"></script></div>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center">
                        <span id="liveclock"></span>
                        <h3><?php echo $dsemana.", ".Date('d')." de ".$mes." de ".Date('Y'); ?></h3>
                    </td>
                    <td rowspan="2" class="contenido">
                        <div id='coin-slider'>
                            <img src='oferta/placas.jpg' />
                            <span>
                                Ofertas Carrión
                            </span>
                            <img src='oferta/horario.jpg' />
                            <span>
                                Horario
                            </span>
                            <img src='oferta/pastillas.jpg' />
                            <img src='oferta/imagen.jpg' />
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="noticias">
                        <div id="slider-code">
                            <div class="viewport">
                                <ul class="overview">
                                    <?php for($i=0;$i<5;$i++){ ?>
                                        <li>
                                            <h3><?php echo @$items[$i]['title']; ?></h3>
                                            <?php echo $items[$i]['media']['description']; ?></li>
                                        <li>
                                            <h3><?php echo @$itemsv[$i]['title']; ?></h3>
                                            <?php echo $itemsv[$i]['description']; ?>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <div class="pie">
        </div>
    </body>
</html>