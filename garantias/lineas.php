<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;" charset="ISO-8859-1"></meta>
        <title>Lineas</title>
        <link rel="shortcut icon" href="favicon.ico" ></link>
        <link rel="stylesheet" type="text/css" href="../estilos/style.css"></link>
        <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
        <script src="http://code.jquery.com/jquery-1.9.1.js"></script>  
        <script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script> 
        <script>
            function foco(){
                document.getElementById('referencia').focus();
            }
            var ajax=new XMLHttpRequest();
            function enviar(){
                    var ref=document.getElementById('referencia').value;
                    ajax.open('GET','../calendario/denominacion.php?ref='+ref,true);
                    ajax.send(null);
                    ajax.onreadystatechange = respuesta;
            }
            function respuesta(){
                    var div=document.getElementById('denominacion');
                    if(ajax.readyState==4){
                            div.value = ajax.responseText;	
                    }else{
                            div.value = "DESCONOCIDO";
                    }
            }
            function cerrar() {
                window.open("","_parent","");
                var ventana = window.self;
                ventana.opener = window.self;
                ventana.close();
 }
        </script>
    </head>
    <body onload="foco()">
        <div class="contenedor">
        <?php
        //header("Cache-Control: no-store, no-cache, must-revalidate");
       	include ('../estilos/conexion.php');
        function saltoLinea($str){
            return str_replace(array("\r\n", "\r", "\n"), "<br />", $str);
        }
        ?>
            <form action="lineas.php"  method="POST">  
                <fieldset>
                    <table>
                    <tbody>
                        <tr>
                            <td>
                                <input type="hidden" name="orden" id="orden" value="<?php echo $_POST['orden']; ?>" />
                                <input type="hidden" name="expediente" id="expediente" value="<?php echo strtoupper($_POST['expediente']); ?>"  />
                                <input type="hidden" name="envio" id="envio" value="<?php echo $_POST['envio']; ?>"  />
                                <label for="referencia">Referencia</label></td>
                            <td><input type="text" onblur="enviar()" name="referencia" id="referencia" class="text ui-widget-content ui-corner-all" /><br/></td>
                        </tr>
                        <tr>
                            <td><label for="cantidad">Cantidad</label></td>
                            <td><input type="text" name="cantidad" id="cantidad" value="" class="text ui-widget-content ui-corner-all" /></td>
                        </tr>
                        <tr>
                            <td><label for="denominacion">Denominacioón</label></td>
                            <td><input type="text" name="denominacion" id="denominacion" value="" class="text ui-widget-content ui-corner-all" /></td>
                        </tr>
                        <tr><td rowspan="2"><td rowspan="3" ><input type="submit" value="Añadir" style="height:60px;width: 160px;font-weight: bold" /></td></td></tr>
                    </tbody>
                    </table>
                </fieldset>  
            </form>
        <div id="users-contain" style="text-align: center" class="ui-widget">  
            <h1>Dosieres</h1>  
            <table id="users" style="margin:auto;" class="ui-widget ui-widget-content">    
                <thead>      
                    <tr class="ui-widget-header ">        
                        <th>Orden</th>        
                        <th>Referencia</th>        
                        <th>Cantidad</th>
                        <th>Denominación</th>
                        <th>Dosier</th>
                    </tr>    
                </thead>    
                <tbody>      
                    <?php
                    include_once '../estilos/conexion.php';
                    if(isset($_POST['referencia'])){
                        mysql_query("INSERT INTO piezas (envio,referencia,cantidad,denominacion,expediente,orden) VALUES ('".$_POST['envio']."','".$_POST['referencia']."','".$_POST['cantidad']."','".$_POST['denominacion']."','".$_POST['expediente']."','".$_POST['orden']."')");
                        echo "INSERT INTO piezas (envio,referencia,cantidad,denominacion,expediente,orden) VALUES ('".$_POST['envio']."','".$_POST['referencia']."','".$_POST['cantidad']."','".$_POST['denominacion']."','".$_POST['expediente']."','".$_POST['orden']."')";
                    }
                    $sentencia=  mysql_query("SELECT * FROM piezas");
                    while($fila=  mysql_fetch_row($sentencia)){
                        ?><tr><td><?php echo $fila[6] ?></td><?php
                        ?><td><?php echo $fila[2] ?></td><?php
                        ?><td><?php echo $fila[3] ?></td><?php
                        ?><td><?php echo $fila[4] ?></td><?php
                        ?><td><?php echo $fila[5] ?></td></tr><?php
                    }
                    ?>
                </tbody>  
            </table>
            <button onclick="cerrar()" id="create-user">Cerar expediente</button>
        </div>
        <div class="pie">
            <hr/>
           Empresa Carrión SA <span>Jesús Martín 2012 ©</span>
        </div>
        </div>
    </body>
</html>