<!DOCTYPE html PUBLIC "-/W3C/DTD XHTML 1.0 Transitional/EN" "http:/www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Coches de cortesía</title>
        <link rel="shortcut icon" href="../imagenes/chechu.ico" />
        <link rel="stylesheet" href="../scripts/styles.css" type="text/css" />
        <link rel="stylesheet" type="text/css" href="../estilos/style.css" />
        <?php include '../../calendario/calcular_dia.php'; ?>
        <script type="text/javascript">
            /Crear Objetos AJAX
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
            / Variables AJAX    
            var eliminar_coche=objetoAjax();
            var listado_coches=objetoAjax();
            
            /Funciones AJAX
            function borrar(id,matricula){
                confirmar=confirm("¿Quieres eliminar "+matricula+" de la lista?")
                if(confirmar){
                eliminar_coche.open('GET','borrar.php?id='+id,true);
                eliminar_coche.send(null);
                eliminar_coche.onreadystatechange = datos;
                }
                
            }
            function datos(){
                var lista_coches=document.getElementById('tabla');
                if(eliminar_coche.readyState==4){
                    lista_coches.innerHTML=eliminar_coche.responseText;
                    tabla();
                }
            }
            function tabla(){
                listado_coches.open('POST','tabla.php',true);
                listado_coches.send(null);
                listado_coches.onreadystatechange = lista;             
            }
            function lista(){
                var lista_coches=document.getElementById('tabla');
                if(listado_coches.readyState==4){
                    lista_coches.innerHTML=listado_coches.responseText;
                }
            }
            
            function insertar_coche(){
                listado_coches.open('POST','insertar.php',true);
                listado_coches.send(null);
                listado_coches.onreadystatechange = lista;             
            }
            
            / Si pulsamos intro
            function intro(tecla){
                if(window.event.keyCode == 13){
                   /sin función 
                }
            }
        </script>
        <?php
        if(isset($_POST['matricula'])and $_POST['matricula']!=''){
            include_once 'insertar.php'; 
        }
        ?>
    </head>
    <body onload="tabla()">
        <div class="contenedor">
            <?php include_once '../../scripts/cabecera.php'; ?>
            <div class="principal">
                <?php include_once '../../scripts/menu.php'; ?>
            </div>
            <div class="banda">
                <h2 style="padding:15px;">Coches de cortesía</h2>
            </div>
            <div id="insertar">
                <form class="formulariopedido" method="post" action="coches.php">
                <table>
                    <th>Matrícula</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Kilómetros</th>
                    <tr>
                        <td><input type="text" name="matricula"/></td>
                        <td><input type="text" name="marca"/></td>
                        <td><input type="text" name="modelo"/></td>
                        <td><input type="text" name="kms"/></td>
                    </tr>
                    <tr><td><input type="submit" value="Añadir"/></td></tr>
                </table>
                </form>
            </div>
            <div id="tabla"></div>
        </div>
    </body>
</html>