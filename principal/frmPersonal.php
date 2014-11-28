<?php include '../estilos/conexion.php'; ?> 
<h2>Añadir Agentes</h2>
<form action="" onsubmit="addinsert()" method="POST">
    <table class="listado">
        <th>Nombre</th>
        <th>Cuenta</th>
        <tr>
            <td><input id="agente" type="text" value=""></td>
            <td><input id="cuenta" type="number" value=""/></td>
        </tr>
        <tr><td colspan="2" style="text-align: center"><input type="submit" value="Añadir"/></td></tr>
    </table>
</form>