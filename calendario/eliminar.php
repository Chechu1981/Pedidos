<?php
include_once '../estilos/conexion.php';
$mysqli->query("DELETE FROM lineas WHERE id LIKE ".$_GET['id'].";"); 
?>
<script type="text/javascript">
window.close();
</script>
