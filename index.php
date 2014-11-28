<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Carrión</title>
        <?php
        if ($_SERVER['REMOTE_ADDR'] == '127.0.0.1') {
            ?> <script type="text/javascript">
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
                    if (!xmlhttp && typeof XMLHttpRequest != 'undefined') {
                        xmlhttp = new XMLHttpRequest();
                    }
                    return xmlhttp;
                }

                function reloj() {
                    setInterval((function() {
                        var segundos = new Date().getSeconds();
                        var minutos = new Date().getMinutes();
                        var hora = new Date().getHours();
                        if(hora == 16 && minutos == 0 && segundos == 0){
                            enviarmail();
                        }
                        document.getElementById('hora').value = hora + ':' + minutos + ':' + segundos;
                    }), 1000);
                }

                var mail = objetoAjax();

                function enviarmail() {
                    mail.open('GET', 'http://www.empresacarrion.com/psmail.php', true);
                    mail.send(null);
                }

                window.onbeforeunload = function exitAlert() {
                 var textillo = "¡¡NO CIERRES ESTA VENTANA!! \n\nSi cierras esa ventana dejarás de enviar los correos automáticos del VP al taller, Medina y Noguiera.\nCiérrala sólo cuando te vayas\n\nHaz click en 'Permanecer en esta página'.";
                 return textillo;
                 }
            </script> 
        <?php } ?>
        <link rel="shortcut icon" href="./imagenes/chechu.ico" />
        <style type="text/css">
            html, body, div, iframe{
                margin:0; 
                padding:0; 
                height:100%; 
            }
            iframe{ 
                display:block; 
                width:100%; 
                border:none; 
            }
        </style>
    </head>
    <body onload="reloj()">
        <input type="hidden" id="hora"></input>
        <iframe src="/principal/indice.php" ></iframe>
    </body>
</html>