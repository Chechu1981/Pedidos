<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv=Content-Type content="text/html; charset=UTF-8" />
        <title>Mailing</title>
        <link rel="shortcut icon" href="../imagenes/chechu.ico" />
        <link rel="stylesheet" href="../scripts/styles.css" type="text/css" />
        <?php include_once '../scripts/estilos.php'; ?>
        <script src="script.js"></script>
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
                    <h2 style="padding:15px;" id="titulo">Mailing. Colectivo</h2>
                </div>
                <h2>Recuerda que el fichero que debes adjuntar debe ser con extensión ".csv" con los campos en el orden siguiente:</h2>
                <table style="margin:auto">
                    <th>matricula</th><th>cliente</th><th>correo</th>
                    <tr><td>0000AAA</td><td>Nombre Apellido1 Apellido2</td><td>cliente@servicdor.com</td></tr>
                </table>
                <div style="padding:15px"></div>
                <form style="background-color: #e1e1e1;padding: 20px;" action="correo.php" method="post" enctype="multipart/form-data">
                    <label><b>Adjunta el archivo:</b></label>
                    <input type="file" id="archivo" name="archivo" style="width: 500px" ></input>
                    <br/>
                    <input type="submit" title="Enviar" value="Enviar correos" style="margin: 80px;width: 150px;height: 80px"></input>
                </form>
<?php include_once '../scripts/pie.php'; ?>
            </div>
        </div>
    </body>
</html>