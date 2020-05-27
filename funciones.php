<?php

function espacios($numero,$tipo){
    if($tipo == '1'){ //AGREGAR ESPACIOS
        if(trim($numero) === '-2'){
            $resultado = 'DEMORADO';
        }else{
            if(trim($numero) === '-1'){
                $resultado = 'S / S';
            }else{
                if(trim($numero) === '0'){
                    $resultado = 'SORTEANDO';
                }else{
                    $array = str_split(trim($numero));
                    $resultado = implode(" ",$array);
                }

            }
        }
    }else{ //QUITAR ESPACIOS
        $resultado = str_replace(" ","",$numero);
    }
    
    return trim($resultado);
}

function quitar_tildes($cadena){

    $cadBuscar = ["á", "Á", "é", "É", "í", "Í", "ó", "Ó", "ú", "Ú","Oro"];
    $cadPoner  = ["a", "A", "e", "E", "i", "I", "o", "O", "u", "U","Montevideo"];

    return str_replace ($cadBuscar, $cadPoner, utf8_encode(utf8_decode($cadena)));
}

function invertirFecha($fecha,$separador,$sepResultado = '-'){
    $x = explode($separador, $fecha);
    return $x[2].$sepResultado.$x[1].$sepResultado.$x[0];
}

function invertirFechaMDY($fecha,$separador,$sepResultado = '-'){
    $x = explode($separador, $fecha);
    return $x[1].$sepResultado.$x[2].$sepResultado.$x[0];
}

function invertirFechaHora($fecha,$separador,$sepResultado = '-'){
    $x = explode(' ', $fecha);
    $y = explode($separador, $x[0]);
    return $y[2].$sepResultado.$y[1].$sepResultado.$y[0]." ".$x[1];
}

function diaVacio(){
    $array = [];
    $idcliente = $_SESSION['idc']; if(trim($idcliente) === ''){die('IDC FALTANTE');}
    $quinielas = quinielas($idcliente,0);
    $negados   = sorteosNegados();
    $sorteos   = [1 => 'primera',2 => 'matutina',3 => 'vespertina',4 => 'nocturna'];
    foreach($quinielas as $x => $q){
        foreach($sorteos as $y => $s){
//            var_dump(isset($negados[$q->idquiniela][$y]));
//            var_dump(empty($negados[$q->idquiniela][$y]));
            if(is_null($negados[$q->idquiniela][$y])){
                //var_dump('hola');
            //$array[$q->nombre][$y] = '';
                $array[$q->orden][$y] = '';
            }
        }
        //$array[$q->nombre]['idq']   = $q->idquiniela;
        $array[$q->orden]['idq']      = $q->idquiniela;
        $array[$q->orden]['nombre']   = str_replace("_"," ",$q->nombre);
    }
    
    return $array;
}

function left($str, $length) {
     return substr($str, 0, $length);
}
 
function right($str, $length) {
    return substr($str, -$length);
     
}

function fechaFromPalabra($fecha){
    $fecha = trim(strtolower($fecha));
    $dias = ["domingo",
             "lunes",
             "martes",
             "miercoles",
             "miércoles",
             "jueves",
             "viernes",
             "sábado",
             "sabado"];
    
    $meses = ['01' => "enero",
              '02' => "febrero",
              '03' => "marzo",
              '04' => "abril",
              '05' => "mayo",
              '06' => "junio",
              '07' => "julio",
              '08' => "agosto",
              '09' => "septiembre",
              '09' => "setiembre",
              '10' => "octubre",
              '11' => "noviembre",
              '12' => "diciembre"];
        
    foreach($dias as $dia){
       $fecha = str_replace($dia,'',$fecha);
    }
    
    $fecha = trim($fecha);
    
    foreach($meses as $x => $mes){
       $fecha = str_replace($mes,$x,$fecha);
    }
    
    $fecha = str_replace(' de ','/',$fecha);
    
    $fecha = trim($fecha);
    
    return $fecha;
}
?>    
