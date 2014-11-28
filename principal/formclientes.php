<?php include '../estilos/conexion.php'; ?> 
<h2>Añadir Agentes</h2>
<form action="" onsubmit="addinsert()" method="POST">
    <table class="listado">
        <th>Nombre</th>
        <th>Contraseña</th>
        <th>Razon social</th>
        <th>codigo cliente</th>
        <tr>
            <td><input id="nombre" type="text" value=""></td>
            <td><input id="pass" type="text" value=""/></td>
            <td><input id="razon" type="text" value=""/></td>
            <td><input id="codigo" type="text" value=""/></td>
        </tr>
        <tr><td colspan="2" style="text-align: center"><input type="submit" value="Añadir"/></td></tr>
    </table>
</form>