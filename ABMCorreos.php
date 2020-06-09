<?php
include_once('globales.php');
include_once('funciones.php');
include_once('DB.php');

$tipo = $_GET['tipo'];
$idc  = $_SESSION['idc']; if(trim($idc) === ''){die("IDC Faltante.");}

switch($tipo){
    case '1': //RCORDATORIO DE PAGO
        $mail      = $_GET['mail'];
        $idcuota   = $_GET['id'];
        $idtrabajo = $_GET['idt'];
        $fecha     = $_GET['fecha'];
        $precio    = explode(".",$_GET['precio']);;
        
        $cuerpo = "Este es un recordatorio del pago de la cuota N&deg$idcuota que vence ";
        $cuerpo.= "el $fecha por un valor de $$precio[0]<sup>$precio[1]</sup>.-<br><br> Muchas Gracias<br>Ariel Estudio<br>Tel: ".TELEFONO." - WP: ".WAP."<br>Facebook: ".FACEBOOK;
        $c = correo($mail,"RECORDATORIO DE PAGO",$cuerpo);
        $res->cod     = $c;
        if($c == 0){
            $res->leyenda = "RECORDATORIO ENVIADO a $mail";
        }else{
            $res->leyenda = "OCURRIO UN ERROR AL ENVIAR EL RECORDATORIO a $mail";
        }
        echo json_encode($res);;
        break;
}

?>