<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv=Content-Type content="text/html; charset=UTF-8" />
        <link rel="shortcut icon" href="../imagenes/chechu.ico" />
        <link rel="stylesheet" type="text/css" href="../scripts/styles.css" />
        <?php include_once '../scripts/estilos.php'; ?>
        <title>Carrión</title>
        <script type="text/javascript">
            $(document).ready(function() {
                $(".carousel").dualSlider({
                    auto: true,
                    autoDelay: 6000,
                    easingCarousel: "swing",
                    easingDetails: "easeOutBack",
                    durationCarousel: 1000,
                    durationDetails: 600
                });
            });
        </script>
    </head>
    <body>
        <div class="contenedor">
            <?php include_once '../scripts/cabecera.php';
            include '../calendario/calcular_dia.php';
            ?>
            <div class="principal">
                <?php
                include_once '../scripts/menu.php';
                include_once '../estilos/conexion.php';
                $destino = $_GET['destino'];
                ?>
                <div class="banda">
                    <img src="../imagenes/logo_Citroen.png" width="90" style="float: left;margin: 8px" />
                    <h2 style="padding:15px;">Pendiente de Servir</h2>
                </div>  
                <div>
                    <table border='2' width='100%;' class='listado'>
                        <th></th>
                        <th>Referencia</th>
                        <th>C</th>
                        <th>Designación</th>
                        <th>Matrícula</th>
                        <th>Cliente</th>
                        <th>Fecha</th>
                        <th>Pedido</th>
                        <?php
                        $contador = 1;
                        $sentencia = $mysqli->query("SELECT * FROM lineas WHERE ps LIKE 'checked=\"checked\"' ORDER BY fecha DESC");
                        if ($destino == "T") {
                            ?><h1>Taller</h1> <?php
                                $sentencia = $mysqli->query("SELECT * FROM lineas WHERE destino LIKE '" . $destino . "' AND ps LIKE 'checked=\"checked\"' ORDER BY fecha DESC");
                            } elseif ($destino == "M") {
                                ?><h1>Mostrador</h1> <?php
                            $sentencia = $mysqli->query("SELECT * FROM lineas WHERE destino LIKE '" . $destino . "' AND ps LIKE 'checked=\"checked\"' ORDER BY fecha DESC");
                        } else {
                            ?><h1>Todos</h1> <?php
                        }
                        while ($fila = $sentencia->fetch_row()) {
                            $mss = Array('enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre');
                            $ms = "";
                            $n = 0;
                            $anio = substr($fila[10], -4);
                            for ($i = 0; $i < 12; $i++) {
                                if (stristr($fila[10], $mss[$i]) == TRUE) {
                                    $ms = $mss[$i];
                                    $n = $i + 1;
                                }
                            }
                            $dy = substr($fila[10], 0, -(strlen($ms) + 4));
                            ?> <tr><td> <?php echo $contador++; ?></td> <?php
                            ?> <td> <?php echo $fila[1]; ?></td> <?php
                            ?> <td> <?php echo $fila[2]; ?></td> <?php
                            ?> <td> <?php echo $fila[3]; ?></td> <?php
                            ?> <td> <?php echo $fila[4]; ?></td> <?php
                            ?> <td> <?php echo $fila[5]; ?></td> <?php
                            ?> <td> <?php echo $fila[6]; ?></td> <?php
                                echo "<td><a href='pedidos.php?ano=" . $anio . "&mes=" . $ms . "&numes=" . $n . "&dia=" . $dy . "&ref=" . $fila[1] . "'>" . $fila[10] . "</a></td></tr>";
                                if ($contador == 51) {
                                    return;
                                }
                            }
                            ?>
                    </table>
                </div>
            </div>
<?php include_once '../scripts/pie.php'; ?>
        </div>
    </body>
</html>