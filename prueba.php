<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv=Content-Type content="text/html; charset=UTF-8" />
        <title>Carrión</title>
        <link rel="stylesheet" href="../../scripts/jquery-ui.css" />
        <script src="../../scripts/jquery-1.9.1.js"></script>  
        <script src="../../scripts/jquery-ui.js"></script>  
        <script>
            $(function() {
                $("#calen").datepicker({
                    changeMonth: true,
                    changeYear: true,
                    monthNames: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
                    monthNamesShort: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
                    firstDay: 1,
                    dayNamesMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
                    dayNames: ["Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo"],
                    dateFormat: "d-MM-mm-yy",
                    onSelect: function(datos) {
                        var fecha = datos.split("-");
                        window.location.href = "./calendario/pedidos.php?ano=" + fecha[3] + "&mes=" + fecha[1] + "&numes=" + fecha[2] + "&dia=" + fecha[0];
                   }
                });
            });
        </script>
    </head>
    <body>
        <input style="height: 50px; width: 50px; color: transparent; cursor:pointer; background-image: url('./imagenes/agenda.gif'); background-repeat: no-repeat; border: none;" type="text" id="calen" />
    </body>
</html>


