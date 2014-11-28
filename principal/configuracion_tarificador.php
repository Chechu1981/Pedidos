<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv=Content-Type content="text/html; charset=UTF-8" />
        <link rel="shortcut icon" href="../imagenes/chechu.ico" />
        <link rel="stylesheet" type="text/css" href="../scripts/styles.css" />
        <?php include_once '../scripts/estilos.php'; ?>
        <title>Configuración</title>
        <link rel="shortcut icon" href="../imagenes/chechu.ico" />
    </head>
    <body>    
        <div class="contenedor">
            <?php 
            include_once '../scripts/cabecera.php';
            include '../calendario/calcular_dia.php'; 
            ?>
            <div class="principal">
                <?php include_once '../scripts/menu.php'; ?>
                <div class="banda">
                    <h2 style="padding:15px;">Configuración.<br/>Tarificador de neumáticos.</h2>
                    <a style="margin-left: 500px;padding-top: 10px" href="configuracion.php" title="Volver"><img src="../imagenes/atras.png"></a>
                </div>
                <div style="clear:both"></div>
                <div class="aviso" >
                    <img src="../imagenes/peligro.png" style="margin: 0 8px 8px 0;" align="center" border="0" />El nombre del archivo debe ser "tarificador.xlsx" y es obligatorio poner la fecha del tarificador."<br/>
                </div>
                <div id="spinner" style="display:none;position: static;margin: auto;width: 30px;vertical-align: central"><img src="../imagenes/spinner.gif" /></div>
                <form style="margin-top: 15px;" action="subirtarificador.php" method="post" enctype="multipart/form-data"> 
                    <b>Fecha del documento:</b> 
                    <br> 
                    <input id="titulo" type="text" name="titulo" size="20" maxlength="17"> 
                    <input type="hidden" name="MAX_FILE_SIZE" value="100000"> 
                    <br/> 
                    <br/> 
                    <b>Archivo: </b> 
                    <br/> 
                    <input size="100" id="archivo" name="archivo" type="file"> 
                    <br/> 
                    <input onclick="subir()" type="submit" value="Enviar"> 
                </form> 
            </div>
            <?php include_once '../scripts/pie.php'; ?>
        </div>
        <script>   
            function subir(){
                document.getElementById('spinner').style.display = "block";
            }
            $(function() {    
                $( "#titulo" ).datepicker({
                    dateFormat: "dd/mm/y",
                    monthNames: [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
                    dayNamesMin: ["Lu", "Ma", "Mi", "Ju", "Vi", "Sa", "Do"],
                    firstDay: 1
                });
            });  
        </script>
    </body>
</html>