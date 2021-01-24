<html>
    <head>
        <script>
            var reloj=new XMLHttpRequest();
            var tiempo;
            var t;
             function reloj1(){
                 reloj.open('GET','hora.php',true);
                 reloj.send(null);
                 reloj.onreadystatechange = hours1;
             }
             function hours1(){
                 if(reloj.readyState>3){
                     tiempo.innerHTML = reloj.responseText;
                 }else{
                     tiempo.innerHTML = "Desconectado";
                 }
             }
             function tiempo(){
                 var h = document.getElementById('hora');
                 var m = document.getElementById('minutos');
                 var s = document.getElementById('segundos');
                 //t = tiempo.split(" : ");
                 //s.innerHTML = t[0];
                 h.innerHTML = tiempo.innerHTML;
             }
             reloj1();
             setInterval("tiempo()" ,1000);
        </script>
    </head>
    <body onload="tiempo()">
        <div id="hora"></div>
        <div id="minutos"></div>
        <div id="segundos"></div>
    </body>
</html>