<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
    </head>
    <body style="font-family: arial">
        <div id="bono">
            <table>
                <tr>
                    <td>
                        <img src="../imagenes/carrion.png" width="170px">            
                    </td>
                    <td>
                        <div>
                            EMPRESA CARRIÓN<br/>
                            Calle del Nitrógeno, 37<br/>
                            47012 (Valaldolid)<br/>
                            recepción: 983 220 841<br>
                            recambios: 983 228 035
                        </div>            
                    </td>
                </tr>
                <tr><td colspan="2"><h1>Tarificador de neumáticos</h1></td></tr>
                <tr><td colspan="2"><h2>Neumaticos: <?php echo $_GET['cantidad']; ?></h2></td></tr>
                <tr><td colspan="2"><h2>Marca: <?php echo $_GET['marca']; ?></h2></td></tr>
                <tr><td colspan="2"><h2>Medida: <?php echo $_GET['ancho'] . " / " . $_GET['alto'] . " R" . $_GET['diam'] . " " . $_GET['ic'] . " " . $_GET['cv']; ?></h2></td></tr>
                <tr><td colspan="2"><h3>Incluye: Neumático + residuo + montaje + equilibrado <?php if ($_SERVER['REMOTE_USER'] != "medina") { ?> + limpieza exterior del vehículo. <?php } ?> </h3></td></tr>
                <tr><td colspan="2"><h3>Fecha: <?php echo date_format($hoy, "d-m-y H:i"); ?></h3></td></tr>
                <tr><td colspan="2"><span style="margin-bottom: 200px;">Referencia: <?php echo $linea[7]; ?></span></td></tr>
                <tr><td colspan="2"><h2 style="text-align: center;">Precio: <span style="font-size: 40px"><?php echo str_replace(".", ",", $pvp); ?>*</span></h2></td></tr>
                <tr><td>*PVP IVA incluído.</td></tr>
                <tr><td>Dto aplicado por rueda: <?php echo $_GET['dto']; ?>%</td></tr>
            </table>
        </div>
    </body>
</html>