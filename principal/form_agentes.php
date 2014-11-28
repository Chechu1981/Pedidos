<?php include '../estilos/conexion.php'; ?> 
<h2>Añadir personal</h2>
<form action="" onsubmit="addinsert()" method="POST">
    <table class="listado">
        <th>Nombre</th>
        <tr>
            <td><input id="nombre" type="text" value=""></td>
        </tr>
        <tr><td colspan="2" style="text-align: center"><input type="submit" value="Añadir"/></td></tr>
    </table>
</form>