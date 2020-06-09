<?php session_start(); 
if(!isset($_SESSION['agencia'])){
    header("Location: logout.php");
}

include_once('globales.php');
include_once('datos.php');
include_once('DB.php');

$idcliente  = $_SESSION['idc']; if(trim($idcliente) === ''){die('IDC FALTANTE');}
$tp  = trabajosPendientes($idcliente);
$psc = planesSinCuotas($idcliente);
$pe  = proximosEventos($idcliente);
$cuo = cuotasPorVencer($idcliente);

//$tira    = obtTira();
//$mensaje = $tira->mensaje;

?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
        <link rel="stylesheet" type="text/css" href="css/bootstrap-3.4.1.css">
        <link rel="stylesheet" type="text/css" href="css/sitio.css">
        <link rel="stylesheet" type="text/css" href="css/themes/base/jquery-ui.min.css">
        <link rel="stylesheet" type="text/css" href="css/principal.css">
        
        <script type="text/javascript" src="js/bootstrap-3.4.1.min.js"></script>
        <script type="text/javascript" src="js/principal.js"></script>
        <?php if(in_array('2',$modulos) && trim($mensaje) !== ''){ ?>
            <script type="text/javascript" src="js/jquery-ui-1.11.4.js"></script>
            <link rel="stylesheet" type="text/css" href="css/jquery-ui-1.10.3.css">
            <script type="text/javascript" src="js/telex.js"></script>
        <?php } else {?>
            <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
        <?php } ?>
        <?php if(in_array('2',$modulos) && trim($mensaje) !== ''){ ?>
            <script type="text/javascript">
                function tira(){
                    $('#news-ticker').telex({
                        duration: 20000,
                        timing:'linear',
                        direction:'normal',
                        delay: 1000,
                        pauseOnHover:true,
                        messages: [{
                            id: 'msg1', // message ID
                            content: "<?= $mensaje ?>",
                            class: 'tira-index' // css class
                          }]
                    });
                }
            </script>
        <?php } ?>
        <title>GRAFICA ONLINE</title>
    </head>
    <?php if(in_array('2',$modulos) && trim($mensaje) !== ''){ ?>
        <body onload="tira();"><div id="news-ticker" style="background-color: <?= $tira->CFTN ?>;color: <?= $tira->CTTN ?>;margin: 0px; padding-bottom: 5px; height: 50px;"></div>
    <?php } else { ?>
        <body>
    <?php } ?>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
              <div class="navbar-header">
                <a class="navbar-brand" href="#">GRAFICA ONLINE</a>
              </div>
              <ul class="nav navbar-nav">
                <!--<li class="dropdown">
                  <a class="dropdown-toggle" data-toggle="dropdown" href="#">Panel de Control<span class="caret"></span></a>
                  <ul class="dropdown-menu">-->
                    <!--<?php if ($_SESSION['idperfil'] == '1'){ ?> -->
                    <li><a href="cuotas.php">Cuotas</a></li>
                    <li><a href="clientes.php">Clientes</a></li>
                    <li><a href="empleados.php">Empleados</a></li>
                    <!--<?php } ?>-->
                    <li><a href="trabajos.php">Trabajos</a></li>
                    <li><a href="recordatorios.php">Recordatorios</a></li>
                  <!--</ul>-->
                <!--</li>-->
                <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
                <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
                <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
                <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
                <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
                <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
                <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>Cerrar Sesión</a></li>
              </ul>
            </div>
          </nav>
            <div class="col-xs-12" style="text-align: -webkit-center;">
                <?php if(count($tp) > 0){ ?>
                <h2><u>Trabajos Pendientes</u></h2>
                <div class="row" style="">
                <table class="table table-striped table-bordered" style="font-size: 1.7em;width:65%;">
                    <thead>
                        <tr>
                            <th style="width:15%;text-align: center;"><i>#</i></th>
                            <th style="width:25%;text-align: center;">Fecha Entrega</th>
                            <th style="width:30%;text-align: center;">Cliente</th>
                            <th style="width:15%;text-align: center;">Importe</th>
                            <th style="width:15%;text-align: center;">Asignado a...</th>
                        </tr>                        
                    </thead>
                    <tbody>
                        <?php foreach($tp as $c){ $imp = explode(".",$c->precio);?>
                            <tr> 
                                <td style="text-align: center;"><i><font color=red><b><?= $c->idtrabajo ?></b></font></i></td>
                                <td style="text-align: center;"><?= invertirFecha(left($c->fechaEntrega,10),"-","/") ?></td>
                                <td style="text-align: center;"><?= $c->cliente ?></td>
                                <td style="text-align: right;"><b><sub>$</sub></b><?= $imp[0] ?><sup><?= $imp[1] ?></sup></td>
                                <td style="text-align: center;"><?= $c->empleado ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>     
                </div>
                <?php } ?>
                <?php if(count($psc) > 0){ ?>
                <h2><u>Trabajos sin planes de cuotas definidos</u></h2>
                <div class="row" style="">
                <table class="table table-striped table-bordered" style="font-size: 1.7em;width:50%;">
                    <thead>
                        <tr>
                            <th style="width:15%;text-align: center;"><i>#</i></th>
                            <th style="width:25%;text-align: center;">Fecha Entrega</th>
                            <th style="width:40%;text-align: center;">Cliente</th>
                            <th style="width:20%;text-align: center;">Asignado a...</th>
                        </tr>                        
                    </thead>
                    <tbody>
                        <?php foreach($psc as $c){ ?>
                            <tr> 
                                <td style="text-align: center;"><i><font color=red><b><?= $c->idtrabajo ?></b></font></i></td>
                                <td style="text-align: center;"><?= invertirFecha(left($c->fechaEntrega,10),"-","/") ?></td>
                                <td style="text-align: center;"><?= $c->cliente ?></td>
                                <td style="text-align: center;"><?= $c->empleado ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>     
                </div>
                <?php } ?>
                <?php if(count($pe) > 0){ ?>
                <h2><u>Próximos Eventos</u></h2>
                <div class="row" style="">
                <table class="table table-striped table-bordered" style="font-size: 1.7em;width:50%;">
                    <thead>
                        <tr>
                            <th style="width:15%;text-align: center;"><i>#</i></th>
                            <th style="width:25%;text-align: center;">Fecha Evento</th>
                            <th style="width:40%;text-align: center;">Cliente</th>
                            <th style="width:20%;text-align: center;">Asignado a...</th>
                        </tr>                        
                    </thead>
                    <tbody>
                        <?php foreach($pe as $c){ ?>
                            <tr> 
                                <td style="text-align: center;"><i><font color=red><b><?= $c->idtrabajo ?></b></font></i></td>
                                <td style="text-align: center;"><?= invertirFechaHora(left($c->fechaEntrega,16),"-","/") ?></td>
                                <td style="text-align: center;"><?= $c->cliente ?></td>
                                <td style="text-align: center;"><?= $c->empleado ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>     
                </div>
                <?php } ?>
                <?php if(count($cuo) > 0){ ?>
                <h2><u>Próximos Cuotas por Vencer</u></h2>
                <div class="row" style="">
                <table class="table table-striped table-bordered" style="font-size: 1.7em;width:65%;">
                    <thead>
                        <tr>
                            <th style="width:15%;text-align: center;"><i>#</i></th>
                            <th style="width:15%;text-align: center;">Cuota</th>
                            <th style="width:25%;text-align: center;">Vencimiento</th>
                            <th style="width:30%;text-align: center;">Cliente</th>
                            <th style="width:15%;text-align: center;">Importe</th>
                            <th style="width:25%;text-align: center;"></th>
                        </tr>                        
                    </thead>
                    <tbody>
                        <?php foreach($cuo as $c){ $fecha = invertirFecha(left($c->fechaVenc,10),"-","/"); $imp = explode(".",$c->precio);?>
                            <tr> 
                                <td style="text-align: center;"><i><font color=red><b><?= $c->idtrabajo ?></b></font></i></td>
                                <td style="text-align: center;"><b><?= $c->idcuota ?></b></td>
                                <td style="text-align: center;color: <?= ($c->pago == 1) ? 'limegreen' : (($c->pago == 2) ? 'orange' : 'red') ?>;"><?= $fecha ?></td>
                                <td style="text-align: center;"><?= $c->cliente ?></td>
                                <td style="text-align: right;"><b><sub>$</sub></b><?= $imp[0] ?><sup><?= $imp[1] ?></sup></td>
                                <td style="text-align: center;"><button id="recordatorio<?= $c->idcuota.$c->idtrabajo ?>" data-p="<?= $c->precio ?>" data-f="<?= $fecha ?>" data-idt="<?= $c->idtrabajo ?>" data-correo="<?= $c->correo ?>" data-id="<?= $c->idcuota ?>" class="recordatorio btn btn-warning btn-xs" title="Enviar Recordatorio a <?= $c->correo ?>">M</button>
                            </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>     
                </div> 
                <?php } ?>
            </div>
    </body>
</html>