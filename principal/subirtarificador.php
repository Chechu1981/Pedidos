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
                    <a style="margin-left: 500px;padding-top: 10px" href="configuracion_tarificador.php" title="Volver"><img src="../imagenes/atras.png"></a>
                </div>
                <div style="clear:both"></div>
<?php 
$destino = "C:\\xampp\htdocs\clientes\documentos\\".trim($_FILES['archivo']['name']); 
$nombre = strtolower($_FILES['archivo']['name']);
if($nombre == "tarificador.xlsx"){
    if($_POST['titulo']!=''){
        move_uploaded_file($_FILES['archivo']['tmp_name'],$destino);
        ?><h3 class="lineas" style="width: 350px">Tarificador actualizado con éxito.</h3><?php
        mysql_connect("localhost","chechu");
	mysql_select_db("carrion");
        mysql_query("UPDATE nombres SET cadena = '(".$_POST['titulo'].")' WHERE aplicacion = 'tarificador';");
    }else{
        ?><div class="banda"><h3>La fecha no puede estar vacía.</h3></div><?php
    }
}else{
    ?><div class="banda"><h3>Error. <br/>El nombre del archivo debe de ser "tarificador.xlsx" </h3></div><?php
} ?>
<?php echo "Nombre: ".$_FILES['archivo']['name']; ?>
<br/>
<?php echo "Tipo: ".$_FILES['archivo']['type']; ?>
<br/>
<?php echo "Tamaño: ".$_FILES['archivo']['size']; ?>
<br/>
</div>
            <?php include_once '../scripts/pie.php'; ?>
        </div>
        <script>
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