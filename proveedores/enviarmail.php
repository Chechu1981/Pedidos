<?php
$nombre=$_POST['operario'];
include ('../estilos/conexion.php');

$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
$cabeceras .= 'Content-type: text/html; charset=UTF-8' . "\r\n";

function mnsj($operario,$tabla){
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
      <p>Hola soy '.$operario.':</p>
                Hemos recibido el pedido de '.$tabla.'';
    return $mensaje;
}

$result= $mysqli->query("SELECT * FROM o_proveedores WHERE indice = ".$_POST['ide'].";");

while($pedido = $result->fetch_row()){
    $lista = $pedido[3]." que es <br/>".$pedido[7]." pedido el ".$pedido[2]." por ".$pedido[4]." para la orden o matrícula ".$pedido[5];
}

if($_POST['d']==1){
    $men = mnsj($nombre,$lista);
    $men .= '<br/><div class="pie">
              <hr>
              Empresa Carrión SA <span><a href="http://www.empresacarrion.com" target="blank">Jesús Martín. </a><?php echo date("Y"); ?></span>
          </div>
          </body>
          </html>';
    mail("recepcion@empresacarrion.com,postventa@empresacarrion.com,f.barrientos@empresacarrion.com,volvo.taller@empresacarrion.com,recepcion1@empresacarrion.com,marisa@empresacarrion.com,lolo@empresacarrion.com,raul@empresacarrion.com,adolfo.lopez@empresacarrion.com,chechu@empresacarrion.com",
            "Otros proveedores",$men,$cabeceras);
}elseif ($_POST['d']==2) {
    $men = mnsj($nombre,$lista);
    $men .= '<br/><div class="pie">
              <hr>
              Empresa Carrión SA <span><a href="http://www.empresacarrion.com" target="blank">Jesús Martín. </a><?php echo date("Y"); ?></span>
          </div>
          </body>
          </html>';
    mail("chechu@empresacarrion.com, jluis@empresacarrion.com",
            "Otros proveedores",$men,$cabeceras);
}elseif ($_POST['d']==3) {
    $men = mnsj($nombre,$lista);
    $men .= '<br/><div class="pie">
              <hr>
              Empresa Carrión SA <span><a href="http://www.empresacarrion.com" target="blank">Jesús Martín. </a><?php echo date("Y"); ?></span>
          </div>
          </body>
          </html>';
    mail("marisa@empresacarrion.com,chechu@empresacarrion.com",
            "Otros proveedores",$men,$cabeceras);
}elseif ($_POST['d']==4) {
    $men = mnsj($nombre,$lista);
    $men .= '<br/><div class="pie">
              <hr>
              Empresa Carrión SA <span><a href="http://www.empresacarrion.com" target="blank">Jesús Martín. </a><?php echo date("Y"); ?></span>
          </div>
          </body>
          </html>';
    mail("recepcion1@empresacarrion.com,volvo.taller@empresacarrion.com,chechu@empresacarrion.com",
            "Otros proveedores",$men,$cabeceras);
    
}
?>