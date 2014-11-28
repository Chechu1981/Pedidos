<script src="../jquery-ui-1.10.4.custom/js/jquery-1.10.2.js" type="text/javascript" ></script>
<script src="../jquery-ui-1.10.4.custom/js/jquery-ui-1.10.4.custom.js" type="text/javascript" ></script>
<script src="../jquery-ui-1.10.4.custom/js/jquery-ui-1.10.4.custom.min.js" type="text/javascript" ></script>
<link rel="stylesheet" href="../jquery-ui-1.10.4.custom/css/cupertino/jquery-ui-1.10.4.custom.css" />
<script type="text/javascript">
            $(function() {
                $("#calen").datepicker({
                    changeMonth: true,
                    changeYear: true,
                    monthNames: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
                    monthNamesShort: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
                    firstDay: 1,
                    dayNamesMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
                    dayNames: ["Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo"],
                    dateFormat: "d-MM-mm-yy-D",
                    onSelect: function(datos) {
                        var fecha = datos.split("-");
                        var diasemana;
                        if (fecha[4] === 'Sun' || fecha[4] === 'Sat') {
                            diasemana = 6;
                        }
                        window.location.href = "../pedidos/pedidos.php?id=<?php echo session_id() ?>&pedido=" + fecha[0] + fecha[1] + fecha[3];
                    }
                });
            });
        </script>
<ul>
    <li><a href="../inicio/inicio.php?id=<?php echo session_id(); ?>" >INICIO</a></li>
    <li><a href="../pedidos/pedidos.php?id=<?php echo session_id(); ?>" >URGENTE</a></li>
    <li><a href="../semanal/semanal.php?id=<?php echo session_id(); ?>" >SEMANAL</a>
        <ul>
            <li><a href="../semanal/todos.php?id=<?php echo session_id(); ?>" >TODOS</a></li>
        </ul>
    </li>
    <li style="background-color: #ccccff;width: 280px">
        <form action="../buscar/buscar.php?id=<?php echo session_id(); ?>" method="POST" id="frmbuscar" >
            <div id="iconbuscar"></div>
            <input type="text" id="buscar" name="buscar" >
            <?php
            $_SESSION['referencia'] = @$_POST['buscar'];
            ?>
        </form>
    </li>
    <li style="background-color: #ccccff" ><input class='calendario' type="text" id="calen" /></li>
</ul>