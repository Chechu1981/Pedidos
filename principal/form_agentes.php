<?php include '../estilos/conexion.php'; ?> 
<h2>Añadir agente</h2>
<form action="" onsubmit="addinsert()" method="POST">
    <table class="listado">
        <th colspan="2">Agente</th>
        <tr>
            <td>Nombre</td>
            <td><input id="agente" type="text" value=""></td>
        </tr>
        <tr>
            <td>Código</td>
            <td><input id="cuenta" type="text" value=""></td>
        </tr>
        <tr><td colspan="2" style="text-align: center"><input type="submit" value="Añadir"/></td></tr>
    </table>
</form>