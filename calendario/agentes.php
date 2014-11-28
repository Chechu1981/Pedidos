<?php 
include '../estilos/conexion.php';
$agentes=mysql_query("SELECT * FROM soc;");
while($nom=mysql_fetch_row($agentes)){
?>
    <option value="<?php echo strtoupper($nom[1])." (".$nom[2]; ?>)"><?php echo strtoupper($nom[1])?></option>
<?php } ?>