<!DOCTYPE html><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html>
    <head>
        <meta http-equiv=Content-Type content="text/html; charset=UTF-8" />
        <title>Ubicacion</title>
        <?php include_once '../scripts/estilos.php'; ?>
        <link rel="stylesheet" href="../scripts/styles.css" type="text/css" />
        <?php include_once '../calendario/calcular_dia.php'; ?>
    </head>
    <body onload="document.getElementById('referencia').focus();">
        <div class="contenedor">
            <header>
                <?php include_once '../scripts/cabecera.php'; ?>
            </header>
            <nav>
                <div class="principal">
                    <?php include_once '../scripts/menu.php'; ?>
                </div>
            </nav>
            <div style="clear: both"></div>
            <div class="banda">
                <h2 style="padding:15px;">Consultas</h2>
                <h3>Actualizado 22/10/14</h3>
            </div>
            <div class="cabecera">
                <table>
                    <tr class="buscar">
                        <td>Referencia</td>
                        <td><input id="referencia"  type="text" name="referencia" /></td>
                    </tr>
                    <tr class="buscar">
                        <td>Denominación</td>
                        <td><input id="den" type="text" name="den" /></td>
                    </tr>
                </table>
            </div>
            <div id="vista"></div>
            <?php include_once '../scripts/pie.php'; ?>
        </div>
        <script src="script.js"></script>
    </body>
</html>