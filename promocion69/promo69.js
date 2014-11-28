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
var filtroajax = objetoAjax();
var filtroPrecio = objetoAjax();
var juntaPrecio = objetoAjax();


function getfiltro() {
    var filtro = document.getElementById('f').value;
    filtroPrecio.open('GET', 'precios.php?f=' + filtro, true);
    filtroPrecio.send(null);
    filtroPrecio.onreadystatechange = respuestafiltro;
}

function respuestafiltro() {
    var texto = document.getElementById('texto');
    var pvpfiltro = document.getElementById('foculto');

    if (filtroPrecio.readyState === 1) {
        texto.innerHTML = "<div style='clear:both;text-align:center;' >Buscando...<img src='../imagenes/spinner.gif' title='spinner' /></div>";
    } else if (filtroPrecio.readyState === 4) {
        if (filtroPrecio.status === 200 || filtroPrecio.status === 0) {
            //texto.innerHTML = ajax.responseText;
            pvpfiltro.value = filtroPrecio.responseText;
        }
    } else {
        texto.innerHTML = "";
    }
}

function getjunta() {
    var junta = document.getElementById('j').value;
    juntaPrecio.open('GET', 'precios.php?f=' + junta, true);
    juntaPrecio.send(null);
    juntaPrecio.onreadystatechange = respuestajunta;
}

function respuestajunta() {
    var pvpjunta = document.getElementById('joculto');
    if (juntaPrecio.readyState === 1) {
        texto.innerHTML = "<div style='clear:both;text-align:center;' >Buscando...<img src='../imagenes/spinner.gif' title='spinner' /></div>";
    } else if (juntaPrecio.readyState === 4) {
        if (juntaPrecio.status === 200 || juntaPrecio.status === 0) {
            //texto.innerHTML = ajax.responseText;
            pvpjunta.value = juntaPrecio.responseText;
        }
    } else {
        texto.innerHTML = "";
    }
}

function calcular() {
    var pvpjunta = document.getElementById('joculto');
    var pvpfiltro = document.getElementById('foculto');
    var mo = document.getElementById('mo').value.replace(',', '.');
    var dmo = document.getElementById('dmo').value.replace(',', '.');
    var iva = document.getElementById('iva').value.replace(',', '.');
    var dtof = document.getElementById('df').value.replace(',', '.');
    var bmo = document.getElementById('bmo').value.replace(',', '.');
    var cantidad = document.getElementById('c').value;
    var pvpkit7 = document.getElementById('7k');
    var pvpkit9 = document.getElementById('9k');
    var pvpkiti = document.getElementById('ik');
    var promo7 = document.getElementById('7p').value.replace(',', '.');
    var promo9 = document.getElementById('9p').value.replace(',', '.');
    var promoi = document.getElementById('ip').value.replace(',', '.');
    var dto7 = document.getElementById('7d');
    var dto9 = document.getElementById('9d');
    var dtoi = document.getElementById('id');
    var totalaceite7 = cantidad.replace(',', '.') * 15.6;
    var totalaceite9 = cantidad.replace(',', '.') * 19.8;
    var totalaceitei = cantidad.replace(',', '.') * 23.3;
    var filtro = pvpfiltro.value.replace(',', '.');
    var junta = pvpjunta.value.replace(',', '.');
    var ecotasa = cantidad * 0.054;
    var totalpiezas = (parseFloat(filtro) * ((100 - parseFloat(dtof)) / 100)) + parseFloat(junta) + parseFloat(ecotasa);
    var totalmo = (mo * bmo) * ((100 - dmo) / 100);
    var kit7total = Math.round(((totalmo + totalpiezas + totalaceite7) * ((iva / 100) + 1)) * 100) / 100;
    var kit9total = Math.round(((totalmo + totalpiezas + totalaceite9) * ((iva / 100) + 1)) * 100) / 100;
    var kititotal = Math.round(((totalmo + totalpiezas + totalaceitei) * ((iva / 100) + 1)) * 100) / 100;
    var texto = document.getElementById('texto');
    if (cantidad !== "") {
        if (cantidad < 3 || cantidad >= 7) {
            alert("La capacidad del aceite debe estar comprendida entre 3 y 7 litros");
            document.getElementById('c').select();
            document.getElementById('c').style.border = "2px red solid";
        }
    }
    dto7.value = Math.round((1 - (totalaceite7 - ((kit7total / ((iva / 100) + 1)) - promo7 / ((iva / 100) + 1))) / totalaceite7) * 10000) / 100 + "%";
    dto9.value = Math.round((1 - (totalaceite9 - ((kit9total / ((iva / 100) + 1)) - promo9 / ((iva / 100) + 1))) / totalaceite9) * 10000) / 100 + "%";
    dtoi.value = Math.round((1 - (totalaceitei - ((kititotal / ((iva / 100) + 1)) - promoi / ((iva / 100) + 1))) / totalaceitei) * 10000) / 100 + "%";
    pvpkit7.value = kit7total;
    pvpkit9.value = kit9total;
    pvpkiti.value = kititotal;
    texto.innerHTML = "Filtro: " + pvpfiltro.value + "€ - " + dtof + "%<br/>Junta: " + pvpjunta.value + "€<br/>Mano de obra: " + (mo * bmo) + "€ - " + dmo + "%<hr/>Aceite 7000: " + Math.round(totalaceite7 * 100) / 100 + "€<br/>Aceite 9000: " + Math.round(totalaceite9 * 100) / 100 + "€<br/>Aceite INEO: " + Math.round(totalaceitei * 100) / 100 + "€<hr/>Ecotasa: " + Math.round(ecotasa * 1000)/1000 + "€";
}