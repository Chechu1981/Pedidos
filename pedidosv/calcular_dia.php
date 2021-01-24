<?php
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
    if((($fe==$ultimoDia and limite()) or ($fe>$ultimoDia))and(calcular_numes()==1))
        $fe=1;
    if($fe>$ultimoDia){
          $fe=1;
          if($ultimoDiaSemana==5 and limite()) //si es sábado
              $fe+=2;
          elseif($ultimoDiaSemana==6) // si es domingo
              $fe+=1;
        }
    while(festivo($fe,calcular_numes())){
        $fe+=1;
        if(date('w', mktime (0, 0, 0, calcular_numes(), $fe, calcular_ano()))==5 and limite())
                $fe+=3;
        elseif(date('w', mktime (0, 0, 0, calcular_numes(), $fe, calcular_ano()))==6)
                $fe+=2;
        elseif(date('w', mktime (0, 0, 0, calcular_numes(), $fe, calcular_ano()))==7)
                $fe+=1;
    }
    return $fe;
}

// ********** FIESTAS **********
function festivo($d,$m){
    $fiesta=false;
    if(($d==1 and $m==1)or
	($d==31 and $m==12) or 
	($d==1 and $m==11)or
	($d==7 and $m==12)or
	($d==24 and $m==12)or
	($d==25 and $m==12)or
	($d==7 and $m==1)or
	($d==28 and $m==3)or
	($d==29 and $m==3)or
	($d==23 and $m==4)or
	($d==1 and $m==5)or
	($d==15 and $m==8)or
	($d==12 and $m==10))
        $fiesta=true;
    
    return $fiesta;
}

function dia_semana(){
	$fecha = date('N');
	return $fecha;
}
function calcular_mes(){
    $meses = Array ('enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre');
    return $meses[calcular_numes()-1];
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
    if(($fe==$ultimoDia and limite()) or ($fe>$ultimoDia)){
                if($mes==12)
                    $mes=1;
                else 
                    $mes++;
    }
    return $mes;
}
function calcular_ano(){
    $fecha = getdate(time());
    $ano = $fecha['year'];
    $ultimoDia = date('t');
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
    if(($fe==$ultimoDia and limite()) or ($fe>$ultimoDia)){
                if($mes==12){
                    $mes=1;
                    $ano++;
                }else 
                    $mes++;
    }
    return $ano;
}
function limite(){
    $activo=false;
    $fecha = getdate(time());
    $hora = $fecha['hours'];
    if($hora > 16)
        $activo=true;
            
  return $activo;
}
?>