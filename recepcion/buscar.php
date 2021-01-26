<h1>Buscar</h1>
<?php 
include ('../estilos/conexion.php');
//if(isset($_GET['oper']) and isset($_GET['ord']) and isset($_GET['prove']))
$result = $mysqli->query("SELECT * FROM recepcion WHERE matricula LIKE '%".$_GET['matricula']."%'AND orden LIKE '%".$_GET['orden']."%' AND observaciones LIKE '%".$_GET['observaciones']."%' ORDER BY f_entrega DESC;");
if($result->num_rows > 0){ ?>
    <table border="1" class="listbuscar">
        <th>Orden</th>
        <th>Matr&iacute;cula</th>
        <th>Entrada</th>
        <th>Peritaci&oacute;n</th>
        <th>Compromiso</th>
        <th>Pendiente PR</th>
        <th>Entrega</th>
        <th>Cortes&iacute;a</th>
        <th>Control Calidad</th>
        <th>Observaciones</th>
        <?php
        header("Cache-Control: no-store, no-cache, must-revalidate");
        while(@$fila = $result->fetch_row()){
            $date1 = date_create($fila[3]);
            $date2 = date_create($fila[4]);
            $date3 = date_create($fila[7]);
            ?> 
            <tr>
                <td style="text-align: center;cursor:pointer;text-decoration: underline"><a onclick="ptepr(<?php echo $fila[1]; ?>)" ><?php echo $fila[1]; ?></a></td>
                <td style="text-align: center"><?php echo $fila[2]; ?></td>
                <td style="text-align: center"><?php echo date_format($date1,'d/m/Y'); ?></td>
                <td style="text-align: center"><?php echo date_format($date2,'d/m/Y'); ?></td>
                <td style="text-align: center"><?php echo $fila[5]; ?></td>
                <td style="text-align: center"><?php echo $fila[6]; ?></td>
                <td style="text-align: center"><?php echo date_format($date3,'d/m/Y'); ?></td>
                <td style="text-align: center"><?php echo $fila[8]; ?></td>
                <td style="text-align: center"><?php echo $fila[9]; ?></td>
                <td style="text-align: center"><?php echo $fila[10]; ?></td>
            </tr> <?php
        }
        ?>
    </table>
<?php }else{
    ?> <h1 style="text-align: center;font-size: 80px;color: coral">No se han encontrado coincidencias</h1> <?php
        }
        ?>