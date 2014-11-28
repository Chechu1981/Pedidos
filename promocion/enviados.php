<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv=Content-Type content="text/html; charset=UTF-8" />
        <title>Mailing</title>
        <link rel="shortcut icon" href="../imagenes/chechu.ico" />
        <link rel="stylesheet" href="../scripts/styles.css" type="text/css" />
        <?php include_once '../scripts/estilos.php'; ?>
        <script type="text/javascript">
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
        
        var entregar=objetoAjax();

        function entregado(id){
            var texto = document.getElementById("inp"+id);
            if(texto.value === ""){
                alert("No puedes dejar la casilla vacía");
                texto.style.border = "2px solid red";
                texto.focus();
            }else{  
                entregar.open('GET','canjeado.php?id='+id+'&asesor='+texto.value,true);
                entregar.send(null);
                window.location.reload();
                //entregar.onreadystatechange = respuestatitulo;

                /*function respuestatitulo(){
                    if(entregar.readyState === 4){
                        div.innerHTML = entregar.responseText;	
                    }else{
                        div.value = "";
                    }
                }*/
            }
        }
        </script>
    </head>
    <body>
        <div class="contenedor">
           <?php include '../calendario/calcular_dia.php'; ?>
            <header>
                <?php include_once '../scripts/cabecera.php'; ?>
            </header>
            <nav>
                <?php include_once '../scripts/menu.php'; ?>
            </nav>
            <div class="principal">
                <div class="banda">
                    <h2 style="padding:15px;" id="titulo">Mailing. <?php echo $_GET['date']; ?></h2>
                </div>
                <?php
                include '../estilos/conexion.php';
                $correos = mysql_query("SELECT * FROM mailing WHERE fecha LIKE '" . $_GET['date'] . "' ORDER BY nombre");
                $numero=1;
                $estilo="";
                ?>
                <div style="clear: both"></div>
                <h2>Correos envíados el <?php echo $_GET['date']; ?></h2>
                <table>
                    <th></th>
                    <th style="width:80px">Matrícula</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Asesor</th>
                    <th>Fecha</th>
                    <th></th>
                <?php while ($fila = mysql_fetch_row($correos)) { 
                    if($fila[5]==""){
                        $estilo="noCanjeado";
                    }else{
                        $estilo="canjeado";
                    }
                    $date = date_create($fila[6]); ?>
                    <tr class="<?php echo $estilo; ?>">
                        <td><?php echo $numero++; ?></td>
                        <td><?php echo $fila[1]; ?></td>
                        <td><?php echo $fila[2]; ?></td>
                        <td><?php echo $fila[3]; ?></td>
                        <td><?php if($estilo == "noCanjeado"){ ?><input value="<?php echo $fila[5]; ?>" id="<?php echo 'inp'.$fila[0]; ?>"></input> <?php }else{ echo strtoupper($fila[5]); } ?></td>
                        <td><?php if($fila[6] != "0000-00-00 00:00:00"){ echo date_format($date,'d/m/Y H:i:s'); } ?></td>
                        <td><?php if($estilo == "noCanjeado"){ ?><button id="<?php echo 'btn'.$fila[0]; ?>" onclick="entregado(<?php echo $fila[0]; ?>)">Entregado</button> <?php } ?></td>
                    </tr>
                <?php } ?>
                    </table>
            </div>
            <?php include_once '../scripts/pie.php'; ?>
        </div>
    </body>
</html>