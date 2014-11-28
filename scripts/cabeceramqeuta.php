<link rel="stylesheet" href="../../scripts/jquery-ui.css" />
<link rel="stylesheet" href="../../scripts/jquery.ui.theme.css" /> 
<script src="../../scripts/jquery-1.9.1.js"></script>  
<script src="../../scripts/jquery-ui.js"></script>
<script>
    $(function() {    
        $( "#ofertacitroen" ).dialog({      
            resizable: false,
            height: 'auto',
            autoOpen: false,
            width: 950,
            height: 1250,
            modal: true,
            zindex: 3999,      
            show: {        
                effect: "fold",        
                duration: 1000      
            },      
            hide: {        
                effect: "fold",        
                duration: 1000
            }    
        });
        $( "#ofertavolvo" ).dialog({      
            resizable: false,
            height: 'auto',
            autoOpen: false,
            width: 700,
            height: 750,
            modal: true,
            zindex: 3999,      
            show: {        
                effect: "fold",        
                duration: 1000      
            },      
            hide: {        
                effect: "fold",        
                duration: 1000
            }    
        });
        $( "#abrircitroen" ).click(function() {      
            $( "#ofertacitroen" ).dialog( "open" );    
        });  
        $( "#abrirvolvo" ).click(function() {      
            $( "#ofertavolvo" ).dialog( "open" );    
        }); 
    });
</script>
<?php
mysql_connect("localhost", "chechu");
mysql_select_db("carrion");
$sen = mysql_query("SELECT * FROM nombres WHERE aplicacion = 'oferta'");
$oferta = '';
while ($mes = mysql_fetch_row($sen))
    $oferta = $mes[2];
?>
<table border="1">
    <tr>
        <td colspan="3">
            <?php
            if ((date('j') >= 25 and date('n') == 12) or (date('j') <= 6 and date('n') == 1)) {
                ?> <img style="left: 10px" src="../../imagenes/navidad.png" width="150px" /> <?php
        } else {
                ?> <img style="left: 10px" src="../../imagenes/carrion.png" width="150px" /> <?php } ?>
        </td>
        <td>
            <?php
            $saludo = getdate(time());
            if ($_SERVER['REMOTE_USER'] == "recepcion") {
                if ($saludo['hours'] < 12) {
                    ?><span class="saludo" >Buenos días recepción</span><?php
        } else {
                    ?><span class="saludo" >Buenas tardes recepción</span><?php
        }
    } else if ($_SERVER['REMOTE_USER'] == "medina") {
        if ($saludo['hours'] < 12) {
                    ?><span class="saludo" >Buenos días Medina del Campo</span><?php
        } else {
                    ?><span class="saludo" >Buenas tardes Medina del Campo</span><?php
        }
    } else {
        if ($saludo['hours'] < 12) {
                    ?><span class="saludo" >Buenos días Valladolid</span><?php
        } else {
                    ?><span class="saludo" >Buenas tardes Valladolid</span><?php
        }
    }
            ?>
        </td>
    </tr>
    <tr>
        <td>
            <?php if ($_SERVER['REMOTE_USER'] != "medina" AND $_SERVER['REMOTE_USER'] != "recepcion") { ?>
                <a href="../../principal/configuracion.php" title="Configuración"><img src="../../imagenes/config.png" height="20" /></a> 
            <?php } ?>
        </td>
        <td>
            <ul class = "oferta" style = "display: inline-block">
                <li>
                    <img title = "Campaña" src = "../imagenes/campana.png" width = "40px"/>
                    <ul>
                        <li><a href = "#" id = "abrircitroen" >Citroen</a></li>
                        <li><a href = "#" id = "abrirvolvo" >Volvo</a></li>
                    </ul>

                </li>
            </ul>
            <div id="ofertacitroen" title="<?php echo $oferta ?>" style="display: none;width: 600px;height: 500px;" >
                <img  src="../documentos/oferta.jpg?<?php echo $oferta ?>" width="100%" height="100%" />
            </div>
            <div id="ofertavolvo" title="Todo el año" style="display: none;width: 600px;height: 500px;" >
                <img  src="../imagenes/ofertavolvo.jpg" width="100%" height="100%" />
            </div>
        </td>
        <td>
            <div style="display: inline-block; width: 10px;height: 10px; background-color: #ABABAB;cursor: pointer;" onclick="cambiarfondo('#ABABAB')" ></div>
            <div style="display: inline-block; width: 10px;height: 10px; background-color: #00907D;cursor: pointer;" onclick="cambiarfondo('#00907D')" ></div>
            <div style="display: inline-block; width: 10px;height: 10px; background-color: #CD928E;cursor: pointer;" onclick="cambiarfondo('#CD928E')" ></div>
            <div style="display: inline-block; width: 10px;height: 10px; background-color: #f0f0f0;cursor: pointer;" onclick="cambiarfondo('#f0f0f0')" ></div>
        </td>
        <td>

        </td>
    </tr>
    <tr>
        <td colspan="4">
            <?php if ($_SERVER['REMOTE_USER'] == "medina") {
                ?> <div id="c_c0d530f38da2649d1adff8284c315e57" class="ancho"></div><script type="text/javascript" src="http://www.eltiempo.es/widget/widget_loader/c0d530f38da2649d1adff8284c315e57"></script> <?php
        } else {
                ?> <div id="c_f6c2f1d2192573924700347ed0011000" class="ancho"></div><script type="text/javascript" src="http://www.eltiempo.es/widget/widget_loader/f6c2f1d2192573924700347ed0011000"></script> <?php
        }
            ?>
        </td>
    </tr>
</table>

