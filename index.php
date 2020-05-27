<?php session_start(); 
if(!isset($_SESSION['agencia'])){
    header("Location: logout.php");
}

include_once('globales.php');
include_once('datos.php');
include_once('DB.php');

$idcliente  = $_SESSION['idc']; if(trim($idcliente) === ''){die('IDC FALTANTE');}
//$modulos    = misModulos($idcliente);

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
          <?php if(in_array('6',$modulos)){ ?>
            <div class="col-xs-12" style="text-align: -webkit-center;">
              <fieldset class="container-fluid"><h2><u>Cabezas que más salen</u></h2>
                  <fieldset class="container-fluid">
                        <h3><em>
                            <?php foreach($quinielas as $q){ echo " ".str_replace("_"," ",$q->nombre)." *"; } ?>
                        </em></h3>
                  <div class="row" style="width:50%;">
                <table class="table table-striped table-bordered" style="font-size: 1.7em;float: left;width:31%;margin:8px;">
                    <thead>
                        <tr>
                            <th style="width:45%;text-align: center;">2 cifras</th>
                            <th style="width:55%;text-align: center;">Cantidad</th>
                        </tr>                        
                    </thead>
                    <tbody>
                        <?php foreach($salidores2 as $c){ ?>
                            <tr> 
                                <td style="text-align: center;"><font color=red><b><?= $c->numero ?></b></font></td>
                                <td style="text-align: center;"><?= $c->cant ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>                  
                <table class="table table-striped table-bordered" style="font-size: 1.7em;float: left;width:31%;margin:8px;">
                    <thead>
                        <tr>
                            <th style="width:45%;text-align: center;">3 cifras</th>
                            <th style="width:55%;text-align: center;">Cantidad</th>
                        </tr>                        
                    </thead>
                    <tbody>
                        <?php foreach($salidores3 as $c){ ?>
                            <tr> 
                                <td style="text-align: center;"><font color=red><b><?= $c->numero ?></b></font></td>
                                <td style="text-align: center;"><?= $c->cant ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <table class="table table-striped table-bordered" style="font-size: 1.7em;float: left;width:31%;margin:8px;">
                    <thead>
                        <tr>
                            <th style="width:45%;text-align: center;">4 cifras</th>
                            <th style="width:55%;text-align: center;">Cantidad</th>
                        </tr>                        
                    </thead>
                    <tbody>
                        <?php foreach($salidores4 as $c){ ?>
                            <tr> 
                                <td style="text-align: center;"><font color=red><b><?= $c->numero ?></b></font></td>
                                <td style="text-align: center;"><?= $c->cant ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>  
              </div>
            </fieldset>
            </div>
            <?php } ?>
    </body>
</html>