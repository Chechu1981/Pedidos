<?php

$array = array("mensaje" => "Hola desde otro punto de la red"); //Por ejemplo
if (isset($_GET['callback'])) { // Si es una petición cross-domain
    echo $_GET['callback'] . '(' . json_encode($array) . ')';
} else // Si es una normal, respondemos de forma normal
    echo json_encode($array);

include ('./pedidosclientes/helper/conexion.php');
include ('./pedidosclientes/calcular_dia.php');
mysql_select_db("pedidos");

// __--MENSAJE--__
function mnsj() {
    $mensaje = '
        <html>
        <head>
          <title>Listado pendiente de servir</title>
          <style>
            th{
                background-color:#969696;
                color:black;
                padding:8px;
            }
            tr:hover{
                background-color:#FFDC23;
                color:#938FBA;
                font-weight:bold;
            }
            .pie{
                clear: both;
                padding-top: 20px;
                border-bottom-style: solid;
                border-bottom-width: 5px;
                border-bottom-color: #dc002e;
                margin-top: 20px;
                text-align: center;
            }
          </style>
        </head>
        <body style="background-color:F0F0F0;">
          <p>Buenas tardes:</p>
                    Este es el listado pendiente de servir del dia ' . date('j') . ' de ' . calcular_mes() . ' de ' . date('Y') . ':
          <table>
              <th>referencia</th><th>Denominación</th><th>Cantidad</th><th>Cliente</th><th>Comentario</th>
            ';
    return $mensaje;
}

$cabeceras = 'MIME-Version: 1.0' . "\r\n";
$cabeceras .= 'Content-type: text/html; charset=UTF-8' . "\r\n";

// __-- DESTINATARIOS --__

$destinatarios = "juan@empresacarrion.com";
$destinatarios = $destinatarios . ",recepcion@empresacarrion.com";
$destinatarios = $destinatarios . ",recepcion1@empresacarrion.com";
$destinatarios = $destinatarios . ",adolfo.lopez@empresacarrion.com";
$destinatarios = $destinatarios . ",raul@empresacarrion.com";
$destinatarios = $destinatarios . ",lolo@empresacarrion.com,";
$destinatarios = $destinatarios . ",marisa@empresacarrion.com";
$destinatarios = $destinatarios . ",postventa@empresacarrion.com";
$destinatarios = $destinatarios . ",f.barrientos@empresacarrion.com";

$fecha = getdate(time());
$fe = $fecha['mday'];

$tbnogueira = "";
$tbcarrion = "";
$tbmedina = "";
$dia = $fe . calcular_mes() . calcular_ano();
mysql_select_db("pedidos");
$psnogueira = mysql_query("SELECT * FROM lineas WHERE destino LIKE 'M' AND cliente LIKE '%NOGUEIRA%' AND ps NOT LIKE '' AND fecha_pedido = '" . $dia . "';");
$pendiente = mysql_query("SELECT * FROM lineas WHERE destino LIKE 'T' AND ps NOT LIKE '' AND fecha_pedido = '" . $dia . "';");
$psmedina = mysql_query("SELECT * FROM lineas WHERE destino LIKE 'M' AND cliente LIKE '%MEDINA%' AND ps NOT LIKE '' AND fecha_pedido = '" . $dia . "';");
echo "SELECT * FROM lineas WHERE destino LIKE 'M' AND cliente LIKE '%MEDINA%' AND ps NOT LIKE '' AND fecha_pedido = '" . $dia . "';";

while ($ref = @mysql_fetch_row($pendiente)) {
    $mss = Array('enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre');
    $anio = substr($ref[10], -4);
    $ms = "";
    $n = 0;
    for ($i = 0; $i < 12; $i++) {
        if (stristr($ref[10], $mss[$i]) == TRUE) {
            $ms = $mss[$i];
            $n = $i + 1;
        }
    }
    $dy = substr($ref[10], 0, -(strlen($ms) + 4));
    $tbcarrion = $tbcarrion . "<tr><td><a href='http://80.32.251.17/calendario/pedidos.php?ano=" . $anio . "&mes=" . $ms . "&numes=" . $n . "&dia=" . $dy . "&ref=" . $ref[1] . "'>" . $ref[1] . "</a></td><td>" . $ref[3] . "</td><td>" . $ref[2] . "</td><td>" . $ref[5] . "</td><td>" . $ref[4] . "</td></tr>";
}

while ($fila = mysql_fetch_row($psnogueira)) {
    $tbnogueira = $tbnogueira . "<tr><td>" . $fila[1] . "</td><td>" . $fila[3] . "</td><td>" . $fila[2] . "</td><td>" . $fila[5] . "</td><td>" . $fila[4] . "</td></tr>";
}

while ($fila = mysql_fetch_row($psmedina)) {
    $tbmedina = $tbmedina . "<tr><td>" . $fila[1] . "</td><td>" . $fila[3] . "</td><td>" . $fila[2] . "</td><td>" . $fila[5] . "</td><td>" . $fila[4] . "</td></tr>";
}

function msjsin() {
    $anio = "";
    $ms = "";
    $n = "";
    $dy = "";
    $fecha = getdate(time());
    $fe = $fecha['mday'];
    $dia = $fe . calcular_mes() . calcular_ano();
    mysql_select_db("pedidos");
    $pendiente = mysql_query("SELECT * FROM lineas WHERE destino LIKE 'T' AND fecha_pedido = '" . $dia . "';");
    while ($ref = @mysql_fetch_row($pendiente)) {
        $mss = Array('enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre');
        $anio = substr($ref[10], -4);
        $ms = "";
        $n = 0;
        for ($i = 0; $i < 12; $i++) {
            if (stristr($ref[10], $mss[$i]) == TRUE) {
                $ms = $mss[$i];
                $n = $i + 1;
            }
        }
        $dy = substr($ref[10], 0, -(strlen($ms) + 4));
    }
    //<b><a href="http://10.159.64.63/calendario/pedidos.php?ano=' . $anio . '&mes=' . $ms . '&numes=' . $n . '&dia=' . $dy . ' title="Usuario: recepcion &#10;Contraseña: arce" >Ver pedido</a></b>
    $mensaje = '
        <html>
        <head>
          <title>Listado pendiente de servir</title>
          <style>
            th{
                background-color:#969696;
                color:black;
                padding:8px;
            }
            tr:hover{
                background-color:#FFDC23;
                color:#938FBA;
                font-weight:bold;
            }
            .pie{
                clear: both;
                padding-top: 20px;
                border-bottom-style: solid;
                border-bottom-width: 5px;
                border-bottom-color: #dc002e;
                margin-top: 20px;
                text-align: center;
            }
          </style>
        </head>
        <body style="background-color:F0F0F0;">
          <p>Buenas tardes:</p>
                No ha quedado nada pendiente de servir hoy día ' . date('j') . ' de ' . calcular_mes() . ' de ' . date('Y') . '.
            <p/>         
            <b><a href="http://80.32.251.17/calendario/pedidos.php?ano=' . $anio . '&mes=' . $ms . '&numes=' . $n . '&dia=' . $dy . '" title="Usuario: recepcion &#10; Contraseña: arce" >Ver pedido</a></b>
            <p>Recambios</p>
            <div class="pie">
              <hr>
              Empresa Carrión SA <span><a href="http://www.empresacarrion.com" target="blank">Jesús Martín. </a><?php echo date("Y"); ?></span>
          </div>
          </body>
          </html>
          ';
    return $mensaje;
}

//****** TALLER ******

if ($tbcarrion != "") {
    $men = mnsj();
    $men = $men . $tbcarrion . '
            </table>
          <p>Recambios</p>
          <div class="pie">
              <hr>
              Empresa Carrión SA <span><a href="http://www.empresacarrion.com" target="blank">Jesús Martín. </a><?php echo date("Y"); ?></span>
          </div>
          </body>
          </html>
          ';
    mail("chechu@empresacarrion.com," . $destinatarios, "Pendiente de servir", $men, $cabeceras);
} else {
    $men = msjsin();
    mail("chechu@empresacarrion.com," . $destinatarios, "Pedido sin incidencias", $men, $cabeceras);
}

//****** NOGUIERA ******

if ($tbnogueira != "") {
    $men = mnsj();
    $men = $men . $tbnogueira . '
            </table>
            <p>Recambios</p>
            <div class="pie">
              <hr>
              <a href="http://www.empresacarrion.com" target="blank">Empresa Carrión SA</a> <span>Jesús Martín.<?php echo date("Y"); ?></span>
          </div>
          </body>
          </html>
          ';
    mail("chechu@empresacarrion.com, juan@empresacarrion.com, autotalleresnogueira@hotmail.com, autotalleresnogueira@hotmail.es", "Pendiente de servir", $men, $cabeceras);
}

//***** MEDINA ****

if ($tbmedina != "") {
    $men = mnsj();
    $men = $men . $tbmedina . '
            </table>
            <p>Recambios</p>
            <div class="pie">
              <hr>
              <a href="http://www.empresacarrion.com" target="blank">Empresa Carrión SA</a> <span>Jesús Martín.<?php echo date("Y"); ?></span>
          </div>
          </body>
          </html>
          ';
    mail("chechu@empresacarrion.com, recmedina@empresacarrion.com", "Pendiente de servir", $men, $cabeceras);
}
?>