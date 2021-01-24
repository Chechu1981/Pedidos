<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;" charset="ISO-8859-1"></meta>
        <title>Nuevo albarán de garantías</title>
        <link rel="shortcut icon" href="favicon.ico" ></link>
        <link rel="stylesheet" type="text/css" href="../estilos/style.css"></link>
        <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
        <script src="http://code.jquery.com/jquery-1.9.1.js"></script>  
        <script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script> 
        <script>
            function foco(){
                document.getElementById('orden').focus();
            }
            function validar(){
                var orden=document.getElementById('orden').value;
                var dosier=document.getElementById('expediente').value;
                var envio=document.getElementById('envio').value;
                var expediente=document.getElementById('expediente').value;
                if(orden==""){
                    alert("Debes introducir un numero de orden");
                }else if(envio==""){
                    alert("Debes introducir un número de envío");
                }else if(expediente==""){
                    alert("Debes introducir un número de expediente");
                }else if(dosier==""){
                    alert("Debes introducir un dosier");
                }else{
                    document.getElementById('enviar').submit();
                }
            }
            function objetoAjax(){
                var xmlhttp=false;
                try {
                    xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
                } catch (e) {
                try {
                   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                } catch (E) {
                    xmlhttp = false;
                }
                    }
                        if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
                        xmlhttp = new XMLHttpRequest();
                    }
                        return xmlhttp;
            }
            var lista=objetoAjax();
            function lista(envio){
                lista.open('GET','piezas.php?envio='+envio,true);
                lista.send(null);
                lista.onreadystatechange=ver;
            }
            function ver(){
                var tabla=document.getElementById('cuerpo');
                if(lista.readyState==4){
			tabla.innerHTML = ajax.responseText;	
		}else{
			tabla.innerHTML = "";
		}
            }
        </script>
    </head>
    <body onload="foco()">
        <?php
        //header("Cache-Control: no-store, no-cache, must-revalidate");
       	include ('../estilos/conexion.php');
        function saltoLinea($str){
            return str_replace(array("\r\n", "\r", "\n"), "<br />", $str);
        }
        ?>
        <div class="contenedor">
            <h1>Relación de envío de garantías PR </h1>
            Empresa Carrión SA<br/>
            C/ Nitrógeno, 37<br/>
            Polígono Industrial San Crstóbal<br/>
            47012 Valladolid<br/>
        <div id="formulario">
            <!--<form method="POST" target="_blank" action="lineas.php" name="nuevo" class="formularioprov">-->
                <table>
                    <tr>
                        <td>Fecha</td>
                        <td><input type="text" id="fecha" name="fecha" value="<?php echo  date('d-m-Y'); ?>"></input></td>
                    </tr>
                    <tr>
                        <td>Nº de envío</td>
                        <td><input type="envio" name="envio" id="envio" value="<?php echo date('Ymd'); ?>"></input></td>
                    </tr>
                    <tr>
                        <td>Albarán de Gefco</td>
                        <td><input type="albaran" name="albaran" value="<?php if(isset($_POST['orden'])) echo $_POST['orden'] ?>"></input></td>
                    </tr>
                    <tr>
                        <td><h3>Código cliente: </h3></td>
                        <td><h3><b> 010036E01 </b></h3></input></td>
                    </tr>
                </table>
                <fieldset>
                    <table>
                    <tbody>
                        <tr>
                            <td><label for="orden">Orden</label></td>
                            <td><input type="text" name="orden" id="orden" class="text ui-widget-content ui-corner-all" /><br/></td>
                        </tr>
                        <tr>
                            <td><label for="dosier">Dosier</label></td>
                            <td><input type="text" name="expediente" id="expediente" value="" class="text ui-widget-content ui-corner-all" /></td>
                        </tr>
                        <tr><td><td colspan="2" ><button id="enviar" onclick="validar()" value="Nueva garantía" style="height:60px;width: 160px;font-weight: bold" >Nueva garantía</button></td></td></tr>
                    </tbody>
                    </table>
                </fieldset>  
            <!--</form>-->
            </div>
            <form action="nuevo.php" method="POST">
                <table>    
                    <thead>      
                        <tr class="ui-widget-header ">        
                            <th>Orden</th>        
                            <th>Referencia</th>        
                            <th>Cantidad</th>
                            <th>Denominación</th>
                            <th>Dosier</th>
                        </tr>    
                    </thead>    
                    <tbody id="cuerpo">
                    </tbody>  
                </table>
            </form>
        <div class="pie">
            <hr/>
            Empresa Carrión SA <span>Jesús Martín 2012 ©</span>
        </div>
        </div>
    </body>
</html>