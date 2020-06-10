<?php
include_once('globales.php');
include_once('funciones.php');
include_once('DB.php');

$tipo = $_GET['tipo'];
$idc  = $_SESSION['idc']; if(trim($idc) === ''){die("IDC Faltante.");}

switch($tipo){
    case '1': //ALTA
        $idtrabajo = $_GET['idtrabajo'];
        $idcuota   = $_GET['idcuota'];
        $idtr      = $_GET['idtr'];
        
        echo altaRecordatorio($idtrabajo,$idcuota,$idtr,$idc);
        break;      
    case '2': //MODIFICACION
        $idrecordatorio = $_GET['idrecordatorio'];
        $idtrabajo = $_GET['idtrabajo'];
        $idcuota   = $_GET['idcuota'];
        $idtr      = $_GET['idtr'];
        
        echo modificacionRecordatorio($idrecordatorio,$idtrabajo,$idcuota,$idtr,$idc);
        
        break;  
    case '3': //BAJA
        $idrecordatorio = $_GET['idrecordatorio'];
        
        echo eliminarCuota($idrecordatorio,$idc);
        break;
}

function altaRecordatorio($idtrabajo,$idcuota,$idtr,$idc){
    $res = new stdClass();
    
    if(trim($idtrabajo) === ''){
        $res->cod = -1;
        $res->leyenda = "TRABAJO INEXISTENTE";
        return json_encode($res);
    }
   
    if(trim($precio) === ''){
        $res->cod = -1;
        $res->leyenda = "PRECIO TOTAL INEXISTENTE";
        return json_encode($res);
    }
    if(trim($idcuota) === ''){
        $res->cod = -1;
        $res->leyenda = "ID DE CUOTA INEXISTENTE";
        return json_encode($res);
    }
    if(trim($idtr) === ''){
        $res->cod = -1;
        $res->leyenda = "TIPO DE RECORDATORIO INEXISTENTE";
        return json_encode($res);
    }
    if(trim($idc) === ''){
        $res->cod = -1;
        $res->leyenda = "IDC INEXISTENTE";
        return json_encode($res);
    }    
    
    $precioCuota  = round($precio / $cuotas,2);
    
    $sql = "insert into recordatorios(idtrabajo,idcuota,fechahora,idtr,idc) select $idtrabajo,$idcuota,now(),$idtr,$idc";
    
   $dbh = objDB();
    
    try{
        
        $stmt = $dbh->prepare($sql);
        $stmt->execute();  
        $stmt->closeCursor();    
        
        $res->cod = 0;
        $res->leyenda = "RECORDATORIO GENERADO CORRECTAMENTE";

    }catch(PDOException $e){
        $res->cod = -1;
        $res->leyenda = "ERROR AL GRABAR EL RECORDATORIO";
    }  
    
    $dbh  = null;
    $stmt = null;
    
    return json_encode($res);
}
function eliminarCuota($idrecordatorio,$idc){
    $res = new stdClass();
    
    if(trim($idrecordatorio) === ''){
        $res->cod = -1;
        $res->leyenda = "TRABAJO INEXISTENTE";
        return json_encode($res);
    }
    if(trim($idc) === ''){
        $res->cod = -1;
        $res->leyenda = "IDC INEXISTENTE";
        return json_encode($res);
    }
    
    $dbh = objDB();
    
    try{
        $sql = "delete from recordatorios where idrecordatorio = $idrecordatorio and idc = $idc";

        $stmt = $dbh->prepare($sql);
        $stmt->execute();  
        $stmt->closeCursor();    
        
        $res->cod = 0;
        $res->leyenda = "RECORDATORIO ELIMINADO CORRECTAMENTE";

    }catch(PDOException $e){
        $res->cod = -1;
        $res->leyenda = "ERROR AL ELIMINAR EL RECORDATORIO";
    }  
    
    $dbh  = null;
    $stmt = null;
    
    return json_encode($res);
}

function modificacionRecordatorio($idrecordatorio,$idtrabajo,$idcuota,$idtr,$idc){
    
    $res = new stdClass();
    if(trim($idrecordatorio) === ''){
        $res->cod = -1;
        $res->leyenda = "RECORDATORIO INEXISTENTE";
        return json_encode($res);
    }
    if(trim($idcuota) === ''){
        $res->cod = -1;
        $res->leyenda = "CUOTA INEXISTENTE";
        return json_encode($res);
    }
    if(trim($idtrabajo) === ''){
        $res->cod = -1;
        $res->leyenda = "TRABAJO INEXISTENTE";
        return json_encode($res);
    }  
    if(trim($idtr) === ''){
        $res->cod = -1;
        $res->leyenda = "TIPO DE RECORDATORIO INEXISTENTE";
        return json_encode($res);
    }  
    if(trim($idc) === ''){
        $res->cod = -1;
        $res->leyenda = "IDC INEXISTENTE";
        return json_encode($res);
    }    
        
    $dbh = objDB();
    try{
        $sql = "update recordatorios set idtrabajo = $idtrabajo, idcuota = $idcuota, idtr = $idtr where idrecordatorio = $idrecordatorio and idc = $idc";

        $stmt = $dbh->prepare($sql);
        $stmt->execute();  
        $stmt->closeCursor();    
        
        $res->cod = 0;
        $res->leyenda = "RECORDATORIO ACTUALIZADO CORRECTAMENTE";

    }catch(PDOException $e){
        $res->cod = -1;
        $res->leyenda = "ERROR AL ACTUALIZAR EL RECORDATORIO";
    }  
        
    $dbh  = null;
    $stmt = null;
    
    return json_encode($res);
}

?>