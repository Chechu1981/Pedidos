<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//ES" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Crear contacto</title>
        <link rel="shortcut icon" href="favicon.ico" />
        <link rel="stylesheet" type="text/css" href="../estilos/style.css" />
    </head>
    <body>
        <?php
        header("Cache-Control: no-store, no-cache, must-revalidate");
        include ('../estilos/conexion.php');

        function saltoLinea($str) {
            return str_replace(array("\r\n", "\r", "\n"), "<br />", $str);
        }
        ?>
        <div class="contenedor">
            <h1>Nuevo pedido </h1>
            <div id="formulario">
                <form method="POST" action="nuevo.php" name="nuevo" class="formularioprov">
                    <table>
                        <th>Proveedor</th>
                        <th>Operario</th>
                        <th>Orden/Cliente/Matrícula</th>
                        <th>Comentario</th>
                        <tr>
                            <td><input type="text" id="prov" name="proveedor" value="<?php if (isset($_POST['proveedor'])) echo $_POST['proveedor'] ?>"></input></td>
                            <td><input type="text" name="operario" value="<?php if (isset($_POST['operario'])) echo $_POST['operario'] ?>"></input></td>
                            <td><input type="text" name="orden" value="<?php if (isset($_POST['orden'])) echo $_POST['orden'] ?>"></input></td>
                            <td><input type="text" name="comentario" value="<?php if (isset($_POST['comentario'])) echo $_POST['comentario'] ?>"></input></td>
                        </tr>
                        <tr><td style="font-weight: bolder;padding:30px 10px 0px 10px;font-size: 18px">Aquí el pedido:</td></tr>
                        <tr><td colspan="4"><textarea style="background-color: antiquewhite" rows="10" cols="100" name="pedido" value="<?php if (isset($_POST['pedido'])) echo $_POST['pedido'] ?>"><?php if (isset($_POST['pedido'])) echo $_POST['pedido'] ?></textarea></td></tr>
                        <tr><td colspan="4" align="center"><input type="submit" name="new" title="Guardar pedido" value="Guardar pedido" class="recibido_btn" style="height: 50px;font-weight: bold"></input></td></tr>
                    </table>
                </form>
            </div>
            <?php
            if (isset($_POST['new'])) {
                if ($_POST['proveedor'] == '') {
                    ?> <script language="javascript"> alert("El nombre del proveedor no puede estar vacío");</script><?php
        } else {
            $texto = $_POST['pedido'];
            $mysqli->query("INSERT INTO o_proveedores VALUES('','',NOW(),'" . strtoupper(utf8_decode($_POST['proveedor'])) . "','" . strtoupper(utf8_decode($_POST['operario'])) . "','" . strtoupper(utf8_decode($_POST['orden'])) . "','" . strtoupper(utf8_decode($_POST['comentario'])) . "','" . strtoupper(saltoLinea(utf8_decode($texto))) . "','');");
            ?> <script language="javascript"> 
                                    //alert("Pedido de <?php $_POST['proveedor'] ?> creado con éxito.");
                                    if(window.parent.document.title == "Otros proveedores")
                                        window.parent.enviartitulo();
                                    window.parent.closeprov();
                    </script> <?php
        }
    }
            ?>
            <div class="pie">
                <hr/>
                Empresa Carrion SA <span>Jesús Martín 2012 </span>
            </div>
        </div>

    </body>
</html>