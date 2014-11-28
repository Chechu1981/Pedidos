<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Crear contacto</title>
        <link rel="shortcut icon" href="favicon.ico" ></link>
        <link rel="stylesheet" type="text/css" href="../estilos/style.css"></link>
    </head>
    <body>
        <?php
        include ('../estilos/conexion.php');
        ?>
        <div class="contenedor">
            <h1>Nuevo contacto </h1>
            <form method="POST" name="nuevo" action="nuevo.php"  >
                <table>
                    <tr class="buscar">
                        <td>Código</td><td> <input type="text" name="cod" value="<?php echo @$_POST['cod']; ?>" /></td>
                        <td>Nombre</td><td> <input type="text" name="nombre" value="<?php echo @$_POST['nombre']; ?>"/></td>
                        <td style="text-align: right">Tipo</td>
                        <td>
                            <select name="tipo" >
                                <option value=""></option>
                                <option value="A">Agente</option>
                                <option value="E">Eurorepar</option>
                                <option value="M">Moroso</option>
                            </select>
                        </td>
                    </tr><tr class="buscar"><td>Denominación</td><td> <input type="text" name="den" value="<?php echo @$_POST['den']; ?>"/></td>
                        <td>Teléfono</td><td colspan="3" ><input TYPE="text" name="tele" value="<?php echo @$_POST['tele']; ?>"/></td></tr>
                    <tr class="buscar"><td>Fax</td><td><input TYPE="text" name="fax" value="<?php echo @$_POST['fax']; ?>"/></td>
                        <td>Contacto</td><td colspan="3" ><input TYPE="text" name="con" value="<?php echo @$_POST['con']; ?>"/></td></tr>
                    <tr class="buscar"><td>Población</td><td colspan="2" ><textarea rows="5" name="pob" value="<?php echo @$_POST['pob']; ?>"></textarea></td>
                        <td>Horario</td><td colspan="2" ><input TYPE="text" name="hor"  value="<?php echo @$_POST['hor']; ?>"/></td></tr>
                    <tr class="buscar"><td>Correo electrónico</td><td><input TYPE="text" name="mail" value="<?php echo @$_POST['mail']; ?>"/></td><td></td>
                        <td>Ruta: <input id="ruta" name="ruta" type="checkbox"></input></td>
                        <td colspan="2" style="text-align: center" ><input TYPE="submit" name="new" value="Crear" /></td></tr>
                </table>
            </form>
            <?php
            if (isset($_POST['new'])) {
                $exist = mysql_query("SELECT * FROM hoja1 WHERE Nombre LIKE '" . $_POST['nombre'] . "'");
                $con = mysql_fetch_row($exist);
                echo $con[0];
                if ($con[0] != "" or $_POST['nombre'] == '') {
                    if ($_POST['nombre'] == '') {
                        ?> <script language="javascript">
                                        alert("El nombre del cliente no puede estar vacío");
                                        window.parent.closeIframe();
                        </script>
                        <?php
                    }else
                        echo '<script language="javascript">alert("Ya hay un cliente con el nombre ' . $_POST['nombre'] . '"); close();</script>';
                    } else {
                    $ruta=0;
                    if(utf8_decode($_POST['ruta'])== 'on'){
                         $ruta=1;
                    }
                    mysql_query("INSERT INTO hoja1 VALUES('" . utf8_decode($_POST['cod']) . "','" . utf8_decode($_POST['nombre']) . "','" . utf8_decode($_POST['den']) . "','" . utf8_decode($_POST['tele']) . "','" . utf8_decode($_POST['fax']) . "','" . utf8_decode($_POST['con']) . "','" . utf8_decode($_POST['pob']) . "','" . utf8_decode($_POST['hor']) . "','" . utf8_decode($_POST['mail']) . "','','" . utf8_decode($_POST['tipo']) . "'," . $ruta . ");");

                    echo '<script language="javascript">alert("Cliente ' . $_POST['nombre'] . ' creado con éxito."); window.parent.closeIframe();</script>';
                }
            }
            ?>
            <div class="pie">
                <hr>
                    Empresa Carrión SA <span>Jesús Martín 2012 </span>
            </div>
        </div>
    </body>
</html>