<?php 
include '../estilos/conexion.php';
$agentes = $mysqli->query("SELECT * FROM soc;");
while($nom = $agentes->fetch_row()){
?>
    <option value="<?php echo strtoupper($nom[1])." (".$nom[2]; ?>)"><?php echo strtoupper($nom[1])?></option>
<?php } ?>