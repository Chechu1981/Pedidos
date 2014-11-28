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
var lineasSemanal = new objetoAjax();
var insertarSemanal = new objetoAjax();
var eliminarLineaSemanal = new objetoAjax();
var cliente = new objetoAjax();
var referencia = new objetoAjax();
var actualizar = new objetoAjax();
var guardarPedido = new objetoAjax();
var guardarcomentaro = new objetoAjax();
var guardarNuevoSemanal = new objetoAjax();

$(document).ready(function() {
    $("#ref").blur(function() {
        $.ajax({
            url: "../pedidosv/denominacion.php?ref=" + this.value,
            success: function(result) {
                $("#des").val(result);
            }
        })
    })
});

function eliminarLinea(id, ref) {
    var afirmativo = confirm("¿Eliminar la referencia " + ref + "?");
    if (afirmativo) {
        eliminarLineaSemanal.open("GET", "eliminar.php?id=" + id, true);
        eliminarLineaSemanal.send(null);
        //verLineasSemanal(1);
        window.location.href = "semanal.php?encurso=SI";
    }
}

function nuevoPedido() {
    var campo = document.getElementById('fecha');
    if (campo.value === "") {
        alert("Debes introducir una fecha");
        campo.style.border = '3px solid red';
        campo.style.background = '#ffcccc';
    } else {
        guardarPedido.open("GET", "npedido.php?fecha=" + campo.value, true);
        guardarPedido.send(null);
        window.location.href = "semanal.php?encurso=SI";
    }
}

function mostrarGuardar() {
    document.getElementById('guardar').style.display = "block";
    document.getElementById('candado').style.display = "none";
}

function printsem(num) {
    var ficha = document.getElementById('tbl');
    var ventimp = window.open('', 'imprimir');
    ventimp.document.write('<style>table, td, th{border:1px solid black;} </style><img src="../imagenes/logo_Citroen.png" width="90" style="float: left;margin: 8px" /><h2>Pedido semanal ' + num + '</h2>');
    ventimp.document.write(ficha.innerHTML);
    ventimp.document.write("<?php include_once '../scripts/pie.php'; ?>");
    ventimp.document.close();
    ventimp.print();
    ventimp.close();
}

function savecom(id, salida) {
    var coment = document.getElementById("com" + id);
    //alert("No se pude cambiar el comentario todavía.\n Ya os avisaré. \n Chechu."+coment);
    guardarcomentaro.open("GET", "comentario.php?id=" + id + "&salida=" + coment.value, true);
    guardarcomentaro.send(null);
    coment.innerHTML = coment.value.toUpperCase();
}

/*
 
 function verLineasSemanal(numero){
 lineasSemanal.open("GET", "lista.php", true);
 lineasSemanal.send(null);
 lineasSemanal.onreadystatechange = mostrarLineasSemanal;
 }
 
 function mostrarLineasSemanal(){
 var tabla=document.getElementById("t-pedido");
 if(lineasSemanal.readyState==4){
 tabla.innerHTML = lineasSemanal.responseText;	
 }else{
 tabla.value = "";
 }
 document.getElementById('ref').focus();
 }
 
 function listarReferencia(numero){
 referencia.open("GET", "listadoReferencia.php", true);
 referencia.send(null);
 referencia.onreadystatechange = mostrarLineasReferencia;
 }
 
 function mostrarLineasReferencia(){
 var tabla=document.getElementById("t-pedido");
 if(referencia.readyState==4){
 tabla.innerHTML = referencia.responseText;	
 }else{
 tabla.value = "";
 }
 document.getElementById('ref').focus();
 }
 
 function listarCliente(numero){
 cliente.open("GET", "listadoClientes.php", true);
 cliente.send(null);
 cliente.onreadystatechange = mostrarLineasCliente;
 }
 
 function mostrarLineasCliente(){
 var tabla=document.getElementById("t-pedido");
 if(cliente.readyState==4){
 tabla.innerHTML = cliente.responseText;	
 }else{
 tabla.value = "";
 }
 document.getElementById('ref').focus();
 }
 
 function insertarLinea(){
 var ref = document.getElementById("ref").value;
 var can = document.getElementById("can").value;
 var des = document.getElementById("des").value;
 var cli = document.getElementById("cli").value;
 var com = document.getElementById("com").value;
 insertarSemanal.open("GET","nuevo.php?ref="+ref+"&can="+can+"&des="+des+"&cli="+cli+"&com="+com,true);
 insertarSemanal.send(null);
 limpiarCampos();
 document.getElementById('ref').focus();
 verLineasSemanal(1);
 }
 
 function pedir(id,pedido,num){
 actualizar.open("GET","pedir.php?id="+id+"&pedido="+pedido+"&num="+num,true);
 actualizar.send(null);
 verLineasSemanal();
 }
 
 function eliminarLinea(id,ref){
 var afirmativo = confirm("¿Eliminar la referencia "+ref+"?");
 if(afirmativo){
 eliminarLineaSemanal.open("GET","eliminar.php?id="+id,true);
 eliminarLineaSemanal.send(null);
 verLineasSemanal(1);
 }
 }
 
 function limpiarCampos(){
 document.getElementById("ref").value = "";
 document.getElementById("can").value = "";
 document.getElementById("des").value = "";
 document.getElementById("cli").value = "";
 document.getElementById("com").value = "";
 }
 
 function todos(){
 //document.getElementsByTagName(input).checked = true;
 }
 
 $(document).ready(function(){
 $("#ref").blur(function(){
 $.ajax({
 url: "../calendario/denominacion.php?ref="+this.value,
 success: function(result){
 $("#des").val(result);
 }
 })
 })
 });
 */