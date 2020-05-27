<?php

function objDB(){
    $dbh = new PDO('mysql:host='.HOST.';dbname='.DB, USER, PD, [PDO::ATTR_PERSISTENT => true]);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   
    
    $sql="SET time_zone = '-03:00';";
    
    $stmt = $dbh->prepare($sql);
    $stmt->execute();  
    $stmt->closeCursor();
    
    return $dbh;
}
?>