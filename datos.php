<?php
include_once('funciones.php');
include_once('DB.php');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

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

function trabajos(){
    $dbh = objDB();
    
    $idc = $_SESSION['idc']; if(trim($idc) === ''){die("IDC Faltante.");}
    
    $sql = "select * from trabajos where idc = $idc";

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
        $a->idtp          = $row['idtp'];
        $datos[]          = $a;
    }
    
    $stmt->closeCursor(); 
    
    $dbh  = null;
    $stmt = null;
    
    return $datos;    
}
?>