<script type="text/javascript">
    function cerrar() {
        var ventana = window.self;
        ventana.opener = window.self;
        ventana.close();
    }
</script>
<?php 
        include ('../estilos/conexion.php');      
        mysql_query('DELETE FROM hoja1 WHERE id_contacto = '.$_GET['id'].';');
?>
<script type="text/javascript">
    alert("Eliminado");
    cerrar();
</script>