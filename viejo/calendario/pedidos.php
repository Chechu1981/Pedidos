<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;" charset="ISO-8859-1"></meta>
        <title><?php echo "Pedido del ".$_GET['dia']." de ".$_GET['mes']." de ".$_GET['ano'];?></title>
        <link rel="shortcut icon" href="../imagenes/chechu.ico" />
        <link rel="stylesheet" type="text/css" href="../estilos/style.css" />
        <link type="text/css" href="../scripts/jquery-ui-1.8.21.custom/css/redmond/jquery-ui-1.8.24.custom.css" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="css/jquery.jdigiclock.css" />
        <script type="text/javascript" src="lib/jquery-1.3.2.min.js"></script>
        <script type="text/javascript" src="lib/jquery.jdigiclock.js"></script>
        <script src="../scripts/jquery-ui-1.8.21.custom/js/jquery-1.7.2.min.js"></script>
        <script src="../scripts/jquery-ui-1.8.21.custom/js/jquery-ui-1.8.21.custom.min.js"></script>
        <?php
		include '../calendario/calcular_dia.php';
                include '../estilos/conexion.php';
		function activar(){
			$a=false;
			$fecha = getdate(time());
			$mes = $fecha['mon'];
			$hora = $fecha['hours'];
			$ano = $fecha['year'];
			$dia = $fecha['mday'];
                        if($_GET['ano']>$ano)
                            $a=true;
                        elseif($_GET['numes']>$mes and $_GET['ano']>=$ano)
                            $a=true;
                        elseif($_GET['dia']>$dia and $_GET['numes']>=$mes and $_GET['ano']>=$ano)
                            $a=true;
			elseif($_GET['ano']==$ano and $_GET['numes']==$mes and $_GET['dia']==$dia and $hora < 16)
                            $a=true;
                        if($_GET['numes']==11 and $_GET['dia']==1)// dia de los santos
                            $a=false;
                        else if($_GET['numes']==12 and $_GET['dia']==24)// nochebuena
                            $a=false;
                        else if($_GET['numes']==12 and $_GET['dia']==25)// navidad
                            $a=false;
                        else if($_GET['numes']==1 and $_GET['dia']==1)// año nuevo
                            $a=false;
                        elseif($_GET['numes']==10 and $_GET['dia']==12)
                            $a=false;
                        elseif($_GET['numes']==12 and $_GET['dia']==6)
                            $a=false;
                        elseif($_GET['numes']==12 and $_GET['dia']==31)
                            $a=false;
		  return $a;
		}
                $activo = activar();
        
		mysql_connect("localhost","chechu");
		mysql_select_db("pedidos");
		function actualizar(){
                    $sen=mysql_query("SELECT * FROM lineas WHERE fecha_pedido like '".$_GET['dia'].$_GET['mes'].$_GET['ano']."' ORDER BY pedido,destino,cliente;");
                    if(@mysql_num_rows($sen)>0){
					while($fila=mysql_fetch_row($sen)){
                    if(isset($_GET['marcado']) and isset($_POST[$fila[0]])){
                        mysql_query("UPDATE  lineas SET pedido='checked=\"checked\"' WHERE id='".$fila[0]."'");
                    }elseif(isset($_GET['marcado'])){
                        mysql_query("UPDATE lineas SET pedido='' WHERE id='".$fila[0]."'");
                    }
                    if(isset($_GET['marcado']) and isset($_POST['ps'.$fila[0]]) ){
                    	mysql_query("UPDATE lineas SET ps='checked=\"checked\"' WHERE id='".$fila[0]."'");
                    }elseif(isset($_GET['marcado'])){
                    	mysql_query("UPDATE lineas SET ps='' WHERE id='".$fila[0]."'");
                    }
                }
              }
            }   
        ?>
        <script>
             var ajax=new XMLHttpRequest();
            function enviar(){
		var ref=document.getElementById('referencia').value;
		ajax.open('GET','denominacion.php?ref='+ref,true);
		ajax.send(null);
		ajax.onreadystatechange = respuesta;
            }
            function respuesta(){
		var div=document.getElementById('den');
		if(ajax.readyState==4){
			div.value = ajax.responseText;	
		}else{
			div.value = "";
		}
	}
	// increase the default animation speed to exaggerate the effect
	$.fx.speeds._default = 1000;
	$(function() {
		$( "#dialog" ).dialog({
			autoOpen: false,
			show: "blind",
			hide: "explode"
		});

		$( "#opener" ).click(function() {
			$( "#dialog" ).dialog( "open" );
			return false;
		});
	});
		var info;
		function cargar(){
			info=window.history.length;
		}
		function volver(){
			window.history.back(info);
		}
		function foco(){
			document.getElementById("referencia").focus();
		}
                function display_c(){
                    var refresh=1000; // Refresh rate in milli seconds
                    mytime=setTimeout('display_ct()',refresh)
                }
                function display_ct() {
                    var strcount;
                    var x = new Date();
                    document.getElementById('ct').innerHTML = x;
                    tt=display_c();
                }
                $(document).ready(function() {
// Create two variable with the names of the months and days in an array
var monthNames = [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ]; 
var dayNames= ["Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado"]

// Create a newDate() object
var newDate = new Date();
// Extract the current date from Date object
newDate.setDate(newDate.getDate());
// Output the day, date, month and year   
$('#Date').html(dayNames[newDate.getDay()] + " " + newDate.getDate() + ' ' + monthNames[newDate.getMonth()] + ' ' + newDate.getFullYear());

setInterval( function() {
	// Create a newDate() object and extract the seconds of the current time on the visitor's
	var seconds = new Date().getSeconds();
	// Add a leading zero to seconds value
	$("#sec").html(( seconds < 10 ? "0" : "" ) + seconds);
	},1000);
	
setInterval( function() {
	// Create a newDate() object and extract the minutes of the current time on the visitor's
	var minutes = new Date().getMinutes();
	// Add a leading zero to the minutes value
	$("#min").html(( minutes < 10 ? "0" : "" ) + minutes);
    },1000);
	
setInterval( function() {
	// Create a newDate() object and extract the hours of the current time on the visitor's
	var hours = new Date().getHours();
	// Add a leading zero to the hours value
	$("#hours").html(( hours < 10 ? "0" : "" ) + hours);
    }, 1000);	
});
        var cuenta=600;
        setInterval(function(){
            cuenta--;
            segundos = cuenta%60;
            minutos = parseInt(cuenta/60);
            if(segundos<10)
                segundos="0"+segundos;
            $("#cuenta").html("Próxima actualización: "+minutos+":"+segundos);
        },1000);
        
        setInterval(function(){
            tiempo=new Date();
            hora=tiempo.getHours();
            min=tiempo.getMinutes();
            seg = tiempo.getSeconds();
            if(hora==16 && min==0 && seg==30){
                alert("Pedido finalizado");
                document.location.href="../calendario/pedidos.php?numes=<?php echo calcular_numes(); ?>&dia=<?php echo calcular_dia(); ?>&mes=<?php echo calcular_mes(); ?>&ano=<?php echo calcular_ano();?>";
                }
       },1000);

            $(function() {
		$( "#dialog:ui-dialog" ).dialog( "destroy" );
		var name = $( "#name" ),
			tips = $( ".validateTips" );

		function updateTips( t ) {
			tips
				.text( t )
				.addClass( "ui-state-highlight" );
			setTimeout(function() {
				tips.removeClass( "ui-state-highlight", 1500 );
			}, 500 );
		}

		function checkLength( o, n, min, max ) {
			if ( o.val().length > max || o.val().length < min ) {
				o.addClass( "ui-state-error" );
				updateTips( "Length of " + n + " must be between " +
					min + " and " + max + "." );
				return false;
			} else {
				return true;
			}
		}

		function checkRegexp( o, regexp, n ) {
			if ( !( regexp.test( o.val() ) ) ) {
				o.addClass( "ui-state-error" );
				updateTips( n );
				return false;
			} else {
				return true;
			}
		}
		
		$( "#dialog-form" ).dialog({
			autoOpen: false,
			height: 300,
			width: 350,
			modal: true,
			buttons: {
				"Aceptar": function() {
					var bValid = true;
					allFields.removeClass( "ui-state-error" );
						$( this ).dialog( "close" );
				},
				Cancelar: function() {
					$( this ).dialog( "close" );
				}
			},
			close: function() {
				allFields.val( "" ).removeClass( "ui-state-error" );
			}
		});

		$( "#create-user" )
			.button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
			});
	});
	function comentarios(){
		<?php
		 $sen=mysql_query("SELECT * FROM lineas WHERE fecha_pedido like '".$_GET['dia'].$_GET['mes'].$_GET['ano']."' ORDER BY pedido,destino,cliente,referencia;");
         if(@mysql_num_rows($sen)>0){
			while($fila=mysql_fetch_row($sen)){
				if(isset($_POST['comentario'.$fila[0]])){
					mysql_query("UPDATE  lineas SET matricula='".strtoupper($_POST['comentario'.$fila[0]])."' WHERE id='".$fila[0]."'");
				}
			}
		 }
		?>
	}
        var t=setTimeout('document.location.href="../calendario/pedidos.php?numes=<?php echo calcular_numes(); ?>&dia=<?php echo calcular_dia(); ?>&mes=<?php echo calcular_mes(); ?>&ano=<?php echo calcular_ano();?>"',600000);
        function imprSelec(nombre)
			{
			  var ficha = document.getElementById(nombre);
			  var ventimp = window.open('','imprimir');
              ventimp.document.write('<h2><?php echo "Pedido del ".$_GET['dia']." de ".$_GET['mes']." de ".$_GET['ano'];?></h2>');
			  ventimp.document.write(ficha.innerHTML);
			  ventimp.document.close();
              ventimp.print();
			  ventimp.close();
			}
                         function seleccionar(){
				if(document.caja.elements[1].checked == 1)
					seleccionar_todo();
				else
					deseleccionar_todo();
			}
		function seleccionar_todo(){ 
                    for(i=1;i<document.caja.elements.length;i++){ 
                        if(document.caja.elements[i].type == "checkbox"){ 
                            document.caja.elements[i].checked=1;
                            i++;
                        }
                    }
                }
		function deseleccionar_todo(){ 
		    for (i=1;i<document.caja.elements.length;i++) 
			if(document.caja.elements[i].type == "checkbox"){
         	document.caja.elements[i].checked=0;
			i++;
			}
			}
                $(document).ready(function(){
                    $("#guardarComentario").click(function(){
                       $ajax({
                          data:{comentario: comment,id: id},
                          type:"POST",
                          url:"actualizar.php",
                          success: function(data){}
                       });
                    });
                });
                function mostrarsalida(){
                selecionar = document.getElementById("salida");
                th = document.getElementById("salidat");
                th.style.display = "none";
                selecionar.style.display="none";
                var age=document.getElementById('agente');
                var ref=document.getElementById('cliente');
                ref.disabled = false;
                ref.style.display="block";
                age.disabled=true;
                age.style.display="none";
                ref.focus();                
                }
                function ocultarsalida(){
                selecionar = document.getElementById("salida");
                selecionar.style.display="block";
                th = document.getElementById("salidat");
                th.style.display = "block";
                }				
				function comprobar(){
					var salida=document.getElementById("tipo");
					//var dial=document.getElementById("tipo1");
					var tipo=document.getElementsByName("destino");
					if((salida.value == "NULO" && tipo.item(1).checked)){//||(dial.value == "nulo" && tipo.item(1).checked)){
						$(function() {
                                                    $( "#dialog:ui-dialog" ).dialog( "destroy" );
                                                    $( "#miVentana" ).dialog({
                                                        height: 140,
                                                        width: 350,
                                                        modal: true
                                                    });
                                                });
                                                /*var ventana = document.getElementById('miVentana');
						ventana.style.marginTop = "100px";
						ventana.style.left = ((document.body.clientWidth-350) / 2) +  "px";
						ventana.style.display = 'block';
						dial.focus();*/
					}else{
						document.pedido.submit();					
					}
				}				
				function comprobar2(){
                                        var seleccion=document.getElementById('tipo');                                      
                                        var emergente = document.getElementById('tipo1');
                                        emergente.disabled=true;
                                        seleccion.selectedIndex = emergente.selectedIndex;
                                        document.pedido.submit();
				}							
				function intro(tecla){
					if(window.event.keyCode == 13){
						comprobar();
					}
				}
                                function ver(){
                                        $(function() {
                                                    $( "#dialog:ui-dialog" ).dialog( "destroy" );
                                                    $( "#estadisticas" ).dialog({
                                                        height: 550,
                                                        width: 450,
                                                        modal: true,
                                                        show: "fold",
                                                        hide: "explode",
                                                        title: 'Estadísticas'
                                                    });
                                                });
                                }
                                function cambio_salida(id){
                                    $respuesta = confirm("¿Quieres cambiar el tipo de salida?");
                                    if($respuesta){
                                    var salida=document.getElementById(id).innerHTML;                               
                                    var frame = window.document.createElement('iframe');
                                    if(salida == "CREDITO"){
                                        frame.setAttribute('src', 'actualizar.php?id='+id+'&salida=CONTADO');                                    
                                        frame.setAttribute('width', 500);
                                        frame.setAttribute('heigth', 500);
                                        document.body.appendChild(frame);
                                        alert("Tipo de salida cambiado a contado");
                                    }else if(salida == "CONTADO"){
                                        frame.setAttribute('src', 'actualizar.php?id='+id+'&salida=SOC');                                    
                                        frame.setAttribute('width', 500);
                                        frame.setAttribute('heigth', 500);
                                        document.body.appendChild(frame);
                                        alert("Tipo de salida cambiado a SOC");
                                    }else{
                                        frame.setAttribute('src', 'actualizar.php?id='+id+'&salida=CREDITO');                                    
                                        frame.setAttribute('width', 500);
                                        frame.setAttribute('heigth', 500);
                                        document.body.appendChild(frame);
                                        alert("Tipo de salida cambiado a Crédito");
                                    }
                                    document.location.href="../calendario/pedidos.php?numes=<?php echo calcular_numes(); ?>&dia=<?php echo calcular_dia(); ?>&mes=<?php echo calcular_mes(); ?>&ano=<?php echo calcular_ano();?>";
                                    }
                                }
                                function eliminar(id){
                                    var frame = window.document.createElement('iframe');
                                    frame.setAttribute('src', 'eliminar.php?id='+id);
                                    frame.setAttribute('width', 0);
                                    frame.setAttribute('heigth', 0);
                                    document.body.appendChild(frame);
                                }
                                function comprobar1(salida,id){
                                    window.open('salida.php?id='+id+'?salida='+salida);
                                }
                                function confirmar_linea (id,referencia){
                                        $respuesta=confirm("¿Quieres eliminar la referencia "+referencia+"?");
                                    if($respuesta){
                                        eliminar(id);
                                        alert(referencia+" eliminada.");
                                        document.location.href="../calendario/pedidos.php?numes=<?php echo calcular_numes(); ?>&dia=<?php echo calcular_dia(); ?>&mes=<?php echo calcular_mes(); ?>&ano=<?php echo calcular_ano();?>";
                                    }
                                }
                                function soc(){
		var age=document.getElementById('agente');
		var salida=document.getElementById('tipo');
                var ref=document.getElementById('cliente');
                                if(salida.value == "SOC"){
                                        ref.disabled = true;
                                        ref.style.display="none";
                                        age.disabled=false;
                                        age.style.display="block";
                                        age.focus();
                                    }else{
                                        ref.disabled = false;
                                        ref.style.display="block";
                                        age.disabled=true;
                                        age.style.display="none";
                                        age.focus();
                                    }
                                }
           
        </script>
    </head>
    <body onload="javascript:foco();cargar();">
        <div id="hora" ></div>
    <div id="miVentana" style="display: none;" >
		Salida:
        <select onchange="comprobar2()" style="font-size:36px;margin:auto" id="tipo1" name="tipo" >
            <option value="NULO">Tipo de salida</option>
            <option value="CONTADO">0 Contado</option>
            <option value="CREDITO">1 Crédito</option>
            <option value="SOC">2 SOC</option>
         </select>
	</div>
        <div id="cambio" style="display: none;" >
		Salida:
                <select onchange="actualizar()" style="font-size:36px;margin:auto" id="tipo2" name="tipo" >
            <option value="NULO">Tipo de salida</option>
            <option value="CONTADO">0 Contado</option>
            <option value="CREDITO">1 Crédito</option>
            <option value="SOC">2 SOC</option>
         </select>
	</div>
        <?php 
        $saludo=  getdate(time());
         if($_SERVER['REMOTE_USER']=="medina"){
            if($saludo['hours']<12){
            echo "<span class=\"saludo\" >Buenos días Medina del Campo</span>";
             }else{
             echo "<span class=\"saludo\" >Buenas tardes Medina del Campo</span>";
             }
        }else if($_SERVER['REMOTE_USER']=="recepcion"){
            if($saludo['hours']<12){
            echo "<span class=\"saludo\" >Buenos días recepción</span>";
            }else{
                echo "<span class=\"saludo\" >Buenas tardes recepción</span>";
            }
        }else{
            if($saludo['hours']<12){
            echo "<span class=\"saludo\" >Buenos días Valladolid</span>";
            }else{
                echo "<span class=\"saludo\" >Buenas tardes Valladolid</span>";
            }
        }
?>
        <div id="cuenta" style="position: fixed;right: 10px;font-weight: bold;"></div>
        <div class="clock">
            <div id="Date"></div>
                <ul>
                    <li id="hours"></li>
                    <li id="point">:</li>
                    <li id="min"></li>
                    <li id="point">:</li>
                    <li id="sec"></li>
                </ul>
            </div>
        <?php
        $activo = activar();
        if((date('j')>=25 and date('n')==12)or(date('j')<=6 and date('n')==1)){?>
            <img style=" margin: 10px;margin-top: 45px;left: 10px;position:fixed;" src="../imagenes/navidad.jpg" width="150px" />
        <?php }else{ ?>
            <img style=" margin: 10px; margin-top: 45px;left: 10px;position:fixed;" src="../imagenes/carrion.jpg" width="150px" />
        <?php } ?>
        <div class="contenedor">
            <?php if($_SERVER['REMOTE_USER']=="medina"){ ?>
<div id="c_ed6da3b0c2c5b38d1ae9a2fbb92eec48" class="ancho"></div><script type="text/javascript" src="http://www.eltiempo.es/widget/widget_loader/ed6da3b0c2c5b38d1ae9a2fbb92eec48"></script>
<?php }else{ ?>
        <div id="c_e57fa2f6fac3f87fd870f0eebef7dbcc" class="ancho">
        	<h2 style="color: #000000; margin: 0 0 3px; padding: 2px; font: bold 13px/1.2 Verdana; text-align: center;"></h2>
            </div>
			<script type="text/javascript" src="http://www.eltiempo.es/widget/widget_loader/e57fa2f6fac3f87fd870f0eebef7dbcc">
            </script>
<?php } ?>
<div class="aviso" ><img src="../imagenes/peligro.png" style="margin: 0 8px 8px 0;" align="center" border="0" />Atención: Las piezas introducidas a partir de las 13:30, probablemente no lleguen. Hay que anotarlas en el pedido del día siguente.</div>
        	<div class="principal">
            <ul>
                <a href="../index.php" target="_self"><li>Inicio</li></a>
                <a href="../clientes/clientes.php" target="_self"><li>Clientes</li></a>
                <a href="../cruze/cruze.php" target="_self"><li>Referencias cruzadas</li></a>
                <a href="../enlaces/enlaces.php" target="_self"><li>Enlaces</li></a>
                <a href="../cambio/cambio.php"><li>Cambio</li></a>
                <a href="../calendario/pedidos.php?numes=<?php echo calcular_numes(); ?>&dia=<?php echo calcular_dia(); ?>&mes=<?php echo calcular_mes(); ?>&ano=<?php echo calcular_ano();?>"><li id="activo">Pedidos Citroen</li></a>
		<?php if($_SERVER['REMOTE_USER']!="medina"){ ?><a href="../pedidosv/pedidosv.php?numes=<?php echo calcular_numes(); ?>&dia=<?php echo calcular_diav(); ?>&mes=<?php echo calcular_mes(); ?>&ano=<?php echo calcular_ano();?>"><li>Pedidos Volvo</li></a> <?php } ?>
            </ul>
             </div>
            <div class="banda">
                <h2 style="padding:15px;"><?php echo "Pedido del ". $_GET['dia']." de ".$_GET['mes']." de ".$_GET['ano'];?></h2>
                 <a href="calendario.php" target="_self">
                <div id="nuevo">
                    Calendario
                </div>
                </a>
        </div>
        <?php
        if(isset($_GET['diasemana']) and $_GET['diasemana']>5)
            $activo = false;   
		if($activo){
		?>
            <?php if($_SERVER['REMOTE_USER']!="recepcion"){ ?>
            <form style="clear:both;" class="formulariopedido" action="pedidos.php?numes=<?php echo $_GET['numes'];?>&dia=<?php echo $_GET['dia']?>&mes=<?php echo $_GET['mes']?>&ano=<?php echo $_GET['ano']?>" method="post" name="pedido" >
            <table>
            <th>Referencia</th>
            <th width='10px;'>C</th>
            <th>Denominación</th>
            <th style="padding-left: 20px;padding-right: 20px">Destino</th>
            <th <?php if( $_SERVER['REMOTE_ADDR']=='10.159.64.47' or $_SERVER['REMOTE_ADDR']=='10.159.64.58' or $_SERVER['REMOTE_USER']=="medina"){ ?> style="display: none;" <?php } ?> id="salidat">Salida</th>
            <th>Cliente/OR</th>
            <th>Matrícula/Comentario</th>
        <tr>
            <td><input onblur="enviar()" type="text" name="referencia" id="referencia" /></td>
            <td><input onkeyup="intro(event)" width="10px;" style="text-align:right;width:30px;" type="text" name="cantidad"  /></td>
            <td><input onkeyup="intro(event)" type="text" id="den" name="denominacion"  /></td>
            <td>
            <?php 
			if( $_SERVER['REMOTE_ADDR']=='10.159.64.47' or $_SERVER['REMOTE_ADDR']=='10.159.64.58'){
			?>
                <input onkeyup="intro(event)" type="radio"  name="destino" value="T" checked="checked" onclick="javascript:mostrarsalida();" ><span style="font-size:12px">Taller</span></input><br/>
                <input onkeyup="intro(event)" type="radio" name="destino" value="M" onclick="javascript:ocultarsalida();" ><span style="font-size:12px">Mostrador</span></input><br/>
            <?php }else{ ?>
                <?php if($_SERVER['REMOTE_USER']!="medina"){ ?>
	            <input onkeyup="intro(event)" type="radio" name="destino" value="T" onclick="javascript:mostrarsalida();" ><span style="font-size:12px">Taller</span></input><br/>
                <?php } ?>
                    <input onkeyup="intro(event)" type="radio" name="destino" value="M" checked="checked" <?php if($_SERVER['REMOTE_USER']!="medina"){ ?> onclick="javascript:ocultarsalida();" <?php } ?> ><span style="font-size:12px">Mostrador</span></input><br/>
           <?php } ?>
            </td>
            <?php if($_SERVER['REMOTE_USER']=="medina"){ ?>
            <td style="display:none;" id="salida">
	            <select disabled="true" id="tipo" name="tipo" >
                    <option value="NULO">Tipo de salida</option>
                    <option value="CONTADO">0 Contado</option>
                    <option value="CREDITO">1 Crédito</option>
                    <option selected="selected" value="SOC">2 SOC</option>
                </select>
            </td>
                <?php }else{ ?>
            <td <?php if( $_SERVER['REMOTE_ADDR']=='10.159.64.47' or $_SERVER['REMOTE_ADDR']=='10.159.64.58'){ ?>style="display: none;" <?php } ?> id="salida">
                <select onblur="soc()" id="tipo" name="tipo" >
                    <option value="NULO">Tipo de salida</option>
                    <option value="CONTADO">0 Contado</option>
                    <option value="CREDITO">1 Crédito</option>
                    <option value="SOC">2 SOC</option>
                </select>
                <?php } ?>
            </td>
            <td>
                <input onkeyup="intro(event)" type="text" name="cliente" id="cliente" style="text-align:center;" <?php if( $_SERVER['REMOTE_ADDR']=='10.159.64.47' or $_SERVER['REMOTE_ADDR']=='10.159.64.58'){ ?> style="display: none;" <?php } ?>  <?php if($_SERVER['REMOTE_USER']=="medina"){ ?>value="MEDINA" disabled="true" <?php } ?> />
                <select onkeyup="intro(event)" style="display:none" disabled="true" id="agente" name="cliente" >
                    <option value="NOGUEIRA">NOGUEIRA</option>
                    <option value="MEDINA">MEDINA</option>
                    <option value="A. SAN JUAN">A. SAN JUAN</option>
                    <option value="VAQUERO">VAQUERO</option>
                    <option value="HALCON">HALCON</option>
                </select>
            </td>
            <td><textarea onkeyup="intro(event)"  name="matricula" rows="3" ></textarea></td>
        </tr>
        </table>
                <input onfocus="comprobar()" type="button" value="Añadir" />
        </form>
         <?php
            }
		 actualizar();
		}else{
                    if(isset($_GET['diasemana']) and $_GET['diasemana']>5){
                        echo "";
                    }elseif(($_GET['numes']==12 and $_GET['dia']==6) || ($_GET['numes']==10 and $_GET['dia']==12) || ($_GET['numes']==11 and $_GET['dia']==1) || ($_GET['numes']==12 and $_GET['dia']==24) || ($_GET['numes']==12 and $_GET['dia']==25) || ($_GET['numes']==1 and $_GET['dia']==1) ){
                        echo "";
                    }else{
			?><div class='resultado'>Pedido Realizado</div><?php
                    }
		}
		 //Crear filas
                if(isset($_POST['referencia']) and $_POST['referencia']!=""){
                if($_SERVER['REMOTE_USER']=="medina"){
                         mysql_query("INSERT INTO lineas 
                            (referencia,cantidad,denominacion,matricula,cliente,fecha,destino,fecha_pedido,pedido,ps,salida)
                            VALUES('".strtoupper($_POST['referencia'])."',
                                '".strtoupper($_POST['cantidad'])."',
                                '".strtoupper($_POST['denominacion'])."',
                                '".strtoupper($_POST['matricula'])."',
                                'MEDINA',
                                NOW(),
                                '".$_POST['destino']."',
                                '".$_GET['dia'].$_GET['mes'].$_GET['ano']."',
                                '',
                                '',
                                'SOC');");
                                 }else{
			mysql_query("INSERT INTO lineas 
                            (referencia,cantidad,denominacion,matricula,cliente,fecha,destino,fecha_pedido,pedido,ps,salida)
                            VALUES('".strtoupper($_POST['referencia'])."',
                                '".strtoupper($_POST['cantidad'])."',
                                '".strtoupper($_POST['denominacion'])."',
                                '".strtoupper($_POST['matricula'])."',
                                '".strtoupper($_POST['cliente'])."',
                                NOW(),
                                '".$_POST['destino']."',
                                '".$_GET['dia'].$_GET['mes'].$_GET['ano']."',
                                '',
                                '',
                                '".$_POST['tipo']."');");
                 }
		 }
		 //ver las lineas que hay
			?><div style='float:left;' id='tabla'><?php
			actualizar();
                        $contador=1;
                        if($_SERVER['REMOTE_USER']=="medina"){ 
                            @$sentencia=mysql_query("SELECT * FROM lineas WHERE fecha_pedido LIKE '".$_GET['dia'].$_GET['mes'].$_GET['ano']."' AND cliente = 'MEDINA' ORDER BY pedido,destino,cliente,referencia;");
                        }else{ 
                            @$sentencia=mysql_query("SELECT * FROM lineas WHERE fecha_pedido LIKE '".$_GET['dia'].$_GET['mes'].$_GET['ano']."' ORDER BY pedido,destino,cliente,referencia;");
                        }
			if(@mysql_num_rows($sentencia)>0){
                            $lineasTaller = mysql_query("SELECT * FROM lineas WHERE fecha_pedido LIKE '".$_GET['dia'].$_GET['mes'].$_GET['ano']."' AND destino LIKE 'T' ORDER BY pedido,destino,cliente,referencia;");
                            $lineasMostrador = mysql_query("SELECT * FROM lineas WHERE fecha_pedido LIKE '".$_GET['dia'].$_GET['mes'].$_GET['ano']."' AND destino LIKE 'M' ORDER BY pedido,destino,cliente,referencia;");
                            $alldia = mysql_query("SELECT * FROM lineas WHERE fecha_pedido LIKE '".$_GET['dia'].$_GET['mes'].$_GET['ano']."' ORDER BY pedido,destino,cliente,referencia;");
                            $allmes = mysql_query("SELECT * FROM lineas WHERE  fecha_pedido LIKE '%".$_GET['mes']."%' AND ".$_GET['ano']." = YEAR(fecha) ORDER BY pedido,destino,cliente,referencia;");
                            $todas = mysql_query("SELECT * FROM lineas;");
                            $credito =mysql_query("SELECT * FROM lineas WHERE fecha_pedido LIKE '%".$_GET['mes']."%' AND fecha_pedido LIKE '%".$_GET['ano']."%' AND salida LIKE 'CREDITO'");
                            $contado =mysql_query("SELECT * FROM lineas WHERE fecha_pedido LIKE '%".$_GET['mes']."%' AND fecha_pedido LIKE '%".$_GET['ano']."%' AND salida LIKE 'CONTADO'");
                            $taller=mysql_query("SELECT * FROM lineas WHERE fecha_pedido LIKE '%".$_GET['mes']."%' AND fecha_pedido LIKE '%".$_GET['ano']."%' AND destino LIKE 'T'");
                            $soc=mysql_query("SELECT * FROM lineas WHERE fecha_pedido LIKE '%".$_GET['mes']."%' AND fecha_pedido LIKE '%".$_GET['ano']."%' AND salida LIKE 'SOC'");
                            $acumulado= mysql_query("SELECT SUM(pvp*cantidad) FROM denominacion_precio,lineas WHERE denominacion_precio.referencia = lineas.referencia AND fecha_pedido LIKE '".$_GET['dia'].$_GET['mes'].$_GET['ano']."';");
				?> <div class="lineas"><?php echo mysql_num_rows($sentencia); ?> LINEAS.</div>
                                <?php
				//Formulario de lineas marcadas
				?>
                                <?php $precio=mysql_fetch_row($acumulado); 
                        if($_SERVER['REMOTE_USER']!="medina"){
                        ?>
                                <div class="pvp"><?php echo $precio[0]." €"; ?></div>
                        <?php } ?>
                        
                                <?php if($_SERVER['REMOTE_USER']!="recepcion"){ ?>
                                <form action="pedidos.php?numes=<?php echo $_GET['numes'];?>&dia=<?php echo $_GET['dia']?>&mes=<?php echo $_GET['mes']?>&ano=<?php echo $_GET['ano']?>&marcado=si" name="caja" method="POST">
                                    <div id="M">
                                    <h2 align="center">Pedido de mostrador</h2>
                                    <table border='2' width='780px;' class='listado'>
                                        <th></th>
                                        <th>Referencia</th>
                                        <th width='50px;'>C</th>
                                        <th style="padding-left: 40px;padding-right: 40px">Denominación</th>
				<?php
                                if($activo){
                                    ?><th style="padding: 0"><button <?php if($_SERVER['REMOTE_USER']=='recepcion'){ ?> disabled="disabled" <?php } ?> onclick="comentarios()" title="Guardar comentario" class="boton_comentario" >Matrícula/Comentario</button></th><th>Cliente/OR</th><th style="padding-left: 45px;padding-right: 45px"> Hora </th><th></th><th>SALIDA</th><th><input<?php if($_SERVER['REMOTE_USER']=='recepcion'){ ?> disabled="disabled" <?php } ?> title="Seleccionar todas las lineas" onclick="javascript:seleccionar();" type="checkbox"  class="caja" /></th><th>PS</th><?php
				}else{
                                    ?><th>Matrícula/Comentario</th><th>Cliente/OR</th><th style="padding-left: 45px;padding-right: 45px"> Hora </th><th></th><th>SALIDA</th><th>PS</th><?php
				}
				$numero=0;
				//Escribo las lineas en la tabla
                                if($_SERVER['REMOTE_USER']=="medina"){ 
                                    @$sentencia=mysql_query("SELECT * FROM lineas WHERE destino LIKE 'M' AND fecha_pedido like '".$_GET['dia'].$_GET['mes'].$_GET['ano']."' AND cliente LIKE 'MEDINA' ORDER BY pedido,destino,cliente,referencia;");
                                }else{
                                    @$sentencia=mysql_query("SELECT * FROM lineas WHERE destino LIKE 'M' AND fecha_pedido like '".$_GET['dia'].$_GET['mes'].$_GET['ano']."' ORDER BY pedido,destino,cliente,referencia;");
                                }
				while($fila=mysql_fetch_row($sentencia)){
					$numero++;
                                        $imp_negr="";
					if($fila[8]!='' && $fila[9]!=''){
						$gris=" class=\"ps\" ";
                                                $imp_negr="style='font-weight: bold;background-color:#ddd;'";
                                                $ps="";
					}
					elseif($fila[8]!=''){					
						$gris="class=\"sombra\"";
                                                $ps="";
					}else{
						$gris="";
                                                $ps="disabled=\"disabled\"";
					}
					echo "<tr ".$gris.$imp_negr.">
                                        <td>".$contador++."</td>
					<td>".$fila[1]."</td>
					<td style='text-align:center;'>".$fila[2]."</td>
					<td>".$fila[3]."</td>";
                                        if($activo){
                                            if($_SERVER['REMOTE_USER']=='recepcion'){
                                                echo "<td><input size='40' disabled='disbaled' type='text' name='comentario".$fila[0]."' value='".$fila[4]."'></td>";
                                            }else{
                                                echo "<td><input size='40' type='text' name='comentario".$fila[0]."' value='".$fila[4]."'></td>";
                                            }
                                        }else{
                                            echo "<td>".$fila[4]."</td>";
                                        }
					echo "<td style='text-align:center;'>".$fila[5]."</td>
					<td style='font-size:12px;'>".$fila[6]."</td>";
					if($activo){
                                            if($_SERVER['REMOTE_USER']=='recepcion'){
                                                echo "<td>
                                                    </td>";
                                            }  else {
						echo "<td>
						<a title='ELIMINAR ".$fila[3]." ".$fila[1]."' onClick='javascript:confirmar_linea(".$fila[0].",\"".$fila[1]."\");' target='_blank'>
                                                <img src='../imagenes/eliminar.png' style=\"cursor:pointer;\">
						</a>
						</td>";
                                            }
					?>
                                        <td <?php if($activo && $_SERVER['REMOTE_USER']!='recepcion'){echo "onclick='cambio_salida(".$fila[0].")' id='".$fila[0]."' style='cursor:pointer'>";}else{echo ">";} echo $fila[11] ?></td>
                                        <td style="text-align:center;">
                                        <input type="checkbox" <?php if($_SERVER['REMOTE_USER']=='recepcion'){ ?> disabled="disabled" <?php } ?> name='<?php echo $fila[0];?>' <?php echo $fila[8]; ?> />
                    </td>
                    <td style='text-align:center;'>
                        <input type="checkbox" <?php if($_SERVER['REMOTE_USER']=='recepcion'){ ?> disabled="disabled" <?php } ?> <?php echo $ps; ?> name='<?php echo "ps".$fila[0];?>' <?php echo $fila[9]; ?> />
                    </td>
                    </tr>
                    <?php
				}else{
					?>
                    <td style="text-align:center;"><input disabled="disabled" type="checkbox" name='<?php echo $numero;?>' <?php echo $fila[8]; ?> /></td>
                    <td><?php echo $fila[11]; ?></td>
                    <td style='text-align:center;'><input disabled="disabled" type="checkbox" name='<?php echo "ps".$numero;?>' <?php echo $fila[9]; ?> /></td>
                    </tr>
                    <?php
				}
				}
				?></tr></table>
                        
                        </div>
                            <?php } if($_SERVER['REMOTE_USER']!="medina"){ ?>
                            <div id="T">
                            <h2 align="center">Pedido de taller</h2>
                        <table border='2' width='780px;' class='listado'>
                                <?php
				//Cabecera de la tabla
				?><th></th><th>Referencia</th><th width='50px;'>C</th><th style="padding-left: 40px;padding-right: 40px">Denominación</th><th>Matrícula/Comentario</th><th>Cliente/OR</th><th style="padding-left: 45px;padding-right: 45px"> Hora </th><th></th><?php
				if($activo){
                                    ?><th></th><th>PS</th><?php
				}else{
					echo "<th>PS</th>";
				}
				$numero=0;
				//Escribo las lineas en la tabla
				@$sentencia=mysql_query("SELECT * FROM lineas WHERE destino LIKE 'T' AND fecha_pedido like '".$_GET['dia'].$_GET['mes'].$_GET['ano']."' ORDER BY pedido,destino,cliente,referencia;");
				while($fila=mysql_fetch_row($sentencia)){
					$numero++;
                                        $imp_negr="";
					if($fila[8]!='' && $fila[9]!=''){
						$gris=" class=\"ps\" ";
                                                $imp_negr="style='font-weight: bold;background-color:#ddd;'";
                                                $ps="";
					}
					elseif($fila[8]!=''){					
						$gris="class=\"sombra\"";
                                                $ps="";
					}else{
						$gris="";
                                                $ps="disabled=\"disabled\"";
					}
					echo "<tr ".$gris.$imp_negr.">
                                        <td>".$contador++."</td>
					<td>".$fila[1]."</td>
					<td style='text-align:center;'>".$fila[2]."</td>
					<td>".$fila[3]."</td>";
					if($activo){
                                            if($_SERVER['REMOTE_USER']=='recepcion'){
                                                echo "<td><input disabled='disabled' size='40' type='text' name='comentario".$fila[0]."' value='".$fila[4]."'></td>";
                                            }else{
                                                echo "<td><input size='40' type='text' name='comentario".$fila[0]."' value='".$fila[4]."'></td>";
                                            }
                                        }else{
                                            echo "<td>".$fila[4]."</td>";
                                        }
					echo "<td style='text-align:center;'>".$fila[5]."</td>
					<td style='font-size:12px;'>".$fila[6]."</td>";
					if($activo){
                                            if($_SERVER['REMOTE_USER']=='recepcion'){
                                             echo "<td></td>";   
                                            }else{
						echo "<td>
						<a title='ELIMINAR ".$fila[3]." ".$fila[1]."' onClick='javascript:confirmar_linea(".$fila[0].",\"".$fila[1]."\");' target='_blank'>
                                                <img src='../imagenes/eliminar.png' style=\"cursor:pointer;\">
						</a>
						</td>";
                                            }
					?>
                    <td style="text-align:center;">
                        <input <?php if($_SERVER['REMOTE_USER']=='recepcion'){ ?> disabled="disabled" <?php } ?> type="checkbox" name='<?php echo $fila[0];?>' <?php echo $fila[8]; ?> />
                    </td>
                    <td style='text-align:center;'>
                        <input<?php if($_SERVER['REMOTE_USER']=='recepcion'){ ?> disabled="disabled" <?php } ?> type="checkbox" <?php echo $ps; ?> name='<?php echo "ps".$fila[0];?>' <?php echo $fila[9]; ?> />
                    </td>
                    </tr>
                    <?php
				}else{
					?>
                    <td style="text-align:center;"><input disabled="disabled" type="checkbox" name='<?php echo $numero;?>' <?php echo $fila[8]; ?> /></td>
   					<td style='text-align:center;'><input disabled="disabled" type="checkbox" name='<?php echo "ps".$numero;?>' <?php echo $fila[9]; ?> /></td>
                    </tr>
                    <?php
				}
				}
				?></tr></table></div>
                        <?php } ?>
                        
                        
                        </div>
				<div class="impresion">
                                    <?php if($_SERVER['REMOTE_USER']=="medina"){ ?>
                                    <a onclick="javascript:imprSelec('M');" style="cursor:pointer;"><img src="../imagenes/print.png" /><b> Imprimir</b></a>
                                    <?php }else if($_SERVER['REMOTE_USER']=="recepcion"){ ?>
                                        <a onclick="javascript:imprSelec('T');" style="cursor:pointer;"><img src="../imagenes/print.png" /><b> Imprimir</b></a>
                                    <?php }else{ ?>
                                    <ul>
                                        <li><b>Imprimir</b></li>
                                        <ul>
                                        <li><a onclick="javascript:imprSelec('tabla');" style="cursor:pointer;"><img src="../imagenes/print.png" /><b> todo</b></a></li>
                                        <li><a onclick="javascript:imprSelec('T');" style="cursor:pointer;"><img src="../imagenes/print.png" /><b> taller</b></a></li>
                                        <li><a onclick="javascript:imprSelec('M');" style="cursor:pointer;"><img src="../imagenes/print.png" /><b> mostrador</b></a></li>
                                        </ul>
                                    </ul>
                                    <?php } ?>
                        <?php if($activo && $_SERVER['REMOTE_USER']!='recepcion'){ ?>
                            <input type="submit" value="Marcar" class="boton_marcar" />
                        <?php }else{ ?>
                            <input type="submit" value="Marcar" style="display:none;" class="boton_marcar" />
                        <?php } ?>
                </div>
                </form>
				<?php
			}else{
				if(isset($_GET['diasemana']) and $_GET['diasemana']>5)
                                    echo "<div class='resultado'>Festivo</div>";
                                elseif($_GET['numes']==11 and $_GET['dia']==1)
                                    echo "<div class='resultado'>Dia de los santos</div>";
                                elseif($_GET['numes']==12 and $_GET['dia']==24)
                                    echo "<div class='resultado'>Nochebuena</div>";
                                elseif($_GET['numes']==12 and $_GET['dia']==25)
                                    echo "<div class='resultado'>Navidad</div>";
                                elseif($_GET['numes']==1 and $_GET['dia']==1)
                                    echo "<div class='resultado'>Año nuevo</div>";
                                elseif($_GET['numes']==10 and $_GET['dia']==12)
                                    echo "<div class='resultado'>Fiesta nacional de España</div>";
                                elseif($_GET['numes']==12 and $_GET['dia']==6)
                                    echo "<div class='resultado'>Día de la Constitución Española</div>";
                                elseif($_GET['numes']==12 and $_GET['dia']==31)
                                    echo "<div class='resultado'>Festivo</div>";
                                else
                                    echo "<div class='resultado'>No hay lineas</div>";}
                                    ?>
                        
        <div class="pie">
            <hr>
            Empresa Carrión SA <span>Jesús Martín 2012 ©</span>
        </div>
                                </div>
        <?php
            $_POST = Array();
            if(isset($alldia)){
        ?><?php if($_SERVER['REMOTE_USER']!="medina"){ ?>
            <span class="estadisticas" onclick="ver()">Mostrar estadísticas</span>
            <?php } ?>
    <div id="estadisticas" style="display: none">
        <fieldset>
            <legend><b><?php echo "Pedido del ".$_GET['dia']." de ".$_GET['mes']." de ".$_GET['ano'];?></b></legend>
            <div class="estadistica">MOSTRADOR <?php echo mysql_num_rows($lineasMostrador); ?> </div>
            <div class="estadistica">TALLER <?php echo mysql_num_rows($lineasTaller); ?> </div>
            <div class="estadistica">TOTAL <?php echo mysql_num_rows($alldia); ?> </div>
        </fieldset>
        <fieldset><legend><b><?php echo strtoupper($_GET['mes'])." ".mysql_num_rows($allmes); ?></b> </legend>
            <div class="estadistica">CRÉDITO: <?php echo mysql_num_rows($credito); ?></div>
            <div class="estadistica">CONTADO: <?php echo mysql_num_rows($contado); ?></div>
            <div class="estadistica">SOC: <?php echo mysql_num_rows($soc); ?></div>
            <div class="estadistica">TALLER: <?php echo mysql_num_rows($taller); ?></div>
            </fieldset>
        <fieldset>
            <legend><b>Total de lineas</b></legend>
            <div class="estadistica"><?php echo mysql_num_rows($todas); ?></div>
        </fieldset>
        </div>
            <?php } ?>

    </body>
</html>