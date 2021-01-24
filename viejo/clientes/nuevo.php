<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv=Content-Type content="text/html; charset=ISO-8859-1"></meta>
        <title>Crear contacto</title>
        <link rel="shortcut icon" href="favicon.ico" ></link>
        <link rel="stylesheet" type="text/css" href="../estilos/style.css"></link>
        <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
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
            </tr><tr class="buscar"><td>Denominación</td><td> <input type="text" name="den" value="<?php echo @$_POST['den']; ?>"/></td>
            <td>Teléfono</td><td><input TYPE="text" name="tele" value="<?php echo @$_POST['tele']; ?>"/></td><td></td></tr>
            <tr class="buscar"><td>Fax</td><td><input TYPE="text" name="fax" value="<?php echo @$_POST['fax']; ?>"/></td><td></td>
            <td>Contacto</td><td><input TYPE="text" name="con" value="<?php echo @$_POST['con']; ?>"/></td><td></td></tr>
                <tr class="buscar"><td>Población</td><td><textarea rows="5" name="pob" value="<?php echo @$_POST['pob']; ?>"></textarea></td><td></td>
            <td>Horario</td><td><input TYPE="text" name="hor"  value="<?php echo @$_POST['hor']; ?>"/></td><td></td></tr>
            <tr class="buscar"><td>Correo electrónico</td><td><input TYPE="text" name="mail" value="<?php echo @$_POST['mail']; ?>"/></td><td></td>
            <td><input TYPE="submit" name="new" value="Crear" /></td><td></td></tr>
            </table>
        </form>
            <?php
            if(isset($_POST['new'])){
                    $exist=mysql_query("SELECT * FROM hoja1 WHERE Nombre LIKE '".$_POST['nombre']."'");
                    $con=mysql_fetch_row($exist);
                    echo $con[0];
                    if($con[0]!="" or $_POST['nombre']==''){
                        if($_POST['nombre']==''){
                                ?> <script language="javascript">
                                    alert("El nombre del cliente no puede estar vacío");
                                    window.parent.closeIframe();
                                </script>
                         <?php
                        }else
                                echo '<script language="javascript">alert("Ya hay un cliente con el nombre '.$_POST['nombre'].'"); close();</script>';
                    }else{
                        mysql_query("INSERT INTO hoja1 VALUES('".$_POST['cod']."','".$_POST['nombre']."','".$_POST['den']."','".$_POST['tele']."','".$_POST['fax']."','".$_POST['con']."','".$_POST['pob']."','".$_POST['hor']."','".$_POST['mail']."','');");
                        
                        echo '<script language="javascript">alert("Cliente '.$_POST['nombre'].' creado con éxito."); window.parent.closeIframe();</script>';
                }
            }
            ?>
        <div class="pie">
            <hr>
           Empresa Carrión SA <span>Jesús Martín 2012 ©</span>
        </div>
        </div>
    </body>
</html>