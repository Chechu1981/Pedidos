<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Recepción</title>
        <link rel="stylesheet" href="../scripts/styles.css" type="text/css" />
        <link rel="stylesheet" type="text/css" href="../estilos/style.css" />
        <?php include '../calendario/calcular_dia.php'; ?>
        <script type="text/javascript">
            //Crear Objetos AJAX
            function objetoAjax(){
            var xmlhttp=false;
            try {
				xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
            } catch (e) {
				try {
				   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
				} catch (E) {
					xmlhttp = false;
				}
			}
			if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
				xmlhttp = new XMLHttpRequest();
			}
			return xmlhttp;
		}
            // Variables AJAX    
            var eliminar_orden=objetoAjax();
            var listado_ordenes=objetoAjax();
            var search=objetoAjax();
            var actualizar=objetoAjax();
            var actcoche=objetoAjax();
            
            //Funciones AJAX
            function borrar(id,matricula){
                confirmar=confirm("¿Quieres eliminar "+matricula+" de la lista?")
                if(confirmar){
                eliminar_orden.open('GET','borrar.php?id='+id,true);
                eliminar_orden.send(null);
                eliminar_orden.onreadystatechange = datos;
                }
                
            }
            
            function datos(){
                var lista_coches=document.getElementById('tabla');
                if(eliminar_orden.readyState==4){
                    lista_coches.innerHTML=eliminar_orden.responseText;
                    tabla();
                }
            }
            
            function tabla(){
                listado_ordenes.open('POST','tabla.php',true);
                listado_ordenes.send(null);
                listado_ordenes.onreadystatechange = lista;             
            }
            
            function lista(){
                var lista_coches=document.getElementById('tabla');
                if(listado_ordenes.readyState==4){
                    lista_coches.innerHTML=listado_ordenes.responseText;
                }
            }
            
            function insertar_coche(){
                listado_ordenes.open('POST','insertar.php',true);
                listado_ordenes.send(null);
                listado_ordenes.onreadystatechange = lista;             
            }
            
            function entregados(){
                listado_ordenes.open('POST','entregados.php',true);
                listado_ordenes.send(null);
                listado_ordenes.onreadystatechange = lista;             
            }
            
            function entregado(id,matricula){
                var confirmar=confirm("Vas a entregar el registro con la matricula "+matricula+".")
                if(confirmar){
                    var kms;
                    do{
                        kms=prompt("Kilómetros.");
                    }while(kms=="");
                    actcoche.open('GET','actcoches.php?kms='+kms+"&id="+id);
                    actcoche.send(null);
                    actualizar.open('GET','actualizar.php?id='+id,true);
                    actualizar.send(null);
                    listado_ordenes.onreadystatechange = lista;
                }
            }
            
            // Si pulsamos intro
            /*function intro(tecla){
                if(window.event.keyCode == 13){
                   //sin función 
                }
            }*/
            
            // Funciones visuales
            function mostrar_formulario(){
                document.getElementById('buscar').style.display="none";
                var formulario=document.getElementById('insertar');
                var boton=document.getElementById('btn_nuevo');
                if(formulario.style.display=="none"){
                    $('#insertar').show('blind');
                }else{
                    $('#insertar').hide('blind');
                    }
            }
            
            function mostrar_buscar(){
                document.getElementById('insertar').style.display="none";
                var formulario=document.getElementById('buscar');
                var boton=document.getElementById('btn_nuevo');
                if(formulario.style.display=="none"){
                    $('#buscar').show('blind');
                }else{
                    $('#buscar').hide('blind');
                    }
            }
            
            function buscar_registro(){
                var matricula=document.getElementById('matricula').value;
                var orden=document.getElementById('orden').value;
                var observaciones=document.getElementById('observaciones').value;
                search.open('GET','buscar.php?matricula='+matricula+'&orden='+orden+'&observaciones='+observaciones,true);
                search.send(null);
                search.onreadystatechange = encontrar_registro;
            }
            
            function encontrar_registro(){
                var div=document.getElementById('tabla');
                if(search.readyState==4){
                        div.innerHTML = search.responseText;
                    }else{
                        div.value = "";
                    }
            }
            
            //JQuery UI
            $(function() {
                $( "#fentrada" ).datepicker({ 
                    showAnim: "fold",
                    dateFormat:"yy-mm-dd"
                });       
                $( "#fperitacion" ).datepicker({ 
                    showAnim: "fold",
                    dateFormat:"yy-mm-d"
                });
                $( "#fentrega" ).datepicker({ 
                    showAnim: "fold",
                    dateFormat:"yy-mm-dd"
                });
            });
            
            function ptepr(cliente){
                $(function() {
                    
                    $( "#ptepr" ).dialog({
                        height: 600,
                        width: 1000,
                        modal: true,
                        show: "scale",
                        hide: "scale",
                        title: 'Piezas pendientes'
                     });
                     $("#framepr").attr('src','buscarpr.php?cliente='+cliente);
                });
        }
        </script>
        <?php
        if(isset($_POST['matricula'])and $_POST['matricula']!=''){
            include_once 'insertar.php'; 
        }
        ?>
    </head>
    <body onload="<?php 
        if($_GET['lista']=='c'){ 
            ?> tabla() <?php }
        if($_GET['lista']=='e'){
            ?> entregados() <?php } ?>" >
        <div class="contenedor">
            <header>
                <?php include_once '../scripts/cabecera.php'; ?>
            </header>
            <nav>
                <?php include_once '../scripts/menu.php'; ?>
            </nav>
            <div class="banda">
                <h2 style="padding:15px;">Recepción</h2>
                <button id="btn_nuevo" onclick="tabla()" style="width: 100px;height: 30px;font-weight: bold" >En curso</button>
                <button id="btn_nuevo" onclick="entregados()" style="width: 100px;height: 30px;font-weight: bold" >Entregados</button>
                <button id="btn_nuevo" onclick="mostrar_formulario()" style="width: 100px;height: 30px;font-weight: bold" >Nuevo</button>
                <button id="btn_nuevo" onclick="mostrar_buscar()" style="width: 100px;height: 30px;font-weight: bold" >Buscar</button>
            </div>
            <div style="clear:both"></div>
            <div id="insertar">
                <form class="formulariopedido" style="margin-bottom: 30px;" method="post" action="recepcion.php">
                    <fieldset title="Añadir"><legend>Nuevo</legend>
                    <table>
                        <tr>
                            <th>Orden</th>
                            <th>Matrícula</th>
                            <th>Fecha de entrada</th>
                            <th>Fecha de peritación</th>
                        </tr>
                        <tr>
                            <td><input type="text" name="orden"/></td>
                            <td><input type="text" name="matricula"/></td>
                            <td><input type="text" id="fentrada" name="fentrada"/></td>
                            <td><input type="text" id="fperitacion" name="fperitacion"/></td>
                        </tr>
                        <tr>
                            <th>Compromiso</th>
                            <th>Pendiente PR</th>
                            <th>Fecha prevista de entrega</th>
                            <th>Coche de cortesía</th>
                        </tr>
                        <tr>
                            <td>
                                <select name="compromiso" style="width: 100%;text-align: center">
                                    <option value="NO">NO</option>
                                    <option value="SI">SÍ</option>
                                </select>
                            </td>
                            <td>
                                <select name="pr" style="width: 100%;text-align: center">
                                    <option value="NO">NO</option>
                                    <option value="SI">SÍ</option>
                                </select>
                            </td>
                            <td><input type="text" id="fentrega" name="fentrega"/></td>
                            <td>
                                <select name="cortesia" style="width: 100%">
                                    <?php 
                                    include '../estilos/conexion.php';
                                    $coches=mysql_query("SELECT * FROM coches;");
                                    ?> <option value="NO TIENE"></option> <?php
                                    while($fila=mysql_fetch_row($coches)){
                                        ?> <option value="<?php echo $fila[1] ?>"><?php echo $fila[1]; ?></option> <?php
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>Control de calidad</th>
                            <th colspan="3">Observaciones</th>
                        </tr>
                        <tr>

                            <td>
                                <select name="calidad" style="width: 100%">
                                    <option value="NO">NO</option>
                                    <option value="SI">SÍ</option>
                                </select>
                            </td>
                            <td colspan="3"><textarea style="width: 100%;height: 80px;" type="text" name="observaciones"></textarea></td>
                        </tr>
                        <tr><td colspan="4"><button type="submit" style="width: 100%;height: 45px;">Añadir</button></td></tr>
                    </table>
                    </fieldset>
                </form>
            </div>
            <div id="buscar" class="buscar" style="display:none;width: 670px;padding-left: 50px">
                <fieldset title="Buscar"><legend>Buscar</legend>
                    <table>
                        <th>Matricula</th>
                        <th>Orden</th>
                        <th>Observaciones</th>
                        <tr>
                            <td><input size="10" onkeyup="buscar_registro()" type="text" id="matricula" name="matricula" value=""></input></td>
                            <td><input size="10" onkeyup="buscar_registro()" type="text" id="orden" name="orden" value=""></input></td>
                            <td><input size="10" onkeyup="buscar_registro()" type="text" id="observaciones" name="observaciones" value=""></input></td>
                        </tr>
                    </table>            
                </fieldset>
            </div>
            <div id="tabla"></div>
            <div id="ptepr" style="display: none;text-align: center"><iframe id="framepr" width="950" height="600" ></iframe></div>
        </div>
        <script>document.getElementById('insertar').style.display="none";</script>
    </body>
</html>