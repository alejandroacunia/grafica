<?php 
if(!isset($_SESSION)){
    session_start();
}
include_once('DB.php');
include_once('globales.php');

$tipo  = $_POST['tipo'];
switch($tipo){
    case '4': //LOGIN
        $us = $_POST['usuario'];
        $pw = $_POST['pw'];
        $a  = login($us,$pw);
        
        if($a->code < 0){
            header('Location: logout.php?er='.$a->code);
        }else{
            $_SESSION['agencia']   = $a->agencia;
            $_SESSION['idagencia'] = $a->idagencia;
            $_SESSION['idusuario'] = $a->idusuario;
            $_SESSION['idperfil']  = $a->idperfil;
            $_SESSION['usuario']   = $a->usuario;
            $_SESSION['idc']       = $a->idcliente;
            
            header('Location: index.php');
        }
        break;
    case '5': //ACTUALIZACION DE MEDIDAS
        $ele    = $_POST['el'];
        $medida = $_POST['me'];
        
        echo actTamaño($ele,$medida);
        break;        
}

function login($us,$pw){
    $res = new stdClass();
    
    $dbh = objDB();
    
    $sql = "select u.*,a.nombre as agencia from usuarios as u left join agencias as a on a.idagencia = u.idagencia where u.nombre = '$us' limit 0,1";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
       
    foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $row){
        if($row['idestado'] != '1'){
            $res->code = -1;
            
            $dbh  = null;
            $stmt = null;            
            
            return $res;
        }
        if($row['pass'] != trim($pw)){
            $res->code = -2;
            
            $dbh  = null;
            $stmt = null;            
            
            return $res;
        }        
        if(trim($row['idagencia']) == ''){
            $res->code = -3;
            
            $dbh  = null;
            $stmt = null;
            
            return $res;
        }       
        
        $res->code = 0;
        $res->idagencia = $row['idagencia'];
        $res->agencia   = $row['agencia'];
        $res->idusuario = $row['idusuario'];
        $res->idperfil  = $row['idperfil'];
        $res->usuario   = $row['nombre'];
        $res->idcliente = $row['idc'];
        
        $dbh  = null;
        $stmt = null;
        
        return $res;
    }
    
    $res->code = -4;
    
    $dbh  = null;
    $stmt = null;
    
    return $res;
}


function actTamaño($elemento,$medida){
    
    $idagencia = $_SESSION['idagencia'];
    $idusuario = $_SESSION['idusuario'];
    
    $idcliente = $_SESSION['idc']; 
    
    $res = new stdClass();
    
    /*VALIDACIONES*/
    $elemento = trim($elemento);
    if($elemento === ''){
        $res->cod = -1;
        $res->leyenda = 'Elemento faltante';
        return json_encode($res);
    }
    if(trim($medida) === ''){
        $res->cod = -1;
        $res->leyenda = 'Medida faltante';
        return json_encode($res);
    }    
    if(trim($idagencia) === ''){
        $res->cod = -1;
        $res->leyenda = 'Agencia faltante';
        return json_encode($res);
    }  
    if(trim($idusuario) === ''){
        $res->cod = -1;
        $res->leyenda = 'Usuario faltante';
        return json_encode($res);
    }      
    if(trim($idcliente) === ''){
        $res->cod = -1;
        $res->leyenda = 'IDC faltante';
        return json_encode($res);
    }      
    /*VALIDACIONES*/
        
    $dbh = objDB();
    
    $sql = "select idtamanio from tamanios where idagencia = $idagencia and idusuario = $idusuario and elemento = '$elemento' and idcliente = $idcliente limit 0,1";
    
    $stmt = $dbh->prepare($sql);
    $stmt->execute();  
    
    $bool = false;
    
    foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $row){
        $idtamanio = $row['idtamanio'];
        if(trim($idtamanio) !== ''){ //EXISTE
            $bool = true;
            $sql = "update tamanios set width = '$medida' where idtamanio = $idtamanio and idagencia = $idagencia and idusuario = $idusuario and elemento = '$elemento' and idcliente = $idcliente";
            
            $stmt = $dbh->prepare($sql);
            $stmt->execute();  
            $stmt->closeCursor(); 
            
            $res->cod = 0;
            $res->leyenda = "MODIFICACION CORRECTA DEL TAMAÑO";
        }
    }
       
    if(!$bool){
        $sql = "insert into tamanios(elemento,width,idagencia,idusuario,idcliente) values ('$elemento','$medida',$idagencia,$idusuario,$idcliente)";
        $stmt = $dbh->prepare($sql);
        $stmt->execute();  
        $stmt->closeCursor(); 
        
        $res->cod = 0;
        $res->leyenda = "INSERCION CORRECTA DEL TAMAÑO";
                
    } 
    
    $dbh  = null;
    $stmt = null;
    
    return json_encode($res);
}

?>