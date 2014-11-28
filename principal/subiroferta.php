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
                    <h2 style="padding:15px;">Configuración.<br/>Campaña del mes.</h2>
                    <a style="margin-left: 500px;padding-top: 10px" href="configuracion_oferta.php" title="Volver"><img src="../imagenes/atras.png"></a>
                </div>
                <div style="clear:both"></div>
                <?php
                $fichero = $_FILES['archivo'];
                @rename($fichero, "oferta.jpg");
                $destino = "C:\\xampp\htdocs\clientes\documentos\oferta.jpg";
                if ($_FILES['archivo']["error"] > 0) {
                    if($_FILES['archivo']["error"] == 2){
                        echo "Archivo demasiado grande. Máximo 10Mb.";
                    }
                    echo "Error: " . $_FILES['archivo']['error'] . "<br>";
                } else {
                    if ($_POST['titulo'] != '') {
                        copy($fichero['tmp_name'], $destino);
                        ?><h3 class="lineas" style="width: 350px">Oferta actualizada con éxito.</h3><?php
                        mysql_connect("localhost", "chechu");
                        mysql_select_db("carrion");
                        mysql_query("UPDATE nombres SET cadena = '" . $_POST['titulo'] . "' WHERE aplicacion = 'oferta';");
                    } else {
                        ?><div class="banda"><h3>El título no puede estar vacío.</h3></div><?php
                    }
                }
                ?>
                <?php echo "Nombre: " . $fichero['name']; ?>
                <br/>
                <?php echo "Tipo: " . $_FILES['archivo']['type']; ?>
                <br/>
                <?php echo "Tamaño: " . $_FILES['archivo']['size']; ?>
                <br/>
            </div>
            <?php include_once '../scripts/pie.php'; ?>
        </div>
        <script>
            $(function() {
                $("#titulo").datepicker({
                    dateFormat: "dd/mm/y",
                    monthNames: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
                    dayNamesMin: ["Lu", "Ma", "Mi", "Ju", "Vi", "Sa", "Do"],
                    firstDay: 1
                });
            });
        </script>
    </body>
</html>