<?php

abstract class fecha {

    function fecha() {
        $dia = new DateTime;
        if (date('H') >= 16 || $dia->format('w') == 0 || $dia->format('w') == 6) {
            $dia->add(new DateInterval('P1D'));
            while ($dia->format('w') == 0 || $dia->format('w') == 6 || festivo($dia->format('j'), $dia->format('m'))) {
                $dia->add(new DateInterval('P1D'));
            }
        }
        return $dia;
    }

    function fechav() {
        $dia = new DateTime;
        if (date('H') > 17 or ( date('H') == 17 and date('i') >= 30) || $dia->format('w') == 0 || $dia->format('w') == 6) {
            $dia->add(new DateInterval('P1D'));
            while ($dia->format('w') == 0 || $dia->format('w') == 6 || festivo($dia->format('j'), $dia->format('m'))) {
                $dia->add(new DateInterval('P1D'));
            }
        }
        return $dia;
    }

    function calcular_dia() {
        return fecha()->format('j');
    }

    function calcular_diav() {
        return fechav()->format('j');
    }

    function calcular_mes() {
        $meses = Array('enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre');
        $int = calcular_numes();
        return $meses[$int - 1];
    }

    function calcular_mesv() {
        $meses = Array('enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre');
        $int = calcular_numesv();
        return $meses[$int - 1];
    }

    function calcular_numesv() {
        return fechav()->format('m');
    }

    function calcular_numes() {
        return fecha()->format('m');
    }

    function dia_semana() {
        $fecha = date('N');
        return $fecha;
    }

    function calcular_ano() {
        return fecha()->format('Y');
    }

    function calcular_anov() {
        return fechav()->format('Y');
    }

//    __...***  FIESTAS  ***...__

    function festivo($d, $m) {
        $fiesta = false;

        mysql_connect("localhost", "chechu");
        mysql_select_db("carrion");
        $sen = mysql_query("SELECT * FROM fiestas;");
        while ($festivo = mysql_fetch_row($sen)) {
            if ($d == $festivo[1] and $m == $festivo[2]) {
                $fiesta = true;
            }
        }

        return $fiesta;
    }

}
