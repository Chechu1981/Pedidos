function confirmar_linea (id,referencia){
	$respuesta=confirm("¿Quieres eliminar la referencia "+referencia+"?");
	if($respuesta){
		window.open("eliminar.php?id="+id);
	}
} 
/*
function eliminar(){
var respuesta=confirm("¿Desa eliminar el contacto?");
if(respuesta){
    borrar();
    alert("eliminado");
    }
}
function borrar(){
	document.write("<?php mysql_connect('localhost','chechu'); mysql_select_db('prueba'); $sentencia=mysql_query('DELETE FROM hoja1 WHERE Nombre LIKE $_GET['nombre'];'); ?>");
}*/