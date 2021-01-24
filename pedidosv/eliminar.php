<?php
mysql_connect("localhost","chechu","EMPcarrion10036j");
mysql_select_db("carrion");
mysql_query("DELETE FROM lineasvolvo WHERE id LIKE ".$_GET['id'].";"); 
?>
<script type="text/javascript">
window.close();
</script>
