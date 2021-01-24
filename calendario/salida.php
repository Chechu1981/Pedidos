<?php
include_once '../estilos/conexion.php';
$mysqli->query("UPDATE lineas SET salida = ".$_GET['salida']." WHERE id LIKE ".$_GET['id'].";"); 
?>
<script type="text/javascript">
window.close();
</script>
