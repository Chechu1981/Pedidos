<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv=Content-Type content="text/html; charset=UTF-8" />
        <title>Modificar contacto <?php echo $_GET['id']; ?></title>
        <link rel="shortcut icon" href="favicon.ico" ></link>
        <link rel="stylesheet" type="text/css" href="../estilos/style.css"></link>
        <script type="text/javascript">
            function cerrar() {
                window.opener.location = "clientes.php";
                var ventana = window.self;
                ventana.opener = window.self;
                ventana.close();
            }
        </script>
    </head>
    <body>
        <?php
        include ('../estilos/conexion.php');
        $sen = mysql_query("SELECT * FROM hoja1 WHERE id_contacto = " . $_GET['id'] . ";");
        $fi = mysql_fetch_row($sen);
        ?>
        <div class="contenedor">
            <h1>Modificar contacto <?php echo utf8_encode($fi[1]); ?></h1>
            <form method="POST" name="modificar" action="editar.php?id=<?php echo utf8_encode($fi[9]); ?>"  >
                <input type="hidden" name="id" value="<?php echo utf8_encode($fi[9]); ?>" />
                <table border="1">
                    <tr class="buscar">
                        <td>Código</td>
                        <td><input type="text" name="cod" value="<?php echo utf8_encode($fi[0]); ?>" /></td>
                        <td>Nombre</td>
                        <td colspan="2" ><input type="text" name="nombre" value="<?php echo utf8_encode($fi[1]); ?>" /></td>
                    </tr>
                    <tr class="buscar">
                        <td>Denominación</td>
                        <td><input type="text" name="den" value="<?php echo utf8_encode($fi[2]) ?>"/></td>
                        <td>Teléfono</td>
                        <td colspan="2" ><input TYPE="text" name="tele" value="<?php echo utf8_encode($fi[3]) ?>"/></td>
                    </tr>
                    <tr class="buscar">
                        <td>Fax</td>
                        <td><input TYPE="text" name="fax" value="<?php echo utf8_encode($fi[4]) ?>"/></td>
                        <td>Contacto</td>
                        <td colspan="2" ><input TYPE="text" name="con" value="<?php echo utf8_encode($fi[5]); ?>"/></td>
                    </tr>
                    <tr class="buscar">
                        <td>Población</td>
                        <td><textarea rows="5" name="pob" ><?php echo utf8_encode($fi[6]) ?></textarea></td>

                        <td>Horario</td>
                        <td><input TYPE="text" name="hor" value="<?php echo utf8_encode($fi[7]) ?>" /></td>
                        <td>Ruta: <input id="ruta" name="ruta" type="checkbox" <?php if ($fi[11] == 1) { ?>checked<?php } ?> ></input></td>
                    </tr>
                    <tr class="buscar">
                        <td>Correo electrónico</td>
                        <td><input TYPE="text" name="mail" value="<?php echo utf8_encode($fi[8]) ?>"/></td>
                        <td>Tipo</td>
                        <td>
                            <select name="tipo" >
                                <option value=""></option>
                                <option <?php
                                if ($fi[10] == "A") {
                                    echo "selected";
                                }
                                ?> value="A">Agente</option>
                                <option <?php
                                if ($fi[10] == "E") {
                                    echo "selected";
                                }
                                ?> value="E">Eurorepar</option>
                                <option <?php
                                if ($fi[10] == "M") {
                                    echo "selected";
                                }
                                ?> value="M">Moroso</option>
                            </select>
                        </td>
                        <td><input TYPE="submit" name="mod" value="Modificar" /></td>
                    </tr>
                </table>
            </form>
            <?php
            if (isset($_POST['mod'])) {
                $ruta = 0;
                if (utf8_decode($_POST['ruta']) == 'on') {
                    $ruta = 1;
                }
                $reult = mysql_query("UPDATE hoja1 SET codigo='" . utf8_decode($_POST['cod']) . "', Nombre='" . utf8_decode($_POST['nombre']) . "', Denominacion='" . utf8_decode($_POST['den']) . "', Telefono='" . utf8_decode($_POST['tele']) . "', Fax='" . utf8_decode($_POST['fax']) . "', Contacto='" . utf8_decode($_POST['con']) . "', Poblacion='" . utf8_decode($_POST['pob']) . "', Horario='" . utf8_decode($_POST['hor']) . "', Mail='" . utf8_decode($_POST['mail']) . "', tipo='" . utf8_decode($_POST['tipo']) . "', ruta=" . $ruta . " WHERE id_contacto= " . $_POST['id'] . ";");
                if ($reult) {
                    ?><script language="javascript">alert("Actualizado");
                                cerrar();</script><?php
                } else {
                    ?><script language="javascript">alert("No se ha actualizado");
                                cerrar();</script><?php
                }
            }
            unset($fi);
            ?>
            <div class="pie">
                Empresa Carrión SA <span>Jesús Martín 2012 </span>
            </div>
        </div>
    </body>
</html>
