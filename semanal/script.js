$(document).ready(function(){
    $("#ref").blur(function(){
        $.ajax({
            url: "../calendario/denominacion.php?ref="+this.value,
            success: function(result){
                $("#des").val(result);
            }
        })
    });
    $("#ref").focus();
    $.ajax({
        url:"lista.php",
        success: function(result){
            $("#t-pedido").html(result)
        }
    })
    $("#can").keyup(function(event){
        //alert(event.which);
        if((event.which < 48 || event.which > 57) && (event.which < 96 || event.which > 105) && event.which != 9 && event.which != 16){
            alert("Hay que introducir números");
            $("#can").val('');
            $("#can").css("border-color","red");
        }
    })
    $("#frm input").keypress(function(event) {
    if (event.which == 13) {
        $.ajax({
            url: "nuevo.php",
            type: "POST",
            data: {ref:$('#ref').val(), can:$('#can').val(), den:$('#den').val(), com:$('#com').val(), cli:$('#cli').val()},
            beforeSend: function () { 
                $("#t-pedido").html("<div class='aviso'>Procesando, espere por favor...</div>")
            }
        })
        $("#can").css("border-color","black");
        $.ajax({
            url:"lista.php",
            success: function(result){
                $("#t-pedido").html(result)
            }
        })
        $("#frm input").val('');
        $("#frm textarea").val('');
        $("#incluir").val('Añadir');
        $("#ref").focus();
        }
    });
    $("#incluir").click(function(){
        $.ajax({
            url: "nuevo.php",
            type: "POST",
            data: {ref:$('#ref').val(), can:$('#can').val(), den:$('#den').val(), com:$('#com').val(), cli:$('#cli').val()},
            beforeSend: function () { 
                $("#t-pedido").html("<div class='aviso'>Procesando, espere por favor...</div>")
            }
        })
        $("#can").css("border-color","black");
        $.ajax({
            url:"lista.php",
            success: function(result){
                $("#t-pedido").html(result)
            }
        })
        $("#frm input").val('');
        $("#frm textarea").val('');
        $("#incluir").val('Añadir');
        $("#ref").focus();
    })
})
function pedir(id,pedido){
    var estado = 0;
        if(id == 'all'){
            if($("#all").is(':checked'))
                estado = 1;
            else
                estado = 0;
        }else{
            if($("#"+id).is(':checked'))
                estado = 1;
            else
                estado = 0;
        }
    $.ajax({
        async: "false",
        url:"pedir.php?id="+id+"&pedido="+pedido+"&num="+estado,
        success: function(result){
            $("#t-pedido").after(result)
        }
    });
    $.ajax({
        async: "false",
        url:"lista.php",
        success: function(result){
            $("#t-pedido").html(result)
        }
    });
}
function eliminar(id,ref){
    var elim = confirm("Vas a eliminar la referencia "+ref);
    if(elim){
        $.ajax({
            url:"eliminar.php?id="+id,
            success: function(result){
                $("#t-pedido").after(result)
            }
        });
        $.ajax({
            url:"lista.php",
            success: function(result){
                $("#t-pedido").html(result)
            }
        });
    }
}
function todos(){
    if($("#all").is(':checked')){
        $("input[type='checkbox']").attr('checked',true);
    }else{
        $("input[type='checkbox']").attr('checked',false);}
    pedir('all',1);
}