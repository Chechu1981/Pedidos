<?php
header("Cache-Control: no-store, no-cache, must-revalidate");
?>
<table class="tarificador">
    <tr>
        <th>ANCHO</th>
        <th>ALTO</th>
        <th>DMTR</th>
        <th>IC</th>
        <th>CV</th>
        <th>MARCA</th>
        <th>MODELO</th>
        <th>REFERENCIA</th>
        <th>DTO</th>
        <th>OFERTA</th>
        <th>pvp</th>
        <th>ECOTASA</th>
        <?php if ($_SERVER['REMOTE_USER'] == "chechu") { ?>
        <th>D</th>
        
            <th><img src="../imagenes/in_nwupdate.gif" ></th>
        <?php } ?>
    </tr>
    <?php
    $max = 25;
    include_once '../estilos/conexion.php';
    $tablaneumaticos = $mysqli->query("SELECT * FROM neumaticos WHERE 
            ancho LIKE '" . $_GET['ancho'] . "%' AND 
            alto LIKE '" . $_GET['alto'] . "%' AND
            diam LIKE '" . $_GET['diam'] . "%' AND
            iv LIKE '" . $_GET['ic'] . "%' AND
            cv LIKE '" . $_GET['cv'] . "%' AND
            marca LIKE '" . $_GET['marca'] . "%' AND
            modelo LIKE '%" . $_GET['modelo'] . "%'");
    $contador = 1;
    if (@$tablaneumaticos->num_rows < 1 ) {
        ?>
        <tr><td colspan="12" style="font-size: 30px;">No se han encontrado coincidencias.</td></tr>
    <?php
    } else {
        while ($linea = $tablaneumaticos->fetch_row()) {
            $contador++;
            if (stripos(strtoupper($linea[5]), "MICHELIN") !== FALSE ||
                    stripos(strtoupper($linea[5]), "BRIDGESTONE") !== FALSE ||
                    stripos(strtoupper($linea[5]), "PIRELLI") !== FALSE ||
                    stripos(strtoupper($linea[5]), "DUNLOP") !== FALSE ||
                    stripos(strtoupper($linea[5]), "CONTINENTAL") !== FALSE ||
                    stripos(strtoupper($linea[5]), "GOOD") !== FALSE) {
                $max = 45;
            }
            $clase = "";
            if (str_replace(",", ".", $_GET['dto']) > $max) {
                $clase = "class='inaceptable'";
            }
            ?>
            <tr <?php echo $clase; ?> >
                <td><?php echo $linea[0] ?></td>
                <td><?php echo $linea[1] ?></td>
                <td><?php echo $linea[2] ?></td>
                <td><?php echo $linea[3] ?></td>
                <td><?php echo $linea[4] ?></td>
                <td><?php echo strtoupper($linea[5]) ?></td>
                <td><?php echo $linea[6] ?></td>
                <td><?php echo $linea[7] ?></td>
                <td><?php
                    if ($max == 45) {
                        echo "45%";
                    } else {
                        echo "25%";
                    }
                    ?></td>
                <td class="oferta"><a title="IMPRIMIR" onclick="javascript:imprSelec('<?php echo "bono" . $contador; ?>');" style="cursor:pointer;" >
                        <?php
                        $dto = (100 - $_GET['dto']) / 100;
                        $dto = str_replace(",", ".", $dto);
                        $foo = str_replace(",", ".", $linea[8] * 1.03); //PVP
                        $residuo = str_replace(",", ".", $linea[9]); //Residuo
                        $pvp = number_format(round((((($foo) * $dto) + 15 + $residuo) * 1.21) * $_GET['cantidad'], 2), 2) . "€";
                        echo $pvp;
                        $hoy = new DateTime();
                        ?>
                    </a> 
                    <div id="bono<?php echo $contador; ?>" style="display:none;">
                        <table style="font-family: arial;">
                            <tr>
                                <td>
                                    <img src="../imagenes/carrion.png" width="170px">            
                                </td>
                                <td>
        <?php if ($_SERVER['REMOTE_USER'] != "medina") { ?>
                                        <div>
                                            EMPRESA CARRIÓN<br/>
                                            Calle del Nitrógeno, 37<br/>
                                            47012 (Valaldolid)<br/>
                                            Recepción: 983 220 841<br>
                                            Recambios: 983 228 035
                                        </div> 
        <?php } else { ?>
                                        <div>
                                            EMPRESA CARRIÓN SA<br/>
                                            Avenida de la Constitución, 78<br/>
                                            47400 (Medina del Campo)<br/>
                                            Recepción: 983 803 229<br>
                                            Recambios: 983 803 229 
                                        </div> 
        <?php } ?>
                                </td>
                            </tr>
                            <tr><td colspan="2"><h1>Tarificador de neumáticos</h1></td></tr>
                            <tr><td colspan="2"><h2>Neumaticos: <?php echo $_GET['cantidad']; ?></h2></td></tr>
                            <tr><td colspan="2"><h2>Marca: <?php echo strtoupper($linea[5]); ?></h2></td></tr>
                            <tr><td colspan="2"><h2>Medida: <?php echo $linea[0] . " / " . $linea[1] . " R" . $linea[2] . " " . $linea[3] . " " . $linea[4]; ?></h2></td></tr>
                            <tr><td colspan="2"></td></tr>
                            <tr><td colspan="2"><h3>Fecha: <?php echo date_format($hoy, "d/m/Y H:i"); ?></h3></td></tr>
                            <tr><td colspan="2"><span style="margin-bottom: 200px;">Referencia: <?php echo $linea[7]; ?></span></td></tr>
                            <tr><td colspan="2"><h2 style="text-align: center;">Precio: <span style="font-size: 40px"><?php echo str_replace(".", ",", $pvp); ?>*</span></h2></td></tr>
                            <tr><td colspan="2"><h3>Incluye: Neumático + residuo + montaje + equilibrado <?php if ($_SERVER['REMOTE_USER'] != "medina") { ?> + limpieza exterior del vehículo. <?php } ?> </h3></td></tr>
                            <tr><td colspan="2">*PVP IVA incluído. Dto aplicado por rueda: <?php echo $_GET['dto']; ?>%</td></tr>
                        </table>
                    </div>
                </td>
                <td><?php echo str_replace(",", ".", $linea[8] * 1.03) ?></td>
                <td><?php echo $linea[9]; ?></td>
                <?php if ($_SERVER['REMOTE_USER'] == "chechu") { ?>
                <td><?php echo $linea[10]; ?></td> 
                <td><div style="cursor:pointer;" onclick="abrircantidad('<?php echo $linea[11]; ?>','<?php echo $linea[10]; ?>')">(+)</div></td>
            <?php } ?>
            </tr>
    <?php }
}
?>
    <tr >
        <td colspan="12" class="pie_neumaticos">
            La oferta incluye: <br/>Neumático + residuo + montaje + equilibrado + limpieza exterior del vehículo + IVA. 
        </td>
    </tr>
</table>