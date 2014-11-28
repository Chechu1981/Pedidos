<?php 
include ('../estilos/conexion.php');
include '../calendario/calcular_dia.php';
$contactos=['recepcion@empresacarrion.com,recepcion1@empresacarrion.com','j.luis@empresacarrion.com','marisa@empresacarrion.com','gonzalo@empresacarrion.com'];
    mail($contactos[$_GET['contacto']],"Otros proveedores","Buenos días: 
    \nHemos recibido");
?>