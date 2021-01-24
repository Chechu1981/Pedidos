<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link rel="shortcut icon" href="../imagenes/chechu.ico" />
        <link rel="stylesheet" type="text/css" href="../scripts/styles.css" />
        <link rel="stylesheet" type="text/css" href="incidencias.css" />
        <script src="gestion.js" ></script>
        <?php include_once '../scripts/estilos.php'; ?>
        <title>Incidencias</title>
    </head>
    <body onload="cargar()">
        <div class="contenedor">
            <?php
            include_once '../estilos/conexion.php';
            if (isset($_POST['ref'])) {
                $designacion = "";
                $ubicacion = "";
                $sentencia = $mysqli->query("SELECT * FROM denominacion WHERE referencia LIKE '" . $_POST['ref'] . "'");
                if ($sentencia->num_rows > 0) {
                    while ($fila = $sentencia->fetch_row()) {
                        $designacion = $fila[1];
                        $ubicacion = $fila[4];
                    }
                } elseif ($_POST['ref'] != "") {
                    $desigancion = "DESCONOCIDO";
                } else {
                    $desigancion = "";
                }
                $mysqli->query("INSERT INTO incidencias (referencia,designacion,ubicacion,comentario,hay,marca,fecha) VALUES ('" . $_POST['ref'] . "','" . $designacion . "','" . $ubicacion . "','" . $_POST['comentario'] . "','" . $_POST['hay'] . "','" . $_POST['marca'] . "',NOW())");
            }
            include '../calendario/calcular_dia.php'; ?>
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
                <h2 style="padding:15px;">Incidencias</h2> 
            </div>
            <div style="clear:both"></div>
            <form action="incidencias.php" method="post" class="incidencias" >
                <fieldset>
                    <legend>Nueva incidencia</legend>
                    <table>
                        <tr>
                            <th>Referencia</th>
                            <th>Hay</th>
                            <th>Marca</th>
                            <th>Comentario</th>
                        </tr>
                        <tr>
                            <td><input type="text" name="ref" id="ref" /><input type="hidden" name="designacion" size="5" style="text-align:right" /></td>
                            <td><input type="number" name="hay" size="5" style="text-align:right" /></td>
                            <td><input type="number" name="marca" size="5" style="text-align:right" /></td>
                            <td><input type="comentario" name="comentario" style="text-align:right" /></td>
                        </tr>
                        <tr>
                            <td colspan="4"><input type="submit" value="Añadir" /></td>
                        </tr>
                    </table>
                </fieldset>
            </form>
            <div id="tabla" ><?php include './tabla.php'; ?></div>
            <?php include_once '../scripts/pie.php'; ?>
        </div>
    </body>
</html>