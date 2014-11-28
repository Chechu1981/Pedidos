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
    
    function enviarConsulta(){
        var id=document.getElementById('id').value;
        var cantidad = document.getElementById('cantidad').value;
        actualizarCantidad.open("GET","actualizarCantidad.php?id="+id+"&cantidad="+cantidad, true);
        actualizarCantidad.send(null);
        window.opener.location.reload();
        this.window.close();    
    }
</script>
<body onload="document.getElementById('cantidad').select()    ;">
    <form method="POST" action="cantidad.php" style="text-align:center" onsubmit="enviarConsulta()" >
    <input type="hidden" id='id' name="id" value="<?php echo @$_GET['id']; ?>" >
    <input style="width:80px;text-align:center;" id="cantidad" name="cantidad" value="<?php echo @$_GET['cantidad']; ?>" ><br/><br/>
    <input type="submit" value="Cambiar cantidad" >
</form>
</body>

