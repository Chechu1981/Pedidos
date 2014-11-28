<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;" charset="ISO-8859-1" />
        <title>Enlaces</title>
        <link rel="shortcut icon" href="../imagenes/chechu.ico" />
        <link rel="stylesheet" type="text/css" href="../estilos/style.css" />
        <script src="../cruze/script.js"></script>
        <link href="jquery-ui-1.9.1.custom/development-bundle/themes/blitzer/jquery-ui.css" rel="stylesheet" type="text/css"/>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>

        <script>
            $(document).ready(function() {
                $("#accordion").accordion({
                    active: false,
                    collapsible: true,
                    heightStyle: "content"
                });
            });
        </script>
        <style>
            #accordion-resizer {
                padding: 0px;
                width: 350px;
                height: 220px;
            }
        </style>

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
                echo "<span class=\"saludo\">Buenas tardes Valladolid</span>";
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
                <a href="../cruze/cruze.php"><li>Referencias cruzadas</li></a>
                <li id="activo">Enlaces</li>
                <a href="../cambio/cambio.php"><li>Cambio</li></a>
                <a href="../calendario/pedidos.php?numes=<?php echo calcular_numes(); ?>&dia=<?php echo calcular_dia(); ?>&mes=<?php echo calcular_mes(); ?>&ano=<?php echo calcular_ano();?>"><li>Pedidos Citroen</li></a>
		<?php if($_SERVER['REMOTE_USER']!="medina"){ ?><a href="../pedidosv/pedidosv.php?numes=<?php echo calcular_numes(); ?>&dia=<?php echo calcular_dia(); ?>&mes=<?php echo calcular_mes(); ?>&ano=<?php echo calcular_ano();?>"><li>Pedidos Volvo</li></a> <?php } ?>
            </ul>
        </div>
        <div class="banda">
                <h2 style="padding:15px;">Enlaces</h2>
        </div>
          	<div id="cabecera">
                    <div style="clear: both;width: 750px" id="accordion">
                        <div>
                            <a href="#"><img src="../imagenes/Auto_Logo_Citroen.png" width="25" height="25" /><h4 class="titulo">Citroen</h4></a>
                        </div>
                        <div>
             <table class="listado" border="0" cellpadding="0" style="float:left;margin:20px;">
                <tr>
                  <td><a href="http://networkservice.citroen.com" target="_blank"><img src="../imagenes/CITROEN_.jpg" width="20" height="20" /></a></td>
                  <td><a href="http://networkservice.citroen.com" target="_blank">Citroen Service</a></td>
                </tr>
                <tr>
                  <td><a href="https://bolsapiezas.citroen.com/" target="_blank"><img src="../imagenes/digg-20.png" width="20" height="20" border="0" /></a></td>
                  <td><a href="https://bolsapiezas.citroen.com/" target="_blank">BPO</a></td>
                </tr>
                <tr>
                  <td><a href="https://accecit.citroen.com/portal/dt" target="_blank"><img src="../imagenes/citroen.gif" width="20" height="20" border="0" /></a></td>
                  <td><a href="https://accecit.citroen.com/portal/dt" target="_blank">ACCECIT</a></td>
                </tr>
                <tr>
                  <td><a href="https://parts.citroen.com/" target="_blank"><img src="../imagenes/carro.png" width="20" height="20" border="0" /></a></td>
                  <td><a href="https://parts.citroen.com/" target="_blank">Parts</a></td>
                </tr>
                <tr>
                  <td><a href="https://speeder.citroen.com/login.do" target="_blank"><img src="../imagenes/despacho.png" width="20" height="20" border="0" /></a></td>
                  <td><a href="https://speeder.citroen.com/login.do" target="_blank">Speeder</a></td>
                </tr>
                <tr>
                  <td><a href="https://emulation.psa-on-line.com/" target="_blank"><img src="../imagenes/tour_run_dos_cmd.png" width="20" height="20" border="0" /></a></td>
                  <td><a href="https://emulation.psa-on-line.com/" target="_blank">Cipre</a></td>
                </tr>
                <tr>
                  <td><a href="https://networkservice.citroen.com/docapvpr/afficheListe.do?ref=&amp;typeDoc=9" target="_blank"><img src="../imagenes/list.jpg" width="20" height="20" border="0" /></a></td>
                  <td><a href="https://networkservice.citroen.com/docapvpr/afficheListe.do?ref=&amp;typeDoc=9" target="_blank">Listas complejas</a></td>
                </tr>
                <tr>
                  <td><a href="http://www.citroen.es/home/#/home/"><img src="../imagenes/citroen1.gif" width="20" height="20" /></a></td>
                  <td><a href="http://www.citroen.es/home/#/home/" target="_blank">Citroen</a></td>
                </tr>
                <tr>
                  <td><a href="https://networkservicetest.citroen.com/socle/?start=true" target="_blank"><img src="../imagenes/Edit.gif" width="20" height="20" border="0" /></a></td>
                  <td><a href="https://networkservicetest.citroen.com/socle/?start=true" target="_blank">Test Service</a></td>
                </tr>
                 <tr>
                  <td><a title="Usuario: MJ08465 &#10;Contraseña: SANCHEZ12" href="https://www.bibserve.com/MichelinSCEBE/LoginServlet" target="_blank"><img src="../imagenes/icone_guide_michelin.gif" width="20" height="20" border="0" /></a></td>
                  <td><a title="Usuario: MJ08465 &#10;Contraseña: SANCHEZ12" href="https://www.bibserve.com/MichelinSCEBE/LoginServlet" target="_blank">Bibserve</a></td>
                </tr>
                <tr>
                  <td><a href="../documentos/neumaticos.xls" target="_blank"><img src="../imagenes/for_neumaticos.gif" width="20" height="20" /></a></td>
                  <td><a href="../documentos/neumaticos.xls" target="_blank">Tarificador (26/10/2012)</a></td>
                </tr>
                  <tr>
                  <td><a href="../documentos/pomos.pdf" target="_blank"><img src="../imagenes/pomo.jpg" width="20" height="20" border="0" /></a></td>
                  <td><a href="../documentos/pomos.pdf" target="_blank">Pomos citroen <img src="../imagenes/icon20x20_pdf.gif" width="20" height="20" /></a></td>
                </tr>
                  <tr>
                  <td><a href="../documentos/cartografias.xls" target="_blank"><img src="../imagenes/mapa.jpg" width="20" height="20" border="0" /></a></td>
                  <td><a href="../documentos/cartografias.xls" target="_blank">Cartografías (29/10/12)<img src="../imagenes/word.png" width="20" height="20" /></a></td>
                </tr>
                 <tr>
                  <td><a href="../documentos/pedido.pdf" target="_blank"><img src="../imagenes/mapa.jpg" width="20" height="20" border="0" /></a></td>
                  <td><a href="../documentos/pedido.pdf" target="_blank">Bono de pedido de cartografías (29/10/12)<img src="../imagenes/icon20x20_pdf.gif" width="20" height="20" /></a></td>
                </tr>
              </table>
                        </div>
                        <div>
                            <a herf="#"><img src="../imagenes/Auto_Logo_Volvo.png" width="25" height="25" /> <h4 class="volvo">Volvo</h4></a>
                        </div>
                        <div>
                        <table class="listado" style="float:left;margin:20px;" border="0" cellpadding="0">
          	    <tr>
          	      <td><a href="http://vida.volvocars.biz/Vida" target="_blank"><img src="../imagenes/VOLVO_.jpg" width="20" height="20" /></a></td>
          	      <td><a href="http://vida.volvocars.biz/Vida" target="_blank">VIDA</a></td>
       	        </tr>
          	    <tr>
          	      <td><a href="http://accessories.volvocars.com/AccessoriesWeb/Accessories.mvc/es-ES/ES" target="_blank"><img src="../imagenes/boton_mas.gif" width="20" height="20" border="0" /></a></td>
          	      <td><a href="http://accessories.volvocars.com/AccessoriesWeb/Accessories.mvc/es-ES/ES" target="_blank">Accesorios</a></td>
       	        </tr>
          	    <tr>
          	      <td><a title="Usuario: volvo6148 &#10;Contraseña: v740630" href="http://pvpconcesionarios.com/default.aspx" target="_blank"><img src="../imagenes/icone_guide_michelin.gif" width="20" height="20" border="0" /></a></td>
          	      <td><a title="Usuario: volvo6148 &#10;Contraseña: v740630" href="http://pvpconcesionarios.com/default.aspx" target="_blank">Michel&iacute;n</a></td>
       	        </tr>
          	    <tr>
          	      <td><a href="\\chechu-pc\Chechu\productos quimicos volvo.pdf" target="_blank"><img src="../imagenes/produtos-quimicos.png" width="20" height="20" border="0" /></a></td>
          	      <td><a href="\\chechu-pc\Chechu\productos quimicos volvo.pdf" target="_blank">Productos qu&iacute;micos <img src="../imagenes/icon20x20_pdf.gif" width="20" height="20" /></a></td>
       	        </tr>
          	    <tr>
          	      <td><a href="http://tie.volvocars.biz/MainPageAction.do?dispatch=getUserData" target="_blank"><img src="../imagenes/global__icon_tie.gif" width="20" height="20" border="0" /></a></td>
          	      <td><a href="http://tie.volvocars.biz/MainPageAction.do?dispatch=getUserData" target="_blank">TIE</a></td>
       	        </tr>

       	      </table>
                        </div>
                        <div>
                        <a><img src="../imagenes/Modio_Logo.png" width="25" height="25" /> <h4 class="otros">Otros</h4></a>
                        </div>
                        <div>
                        <table class="listado" style="float:left;margin:20px;" border="0" cellpadding="0">
          	    <tr>
                      <td><a title="Usuario: AP01721052 &#10;Contraseña: chechu" href="http://public.servicebox.peugeot.com/" target="_blank"><img src="../imagenes/PEUGEOT_.jpg" width="20" height="20" /></a></td>
          	      <td><a title="Usuario: AP01721052 &#10;Contraseña: chechu" href="http://public.servicebox.peugeot.com/" target="_blank">Service Box</a></td>
       	        </tr>
                 <tr>
                      <td><a title="Usuario: es-720859 &#10; Nombre: admin &#10;Contraseña: o3d8h67z8k" href="http://www.partslink24.com/" target="_blank"><img src="../imagenes/parts.gif" width="120" height="20" /></a></td>
                      <td><a title="Usuario: es-720859 &#10; Nombre: admin &#10;Contraseña: o3d8h67z8k" href="http://www.partslink24.com/" target="_blank">Parts Link 24</a> <cite style="font-size: small"> (contraseña: o3d8h67z8k)</cite></td>
       	        </tr>
          	    <tr>
          	      <td><a title="Usuario: 230654 &#10;Contraseña: C54r23" href="http://www.lausan.es/" target="_blank"><img src="../imagenes/l.gif" width="20" height="20" border="0" /></a></td>
          	      <td><a title="Usuario: 230654 &#10;Contraseña: C54r23" href="http://www.lausan.es/" target="_blank">Lausan</a></td>
       	        </tr>
          	    <tr>
          	      <td><a href="https://www.mann-hummel.com/mf_prodkata_eur/index.html?iKeys=23.3.0.31.3" target="_blank"><img src="../imagenes/mann.gif" width="40" height="25" border="0" /></a></td>
          	      <td><a href="https://www.mann-hummel.com/mf_prodkata_eur/index.html?iKeys=23.3.0.31.3" target="_blank">Filtros Mann</a></td>
       	        </tr>
          	    <tr>
          	      <td><a href="http://www.oscaro.es/" target="_blank"><img src="../imagenes/40151261_avatar_small.jpg" width="30" height="30" border="0" /></a></td>
          	      <td><a href="http://www.oscaro.es/" target="_blank">Oscaro</a></td>
       	        </tr>
          	<tr>
          	      <td><a href="http://www.teleneumatico.com/equivalencias/" target="_blank"><img src="../imagenes/for_neumaticos.gif" width="20" height="20" border="0" /></a></td>
          	      <td><a href="http://www.teleneumatico.com/equivalencias/" target="_blank">Equivalencias</a></td>
                </tr>
                  <tr class="credito">
          	      <td><a href="../documentos/autorizacion.pdf" target="_blank"><img src="../imagenes/credito.png" width="20" height="20" border="0" /></a></td>
          	      <td><a href="../documentos/autorizacion.pdf" target="_blank">Autorización de crédito <img src="../imagenes/icon20x20_pdf.gif" width="20" height="20" /></a></td>
                </tr>
                  <tr class="credito">
          	      <td><a href="../documentos/autorizacion_de_credito.pdf" target="_blank"><img src="../imagenes/credito.png" width="20" height="20" border="0" /></a></td>
          	      <td><a href="../documentos/autorizacion_de_credito.pdf" target="_blank">Autorización de crédito <img src="../imagenes/icon20x20_pdf.gif" width="20" height="20" /></a></td>
                </tr>
       	      </table>
                    </div>
                        <div>
                            <a><img src="../imagenes/imagen25.jpg"  width="25" height="25"/> <h4 class="otros">Eurorepar</h4></a>
                        </div>
                    <div>
                        <table class="listado" style="float:left;margin:20px;" border="0" cellpadding="0">
                <tr>
                <td>
                <a href="../documentos/FILTROS DE ACEITE.xls"><img src="../imagenes/excel1.png" /></a>
                </td>
                <td>
                <a href="../documentos/FILTROS DE ACEITE.xls">Filtros de aceite</a>
                </td>
                </tr>
                <tr>
                <td>
                <a href="../documentos/FILTROS DE AIRE.xls"><img src="../imagenes/excel1.png" /></a>
                </td>
                <td>
                <a href="../documentos/FILTROS DE AIRE.xls">Filtros de aire</a>
                </td>
                </tr>
                <tr>
                <td>
                <a href="../documentos/FILTROS DIESEL.xls"><img src="../imagenes/excel1.png" /></a>
                </td>
                <td>
                <a href="../documentos/FILTROS DIESEL.xls">Filtros de gasoil</a>
                </td>
                </tr>
                <tr>
                <td>
                <a href="../documentos/FILTROS GASOLINA.xls"><img src="../imagenes/excel1.png" /></a>
                </td>
                <td>
                <a href="../documentos/FILTROS GASOLINA.xls">Filtros de gasolina</a>
                </td>
                </tr>
                <tr>
                <td>
                <a href="../documentos/PLAQUETAS DELANTERAS Y TRAS.xls"><img src="../imagenes/excel1.png" /></a>
                </td>
                <td>
                <a href="../documentos/PLAQUETAS DELANTERAS Y TRAS.xls">Plaquetas de freno</a>
                </td>
                </tr>
                <tr>
                <td>
                <a href="../documentos/DISCOS DE FRENO DELANTEROS Y TRAS.xls"><img src="../imagenes/excel1.png" /></a>
                </td>
                <td>
                <a href="../documentos/DISCOS DE FRENO DELANTEROS Y TRAS.xls">Discos de freno</a>
                </td>
                </tr>
                <tr>
                <td>
                <a href="../documentos/KITS DISTRIBUCION.xls"><img src="../imagenes/excel1.png" /></a>
                </td>
                <td>
                <a href="../documentos/KITS DISTRIBUCION.xls">Kit de distribución</a>
                </td>
                </tr>
              </table>
                        </div>
                        </div>
                </div>
                    
<p>&nbsp;</p>
        	<div class="pie">
            <hr>
           	Empresa Carrión SA <span>Jesús Martín 2012 ®</span>
        	</div>
       	  </div>
            </body>
    </body>
</html>