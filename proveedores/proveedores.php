<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv=Content-Type content="text/html; charset=UTF-8" />
        <title>Otros proveedores</title>
        <link rel="shortcut icon" href="../imagenes/chechu.ico" />
        <link rel="stylesheet" href="../scripts/styles.css" type="text/css" />
        <?php include_once '../scripts/estilos.php'; ?>
        <script src="script.js"></script>
    </head>
    <body onload="<?php 
        if(isset($_GET['p'])){ 
            if($_GET['p']=='r'){
                ?> antigu(); <?php 
            }elseif($_GET['p']=='b'){
              ?>  buscar();vercuadro();document.getElementById('prove').focus(); <?php
            } else { 
            ?> enviartitulo(); <?php }} ?>;enviartitulo();" >
        <div id="dialog-message" style="display: none" title="Nombre del operario">       
                <span class="ui-icon ui-icon-circle-check" style="float: left; margin: 0 7px 50px 0;"></span>        
            Nombre:
            <p>
                <input id="nomb"></input>    
            </p>
        </div>
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
                <h2 style="padding:15px;" id="titulo">Otros proveedores</h2>
                <div class="antig" style="height: 14px;" onclick="vercuadro()">
                    <img src="../imagenes/buscar.png" align="middle" style="cursor:pointer;height: 18px" title="Buscar"/> Buscar
                </div>
                <div id="nuevo" onclick="nuevo()">
                    Nuevo pedido
                </div>
                <div class="antig" onclick="antigu()">
                    Recibidos
                </div>
                <div class="antig" onclick="enviartitulo()">
                    En curso
                </div>
                    <div style="clear: both"></div>
             </div>
                    <div id="buscar" class="buscar" style="display:none;width: 670px;padding-left: 50px">
                        <fieldset title="Buscar"><legend>Buscar</legend>
                            <table>
                                <th>Proveedor</th>
                                <th>Orden</th>
                                <th>Pedido</th>
                                <th>Operario</th>
                                <th>Comentario</th>
                                <tr>
                                    <td><input size="10" onkeyup="buscar()" type="text" id="prove" name="proveedor" value=""></input></td>
                                    <td><input size="10" onkeyup="buscar()" type="text" id="ord" name="orden" value=""></input></td>
                                    <td><input size="10" onkeyup="buscar()" type="text" id="pedido" name="pedido" value=""></input></td>
                                    <td><input size="10" onkeyup="buscar()" type="text" id="operario" name="operario" value=""></input></td>
                                    <td><input size="10" onkeyup="buscar()" type="text" id="comentario" name="comentario" value=""></input></td>
                                </tr>
                            </table>            
                        </fieldset>
                    </div>
                    <div id="tabla"></div>
            <?php include_once '../scripts/pie.php'; ?>
            </div>
        </div>
    </body>
</html>