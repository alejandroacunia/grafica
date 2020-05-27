<?php
include_once('globales.php');
include_once('funciones.php');
include_once('DB.php');

$tipo = $_GET['tipo'];

$idc = $_SESSION['idc']; if(trim($idc) === ''){die("IDC Faltante.");}

switch($tipo){
    case '1': //ALTA
        $nombre = $_GET['nombre'];
        $correo = $_GET['correo'];
        $tel    = $_GET['tel'];
        
        echo altaCliente($nombre,$correo,$tel,$idc);
        break;      
    case '2': //MODIFICACION
        $idcliente  = $_GET['idcliente'];
        $nombre     = $_GET['nombre'];
        $correo     = $_GET['correo'];
        $tel        = $_GET['tel'];
        
        echo modificacionCliente($idcliente,$nombre,$correo,$tel,$idc);
        
        break;  
    case '3': //BAJA
        $idcliente  = $_GET['idcliente'];
        
        echo eliminarCliente($idcliente,$idc);
        break;  
}
function altaCliente($nombre,$correo,$tel,$idc){
    $res = new stdClass();
    
    if(trim($nombre) === ''){
        $res->cod = -1;
        $res->leyenda = "NOMBRE INEXISTENTE";
        return json_encode($res);
    }
    
    if(trim($idc) === ''){
        $res->cod = -1;
        $res->leyenda = "IDC INEXISTENTE";
        return json_encode($res);
    }  
    
    if(trim($correo) === ''){
        $correo = 'NULL';
    }else{$correo = "'".$correo."'";}
    
    if(trim($tel) === ''){
        $tel = 'NULL';
    }else{$tel = "'".$tel."'";}
    
      
    $dbh = objDB();
    
    try{
        $sql = "insert into clientes(nombre,correo,tel,idc) values ('".strtoupper($nombre)."',$correo,$tel,$idc)";

        $stmt = $dbh->prepare($sql);
        $stmt->execute();  
        $stmt->closeCursor();    
        
        $res->cod = 0;
        $res->leyenda = "CLIENTE AGREGADO CORRECTAMENTE";

    }catch(PDOException $e){
        $res->cod = -1;
        $res->leyenda = "ERROR AL AGREGAR EL CLIENTE";
    }  
    
    $dbh  = null;
    $stmt = null;
    
    return json_encode($res);
}
function eliminarCliente($idcliente,$idc){
    $res = new stdClass();
    
    if(trim($idcliente) === ''){
        $res->cod = -1;
        $res->leyenda = "ID INEXISTENTE";
        return json_encode($res);
    }
    if(trim($idc) === ''){
        $res->cod = -1;
        $res->leyenda = "IDC INEXISTENTE";
        return json_encode($res);
    }
    
    $dbh = objDB();
    
    try{
        $sql = "delete from clientes where idcliente = $idcliente and idc = $idc";

        $stmt = $dbh->prepare($sql);
        $stmt->execute();  
        $stmt->closeCursor();    
        
        $res->cod = 0;
        $res->leyenda = "CLIENTE ELIMINADO CORRECTAMENTE";

    }catch(PDOException $e){
        $res->cod = -1;
        $res->leyenda = "ERROR AL ELIMINAR EL CLIENTE";
    }  
    
    $dbh  = null;
    $stmt = null;
    
    return json_encode($res);
}

function modificacionCliente($idcliente,$nombre,$correo,$tel,$idc){
    
    $res = new stdClass();
    if(trim($idcliente) === ''){
        $res->cod = -1;
        $res->leyenda = "ID INEXISTENTE";
        return json_encode($res);
    }
    if(trim($nombre) === ''){
        $res->cod = -1;
        $res->leyenda = "NOMBRE INEXISTENTE";
        return json_encode($res);
    }    
    if(trim($idc) === ''){
        $res->cod = -1;
        $res->leyenda = "IDC INEXISTENTE";
        return json_encode($res);
    }    
    
    if(trim($correo) === ''){
        $correo = 'NULL';
    }else{$correo = "'".$correo."'";}
    
    if(trim($tel) === ''){
        $tel = 'NULL';
    }else{$tel = "'".$tel."'";}
    
    $dbh = objDB();
    
    try{
        $sql = "update clientes set nombre = '".strtoupper($nombre)."', correo = $correo, tel = $tel where idcliente = $idcliente and idc = $idc";

        $stmt = $dbh->prepare($sql);
        $stmt->execute();  
        $stmt->closeCursor();    
        
        $res->cod = 0;
        $res->leyenda = "CLIENTE ACTUALIZADO CORRECTAMENTE";

    }catch(PDOException $e){
        $res->cod = -1;
        $res->leyenda = "ERROR AL ACTUALIZAR EL CLIENTE";
    }  
        
    $dbh  = null;
    $stmt = null;
    
    return json_encode($res);
}

?>