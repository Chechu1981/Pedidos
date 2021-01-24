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
var ajax = objetoAjax();
var actual = objetoAjax();
var elim = objetoAjax();
var anti = objetoAjax();
var pagina = objetoAjax();

function enviartitulo() {
    var h2 = document.getElementById('titulo');
    h2.innerHTML = "En curso</br><img src='../imagenes/29.gif' />";
    ajax.open('GET', 'tabla.php', true);
    ajax.send(null);
    ajax.onreadystatechange = respuestatitulo;
}
function respuestatitulo() {
    var div = document.getElementById('tabla');
    if (ajax.readyState == 4) {
        div.innerHTML = ajax.responseText;
    } else {
        div.value = "";
    }
}
function actualizar(id) {
    var com = document.getElementById('com' + id).value;
    actual.open('GET', 'actualizar.php?com=' + com + '&id=' + id, true);
    actual.send(null);
    ajax.onreadystatechange = respuestatitulo;
    enviartitulo();
}
function eliminar(id) {
    elim.open('GET', 'eliminar.php?id=' + id);
    elim.send(null);
    elim.onreadystatechange = respuestatitulo;
}
function nuevo_cliente() {
    $(function() {
        //$( "#dialog:ui-dialog" ).dialog( "destroy" );
        $("#nven").dialog({
            height: 500,
            width: 950,
            modal: true,
            show: "fold",
            hide: "scale",
            title: 'Nuevo Contacto'
        });
    });
}
function nuevo() {
    $(function() {
        //$( "#dialog:ui-dialog" ).dialog( "destroy" );
        $("#new").dialog({
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
    $("#new").dialog('destroy');
    return false;
}
function confirmar_linea(id, proveedor) {
    $respuesta = confirm("¿Quieres eliminar el pedido de " + proveedor + "?");
    if ($respuesta) {
        eliminar(id);
        alert("Pedido de " + proveedor + " eliminado.");
        enviartitulo();
    }
}
function recibido(id, proveedor) {
    $respuesta = confirm("El pedido de " + proveedor + " ha sido recibido.");
    if ($respuesta) {
        recepcion(id);
    }
}
function antigu() {
    anti.open('GET', 'antiguos.php', true);
    anti.send(null);
    anti.onreadystatechange = resanti;
}
function resanti() {
    var div = document.getElementById('tabla');
    var h2 = document.getElementById('titulo');
    if (anti.readyState == 4) {
        div.innerHTML = anti.responseText;
        h2.innerHTML = "Recibidos";
    } else {
        div.value = "";
    }
}
function paginas(num) {
    pagina.open('GET', 'antiguos.php?pagina=' + num, true);
    pagina.send(null);
    pagina.onreadystatechange = respagina;
}
function respagina() {
    var div = document.getElementById('tabla');
    var h2 = document.getElementById('titulo');
    if (pagina.readyState == 4) {
        div.innerHTML = pagina.responseText;
        h2.innerHTML = "Recibidos";
    } else {
        div.value = "";
    }
}
var busc = new objetoAjax();
function buscar() {
    var prov = document.getElementById('prove').value;
    var ord = document.getElementById('ord').value;
    var pedido = document.getElementById('pedido').value;
    var operario = document.getElementById('operario').value;
    var comentario = document.getElementById('comentario').value;
    busc.open('GET', 'buscar.php?prove=' + prov + '&ord=' + ord + '&pedido=' + pedido + '&operario=' + operario + '&comentario=' + comentario, true);
    busc.send(null);
    busc.onreadystatechange = encontrar;
}
function encontrar() {
    var div = document.getElementById('tabla');
    var h2 = document.getElementById('titulo');
    if (busc.readyState == 4) {
        div.innerHTML = busc.responseText;
        h2.innerHTML = "Buscar";
    } else {
        div.value = "";
    }
}
function examinar() {
    setInterval(function() {
        if (document.getElementById('titulo').innerHTML == 'En curso')
            enviartitulo();
    }, 1000);
}
function comentario() {
    $(function() {
        //$( "#dialog:ui-dialog" ).dialog( "destroy" );
        $("#comentario").dialog({
            height: 300,
            width: 300,
            modal: true,
            show: "fold",
            hide: "scale",
            title: 'Modificar comentario'
        });
    });
}
function editar() {
    var h2 = document.getElementById('titulo');
    h2.innerHTML = "Editar";
}
function recepcion(id) {
    $(function() {
        $("#dialog-message").dialog({
            modal: true,
            buttons: {
                Aceptar: function() {
                    $(this).dialog("close");
                    var oper = document.getElementById('nomb').value;
                    actual.open('GET', 'recibido.php?id=' + id + '&oper=' + oper, true);
                    actual.send(null);
                    enviartitulo();
                }
            }
        });
    });
}

function vercuadro() {
    var buscar = document.getElementById('buscar');
    if (buscar.style.display == "none")
        $('#buscar').show('blind');
    else
        $('#buscar').hide('blind');
}
function avisarmail(id) {
    if (document.getElementById("hi" + id).value == 0) {
        document.getElementById(id).style.display = "table-row";
        //$("#"+id).show();
        document.getElementById("img" + id).src = "../imagenes/arriba.png";
        document.getElementById("hi" + id).value = 1;
    } else {
        document.getElementById(id).style.display = "none";
        //$("#"+id).hide();
        document.getElementById("img" + id).src = "../imagenes/abajo.png";
        document.getElementById("hi" + id).value = 0;
    }
}

function enviarmail(destinatario, id) {
    alert("Función deshabilitada. Tenemos que enviar el correo a pedal. \n  Lo estoy arreglando. Chechu");
    var nombre = "Chechu";
    /*
    var nombre = prompt("Escribe tu nombre:", "");
    while (nombre == '') {
        nombre = prompt("Escribe tu nombre:", "");
    }*/
    $.ajax({
        url: "www.empresacarrion.com/pruebaajax.php",
        type: "POST",
        data: {
            d: destinatario,
            ide: id,
            operario: nombre
        }
    });
    /*
    document.getElementById('' + destinatario + id).disabled = "disabled";*/
}

function modificar_pedido(id, pedido) {
    var posicion_x = (screen.width / 2) - (400 / 2);
    var posicion_y = (screen.height / 2) - (350 / 2);
    window.open("actualizar_pedido.php?id=" + id + "&pedido=" + pedido, this.target, 'width=400,height=350,left=' + posicion_x + ',top=' + posicion_y);
}