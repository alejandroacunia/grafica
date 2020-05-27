<?php 
session_start();
session_destroy(); 
if(isset($_GET['er'])){
    $err = $_GET['er'];
}
header('Location: login.php'.((isset($err)) ? '?er='.$err : ''));
?>

