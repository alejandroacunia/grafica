<?php

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
    if(trim($fecha) === ''){return '';}
    $x = explode(' ', $fecha);
    $y = explode($separador, $x[0]);
    return $y[2].$sepResultado.$y[1].$sepResultado.$y[0]." ".$x[1];
}

function left($str, $length) {
     return substr($str, 0, $length);
}
 
function right($str, $length) {
    return substr($str, -$length);
     
}

function correo($destinatario,$asunto,$cuerpo){
    //TUTO: http://programacionconphp.com/enviar-email-php/
    //1.librerias
    //2.permitir aplicaciones no seguras (https://myaccount.google.com/u/0/lesssecureapps?pli=1)
    //3.https://accounts.google.com/DisplayUnlockCaptcha
    
    require 'clases/PHPMailerAutoload.php';
    $mail = new PHPMailer();

    //Luego tenemos que iniciar la validación por SMTP:
    $mail->IsSMTP();
    //$mail->SMTPDebug = 2;
    $mail->SMTPAuth   = true;
    $mail->SMTPSecure = MAIL_SMTPSEG;
    $mail->Host       = MAIL_HOST; // SMTP a utilizar. Por ej. smtp.elserver.com
    $mail->Username   = MAIL_FROM; // Correo completo a utilizar
    $mail->Password   = MAIL_PASS; // Contraseña
    $mail->Port       = MAIL_PORT; // Puerto a utilizar 
    //Con estas pocas líneas iniciamos una conexión con el SMTP. Lo que ahora deberíamos hacer, es configurar el mensaje a enviar, el //From, etc.
    $mail->From       = MAIL_FROM; // Desde donde enviamos (Para mostrar)
    $mail->FromName   = MAIL_FROMNAME;


    //Estas dos líneas, cumplirían la función de encabezado (En mail() usado de esta forma: “From: Nombre <correo@dominio.com>”) de //correo.
    $mail->AddAddress($destinatario); // Esta es la dirección a donde enviamos
    $mail->IsHTML(true); // El correo se envía como HTML
    $mail->Subject = $asunto; // Este es el titulo del email.
    //$body = "Hola mundo. Esta es la primer línea<br />";
    $mail->Body = $cuerpo; // Mensaje a enviar
    $exito = $mail->Send(); // Envía el correo.

    //También podríamos agregar simples verificaciones para saber si se envió:
    if($exito){
        return 0; 
    }else{
        return -1;
    }
}
?>    
