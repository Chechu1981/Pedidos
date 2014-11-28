<?php
//$nombre=$_POST['operario'];
include ('./pedidosclientes/helper/conexion.php');

mysql_select_db("pedidos");

$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
$cabeceras .= 'Content-type: text/html; charset=UTF-8' . "\r\n";

function mnsj($tabla){
    $mensaje = '
    <html>
    <head>
      <title>Recibidos</title>
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
      <p>Hola:</p>
                Hemos recibido '.$tabla.'';
    return $mensaje;
}

$result= mysql_query("SELECT * FROM lineas WHERE id = ".$_GET['id'].";");

while($pedido=mysql_fetch_row($result)){
    $lista = $pedido[2]." ".$pedido[3]." con referencia ".$pedido[1]." pedido el ".$pedido[6]." para la orden o matrícula ".$pedido[5]." (".$pedido[4].")";
}

    $men = mnsj($lista);
    $men .= '<p>Recambios.</p><br/><div class="pie">
              <hr>
              Empresa Carrión SA <span><a href="http://www.empresacarrion.com" target="blank">Jesús Martín. </a><?php echo date("Y"); ?></span>
          </div>
          </body>
          </html>';
    //recepcion@empresacarrion.com,f.barrientos@empresacarrion.com,postventa@empresacarrion.com,volvo.taller@empresacarrion.com,recepcion1@empresacarrion.com,marisa@empresacarrion.com,lolo@empresacarrion.com,raul@empresacarrion.com,tecnico.volvo@empresacarrion.com,
    mail("chechu@empresacarrion.com", 
            "PR recibidos",$men,$cabeceras);
?>