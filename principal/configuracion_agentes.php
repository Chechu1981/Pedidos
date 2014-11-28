<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv=Content-Type content="text/html; charset=UTF-8" />
        <link rel="shortcut icon" href="../imagenes/chechu.ico" />
        <link rel="stylesheet" type="text/css" href="../scripts/styles.css" />
        <?php include_once '../scripts/estilos.php'; ?>
        <title>Configuracion</title>
        <link rel="shortcut icon" href="../imagenes/chechu.ico" />
        
    </head>
    <body onload="cargar()">    
        <div class="contenedor">
            <?php 
            include_once '../scripts/cabecera.php';
            include '../calendario/calcular_dia.php'; 
            ?>
            <div class="principal">
                <?php include_once '../scripts/menu.php'; ?>
                <div class="banda">
                <h2 style="padding:15px;">Configuración.<br/>Gestión de agentes.</h2>
                <button onclick="add()">Nuevo</button>
                <a style="margin-left: 500px;padding-top: 10px" href="configuracion.php" title="Volver"><img src="../imagenes/atras.png"></a>
                </div>
                <div style="clear:both"></div>
                <div id="formulario" style="display: none"><?php include 'form_agentes.php'; ?></div>
                <div id="agentes" style="width: 200px;margin: auto"></div>
            </div>
            <?php include_once '../scripts/pie.php'; ?>
        </div>
        <script>
            function cargar(){
                $("#agentes").html("<h3>Cargando...</h3>");
                $.ajax({
                    url: "agentes.php",
                    async:false,
                    cache:false,
                    success: function(datos){
                        $("#agentes").html(datos);
                    }
                });
            }
            function addinsert(){
            var agente=$("#agente").val();
            var cuenta=$("#cuenta").val();
            var data={
                "ag":agente,
                "cu":cuenta
            }
                $.ajax({
                    url: "insert.php",
                    type: "POST",
                    data: data,
                    success:function(datos){
                        $("#agentes").html(datos);
                    }
                });
            }
            function eraser(id){
                $("#agentes").html("<h2>Eliminando...</h2>");
                $.ajax({
                    url:"eliminar.php?id="+id,
                });
                cargar();
            }
            
            //Mostrar formulario
            function add(){
                if($("#formulario").css("display") == "none")
                    $("#formulario").show("fold");
                else
                    $("#formulario").hide("fold");
            }
        </script>
    </body>
</html>