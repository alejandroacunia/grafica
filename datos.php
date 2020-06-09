<?php
include_once('funciones.php');
include_once('DB.php');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function planCuotas($idtrabajo){
    $dbh = objDB();
    
    $idc = $_SESSION['idc']; if(trim($idc) === ''){die("IDC Faltante.");}
    if(trim($idtrabajo) === ''){$idtrabajo = 'NULL';}
    
    $sql = "select idtrabajo,idcuota,DATE(fechaVenc) as fechaVenc,DATE(fechaPago) as fechaPago,precio,case when fechaPago is not null then 1 else case when fechaVenc > now() then 1 else case when fechaVenc = now() then 2 else 3 end end end as pago from cuotas where idtrabajo = $idtrabajo and idc = $idc order by idcuota asc";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $datos = [];
        
    foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $row){     
        $a            = new stdClass();
        $a->idtrabajo = $row['idtrabajo'];
        $a->idcuota   = $row['idcuota'];
        $a->fechaVenc = $row['fechaVenc'];
        $a->fechaPago = $row['fechaPago'];
        $a->precio    = $row['precio'];
        $a->pago      = $row['pago'];
        $datos[]      = $a;
    }
    
    $stmt->closeCursor(); 
    
    $dbh  = null;
    $stmt = null;
    
    return $datos;    
}

function empleados(){
    $dbh = objDB();
    
    $idcliente = $_SESSION['idc']; if(trim($idcliente) === ''){die("IDC Faltante.");}
    
    $sql = "select * from empleados where idc = $idcliente";

    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $datos = [];
        
    foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $row){     
        $a             = new stdClass();
        $a->idempleado = $row['idempleado'];
        $a->apeynom    = $row['apeynom'];
        $datos[]       = $a;
    }
    
    $stmt->closeCursor(); 
    
    $dbh  = null;
    $stmt = null;
    
    return $datos;    
}

function clientes(){
    $dbh = objDB();
    
    $idc = $_SESSION['idc']; if(trim($idc) === ''){die("IDC Faltante.");}
    
    $sql = "select * from clientes where idc = $idc";

    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $datos = [];
        
    foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $row){     
        $a            = new stdClass();
        $a->idcliente = $row['idcliente'];
        $a->nombre    = $row['nombre'];
        $a->correo    = $row['correo'];
        $a->tel       = $row['tel'];
        $datos[]      = $a;
    }
    
    $stmt->closeCursor(); 
    
    $dbh  = null;
    $stmt = null;
    
    return $datos;    
}

function estados(){
    $dbh = objDB();
    
    $idcliente = $_SESSION['idc']; if(trim($idcliente) === ''){die("IDC Faltante.");}
    
    $sql = "select * from estados where idc = $idcliente";

    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $datos = [];
        
    foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $row){     
        $a              = new stdClass();
        $a->idestado      = $row['idestado'];
        $a->descripcion = $row['descripcion'];
        $datos[]        = $a;
    }
    
    $stmt->closeCursor(); 
    
    $dbh  = null;
    $stmt = null;
    
    return $datos;    
}

function tiposTrabajo(){
    $dbh = objDB();
    
    $idcliente = $_SESSION['idc']; if(trim($idcliente) === ''){die("IDC Faltante.");}
    
    $sql = "select * from tiposTrabajo where idc = $idcliente";

    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $datos = [];
        
    foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $row){     
        $a              = new stdClass();
        $a->idtipo      = $row['idtipo'];
        $a->descripcion = $row['descripcion'];
        $datos[]        = $a;
    }
    
    $stmt->closeCursor(); 
    
    $dbh  = null;
    $stmt = null;
    
    return $datos;    
}

function tiposPago(){
    $dbh = objDB();
    
    $idcliente = $_SESSION['idc']; if(trim($idcliente) === ''){die("IDC Faltante.");}
    
    $sql = "select * from tiposPago where idc = $idcliente";

    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $datos = [];
        
    foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $row){     
        $a              = new stdClass();
        $a->idtp        = $row['idtp'];
        $a->descripcion = $row['descripcion'];
        $datos[]        = $a;
    }
    
    $stmt->closeCursor(); 
    
    $dbh  = null;
    $stmt = null;
    
    return $datos;    
}
/*INDEX*/
function trabajos($idtrabajo = ''){
    $dbh = objDB();
    
    $idc = $_SESSION['idc']; if(trim($idc) === ''){die("IDC Faltante.");}
    if(trim($idtrabajo) === ''){$idtrabajo = 'NULL';}
    
    $sql = "select * from trabajos where (idtrabajo = $idtrabajo or $idtrabajo is null) and idc = $idc";

    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $datos = [];
        
    foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $row){     
        $a                = new stdClass();
        $a->idtrabajo     = $row['idtrabajo'];
        $a->fechaCreacion = $row['fechaCreacion'];
        $a->fechaEntrega  = $row['fechaEntrega'];
        $a->idempleado    = $row['idempleado'];
        $a->idcliente     = $row['idcliente'];
        $a->idestado      = $row['idestado'];
        $a->precio        = $row['precio'];
        $a->seña          = $row['seña'];
        $a->tipo          = $row['tipo'];
        $a->observaciones = $row['observaciones'];
        $a->interes       = $row['interes'];
        $a->idtp          = $row['idtp'];
        $datos[]          = $a;
    }
    
    $stmt->closeCursor(); 
    
    $dbh  = null;
    $stmt = null;
    
    return $datos;    
}

function proximosEventos(){
    $dbh = objDB();
    
    $idc = $_SESSION['idc']; if(trim($idc) === ''){die("IDC Faltante.");}
    
    $sql = "select t.*,c.nombre as cliente,e.apeynom as empleado from trabajos t inner join clientes c on c.idcliente = t.idcliente inner join empleados e on e.idempleado = t.idempleado where t.tipo = 2 and t.idc = $idc order by t.fechaEntrega asc";

    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $datos = [];
        
    foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $row){     
        $a                = new stdClass();
        $a->idtrabajo     = $row['idtrabajo'];
        $a->fechaCreacion = $row['fechaCreacion'];
        $a->fechaEntrega  = $row['fechaEntrega'];
        $a->cliente       = $row['cliente'];
        $a->empleado      = $row['empleado'];
        $a->precio        = $row['precio'];
        $a->seña          = $row['seña'];
        $datos[]          = $a;
    }
    
    $stmt->closeCursor(); 
    
    $dbh  = null;
    $stmt = null;
    
    return $datos;    
}

function planesSinCuotas($idc){
    $dbh = objDB();
        
    $sql = "select t.*,c.nombre as cliente, e.apeynom as empleado from trabajos t inner join clientes c on c.idcliente = t.idcliente inner join empleados e on e.idempleado = t.idempleado where t.idestado = 1 and t.idtp = 2 and not exists (select 1 from cuotas as c where c.idtrabajo = t.idtrabajo) and t.idc = $idc order by fechaEntrega asc";

    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $datos = [];
        
    foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $row){     
        $a                = new stdClass();
        $a->idtrabajo     = $row['idtrabajo'];
        $a->fechaCreacion = $row['fechaCreacion'];
        $a->fechaEntrega  = $row['fechaEntrega'];
        $a->cliente       = $row['cliente'];
        $a->empleado      = $row['empleado'];
        $a->precio        = $row['precio'];
        $a->seña          = $row['seña'];
        $datos[]          = $a;
    }
    
    $stmt->closeCursor(); 
    
    $dbh  = null;
    $stmt = null;
    
    return $datos;    
}

function cuotasPorVencer($idc){
    $dbh = objDB();
        
    $sql = "select 
                t.idtrabajo,
                o.fechaVenc,
                c.nombre as cliente,
                c.correo,
                o.idcuota,
                o.precio,
                case when o.fechaVenc > now() then 1 else case when o.fechaVenc = now() then 2 else 3 end end as pago
            from trabajos t 
            inner join clientes c
            on c.idcliente = t.idcliente 
            inner join cuotas o
            on o.idtrabajo = t.idtrabajo 
            where o.fechaPago is null and t.idestado = 1 and t.idc = $idc order by o.fechaVenc asc";

    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $datos = [];
        
    foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $row){     
        $a                = new stdClass();
        $a->idtrabajo     = $row['idtrabajo'];
        $a->fechaVenc     = $row['fechaVenc'];
        $a->cliente       = $row['cliente'];
        $a->correo        = $row['correo'];
        $a->idcuota       = $row['idcuota'];
        $a->precio        = $row['precio'];
        $a->pago          = $row['pago'];
        $datos[]          = $a;
    }
    
    $stmt->closeCursor(); 
    
    $dbh  = null;
    $stmt = null;
    
    return $datos;    
}

function trabajosPendientes($idc){
    $dbh = objDB();
        
    $sql = "select t.*,c.nombre as cliente,e.apeynom as empleado from trabajos t inner join clientes c on c.idcliente = t.idcliente inner join empleados e on e.idempleado = t.idempleado where t.idestado = 1 and t.idc = $idc order by fechaEntrega asc";
 
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $datos = [];
        
    foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $row){     
        $a                = new stdClass();
        $a->idtrabajo     = $row['idtrabajo'];
        $a->fechaCreacion = $row['fechaCreacion'];
        $a->fechaEntrega  = $row['fechaEntrega'];
        $a->cliente       = $row['cliente'];
        $a->empleado      = $row['empleado'];
        $a->precio        = $row['precio'];
        $a->seña          = $row['seña'];
        $datos[]          = $a;
    }
    
    $stmt->closeCursor(); 
    
    $dbh  = null;
    $stmt = null;
    
    return $datos;    
}
/*INDEX*/
?>