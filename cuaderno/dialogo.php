<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd" >
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Cuaderno</title>
        <link rel="shortcut icon" href="../imagenes/chechu.ico" />
        <link rel="stylesheet" href="../scripts/styles.css" type="text/css" />
        <link rel="stylesheet" href="../scripts/jquery-ui.css" />
        <link rel="stylesheet" href="../scripts/jquery.ui.theme.css" />
        <script src="../scripts/jquery-1.9.1.js"></script>  
        <script src="../scripts/jquery-ui.js"></script>
        <?php 
        include_once '../scripts/estilos.php'; 
        $id = $_GET['id'];
        include '../estilos/conexion.php';
        $result = $mysqli->query("SELECT * FROM cuaderno WHERE id= ".$id."");
        $datos = $result->fetch_row();
        if($datos[11] == "JAVI"){
            ?> <script src="funcionesJ.js" type="text/javascript" ></script> <?php
        }elseif($datos[11] == "CESAR"){
            ?> <script src="funcionesC.js" type="text/javascript" ></script> <?php
        }else{
             ?> <script src="funciones.js" type="text/javascript" ></script> <?php
        }
        ?>
    </head>
    <body onload="document.getElementById('cli').focus()" >
    <div id="insertar" class="marcoFrm" >
    <fieldset title="Añadir"><legend>Añadir linea</legend>
        <form action="" method="POST">
            <table class='cuadernoFrm'>
                <tr style="background-color: white;">
                    <th colspan="2">cliente</th>
                    <th>contacto</th>
                    <th>vehiculo</th>
                    <th>Datos del pedido</th>
                    <th colspan="2"></th>
                </tr>
                <tr style="background-color: white;">
                    <td colspan="2"><input type="hidden" name="id" id="id" value="<?php echo $datos[0];  ?>" /><input size="10" style="width:260px" type="text" id="cli" name="cli" onkeyup="envioConIntro(event)" value="<?php echo utf8_encode(strtoupper($datos[1])); ?>" /></td>
                    <td><input size="6" style="text-align: right;width:100px"  type="text" id="contacto" name="contacto" onkeyup="envioConIntro(event)" value="<?php echo utf8_encode(strtoupper($datos[2])); ?>" /></td>
                    <td><input size="10" style="width:210px" type="text" id="vehiculo" name="vehiculo" onkeyup="envioConIntro(event)" value="<?php echo $datos[5]; ?>" /></td>
                    <td  rowspan="3"><textarea size="4" style="width:200px;height: 200px;" type="text" id="descripcion" name="descripcion" value="<?php echo $datos[3]; ?>" ><?php echo utf8_encode(strtoupper($datos[3])); ?></textarea></td>
                    <td colspan="2"><div class="boton" onclick="ruta()" >Añadir a la ruta</div></td>
                </tr>
                <tr style="background-color: white;">
                    <th>n</th>
                    <th>referencia</th>
                    <th>ubicacion</th>
                    <th>comentario</th>
                    <th rowspan="1">servido</th>
                    <th rowspan="1">pedido</th>
                </tr>
                <tr style="background-color: white;">
                    <td><input size="20" style="width:40px;margin-top: -50px;" name="numero" id="numero" onkeyup="envioConIntro(event)" value="<?php echo utf8_encode(strtoupper($datos[4])); ?>" /></td>
                    <td><textarea style="width:215px;height:100px;" type="text" id="referencia" name="referencia"  value="<?php echo utf8_encode($datos[6]); ?>" ><?php echo utf8_encode($datos[6]); ?></textarea></td>
                    <td><input size="10" style="width:100px;margin-top: -50px;" type="text" id="ubicacion" name="ubicacion" onkeyup="envioConIntro(event)" value="<?php echo utf8_encode(strtoupper($datos[7])); ?>" /></td>
                    <td rowspan="1"><textarea size="10" style="width:210px;height:100px" type="text" id="comentario" name="comentario" value="<?php echo $datos[8]; ?>" ><?php echo utf8_encode(strtoupper($datos[8])); ?></textarea></td>
                    <td ><input size="10" style="width:90px;margin-top: -50px;" type="text" id="servido" name="servido" onkeyup="envioConIntro(event)" value="<?php echo utf8_encode(strtoupper($datos[9])); ?>" /></td>
                    <td ><input size="10" style="width:90px;margin-top: -50px;" type="text" id="pedido" name="pedido" onkeyup="envioConIntro(event)" value="<?php echo utf8_encode(strtoupper($datos[10])); ?>" /></td>
                </tr>
                <tr style="background-color: white;">
                    <td colspan="7"><button onclick="update()">Guardar y cerrar</button></td>
                </tr>
            </table>
        </form>
    </fieldset>
</div>