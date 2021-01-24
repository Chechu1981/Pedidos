<?php
mysql_connect("localhost","chechu");
mysql_select_db("pedidos");
mysql_query("DELETE FROM lineas WHERE id LIKE ".$_GET['id'].";"); 
?>
<script type="text/javascript">
window.close();
</script>
