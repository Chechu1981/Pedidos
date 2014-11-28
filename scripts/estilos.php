<?php
include ('../estilos/conexion.php');
$equipos = mysql_query("SELECT * FROM nombres WHERE aplicacion = '" . $_SERVER['REMOTE_ADDR'] . "';");
$puesto = mysql_fetch_row($equipos);
if ($puesto[2] == '#CD928E') {
    ?> <link rel="stylesheet" type="text/css" href="../estilos/styleRojo.css" /> <?php
} elseif ($puesto[2] == '#ABABAB') {
    ?> <link rel="stylesheet" type="text/css" href="../estilos/styleGris.css" /> <?php
} elseif ($puesto[2] == '#00907D') {
    ?> <link rel="stylesheet" type="text/css" href="../estilos/styleVerde.css" /> <?php
} elseif ($puesto[2] == '#f0f0f0') {
    ?> <link rel="stylesheet" type="text/css" href="../estilos/styleClaro.css" /> <?php
} else {
    ?> <link rel="stylesheet" type="text/css" href="../estilos/style.css" /> <?php
}
?>
