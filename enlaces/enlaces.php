<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv=Content-Type content="text/html; charset=UTF-8" />
        <title>Enlaces</title>
        <?php include_once '../scripts/estilos.php'; ?>
        <link rel="stylesheet" href="../scripts/styles.css" type="text/css" /> 
        <?php
        include '../calendario/calcular_dia.php';
        include_once'../estilos/conexion.php';
        $nombres = $mysqli->query("SELECT cadena FROM nombres WHERE aplicacion = 'tarificador'");
        while ($tarificador = $nombres->fetch_row())
            $linea = $tarificador[0];
        ?>
    </head>
    <body>
        <div class="contenedor">
            <header>
                <?php include_once '../scripts/cabecera.php'; ?>
            </header>
            <nav>
                <?php include_once '../scripts/menu.php'; ?>
            </nav>
            <div class="principal">
                <div class="banda">
                    <h2 style="padding:15px;">Enlaces</h2>
                </div>
            </div>

            <div style="clear: both"></div>
            <div id="accordion">
                <h3>
                    <a href="#"><img src="../imagenes/Auto_Logo_Citroen.png" /><span class="titulo">Citroen</span></a>
                </h3>
                <div>
                    <table class="listado" border="0" cellpadding="0" style="float:left;margin:20px;">
                        <tr>
                            <td><a href="https://networkservice.citroen.com" target="_blank"><img src="../imagenes/CITROEN_.jpg" /></a></td>
                            <td><a href="https://networkservice.citroen.com" target="_blank">Citroen Service</a></td>
                        </tr>
                        <tr>
                            <td><a title="Usuario: AC31673132 &#10;Contraseña: 07092004" href="http://service.citroen.com/" target="_blank"><img src="../imagenes/CITROEN_.jpg" /></a></td>
                            <td><a title="Usuario: AC31673132 &#10;Contraseña: 07092004" href="http://service.citroen.com/" target="_blank">Citroen Service (Gratuíto)</a></td>
                        </tr>
                        <tr>
                            <td><a href="../documentos/garantias.xlsx"><img src="../imagenes/excel1.png" /></a></td>
                            <td><a href="../documentos/garantias.xlsx">Garantías</a> <i><a href="mailto:recogidas.valladolid@gefco.net?Subject=Recogida%20garantía%20Empresa%20Carrión" target="_top">(recogidas.valladolid@gefco.net)</a></i></td>
                        </tr>
                        <tr>
                            <td><a href="../documentos/garantias.xlsx"><img src="../imagenes/excel1.png" /></a></td>
                            <td><a href="../documentos/garantias.xlsx">Cambio estándar</a> <i><a href="mailto:recogidas.valladolid@gefco.net?Subject=Recogida%20estándar%20Empresa%20Carrión" target="_top">(recogidas.valladolid@gefco.net)</a></i></td>
                        </tr>
                        <tr>
                            <td><a href="https://bolsapiezas.citroen.com/" target="_blank"><img src="../imagenes/digg-20.png" border="0" /></a></td>
                            <td><a href="https://bolsapiezas.citroen.com/" target="_blank">BPO</a></td>
                        </tr>
                        <tr>
                            <td><a href="https://accecit.citroen.com" target="_blank"><img src="../imagenes/citroen.gif" border="0" /></a></td>
                            <td><a href="https://accecit.citroen.com" target="_blank">ACCECIT</a></td>
                        </tr>
                        <tr>
                            <td><a href="https://docinfogroupe.psa-peugeot-citroen.com/ead/dom/view.action?domId=1000383482" target="_blank"><img src="../imagenes/personne.gif" border="0" /></a></td>
                            <td><a href="https://docinfogroupe.psa-peugeot-citroen.com/ead/dom/view.action?domId=1000383482" target="_blank">B2B</a></td>
                        </tr>
                        <tr>
                            <td><a href="https://parts.citroen.com/" target="_blank"><img src="../imagenes/carro.png" border="0" /></a></td>
                            <td><a href="https://parts.citroen.com/" target="_blank">Parts</a></td>
                        </tr>
                        <tr>
                            <td><a href="https://speeder.citroen.com/login.do" target="_blank"><img src="../imagenes/despacho.png" border="0" /></a></td>
                            <td><a href="https://speeder.citroen.com/login.do" target="_blank">Speeder</a></td>
                        </tr>
                        <tr>
                            <td><a href="https://emulation.psa-on-line.com/" target="_blank"><img src="../imagenes/tour_run_dos_cmd.png" border="0" /></a></td>
                            <td><a href="https://emulation.psa-on-line.com/" target="_blank">Cipre</a></td>
                        </tr>
                        <tr>
                            <td><a href="https://networkservice.citroen.com/docapvpr/afficheListe.do?ref=&amp;typeDoc=9" target="_blank"><img src="../imagenes/list.jpg"  border="0" /></a></td>
                            <td><a href="https://networkservice.citroen.com/docapvpr/afficheListe.do?ref=&amp;typeDoc=9" target="_blank">Listas complejas</a></td>
                        </tr>
                        <tr>
                            <td><a href="http://www.citroen.es/home/#/home/"><img src="../imagenes/citroen1.gif" /></a></td>
                            <td><a href="http://www.citroen.es/home/#/home/" target="_blank">Citroen</a></td>
                        </tr>
                        <tr>
                            <td><a href="https://networkservicetest.citroen.com/socle/?start=true" target="_blank"><img src="../imagenes/Edit.gif" border="0" /></a></td>
                            <td><a href="https://networkservicetest.citroen.com/socle/?start=true" target="_blank">Test Service</a></td>
                        </tr>
                        <tr>
                            <td><a title="Usuario: MJ08465 &#10;Contraseña: SANCHEZ12" href="https://www.bibserve.com/MichelinSCEBE/LoginServlet" target="_blank"><img src="../imagenes/icone_guide_michelin.gif" border="0" /></a></td>
                            <td><a title="Usuario: MJ08465 &#10;Contraseña: SANCHEZ12" href="https://www.bibserve.com/MichelinSCEBE/LoginServlet" target="_blank">Bibserve</a></td>
                        </tr>
                        <tr>
                            <td><a href="https://myway.goodyear.com/login" title="Usuario: juan@empresacarrion.com &#10;Contraseña: cala4704" target="_blank"><img src="../imagenes/goodyear-logo.jpg" /></a></td>
                            <td><a href="https://myway.goodyear.com/login" title="Usuario: juan@empresacarrion.com &#10;Contraseña: cala4704" target="_blank">MyWay <?php echo $linea; ?></a></td>
                        </tr>
                        <tr>
                            <td><a href="../documentos/pomos.pdf" target="_blank"><img src="../imagenes/pomo.jpg" border="0" /></a></td>
                            <td><a href="../documentos/pomos.pdf" target="_blank">Pomos citroen <img src="../imagenes/icon20x20_pdf.gif" /></a></td>
                        </tr>
                        <tr>
                            <td><a href="../documentos/cartografias.pdf" target="_blank"><img src="../imagenes/mapa.jpg" border="0" /></a></td>
                            <td><a href="../documentos/cartografias.pdf" target="_blank">Cartografías (Junio 2014)<img src="../imagenes/icon20x20_pdf.gif" /></a></td>
                        </tr>
                        <tr>
                            <td><a href="../documentos/pedido.pdf" target="_blank"><img src="../imagenes/mapa.jpg" border="0" /></a></td>
                            <td><a href="../documentos/pedido.pdf" target="_blank">Bono de pedido de cartografías<img src="../imagenes/icon20x20_pdf.gif" /></a></td>
                        </tr>
                    </table>
                </div>
                <h3>
                    <a herf="#"><img src="../imagenes/Auto_Logo_Volvo.png" /> <span class="volvo">Volvo</span></a>
                </h3>
                <div>
                    <table class="listado" style="float:left;margin:20px;" border="0" cellpadding="0">
                        <tr>
                            <td><a href="http://vida.volvocars.biz/Vida" target="_blank"><img src="../imagenes/VOLVO_.jpg" /></a></td>
                            <td><a href="http://vida.volvocars.biz/Vida" target="_blank">VIDA</a></td>
                        </tr>
                        <tr>
                            <td><a href="http://accessories.volvocars.com/AccessoriesWeb/Accessories.mvc/es-ES/ES" target="_blank"><img src="../imagenes/boton_mas.gif" border="0" /></a></td>
                            <td><a href="http://accessories.volvocars.com/AccessoriesWeb/Accessories.mvc/es-ES/ES" target="_blank">Accesorios</a></td>
                        </tr>
                        <tr>
                            <td><a href="..\documentos\neum_volvo.xlsx" ></a><img src="../imagenes/excel1.png" /></td>
                            <td></a><a href="..\documentos\neum_volvo.xlsx" >Neumáticos</a></td>
                        </tr>
                        <tr>
                            <td><a title="Usuario: volvo6148 &#10;Contraseña: v740630" href="http://pvpconcesionarios.com/default.aspx" target="_blank"><img src="../imagenes/icone_guide_michelin.gif" border="0" /></a></td>
                            <td><a title="Usuario: volvo6148 &#10;Contraseña: v740630" href="http://pvpconcesionarios.com/default.aspx" target="_blank">Michel&iacute;n</a></td>
                        </tr>
                        <tr>
                            <td><a href="../documentos/pqvolvo.pdf" target="_blank"><img src="../imagenes/produtos-quimicos.png" border="0" /></a></td>
                            <td><a href="../documentos/pqvolvo.pdf" target="_blank">Productos qu&iacute;micos <img src="../imagenes/icon20x20_pdf.gif" /></a></td>
                        </tr>
                        <tr>
                            <td><a href="http://tie.volvocars.biz/MainPageAction.do?dispatch=getUserData" target="_blank"><img src="../imagenes/global__icon_tie.gif" border="0" /></a></td>
                            <td><a href="http://tie.volvocars.biz/MainPageAction.do?dispatch=getUserData" target="_blank">TIE</a></td>
                        </tr>
                        <tr>
                            <td><a href="../documentos/volvo/DISCREPANCIAS.xls" ></a><img src="../imagenes/excel1.png" /></td>
                            <td></a><a href="../documentos/volvo/DISCREPANCIAS.xls" >Discrepancias</a></td>
                        </tr>
                        <tr>
                            <td><a href="../documentos/volvo/INTERCAMBIO.xls" ></a><img src="../imagenes/excel1.png" /></td>
                            <td></a><a href="../documentos/volvo/INTERCAMBIO.xls" >Intercabio</a></td>
                        </tr>
                        <tr>
                            <td><a href="../documentos/volvo/RETIRADA_DE_MERCANCIA-bluebox.xls" ></a><img src="../imagenes/excel1.png" /></td>
                            <td></a><a href="../documentos/volvo/RETIRADA_DE_MERCANCIA-bluebox.xls" >Retirada de mercancía bluebox</a></td>
                        </tr>
                        <tr>
                            <td><a href="../documentos/volvo/RETIRADA_DE_MERCANCIA-CONCESIONARIOS.xls" ></a><img src="../imagenes/excel1.png" /></td>
                            <td></a><a href="../documentos/volvo/RETIRADA_DE_MERCANCIA-CONCESIONARIOS.xls" >Retirada de mercancía Concesionarios</a></td>
                        </tr>	
                        <tr>
                            <td><a href="../documentos/volvo/RETIRADA_DE_MERCANCIA-INTERCAMBIO.xls" ></a><img src="../imagenes/excel1.png" /></td>
                            <td></a><a href="../documentos/volvo/RETIRADA_DE_MERCANCIA-INTERCAMBIO.xls" >Retirada de mercancía Intercambio</a></td>
                        </tr>
                        <tr>
                            <td><a href="../documentos/volvo/RETIRADA_DE_MERCANCIA-PALLET.xls" ></a><img src="../imagenes/excel1.png" /></td>
                            <td></a><a href="../documentos/volvo/RETIRADA_DE_MERCANCIA-PALLET.xls" >Retirada de mercancía Pallet</a></td>
                        </tr>
                        <tr>
                            <td><a href="../documentos/volvo/RETIRADA_DE_MERCANCIA-TMA.xls" ></a><img src="../imagenes/excel1.png" /></td>
                            <td></a><a href="../documentos/volvo/RETIRADA_DE_MERCANCIA-TMA.xls" >Retirada de mercancía TMA</a></td>
                        </tr>
                        <tr>
                            <td><a href="../documentos/volvo/RETIRADA_DE_MERCANCIA-discrep.xls" ></a><img src="../imagenes/excel1.png" /></td>
                            <td></a><a href="../documentos/volvo/RETIRADA_DE_MERCANCIA-discrep.xls" >Retirada de mercancía Discrepancia</a></td>
                        </tr>
                        <tr>
                            <td><a href="../documentos/volvo/VOR.xls" ></a><img src="../imagenes/excel1.png" /></td>
                            <td></a><a href="../documentos/volvo/VOR.xls" >VOR</a></td>
                        </tr>
                        <tr>
                            <td><a href="../documentos/volvo/etiquetas.ppt" ></a><img src="../imagenes/tour_run_dos_cmd.png" /></td>
                            <td></a><a href="../documentos/volvo/etiquetas.ppt" >Etiquetas</a></td>
                        </tr>

                    </table>
                </div>
                <h3>
                    <a><img src="../imagenes/Modio_Logo.png" /> <span class="otros">Otros</span></a>
                </h3>
                <div>
                    <table class="listado" style="float:left;margin:20px;" border="0" cellpadding="0">
                        <tr>
                            <td><a title="Usuario: AP01721052 &#10;Contraseña: chechu" href="http://public.servicebox.peugeot.com/" target="_blank"><img src="../imagenes/PEUGEOT_.jpg" /></a></td>
                            <td><a title="Usuario: AP01721052 &#10;Contraseña: chechu" href="http://public.servicebox.peugeot.com/" target="_blank">Service Box</a></td>
                        </tr>
                        <tr>
                            <td><a title="Usuario: es-720859 &#10; Nombre: admin &#10;Contraseña: o3d8h67z8k" href="http://www.partslink24.com/" target="_blank"><img src="../imagenes/parts.gif" /></a></td>
                            <td><a title="Usuario: es-720859 &#10; Nombre: admin &#10;Contraseña: o3d8h67z8k" href="http://www.partslink24.com/" target="_blank">Parts Link 24</a> <cite style="font-size: small"> (contraseña: o3d8h67z8k)</cite></td>
                        </tr>
                        <tr>
                            <td><a title="Usuario: 230654 &#10;Contraseña: C54r23" href="http://www.lausan.es/" target="_blank"><img src="../imagenes/l.gif" border="0" /></a></td>
                            <td><a title="Usuario: 230654 &#10;Contraseña: C54r23" href="http://www.lausan.es/" target="_blank">Lausan</a></td>
                        </tr>
                        <tr>
                            <td><a href="https://www.mann-hummel.com/mf_prodkata_eur/index.html?iKeys=23.3.0.31.3" target="_blank"><img src="../imagenes/mann.gif" border="0" /></a></td>
                            <td><a href="https://www.mann-hummel.com/mf_prodkata_eur/index.html?iKeys=23.3.0.31.3" target="_blank">Filtros Mann</a></td>
                        </tr>
                        <tr>
                            <td><a href="http://www.oscaro.es/" target="_blank"><img src="../imagenes/40151261_avatar_small.jpg" border="0" /></a></td>
                            <td><a href="http://www.oscaro.es/" target="_blank">Oscaro</a></td>
                        </tr>
                        <tr>
                            <td><a href="http://www.teleneumatico.com/equivalencias/" target="_blank"><img src="../imagenes/for_neumaticos.gif" border="0" /></a></td>
                            <td><a href="http://www.teleneumatico.com/equivalencias/" target="_blank">Equivalencias</a></td>
                        </tr>
                        <?php if ($_SERVER['REMOTE_USER'] == "chechu") { ?>
                            <tr class="credito">
                                <td><a href="../documentos/datos.pdf" target="_blank"><img src="../imagenes/credito.png" border="0" /></a></td>
                                <td><a href="../documentos/datos.pdf" target="_blank">Datos bancarios<img src="../imagenes/icon20x20_pdf.gif" /></a></td>        
                            </tr>
                        <?php } ?>
                        <tr class="credito">
                            <td><a href="../documentos/autorizacion.pdf" target="_blank"><img src="../imagenes/credito.png" border="0" /></a></td>
                            <td><a href="../documentos/autorizacion.pdf" target="_blank">Autorización de recibos <img src="../imagenes/icon20x20_pdf.gif" /></a></td>
                        </tr>
                        <tr class="credito">
                            <td><a href="../documentos/autorizacion_de_credito.pdf" target="_blank"><img src="../imagenes/credito.png" border="0" /></a></td>
                            <td><a href="../documentos/autorizacion_de_credito.pdf" target="_blank">Autorización de crédito <img src="../imagenes/icon20x20_pdf.gif" /></a></td>
                        </tr>
                    </table>
                </div>
                <h3>
                    <a><img src="../imagenes/imagen25.jpg" /> <span class="otros">Eurorepar</span></a>
                </h3>
                <div>
                    <table class="listado" style="float:left;margin:20px;" border="0" cellpadding="0">
                        <tr>
                            <td>
                                <a href="../documentos/escobillas.xls"><img src="../imagenes/excel1.png" /></a>
                            </td>
                            <td>
                                <a href="../documentos/escobillas.xls">Escobillas</a>
                            </td>
                        </tr>
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



            <p>&nbsp;</p>
            <?php include_once '../scripts/pie.php'; ?>
        </div>
        <script>
            $(function() {
                $("#accordion").accordion({
                    collapsible: true
                });
            });
        </script>
    </body>
</html>