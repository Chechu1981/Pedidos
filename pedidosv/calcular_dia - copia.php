<?php
function esFestivo(){
    $m=calcular_numes();
    $d=calcular_dia();
    $fiesta = "";
    if($m==11 and $d==1)
        $fiesta = "Dia de los santos";
    elseif($m==12 and $d==24)
        $fiesta = "Nochebuena";
    elseif($m==12 and $d==25)
        $fiesta = "Navidad";
    elseif($m==12 and $d==31)
        $fiesta = "Festivo";
    return $fiesta;
}

function calcular_dia(){
    $fecha = getdate(time());
    $ultimoDia = date('t');
    $ames = $fecha['mon'];
    $aano = $fecha['year'];
    $ultimoDiaSemana = date('w', mktime (0, 0, 0, $ames, $ultimoDia, $aano));
    $fe=$fecha['mday'];
    if(dia_semana()==5 and limite()==1)
        $fe=$fecha['mday']+3;
    elseif(dia_semana()==6)
        $fe=$fecha['mday']+2;
    elseif(dia_semana()==7)
        $fe=$fecha['mday']+1;
    elseif(limite())
        $fe=$fecha['mday']+1;
    if($fe==6 and calcular_numes()==12)//Dia de la Constitución
        $fe++;
    if($fe>$ultimoDia){
          $fe=1;
          if($ultimoDiaSemana==5 and limite())
              $fe+=2;
          elseif($ultimoDiaSemana==6)
              $fe+=1;
    }
    if($fe==1 and calcular_numes()==11)//Dia de los santos
        $fe=$fe+1;
    if($fe==1 and calcular_numes()==1)//Año nuevo
        $fe=2;
    if($fe==31 and calcular_numes()==12)//Año nuevo
        $fe=2;
    return $fe;
}
function dia_semana(){
	$fecha = date('N');
	return $fecha;
}
function calcular_mes(){
    $ultimoDia = date('t');
    $fecha = getdate(time());
    $fe=$fecha['mday'];
    if(dia_semana()==5 and limite()==1)
        $fe=$fecha['mday']+3;
    elseif(dia_semana()==6)
        $fe=$fecha['mday']+2;
    elseif(dia_semana()==7)
        $fe=$fecha['mday']+1;
    elseif(limite())
        $fe=$fecha['mday']+1;
    $mes = $fecha['mon'];
    if(($fe==$ultimoDia and limite())){
        $mes = $fecha['mon']-1;
    }elseif($fe>$ultimoDia){
        $mes = $fecha['mon'];
    }
    $meses = Array ('enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre');
    for($i = 1; $i <= 12; $i++){
        if($mes == $i){
            $mesletra = $meses[$i-1];
        if(($fe==$ultimoDia and limite()) or ($fe>$ultimoDia)){
            if($i==12)
                $mesletra=$meses[0];
            else
                $mesletra=$meses[$i];
            }
        }
    }
    return $mesletra;
}
function calcular_numes(){
    $ultimoDia = date('t');
    $fecha = getdate(time());
    $fe=$fecha['mday'];
    if(dia_semana()==5 and limite()==1)
        $fe=$fecha['mday']+3;
    elseif(dia_semana()==6)
        $fe=$fecha['mday']+2;
    elseif(dia_semana()==7)
        $fe=$fecha['mday']+1;
    elseif(limite())
        $fe=$fecha['mday']+1;
    $mes = $fecha['mon'];
    if(($fe==$ultimoDia and limite())){
        $mes = $fecha['mon']+1;
    }elseif($fe>$ultimoDia){
        $mes = $fecha['mon'];
    }
    if(($fe==$ultimoDia and limite()) or ($fe>$ultimoDia)){
                if($mes>12)
                    $mes=1;
                else 
                    $mes++;
    }
    return $mes;
}
function calcular_ano(){
    $ultimoDia = date('t');
    $fecha = getdate(time());
    $fe=$fecha['mday'];
    if(dia_semana()==5 and limite()==1)
        $fe=$fecha['mday']+3;
    elseif(dia_semana()==6)
        $fe=$fecha['mday']+2;
    elseif(dia_semana()==7)
        $fe=$fecha['mday']+1;
    elseif(limite())
        $fe=$fecha['mday']+1;
    $mes = $fecha['mon'];
    $ano = $fecha['year'];
    if($fe>$ultimoDia and limite()){
                if($mes==12){
                    $mes=1;
                    $ano++;
                }else 
                    $mes++;
    }
    return $ano;
}
function limite(){
    $activo = false;
    $fecha = getdate(time());
    $hora = $fecha['hours'];
    if($hora > 17){
        $activo=true;
    }
    //Fiestas
            
  return $activo;
}
?>