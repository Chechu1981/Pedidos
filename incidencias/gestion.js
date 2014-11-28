function objetoAjax() {
    var xmlhttp = false;
    try {
        xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
    } catch (e) {
        try {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        catch (E) {
            xmlhttp = false;
        }
    }
    if (!xmlhttp && typeof XMLHttpRequest != 'undefined') {
        xmlhttp = new XMLHttpRequest();
    }
    return xmlhttp;
}
var eliminarLineaSemanal = new objetoAjax();
var borrartabla = new objetoAjax();

function eliminarLinea(id, ref) {
    var afirmativo = confirm("¿Eliminar la referencia " + ref + "?");
    if (afirmativo) {
        eliminarLineaSemanal.open("GET", "eliminar.php?id=" + id, true);
        eliminarLineaSemanal.send(null);
        window.location.href = "incidencias.php";
    }
}

function eliminartabla() {
    var afirmativo = confirm("¿Eliminar la tabla completa?");
    if (afirmativo) {
        borrartabla.open("GET", "eliminartodo.php", true);
        borrartabla.send(null);
        window.location.href = "incidencias.php";
    }
}

function imprimir() {
    var ficha = document.getElementById('tbl');
    var ventimp = window.open('', 'imprimir');
    var fecha = new Date();
    ventimp.document.write('<style>table, td, th{border:1px solid black;} </style><img src="../imagenes/logo_Citroen.png" width="90" style="float: left;margin: 8px" /><h2>Incidencias </h2><h4>' + fecha.getDate() + '/' + (fecha.getMonth() + 1) + '/' + fecha.getFullYear() + '</h4>');
    ventimp.document.write(ficha.innerHTML);
    ventimp.document.write("<?php include_once '../scripts/pie.php'; ?>");
    ventimp.document.close();
    ventimp.print();
    ventimp.close();
}

function cargar() {
    document.getElementById('ref').focus();
}