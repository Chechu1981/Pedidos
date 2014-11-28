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
                    <h2 style="padding:15px;">Configuración.<br/>Gestión de campañas.</h2>
                    <a style="margin-left: 500px;padding-top: 10px" href="configuracion.php" title="Volver"><img src="../imagenes/atras.png"></a>
                </div>
                <div style="clear:both"></div>
                <form action="subiroferta.php" method="POST" enctype="multipart/form-data"> 
                    <b>Título del documento:</b> 
                    <br> 
                    <input type="text" name="titulo" size="20" maxlength="17"  /> 
                    <input type="hidden" name="MAX_FILE_SIZE" value="10000000" /> 
                    <br> 
                    <br> 
                    <b>Archivo: </b> 
                    <br> 
                    <input size="100" name="archivo" type="file"> 
                    <br> 
                    <input type="submit" value="Enviar"> 
                </form> 
            </div>
            <?php include_once '../scripts/pie.php'; ?>
        </div>
    </body>
</html>