<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv=Content-Type content="text/html; charset=ISO-8859-1"></meta>
        <title>Modificar contacto <?php echo $_GET['cod'];?></title>
        <link rel="shortcut icon" href="favicon.ico" ></link>
        <link rel="stylesheet" type="text/css" href="../estilos/style.css"></link>
        <script type="text/javascript">
        function cerrar() {
            window.opener.location="clientes.php";
            var ventana = window.self;
            ventana.opener = window.self;
            ventana.close();
        }
        </script>
    </head>
    <body>
        <?php
        include ('../estilos/conexion.php');
        $sen=mysql_query("SELECT * FROM hoja1 WHERE id_contacto = ".$_GET['id'].";");
        $fi=mysql_fetch_row($sen);
        ?>
        <div class="contenedor">
            <h1>Modificar contacto <?php echo $fi[1];?></h1>
            <form method="POST" name="modificar" action="editar.php?id=<?php echo $fi[9]; ?>"  >
            <input type="hidden" name="id" value="<?php echo $fi[9]; ?>" />
            <table>
                <tr class="buscar">
                    <td>Código</td>
                    <td><input type="text" name="cod" value="<?php echo $fi[0];?>" /></td>
                    <td>Nombre</td>
                    <td><input type="text" name="nombre" value="<?php echo $fi[1]; ?>" /></td>
                </tr>
                <tr class="buscar">
                    <td>Denominación</td>
                    <td><input type="text" name="den" value="<?php echo $fi[2]?>"/></td>
                    <td>Teléfono</td>
                    <td><input TYPE="text" name="tele" value="<?php echo $fi[3]?>"/></td>
                    <td></td>
                </tr>
                <tr class="buscar">
                    <td>Fax</td>
                    <td><input TYPE="text" name="fax" value="<?php echo $fi[4]?>"/></td>
                    <td></td>
                    <td>Contacto</td>
                    <td><input TYPE="text" name="con" value="<?php echo $fi[5]?>"/></td>
                    <td></td>
                </tr>
                <tr class="buscar">
                    <td>Población</td>
                    <td><textarea rows="5" name="pob" ><?php echo $fi[6]?></textarea></td>
                    <td></td>
                    <td>Horario</td>
                    <td><input TYPE="text" name="hor" value="<?php echo $fi[7]?>" /></td>
                    <td></td>
                </tr>
                <tr class="buscar">
                    <td>Correo electrónico</td>
                    <td><input TYPE="text" name="mail" value="<?php echo $fi[8]?>"/></td>
                    <td></td>
                    <td><input TYPE="submit" name="mod" value="Modificar" /></td>
                    <td></td>
                </tr>
            </table>
        </form>
        <?php
        if(isset($_POST['mod'])){
            $reult=mysql_query("UPDATE hoja1 SET codigo='".$_POST['cod']."', Nombre='".$_POST['nombre']."', Denominacion='".$_POST['den']."', Telefono='".$_POST['tele']."', Fax='".$_POST['fax']."', Contacto='".$_POST['con']."', Poblacion='".$_POST['pob']."', Horario='".$_POST['hor']."', Mail='".$_POST['mail']."' WHERE id_contacto= ".$_POST['id'].";");  
            if($reult){
                ?><script language="javascript">alert("Actualizado"); cerrar();</script><?php
            }else{
                ?><script language="javascript">alert("No se ha actualizado"); cerrar();</script><?php
            }
        }
        unset($fi);
        ?>
        <div class="pie">
           Empresa Carrión SA <span>Jesús Martín 2012 ©</span>
        </div>
        </div>
    </body>
</html>
