$(document).ready(function(){
    $("#referencia").keyup(function(evento){
        if(evento.which == 13 && $("#referencia").val() != ''){
        $.ajax({
            url: "piezas.php?ref="+$("#referencia").val()+"&den="+$("#den").val(),
            type: "GET",
            beforeSend: function(){
                    $("#vista").html("<div class='aviso'>Procesando "+$("#referencia").val()+", espere por favor...</div>")
            },
            success: function(res){
                $("#vista").html(res);
            }
        })
        }
    })
    $("#den").keyup(function(evento){
        if(evento.which == 13 && $("#den").val() != ''){
        $.ajax({
            url: "piezas.php?ref="+$("#referencia").val()+"&den="+$("#den").val(),
            type: "GET",
            beforeSend: function(){
                    $("#vista").html("<div class='aviso'>Procesando "+$("#den").val()+", espere por favor...</div>")
            },
            success: function(res){
                $("#vista").html(res);
            }
        })
        }
    })
});