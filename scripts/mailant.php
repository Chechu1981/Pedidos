<?php 
include '../estilos/conexion.php';
include '../calendario/calcular_dia.php';

        // __-- DESTINATARIOS --__
        $destinatarios="juan@empresacarrion.com";
        $destinatarios=$destinatarios.",recepcion@empresacarrion.com";
        $destinatarios=$destinatarios.",recepcion1@empresacarrion.com";
        $destinatarios=$destinatarios.",tecnico.volvo@empresacarrion.com";
        $destinatarios=$destinatarios.",raul@empresacarrion.com";
        $destinatarios=$destinatarios.",lolo@empresacarrion.com,";
        $destinatarios=$destinatarios.",marisa@empresacarrion.com";
        $destinatarios=$destinatarios.",f.barrientos@empresacarrion.com";
        
        $fecha = getdate(time());
        $fe=$fecha['mday'];
        
        mysql_select_db("pedidos");
        
        $dia = $fe.calcular_mes().calcular_ano();
        $psnogueira =  mysql_query("SELECT * FROM lineas WHERE destino LIKE 'M' AND cliente LIKE '%NOGUEIRA%' AND ps NOT LIKE '' AND fecha_pedido = '".$dia."';");
        $pendiente =  mysql_query("SELECT * FROM lineas WHERE destino LIKE 'T' AND ps NOT LIKE '' AND fecha_pedido = '".$dia."';");
        while($fila=mysql_fetch_row($pendiente)){
            $tabla=$tabla." ".$fila[2]." ".$fila[3]." con la referencia ".$fila[1]." pedido para el cliente ".$fila[5]." (".$fila[4].")\n";
        }
        if($tabla!=""){
            mail("chechu@empresacarrion.com,".$destinatarios,"Pendiente de servir","Buenas tardes: 
            \nEste es el listado pendiente de servir del dia ".date('d')." de ".calcular_mes()." de ".date('Y').":
            \n".$tabla."\nRecambios");
        }else{
            mail("chechu@empresacarrion.com,".$destinatarios,"Pedido sin incidencias","Buenas tardes: 
            \nEn el pedido del ".date('d')." de ".calcular_mes()." de ".date('Y')." no ha quedado nada pendiente de servir para el taller.\n\nRecambios.");
        }
        $tabla="";
        
        // __--** Envío a Nogueira **--__
        while($fila=mysql_fetch_row($psnogueira)){
            $tabla=$tabla." ".$fila[2]." ".$fila[3]." con la referencia ".$fila[1]." pedido para el cliente ".$fila[5]." (".$fila[4].")\n";
        }
        if($tabla!=""){
            mail("chechu@empresacarrion.com, juan@empresacarrion.com, t.nogueira@terra.es","Pendiente de servir","Buenas tardes: 
            \nEste es el listado pendiente de servir del dia ".date('d')." de ".calcular_mes()." de ".date('Y').":
            \n".$tabla."\n\nRecambios\nEmpresa Carrión SA");
        }
        
        /*$mensaje = '
<html>
<head>
  <title>Atención con el Cambio de Tarifas y Comisiones</title>
</head>
<body style="background-color:green;">
  <p>¡todos los vendedores a leer las tarifas segun empresas!</p>
  <table>
    <tr>
      <th>Empresa</th><th>Tarifa Anterior</th><th><a href="#">Nueva Tarifa</a></th><th>Comision</th>
    </tr>
    <tr>
      <td>Repsol</td><td>3.3</td><td>3.5</td><td>10%</td>
    </tr>
    <tr>
      <td>Telefonica</td><td>17.45</td><td>18.1</td><td>11%</td>
    </tr>
  </table>
</body>
</html>
';

        $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
        $cabeceras .= 'Content-type: text/html; charset=UTF-8' . "\r\n";

        mail('chechu@empresacarrion.com','prueba html',$mensaje,$cabeceras);*/
?>