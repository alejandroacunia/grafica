<?php 
error_reporting(E_ERROR | E_PARSE);
session_start();
 
include_once 'globales_perm.php';

define('HORA_PRIMER_SORTEO','11:40');
define('AGENCIA',$_SESSION['agencia']);

$semana = ["domingo","lunes","martes","mierco.","jueves","viernes","sabado"];

/*COSAS PARA MOSTRAR*/
define('FECHAS','0');
?>