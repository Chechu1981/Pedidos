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
    var ajax=objetoAjax();
    var actual=objetoAjax();
    var elim=objetoAjax();
    var anti=objetoAjax();
             
    function nuevo_cliente(){
        $(function() {
            //$( "#dialog:ui-dialog" ).dialog( "destroy" );
            $( "#nven" ).dialog({
                height: 500,
                width: 950,
                modal: true,
                show: "fold",
                hide: "scale",
                title: 'Nuevo Contacto'
            });
        });
    }
    function nuevo(){
        $(function() {
            //$( "#dialog:ui-dialog" ).dialog( "destroy" );
            $( "#new1" ).dialog({
                height: 600,
                width: 1000,
                modal: true,
                show: "fold",
                hide: "scale",
                title: 'Otros proveedores'
            });
        });
    }
    function closeIframe()
    {
        $("#nven").dialog('destroy');
        return false;
    }
            
    function closeprov(){
        $("#new1").dialog('destroy');
        return false;
    }
    function antigu(){
        anti.open('GET','antiguos.php',true);
        anti.send(null);
        anti.onreadystatechange = resanti;
    }
    function resanti(){
        var div=document.getElementById('tabla');
        var h2=document.getElementById('titulo');
        if(anti.readyState==4){
            div.innerHTML = anti.responseText;
            h2.innerHTML = "Recibidos";
        }else{
            div.value = "";
        }
    }
    var busc=new objetoAjax();
    function buscar(){
        var prov=document.getElementById('prove').value;
        var ord=document.getElementById('ord').value;
        var pedido=document.getElementById('pedido').value;
        var operario=document.getElementById('operario').value;
        var comentario=document.getElementById('comentario').value;
        busc.open('GET','buscar.php?prove='+prov+'&ord='+ord+'&pedido='+pedido+'&operario='+operario+'&comentario='+comentario,true);
        busc.send(null);
        busc.onreadystatechange = encontrar;
    }
    function encontrar(){
        var div=document.getElementById('tabla');
        var h2=document.getElementById('titulo');
        if(busc.readyState==4){
            div.innerHTML = busc.responseText;
            h2.innerHTML = "Buscar";
        }else{
            div.value = "";
        }
    }
    function examinar(){
        setInterval(function(){
            if(document.getElementById('titulo').innerHTML == 'En curso')
                enviartitulo();
        },1000);
    }
    
    // Llamado cuando se cargue la página
posicionarMenu();

$(window).scroll(function() {
    posicionarMenu();
});

function posicionarMenu() {
    var altura_del_header = $('header').outerHeight(true);
    var altura_del_menu = $('nav').outerHeight(true);

    if ($(window).scrollTop() >= altura_del_header){
        $('nav').addClass('fixed').fadeIn(3000);
        $('.content').css('margin-top', (altura_del_menu) + 'px').fadeIn(3000);
    } else {
        $('nav').removeClass('fixed');
        $('.content').css('margin-top', '0');
    }
}
</script>
<ul id="nav">
    <li><a href="../../principal/indice.php" target="_self">Inicio</a></li>
    <li><a href="../../clientes/clientes.php" target="_self">Clientes</a>
        <ul>
            <li><a href="javascript:nuevo_cliente()" >Nuevo cliente</a></li>
        </ul>
    </li>
    <li><a href="../../cruze/cruze.php" target="_self">Cruze</a></li>
    <li><a href="../../enlaces/enlaces.php" target="_self">Enlaces</a></li>
    <li><a href="../calendario/pedidos.php?numes=<?php echo calcular_numes(); ?>&dia=<?php echo calcular_dia(); ?>&mes=<?php echo calcular_mes(); ?>&ano=<?php echo calcular_ano(); ?>">Pedidos Citroen</a>
        <ul>
            <li><a href="../calendario/calendario.php">Calendario</a></li>
            <li><a href="#">Estadistica VP<span class="ui-icon ui-icon-triangle-1-e"></span></a>
                <ul>
                    <li><a href="../calendario/estadistica.php">Diaria</a></li>
                    <li><a href="../calendario/estadisticames.php">Mensual</a></li>
                </ul>
            </li>
            <li><a href="#" >Pendiente de Servir<span class="ui-icon ui-icon-triangle-1-e"></span></a>
                <ul>
                    <li><a href="../../calendario/pendiente.php?destino=M">Mostrador</a></li>
                    <li><a href="../../calendario/pendiente.php?destino=T">Taller</a></li>
                    <li><a href="../../calendario/pendiente.php?destino=all">Todo</a></li>
                </ul>
            </li>
        </ul>
    </li>
    <li><a href="../../tarificador/tarificador.php">Tarificador</a></li>
    <?php if ($_SERVER['REMOTE_USER'] != "medina") { ?><li><a href="../../pedidosv/pedidosv.php?numes=<?php echo calcular_numesv(); ?>&dia=<?php echo calcular_diav(); ?>&mes=<?php echo calcular_mesv(); ?>&ano=<?php echo calcular_anov(); ?>">Pedidos Volvo</a>
            <ul>
                <li><a href="../pedidosv/calendario.php" >Calendario</a></li>
                <li><a href="#">Pendiente de Servir<span class="ui-icon ui-icon-triangle-1-e"></span></a>
                    <ul>
                        <li><a href="../../pedidosv/pendiente.php?destino=M">Mostrador</a></li>
                        <li><a href="../../pedidosv/pendiente.php?destino=T">Taller</a></li>
                        <li><a href="../../pedidosv/pendiente.php?destino=all">Todo</a></li>
                    </ul>
                </li>
            </ul></li>
            
        <?php if ($_SERVER['REMOTE_USER'] == "recepcion") { ?>
            <li><a href="../../promocion69/promo69.php">Calculador</a></li>
            <li>
                <a href="../../recepcion/recepcion.php?lista=c">Recepción</a>
                <ul>
                    <li><a href="../../recepcion/recepcion.php?lista=c">En curso</a></li>
                    <li><a href="../../recepcion/recepcion.php?lista=e">Entregados</a></li>
                    <li><a href="../../recepcion/coches/coches.php">Coches de Cortesía</a></li>
                </ul>
            </li>
            <li>
                <a href="../../promocion/todos.php">Mailing</a>
                <ul>
                    <li><a href="../../promocion/todos.php">Colectivo</a></li>
                    <li><a href="../../promocion/uno.php">Individual</a></li>
                    <li><a href="../../promocion/mailing.php">Muestra</a></li>
                    <li><a href="../../promocion/historico.php">Histórico</a></li>
                </ul>
            </li>
        <?php } ?>
        <?php if ($_SERVER['REMOTE_USER'] != "recepcion") { ?>
            <li><a href="#">Semanal</a>
                <ul>
                    <li><a href="../../semanal/semanal.php?encurso=SI">Citroen<span class="ui-icon ui-icon-triangle-1-e"></span></a>
                        <ul>
                            <li><a href="../../semanal/listasemanal.php">Anteriores</a></li>
                        </ul>
                    </li>
                    <li><a href="../../semanalvolvo/semanal.php?encurso=SI">Volvo<span class="ui-icon ui-icon-triangle-1-e"></span></a>
                        <ul>
                            <li><a href="../../semanalvolvo/listasemanal.php">Anteriores</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li>
            <a href="../incidencias/incidencias.php" >Incidencias</a>
        </li>
        <?php } ?>
        <li><a href="../../proveedores/proveedores.php" >Otros proveedores</a>
            <ul>
                <li><a href="../../proveedores/proveedores.php" >En curso</a></li>
                <li><a href="../../proveedores/proveedores.php?p=r" >Recibidos</a></li>
                <li><a href="javascript:nuevo()" >Nuevo pedido</a></li>
                <li><a href="../../proveedores/proveedores.php?p=b" >Buscar</a></li>
            </ul>
        </li>
        <li><a href="#">Otros</a>
                    <ul>
                        <li><a href="../../cambio/cambio.php">Cambio</a></li>
                        <li><a href="../../ubicacion/consulta.php">Consulta</a></li>
                        <li><a href="../../factura/factura.php">Factura provisional</a></li>
                    </ul></li>
        <?php
    }
    if ($_SERVER['REMOTE_USER'] == "medina") {
        ?><li><a href="../../proveedores/proveedores.php" >Otros proveedores</a></li><li><a href="../../semanal/semanal.php?encurso=SI">Semanal</a></li> <?php } ?>
</ul>
<div id="new1" style="display:none"><iframe id="iframe" style="padding: 20px" src="../../proveedores/nuevo.php" height="500" width="900"></iframe></div>
<div id="nven" style="display:none"><iframe style="padding: 20px" src="../../clientes/nuevo.php" height="400" width="900"></iframe></div>