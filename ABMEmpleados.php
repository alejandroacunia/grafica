<?php
include_once('globales.php');
include_once('funciones.php');
include_once('DB.php');

$tipo  = $_GET['tipo'];

$idcliente = $_SESSION['idc']; if(trim($idcliente) === ''){die("IDC Faltante.");}

switch($tipo){
    case '1': //ALTA
        $apeynom     = $_GET['apeynom'];
        
        echo altaEmpleado($apeynom,$idcliente);
        break;      
    case '2': //MODIFICACION
        $idempleado  = $_GET['idempleado'];
        $apeynom     = $_GET['apeynom'];
        
        echo modificacionEmpleado($idempleado,$apeynom,$idcliente);
        
        break;  
    case '3': //BAJA
        $idempleado  = $_GET['idempleado'];
        
        echo eliminarEmpleado($idempleado,$idcliente);
        break;  
}
function altaEmpleado($apeynom,$idcliente){
    $res = new stdClass();
    
    if(trim($apeynom) === ''){
        $res->cod = -1;
        $res->leyenda = "APELLIDO Y NOMBRE INEXISTENTE";
        return json_encode($res);
    }    
    if(trim($idcliente) === ''){
        $res->cod = -1;
        $res->leyenda = "IDC INEXISTENTE";
        return json_encode($res);
    }    
    $dbh = objDB();
    
    try{
        $sql = "insert into empleados(apeynom,idc) values ('".strtoupper($apeynom)."',$idcliente)";

        $stmt = $dbh->prepare($sql);
        $stmt->execute();  
        $stmt->closeCursor();    
        
        $res->cod = 0;
        $res->leyenda = "EMPLEADO AGREGADO CORRECTAMENTE";

    }catch(PDOException $e){
        $res->cod = -1;
        $res->leyenda = "ERROR AL AGREGAR EL EMPLEADO";
    }  
    
    $dbh  = null;
    $stmt = null;
    
    return json_encode($res);
}
function eliminarEmpleado($idempleado,$idcliente){
    $res = new stdClass();
    
    if(trim($idempleado) === ''){
        $res->cod = -1;
        $res->leyenda = "ID INEXISTENTE";
        return json_encode($res);
    }
    if(trim($idcliente) === ''){
        $res->cod = -1;
        $res->leyenda = "IDC INEXISTENTE";
        return json_encode($res);
    }
    
    $dbh = objDB();
    
    try{
        $sql = "delete from empleados where idempleado = $idempleado and idc = $idcliente";

        $stmt = $dbh->prepare($sql);
        $stmt->execute();  
        $stmt->closeCursor();    
        
        $res->cod = 0;
        $res->leyenda = "EMPLEADO ELIMINADO CORRECTAMENTE";

    }catch(PDOException $e){
        $res->cod = -1;
        $res->leyenda = "ERROR AL ELIMINAR EL EMPLEADO";
    }  
    
    $dbh  = null;
    $stmt = null;
    
    return json_encode($res);
}

function modificacionEmpleado($idempleado,$apeynom,$idcliente){
    
    $res = new stdClass();
    if(trim($idempleado) === ''){
        $res->cod = -1;
        $res->leyenda = "ID INEXISTENTE";
        return json_encode($res);
    }
    if(trim($apeynom) === ''){
        $res->cod = -1;
        $res->leyenda = "APELLID Y NOMBRE INEXISTENTE";
        return json_encode($res);
    }    
    if(trim($idcliente) === ''){
        $res->cod = -1;
        $res->leyenda = "IDC INEXISTENTE";
        return json_encode($res);
    }    
    
    $dbh = objDB();
    
    try{
        $sql = "update empleados set apeynom = '".strtoupper($apeynom)."' where idempleado = $idempleado and idc = $idcliente";

        $stmt = $dbh->prepare($sql);
        $stmt->execute();  
        $stmt->closeCursor();    
        
        $res->cod = 0;
        $res->leyenda = "EMPLEADO ACTUALIZADO CORRECTAMENTE";

    }catch(PDOException $e){
        $res->cod = -1;
        $res->leyenda = "ERROR AL ACTUALIZAR EL EMPLEADO";
    }  
        
    $dbh  = null;
    $stmt = null;
    
    return json_encode($res);
}

?>