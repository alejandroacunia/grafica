<?php 
error_reporting(E_ERROR | E_PARSE);
session_start();
 
include_once 'globales_perm.php';

define('AGENCIA',$_SESSION['agencia']);
define('DIRECCION',$_SESSION['agencia']);
define('TELEFONO','5437 - 1498');
define('WAP','01168149199');
define('FACEBOOK','https://www.facebook.com/ariel.estudio.52');

$semana = ["domingo","lunes","martes","mierco.","jueves","viernes","sabado"];

define('MAIL_FROM',"Ariel.Estudio.Correo@gmail.com");
define('MAIL_PASS',"opticariel");
define('MAIL_PORT',587);
define('MAIL_HOST',"smtp.gmail.com");
define('MAIL_SMTPSEG',"tls");
define('MAIL_FROMNAME',"Ariel Estudio");

define('MAX_CUOTAS',18);
define('INTERESES',[0,5,10,15,20,25,30,35,40,45,50,55,60,65,70]);

?>