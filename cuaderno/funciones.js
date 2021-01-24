/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function abrirDialogo(id) {
    var posicion_x = (screen.width / 2) - (1010 / 2);
    var posicion_y = (screen.height / 2) - (320 / 2);
    window.open('dialogo.php?id=' + id, this.target, 'width=1010,height=320,toolbar=no, scrollbars=yes, resizable=yes,left=' + posicion_x + ',top=' + posicion_y);
}

$(function() {
    $("#calen").datepicker({
        changeMonth: true,
        changeYear: true,
        monthNames: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
        monthNamesShort: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
        firstDay: 1,
        dayNamesMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
        dayNames: ["Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo"],
        dateFormat: "dd-MM-m-yy",
        onSelect: function(datos) {
            var fecha = datos.split("-");
            window.location.href = "anterior.php?dia=" + fecha[0] + "-" + fecha[2] + "-" + fecha[3];
        }
    });
});

function borrar(id, cliente) {
    var pregunta = confirm("¿Eliminar pedido de " + cliente + "?");
    if (pregunta) {
        $.ajax({
            url: 'eliminar.php?id=' + id
        });
        location = 'cuaderno.php';
    }
}

function ruta() {
    var cliente = document.getElementById('cli').value;
    $.ajax({
        url: "../reparto/insertarRuta.php?ordenante=chechu&clien=" + cliente + "&prio=NORMAL&comentario="
    });
    alert("Añadido a la ruta");
}

function update() {
    var id = document.getElementById('id').value;
    var cliente = document.getElementById('cli').value;
    var contacto = document.getElementById('contacto').value;
    var descripcion = document.getElementById('descripcion').value;
    var numero = document.getElementById('numero').value;
    var vehiculo = document.getElementById('vehiculo').value;
    var referencia = document.getElementById('referencia').value;
    var ubicacion = document.getElementById('ubicacion').value;
    var comentario = document.getElementById('comentario').value;
    var servido = document.getElementById('servido').value;
    var pedido = document.getElementById('pedido').value;
    //document.getElementById('comentario').value = "actualizar.php?id=" + id + "&cliente=" + cliente + "&contacto=" + contacto + "&descripcion=" + descripcion + "&numero=" + numero + "&vehiculo=" + vehiculo + "&ubicacion=" + ubicacion + "&comentario=" + comentario + "&servido=" + servido + "&pedido=" + pedido + "&referencia=" + referencia;
    $.ajax({
        url: "actualizar.php?id=" + id + "&cliente=" + cliente + "&contacto=" + contacto + "&descripcion=" + descripcion + "&numero=" + numero + "&vehiculo=" + vehiculo + "&ubicacion=" + ubicacion + "&comentario=" + comentario + "&servido=" + servido + "&pedido=" + pedido + "&referencia=" + referencia
    });
    //document.getElementById('comentario').innerHTML = 'actualizar.php?id=' + id + "&cliente=" + cliente + "&contacto=" + contacto + "&descripcion=" + descripcion + "&numero=" + numero + "&vehiculo=" + vehiculo + "&ubicacion=" + ubicacion + "&comentario=" + comentario + "&servido=" + servido + "&pedido=" + pedido + "&referencia=" + referencia;
    window.opener.location = 'cuaderno.php';
    this.window.close();
}

function verCalendario() {
    if (document.getElementById('calendario').style.display === "none") {
        $('#calendario').show('blind', 200);
        setTimeout("$('#buscreferencia').focus()", 500);
    } else {
        $('#calendario').hide('slide');
    }
}

function envioConIntro(e) {
    var esIE = (document.all);
    var esNS = (document.layers);
    tecla = (esIE) ? event.keyCode : e.which;
    if (tecla === 13) {
        update();
        return false;
    }
}