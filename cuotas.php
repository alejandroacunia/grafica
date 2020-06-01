<?php error_reporting(E_ERROR | E_PARSE);if(!isset($_SESSION)){    session_start();}if(!isset($_SESSION['agencia'])){    header("Location: logout.php");}include_once('globales.php');include_once('datos.php');$clientes  = clientes(); $empleados = empleados(); $trabajos  = trabajos(); $tipos     = tiposTrabajo(); $tps       = tiposPago(); $estados   = estados(); ?><html>    <head>         <title>PLANES DE CUOTAS</title>        <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>        <script type="text/javascript" src="js/jquery-ui-1.11.4.js"></script>        <script type="text/javascript" src="js/principal.js"></script>        <script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>        <script type="text/javascript" src="js/dist/rome.js"></script>        <link href="js/dist/rome.css" rel="stylesheet">        <link rel="stylesheet" type="text/css" href="css/bootstrap.css">        <link rel="stylesheet" type="text/css" href="css/themes/base/jquery-ui.css">        <link rel="stylesheet" type="text/css" href="css/sitio.css">             </head>    <body>        <h2 align="center"><u>PLANES DE CUOTAS</u></h2>        <br>        <div class="col-xs-12" style="text-align: -webkit-center;">        <h3>Nuevo Trabajo</h3>        <form class="form" id="formGuardar" method="POST" >            <fieldset class="container-fluid">                <div class="row">                        <div class="form-group col-lg-2"></div>                    <div class="form-group col-lg-2"><label>N° de trabajo:</label>                    <input class="form-control dato"  type="text" name="fechaEntregaN" id="fechaEntregaN" value="">                                        </div>                    <div class="form-group col-lg-2"><label>Tipo de trabajo:</label>                    <select class="form-control" name="idtipoN" id="idtipoN">                        <?php foreach($tipos as $e){ ?>                            <option value="<?= $e->idtipo ?>"><?= $e->descripcion ?></option>                        <?php } ?>                    </select>                    </div>                    <div class="form-group col-lg-2"><label>Empleado:</label>                    <select class="form-control" name="idempleadoN" id="idempleadoN">                        <?php foreach($empleados as $e){ ?>                            <option value="<?= $e->idempleado ?>"><?= $e->apeynom ?></option>                        <?php } ?>                    </select>                    </div>                    <div class="form-group col-lg-2"><label>Cliente:</label>                    <select class="form-control" name="idclienteN" id="idclienteN">                        <?php foreach($clientes as $c){ ?>                            <option value="<?= $c->idcliente ?>"><?= $c->nombre ?></option>                        <?php } ?>                    </select>                    </div>                                    </div>                <div class="row">                     <div class="form-group col-lg-2"></div>                    <div class="form-group col-lg-1"><label>Precio:</label>                        <input class="form-control dato"  type="text" name="precioN" id="precioN" value="">                    </div>                    <div class="form-group col-lg-2"><label>Tipo de trabajo:</label>                    <select class="form-control" name="idtpN" id="idtpN">                        <?php foreach($tps as $e){ ?>                            <option value="<?= $e->idtp ?>"><?= $e->descripcion ?></option>                        <?php } ?>                    </select>                    </div>                    <div class="form-group col-lg-5"><label>Observaciones:</label>                    <input class="form-control dato"  type="text" name="observacionesN" id="observacionesN" value="<?= $f->observaciones ?>">                    </div>                </div>                <div class="row">                     <div class="form-group col-lg-12"><label>&nbsp;</label>                        <input class="btn btn-success" style="margin-top: 2em;" type="button" id="altaTrabajo" value="GRABAR">                        <a class="btn btn-primary" href="index.php" style="margin-top: 2em;" id="menuPrincipal">MENU PRINCIPAL</a>                    </div>                                    </div>            </fieldset>        </form>        </div>        <br><br>        <div class="col-xs-12" style="text-align: -webkit-center;">        <h3>Trabajos guardados</h3>        <table class="table table-striped table-bordered centered" style="float: bottom;width:90%;">            <thead>                <tr>                    <th style="width:7%;text-align: center;">#</th>                    <th style="width:09%;text-align: center;">TIPO TRABAJO</th>                    <th style="width:12%;text-align: center;">CREADO</th>                    <th style="width:15%;text-align: center;">ENTREGA</th>                    <th style="width:11%;text-align: center;">ESTADO</th>                    <th style="width:09%;text-align: center;">ASIGNADO A...</th>                    <th style="width:12%;text-align: center;">CLIENTE</th>                    <th style="width:09%;text-align: center;">PRECIO</th>                    <th style="width:09%;text-align: center;">TIPO DE PAGO</th>                    <th style="width:10%;text-align: center;"></th>                </tr>                                    </thead>            <tbody>                <?php foreach($trabajos as $f){ ?>                 <tr id="fila<?= $f->idtrabajo ?>">                    <td rowspan="2" style="vertical-align:middle;text-align: center;"><label class="form-control-plaintext"><b><i>#<?= $f->idtrabajo ?></i><b></label></td>                    <td><select class="form-control" name="idtipo" id="idtipo<?= $f->idtrabajo ?>">                            <?php foreach($tipos as $e){ ?>                                <option value="<?= $e->idtipo ?>" <?= ($e->idtipo == $f->tipo) ? 'selected' : '' ?>><?= $e->descripcion ?></option>                            <?php } ?>                        </select>                    </td>                    <td style="text-align: center;"><label class="form-control-plaintext"><?= invertirFechaHora($f->fechaCreacion,"-","/") ?></label></td>                    <td><input  type='text' class="form-control" value="<?= invertirFechaHora(left($f->fechaEntrega,16),"-","/") ?>" name="fechaEntrega" id='fechaEntrega<?= $f->idtrabajo ?>'></td>                    <td><select class="form-control" name="idestado" id="idestado<?= $f->idtrabajo ?>">                            <?php foreach($estados as $e){ ?>                                <option value="<?= $e->idestado ?>" <?= ($e->idestado == $f->idestado) ? 'selected' : '' ?>><?= $e->descripcion ?></option>                            <?php } ?>                        </select>                    </td>                    <td><select class="form-control" name="idempleado" id="idempleado<?= $f->idtrabajo ?>">                            <?php foreach($empleados as $e){ ?>                                <option value="<?= $e->idempleado ?>" <?= ($e->idempleado == $f->idempleado) ? 'selected' : '' ?>><?= $e->apeynom ?></option>                            <?php } ?>                        </select>                    </td>                    <td><select class="form-control" name="idcliente" id="idcliente<?= $f->idtrabajo ?>">                            <?php foreach($clientes as $e){ ?>                                <option value="<?= $e->idcliente ?>" <?= ($e->idcliente == $f->idcliente) ? 'selected' : '' ?>><?= $e->nombre ?></option>                            <?php } ?>                        </select>                    </td>                    <td><input class="form-control" type="text" value="<?= $f->precio ?>" name="precio" id="precio<?= $f->idtrabajo ?>"></td>                    <td><select class="form-control" name="idtp" id="idtp<?= $f->idtrabajo ?>">                            <?php foreach($tps as $e){ ?>                                <option value="<?= $e->idtp ?>" <?= ($e->idtp == $f->idtp) ? 'selected' : '' ?>><?= $e->descripcion ?></option>                            <?php } ?>                        </select>                    </td>                    <td rowspan="2" style="vertical-align:middle;text-align:center;">                        <button id="guaTrabajo<?= $f->idtrabajo ?>" data-id="<?= $f->idtrabajo ?>" class="guaTrabajo btn btn-warning btn-xs"><span class="glyphicon glyphicon-edit" title="Guardar Cambios" aria-hidden="true">G</span></button>                        <button id="eliTrabajo<?= $f->idtrabajo ?>" data-id="<?= $f->idtrabajo ?>" class="eliTrabajo btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove" title="Eliminar Trabajo" aria-hidden="true">X</span></button>                        <button id="planCuotas<?= $f->idtrabajo ?>" style="display: <?= ($f->idtp == '2') ? 'initial' : 'none' ?>" data-id="<?= $f->idtrabajo ?>" class="planCuotas btn btn-success btn-xs"><span class="glyphicon glyphicon-remove" title="Plan de Cuotas" aria-hidden="true">P</span></button>                    </td>                    <script type="text/javascript">                    $(function () {                        rome(fechaEntrega<?= $f->idtrabajo ?>,{timeInterval:'900',inputFormat: "DD/MM/YYYY HH:mm"});                    });                    </script>                </tr>                <tr><td colspan="8"><label style="width: 10%;display:inline;float:left;"><b>OBSERVACIONES:</b></label><input style="width: 90%;display:inline;float:right;" class="form-control" type="text" value="<?= $f->observaciones ?>" name="observaciones" id="observaciones<?= $f->idtrabajo ?>"></td></tr>                <?php } ?>            </tbody>        </table>        </div>    </body></html>