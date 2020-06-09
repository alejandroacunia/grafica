<?php
include_once('globales.php');
include_once('funciones.php');
include_once('DB.php');

$tipo = $_GET['tipo'];
$idc  = $_SESSION['idc']; if(trim($idc) === ''){die("IDC Faltante.");}

switch($tipo){
    case '1': //ALTA
        $fechaVenc = $_GET['fechaVenc'];
        $idtrabajo = $_GET['idtrabajo'];
        $cuotas    = $_GET['cuotas'];
        $precio    = $_GET['precio'];
        $interes   = $_GET['interes'];
        
        echo altaCuotas($idtrabajo,$fechaVenc,$cuotas,$precio,$interes,$idc);
        break;      
    case '2': //MODIFICACION
        $idtrabajo     = $_GET['idtrabajo'];
        $idcuota       = $_GET['idcuota'];
        $precio        = $_GET['precio'];
        
        echo modificacionCuota($idtrabajo,$idcuota,$precio,$idc);
        
        break;  
    case '3': //BAJA
        $idtrabajo = $_GET['idtrabajo'];
        $idcuota       = $_GET['idcuota'];
        
        echo eliminarCuota($idtrabajo,$idcuota,$idc);
        break;  
    
    case '4': //PAGO
        $idcuota   = $_GET['idcuota'];
        $idtrabajo = $_GET['idtrabajo'];
        
        echo pagarCuota($idtrabajo,$idcuota,$idc);
        break; 
}

function pagarCuota($idtrabajo,$idcuota,$idc){
    if(trim($idtrabajo) === ''){
        $res->cod = -1;
        $res->leyenda = "TRABAJO INEXISTENTE";
        return json_encode($res);
    }
    if(trim($idcuota) === ''){
        $res->cod = -1;
        $res->leyenda = "CUOTA INEXISTENTE";
        return json_encode($res);
    }
    if(trim($idc) === ''){
        $res->cod = -1;
        $res->leyenda = "IDC INEXISTENTE";
        return json_encode($res);
    }
    
    $dbh = objDB();
    
    try{
        $sql = "update cuotas set fechaPago = now() where idtrabajo = $idtrabajo and idcuota = $idcuota and idc = $idc";

        $stmt = $dbh->prepare($sql);
        $stmt->execute();  
        $stmt->closeCursor();    
        
        $res->cod = 0;
        $res->leyenda = "ASIENTO DE PAGO CORRECTO";

    }catch(PDOException $e){
        $res->cod = -1;
        $res->leyenda = "ERROR AL ASENTAR EL PAGO";
    }  
    
    $dbh  = null;
    $stmt = null;
    
    return json_encode($res);
}

function altaCuotas($idtrabajo,$fechaVenc,$cuotas,$precio,$interes,$idc){
    $res = new stdClass();
    
    if(trim($idtrabajo) === ''){
        $res->cod = -1;
        $res->leyenda = "TRABAJO INEXISTENTE";
        return json_encode($res);
    }
    if(trim($fechaVenc) === ''){
        $res->cod = -1;
        $res->leyenda = "PRIMERA FECHA DE VENCIMIENTO INEXISTENTE";
        return json_encode($res);
    }
    if(trim($precio) === ''){
        $res->cod = -1;
        $res->leyenda = "PRECIO TOTAL INEXISTENTE";
        return json_encode($res);
    }
    if(trim($cuotas) === ''){
        $res->cod = -1;
        $res->leyenda = "CANTIDAD DE CUOTAS INEXISTENTE";
        return json_encode($res);
    }
    if(trim($interes) === ''){
        $res->cod = -1;
        $res->leyenda = "INTERES INEXISTENTE";
        return json_encode($res);
    }
    if(trim($idc) === ''){
        $res->cod = -1;
        $res->leyenda = "IDC INEXISTENTE";
        return json_encode($res);
    }    
    
    //$precioConInteres = $precio * floatval("1.$interes");
    $precioCuota  = round($precio / $cuotas,2);
    
    $sql = "insert into cuotas(idtrabajo,idcuota,fechaPago,fechaVenc,precio,idc) VALUES";
    $sql.= "($idtrabajo,1,null,'".invertirFecha($fechaVenc,"/","-")."','$precioCuota',$idc)";
    
    for($i=2 ; $i <= $cuotas ; $i++){
        $sql.= ",($idtrabajo,$i,null,DATE_ADD('".invertirFecha($fechaVenc,"/","-")."', INTERVAL ".($i - 1)." MONTH),'$precioCuota',$idc)";
    }
//    var_dump($sql);
//    die();
    
    $dbh = objDB();
    
    try{
        
        $stmt = $dbh->prepare($sql);
        $stmt->execute();  
        $stmt->closeCursor();    
        
        $sql = "update trabajos set interes = $interes where idtrabajo = $idtrabajo and idc = $idc";
        $stmt = $dbh->prepare($sql);
        $stmt->execute();  
        $stmt->closeCursor();
        
        $res->cod = 0;
        $res->leyenda = "PLAN DE CUOTAS GENERADO CORRECTAMENTE";

    }catch(PDOException $e){
        $res->cod = -1;
        $res->leyenda = "ERROR AL GENERAR EL PLAN DE CUOTAS";
    }  
    
    $dbh  = null;
    $stmt = null;
    
    return json_encode($res);
}
function eliminarCuota($idtrabajo,$idcuota,$idc){
    $res = new stdClass();
    
    if(trim($idtrabajo) === ''){
        $res->cod = -1;
        $res->leyenda = "TRABAJO INEXISTENTE";
        return json_encode($res);
    }
    if(trim($idcuota) === ''){
        $res->cod = -1;
        $res->leyenda = "CUOTA INEXISTENTE";
        return json_encode($res);
    }
    if(trim($idc) === ''){
        $res->cod = -1;
        $res->leyenda = "IDC INEXISTENTE";
        return json_encode($res);
    }
    
    $dbh = objDB();
    
    try{
        $sql = "delete from cuotas where idtrabajo = $idtrabajo and idcuota = $idcuota and idc = $idc";

        $stmt = $dbh->prepare($sql);
        $stmt->execute();  
        $stmt->closeCursor();    
        
        $res->cod = 0;
        $res->leyenda = "CUOTA ELIMINADA CORRECTAMENTE";

    }catch(PDOException $e){
        $res->cod = -1;
        $res->leyenda = "ERROR AL ELIMINAR LA CUOTA";
    }  
    
    $dbh  = null;
    $stmt = null;
    
    return json_encode($res);
}

function modificacionCuota($idtrabajo,$idcuota,$precio,$idc){
    
    $res = new stdClass();
    if(trim($idtrabajo) === ''){
        $res->cod = -1;
        $res->leyenda = "TRABAJO INEXISTENTE";
        return json_encode($res);
    }
    if(trim($idcuota) === ''){
        $res->cod = -1;
        $res->leyenda = "CUOTA INEXISTENTE";
        return json_encode($res);
    }
    if(trim($precio) === ''){
        $res->cod = -1;
        $res->leyenda = "PRECIO INEXISTENTE";
        return json_encode($res);
    }  
    if(trim($idc) === ''){
        $res->cod = -1;
        $res->leyenda = "IDC INEXISTENTE";
        return json_encode($res);
    }    
        
    $dbh = objDB();
    try{
        $sql = "update cuotas set precio = '$precio' where idtrabajo = $idtrabajo and idcuota = $idcuota and idc = $idc";

        $stmt = $dbh->prepare($sql);
        $stmt->execute();  
        $stmt->closeCursor();    
        
        $res->cod = 0;
        $res->leyenda = "CUOTA ACTUALIZADA CORRECTAMENTE";

    }catch(PDOException $e){
        $res->cod = -1;
        $res->leyenda = "ERROR AL ACTUALIZAR LA CUOTA";
    }  
        
    $dbh  = null;
    $stmt = null;
    
    return json_encode($res);
}

?>