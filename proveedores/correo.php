<?php 
include ('../estilos/conexion.php');
include '../calendario/calcular_dia.php';
?>
<script>
    function objetoAjax(){
        var xmlhttp=false;
        try {
            xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (e) {
        try {
           xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        } catch (E) {
            xmlhttp = false;
        }
            }
            if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
                xmlhttp = new XMLHttpRequest();
            }
                return xmlhttp;
    }
    var mail=objetoAjax();
    function mail(destino){
    mail.open('GET','enviarmail.php?d='+destino,true);
    mail.send(null);
    }
    function send(){
        var opcion=document.getElementById('destino');
        if(opcion.value==1){
            mail(1);
            alert("Correo enviado a recepci�n");
        }else if(opcion.value==2){
            mail(2);
            alert("Correo enviado a chapa");
        }else if(opcion.value==3){
            mail(3);
            alert("Correo enviado a Marisa");
        }else if(opcion.value==4){
            mail(4);
            alert("Correo enviado a Gonzalo");
        }
    }
</script>
<table>
    <tr>
        <td>
            <select id="destino" name="destinatarios" onchange="send()">
                <option value="0"></option>
                <option value="1">Recepción</option>
                <option value="2">Chapa</option>
                <option value="3">Marisa</option>
                <option value="4">Gonzalo</option>
            </select>
        </td>
    </tr>
</table>