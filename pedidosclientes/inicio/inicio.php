<!DOCTYPE html>
<html>
    <head>
        <title>Empresa Carrión. Noticias</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=1024, user-scalable=yes" />
        <meta name="description" content="Carrion, concesionario oficial CITROEN y VOLVO en Valladolid" />
        <meta name="keywords" content="Carrion, CITROEN, Valladolid, Noticias, Facebook" />
        <meta name="Description" id="ctl00_mDescription" content="CITROËN, VALLADOLID, EMPRESA CARRION, S.A. :Bienvenido a la Red Oficial de Citroën. Te invitamos a descubrir las mejores ofertas y servicios.">
        <meta name="author" content="Jesús Martín" />
        <style>
            #ticker-wrapper{ width:100%; margin:0 ;}
            #ticker-wrapper-alt{ width:100%; margin:0 ; display:none;}
            .vertical-ticker{
                height:100%;
                overflow:hidden;
                -webkit-box-shadow:0 1px 3px rgba(0,0,0, .4);
            }
            .vertical-ticker li{
                display:block;
                height: 110px;
                border-bottom:1px solid #646464;

                margin:0 0 5px 0;
            }
            .vertical-ticker li img{
                float:left;
                padding-right:0px;
                padding-top:5px;
            }
            .vertical-ticker p{padding:0 0 20px 0;}

        </style>
        <link rel="stylesheet" href="../css/style.css" >
        <link rel="stylesheet" href="../css/jquery-ui-1.10.4.custom.min_1.css" />
        <script type="text/javascript" src="../js/jquery-1.10.2.js" ></script>
        <script type="text/javascript" src="../js/jquery-ui-1.10.4.custom.min.js" ></script>
        <script type="text/javascript" src="../../js/script.js" ></script>
        <script type="text/javascript" src="../../js/jquery.totemticker.min.js"></script>
        <script src="../../js/scroll.js"></script>
    </head>
    <body>
        <?php
        session_start();
        include_once '../rss/rss_fetch.inc';
        if (session_id() === @$_GET['id']) {
        ?>
        <div class="limpiar"></div>
        <div id="contenedor">
            <?php include '../helper/cabecera.php'; ?>
            <div id="menu" ><?php include '../helper/menu.php'; ?></div>
            <div id="tabla">
                <div class="titulo">Inicio</div>
                <div class="cuerpo" style="width: 700px;margin: auto;border-right:none;padding: 8px">
                    <?php
                    define('MAGPIE_OUTPUT_ENCODING', 'UTF-8');
                    $carrion = 'http://www.facebook.com/feeds/page.php?format=rss20&id=231839570273186';
                    $num_items = 7;
                    @$rssc = fetch_rss($carrion);
                    @$items = array_slice($rssc->items, 0, $num_items);
                    for ($numero = 0; $numero < 7; $numero++) {
                        ?> <a href="<?php echo $items[$numero]['link'] ?>" target="blank" ><h2> <?php echo $items[$numero]['title']; ?> </h2></a> <?php
                        echo $items[$numero]['description'];
                        ?> <hr> <?php
                    }
                    ?>
                </div>
            </div>
            <div id="pie"><?php include_once '../helper/pie.php'; ?></div>
        </div>
        <?php
        } else {
            echo "<a href='../pedidosclientes.php' >Debe iniciar sesion</a>";
        } ?>
    </body>
</html>
