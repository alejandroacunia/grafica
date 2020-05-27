<?php
include_once('globales.php');
include_once('funciones.php');
include_once('DB.php');

$tipo = $_GET['tipo'];

$idc = $_SESSION['idc']; if(trim($idc) === ''){die("IDC Faltante.");}

switch($tipo){
    case '1': //ALTA
        $fechaEntrega  = $_GET['fechaEntrega'];
        $idempleado    = $_GET['idempleado'];
        $idcliente     = $_GET['idcliente'];
        $precio        = $_GET['precio'];
        $idtp          = $_GET['idtp'];
        $idtipo        = $_GET['idtipo'];
        $observaciones = $_GET['observaciones'];
        
        echo altaTrabajo($fechaEntrega,1,$idtipo,$idempleado,$idcliente,$precio,$idtp,$observaciones,$idc);
        break;      
    case '2': //MODIFICACION
        $idtrabajo     = $_GET['idtrabajo'];
        $fechaEntrega  = $_GET['fechaEntrega'];
        $idempleado    = $_GET['idempleado'];
        $idcliente     = $_GET['idcliente'];
        $precio        = $_GET['precio'];
        $idtp          = $_GET['idtp'];
        $idtipo        = $_GET['idtipo'];
        $idestado      = $_GET['idestado'];
        $observaciones = $_GET['observaciones'];
        
        echo modificacionTrabajo($idtrabajo,$fechaEntrega,$idestado,$idtipo,$idempleado,$idcliente,$precio,$idtp,$observaciones,$idc);
        
        break;  
    case '3': //BAJA
        $idtrabajo = $_GET['idtrabajo'];
        
        echo eliminarTrabajo($idtrabajo,$idc);
        break;  
}
function altaTrabajo($fechaEntrega,$idestado,$idtipo,$idempleado,$idcliente,$precio,$idtp,$observaciones,$idc){
    $res = new stdClass();
    
    if(trim($idempleado) === ''){
        $res->cod = -1;
        $res->leyenda = "EMPLEADO INEXISTENTE";
        return json_encode($res);
    }
    if(trim($idestado) === ''){
        $res->cod = -1;
        $res->leyenda = "ESTADO INEXISTENTE";
        return json_encode($res);
    }
    if(trim($idcliente) === ''){
        $res->cod = -1;
        $res->leyenda = "CLIENTE INEXISTENTE";
        return json_encode($res);
    }
    if(trim($precio) === ''){
        $res->cod = -1;
        $res->leyenda = "PRECIO INEXISTENTE";
        return json_encode($res);
    } 
    if(trim($idtipo) === ''){
        $res->cod = -1;
        $res->leyenda = "TIPO DE TRABAJO INEXISTENTE";
        return json_encode($res);
    }
    if(trim($idtp) === ''){
        $res->cod = -1;
        $res->leyenda = "TIPO DE PAGO INEXISTENTE";
        return json_encode($res);
    }
    if(trim($idc) === ''){
        $res->cod = -1;
        $res->leyenda = "IDC INEXISTENTE";
        return json_encode($res);
    }    
    
    if(trim($fechaEntrega) === ''){
        $fechaEntrega = 'NULL';
    }else{$fechaEntrega = "'".invertirFechaHora($fechaEntrega,"/","-").":00'";}
    
    if(trim($observaciones) === ''){
        $observaciones = 'NULL';
    }else{$observaciones = "'".$observaciones."'";}
    
      
    $dbh = objDB();
    
    try{
        $sql = "insert into trabajos(fechaCreacion,fechaEntrega,idestado,tipo,idempleado,idcliente,precio,idtp,observaciones,idc) values (now(),$fechaEntrega,$idestado,$idtipo,$idempleado,$idcliente,'$precio',$idtp,$observaciones,$idc)";

        $stmt = $dbh->prepare($sql);
        $stmt->execute();  
        $stmt->closeCursor();    
        
        $res->cod = 0;
        $res->leyenda = "TRABAJO AGREGADO CORRECTAMENTE";

    }catch(PDOException $e){
        $res->cod = -1;
        $res->leyenda = "ERROR AL AGREGAR EL TRABAJO.$sql";
    }  
    
    $dbh  = null;
    $stmt = null;
    
    return json_encode($res);
}
function eliminarTrabajo($idtrabajo,$idc){
    $res = new stdClass();
    
    if(trim($idtrabajo) === ''){
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
        $sql = "delete from trabajos where idtrabajo = $idtrabajo and idc = $idc";

        $stmt = $dbh->prepare($sql);
        $stmt->execute();  
        $stmt->closeCursor();    
        
        $res->cod = 0;
        $res->leyenda = "TRABAJO ELIMINADO CORRECTAMENTE";

    }catch(PDOException $e){
        $res->cod = -1;
        $res->leyenda = "ERROR AL ELIMINAR EL CLIENTE";
    }  
    
    $dbh  = null;
    $stmt = null;
    
    return json_encode($res);
}

function modificacionTrabajo($idtrabajo,$fechaEntrega,$idestado,$idtipo,$idempleado,$idcliente,$precio,$idtp,$observaciones,$idc){
    
    $res = new stdClass();
    if(trim($idtrabajo) === ''){
        $res->cod = -1;
        $res->leyenda = "ID INEXISTENTE";
        return json_encode($res);
    }
    if(trim($idestado) === ''){
        $res->cod = -1;
        $res->leyenda = "ESTADO INEXISTENTE";
        return json_encode($res);
    }
    if(trim($idempleado) === ''){
        $res->cod = -1;
        $res->leyenda = "EMPLEADO INEXISTENTE";
        return json_encode($res);
    }
    if(trim($idcliente) === ''){
        $res->cod = -1;
        $res->leyenda = "CLIENTE INEXISTENTE";
        return json_encode($res);
    }
    if(trim($precio) === ''){
        $res->cod = -1;
        $res->leyenda = "PRECIO INEXISTENTE";
        return json_encode($res);
    }  
    if(trim($idtipo) === ''){
        $res->cod = -1;
        $res->leyenda = "TIPO DE TRABAJO INEXISTENTE";
        return json_encode($res);
    }
    if(trim($idtp) === ''){
        $res->cod = -1;
        $res->leyenda = "TIPO DE PAGO INEXISTENTE";
        return json_encode($res);
    }
    if(trim($idc) === ''){
        $res->cod = -1;
        $res->leyenda = "IDC INEXISTENTE";
        return json_encode($res);
    }    
    
    if(trim($fechaEntrega) === ''){
        $fechaEntrega = 'NULL';
    }else{$fechaEntrega = "'".invertirFechaHora($fechaEntrega,"/","-").":00'";}
    
    if(trim($observaciones) === ''){
        $observaciones = 'NULL';
    }else{$observaciones = "'".$observaciones."'";}
    
    $dbh = objDB();
    try{
        $sql = "update trabajos set tipo = $idtipo, idestado = $idestado, fechaEntrega = $fechaEntrega, idempleado = $idempleado, idcliente = $idcliente, observaciones = $observaciones, precio = '$precio', idtp = $idtp where idtrabajo = $idtrabajo and idc = $idc";
    //die(trim($sql));

        $stmt = $dbh->prepare($sql);
        $stmt->execute();  
        $stmt->closeCursor();    
        
        $res->cod = 0;
        $res->leyenda = "TRABAJO ACTUALIZADO CORRECTAMENTE";

    }catch(PDOException $e){
        $res->cod = -1;
        $res->leyenda = "ERROR AL ACTUALIZAR EL TRABAJO";
    }  
        
    $dbh  = null;
    $stmt = null;
    
    return json_encode($res);
}

?>