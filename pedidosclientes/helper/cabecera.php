<a href="../pedidosclientes.php" >Cerrar sesión</a>
<div style="text-align: center;">
    <img src="../../imagenes/carrion.jpg" style="float: left;" /> Gestón de pedidos de Empresa Carrión
    <h1><?php echo $_SESSION['razon'] ?></h1>
</div>
<?php
include '../helper/conexion.php';
mysql_select_db("carrion");
$sen_fsemanl = mysql_query("SELECT * FROM nombres WHERE aplicacion LIKE 'proximoSemanal'");
$semanal = mysql_fetch_row($sen_fsemanl);
echo "Próximo semanal " . utf8_encode($semanal[2]);
