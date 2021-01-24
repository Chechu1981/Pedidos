<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">  
        <script type="text/javascript">
            function objetoAjax() {
                var xmlhttp = false;
                try {
                    xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
                } catch (e) {
                    try {
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                    } catch (E) {
                        xmlhttp = false;
                    }
                }
                if (!xmlhttp && typeof XMLHttpRequest !== 'undefined') {
                    xmlhttp = new XMLHttpRequest();
                }
                return xmlhttp;
            }

            var actualizarCantidad = new objetoAjax();

            function enviarConsulta() {
                var id = document.getElementById('id').value;
                var pedido = document.getElementById('pedido').value;
                actualizarCantidad.open("GET", "actualizarPedido.php?id=" + id + "&pedido=" + pedido, true);
                actualizarCantidad.send(null);
                window.opener.location.reload();
                this.window.close();
            }
        </script>
    </head>
    <body>
        <form method="POST" action="actualizar_pedido.php" style="text-align:center" onsubmit="enviarConsulta()" >
            <input type="hidden" id='id' name="id" value="<?php echo @$_GET['id']; ?>" >
            <textarea style="width:380px;height:270px;text-align:center;"  id="pedido" name="pedido" value="<?php echo @$_GET['pedido']; ?>" ><?php echo @$_GET['pedido']; ?></textarea><br/><br/>
            <input type="submit" value="Modificar pedido" >
        </form>
    </body>
</html>