<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Gestor de pedidos de Empresa Carrión</title>
        <link href="../css/style.css" rel="stylesheet" />
        <script src="../jquery-ui-1.10.4.custom/js/jquery-1.10.2.js" type="text/javascript" ></script>
        <script src="../jquery-ui-1.10.4.custom/js/jquery-ui-1.10.4.custom.js" type="text/javascript" ></script>
        <script src="../jquery-ui-1.10.4.custom/js/jquery-ui-1.10.4.custom.min.js" type="text/javascript" ></script>
        <link rel="stylesheet" href="../jquery-ui-1.10.4.custom/css/cupertino/jquery-ui-1.10.4.custom.css" />
        <?php
        session_start();
        ?>
        <script type="text/javascript" >
            function objetoAjax() {
                var xmlhttp = false;
                try {
                    xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
                } catch (e) {
                    try {
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                    }
                    catch (E) {
                        xmlhttp = false;
                    }
                }
                if (!xmlhttp && typeof XMLHttpRequest != 'undefined') {
                    xmlhttp = new XMLHttpRequest();
                }
                return xmlhttp;
            }

            var eliminarLineaAjax = new objetoAjax();

            function eliminarlinea(id) {
                var afirmativo = confirm("¿Eliminar linea?")
                if (afirmativo) {
                    eliminarLineaAjax.open("GET", "eliminarlinea.php?ide=" + id, true);
                    eliminarLineaAjax.send(null);
                    //verLineasSemanal(1);
                    window.location.href = "semanal.php?id=<?php echo session_id(); ?>";
                }
            }
        </script>
    </head>
    <body onload="document.getElementById('ref').focus()">
        <?php
        include_once '../calcular_dia.php';
        if (session_id() === @$_GET['id']) {
            ?>
            <div id="contenedor">
                <?php include '../helper/cabecera.php'; ?>
                <div id="menu"><?php include_once '../helper/menu.php'; ?></div>
                <?php
                mysql_select_db("pedidos");
                $sen_sema = mysql_query("SELECT * FROM listasemanal;");
                $ultimo = false;
                if(!isset($_GET['pedido'])){
                    $ultimo = true;
                }
                while($filas = mysql_fetch_row($sen_sema)){
                    if($filas[0] === @$_GET['pedido']){
                        if($filas[1] == "En curso"){
                            $ultimo = true;
                        }
                    }
                }
                if($ultimo){
                ?>
                <div class="frm_smn">
                    <form method="POST" action="semanal.php?id=<?php echo session_id(); ?>" >
                        <table>
                            <tr>
                                <th>REFERENCIA</th>
                                <th>C</th>
                                <th>COMENTARIO</th>
                            </tr>
                            <tr>
                                <td><input id="ref" name="ref" ></td>
                                <td style="width:40px;text-align:right;"><input style="width:40px;text-align:right;" id="can" name="can" ></td>
                                <td><input id="com" name="com" ></td>
                            </tr>
                            <tr><td colspan="2"><input type="submit" value="AÑADIR" ></td></tr>
                        </table>
                    </form>
                </div>
                <?php
                }
                ?>
                <div id="tabla"><?php include_once '../semanal/tabla_pedidos.php'; ?></div>
                <div id="pie"><?php include_once '../helper/pie.php'; ?></div>
            </div>
            <?php
        } else {
            echo "<a href='../pedidosclientes.php' >Debe iniciar sesion</a>";
        }
        ?>
    </body>
</html>