<?php session_start();
if(isset($_GET['er'])){
    $err = $_GET['er'];
}
?>
<html>
    <head>
        <title>LOGIN GRAFICA</title> 
        <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
        <script type="text/javascript" src="js/jquery-ui-1.11.4.js"></script>
        <script type="text/javascript" src="js/principal.js"></script>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="css/themes/base/jquery-ui.css">
        <link rel="stylesheet" type="text/css" href="css/sitio.css">
    </head>
    <body>
        <h2 align="center">LOGIN GRAFICA</h2>
        <form class="form" id="formLogin" method="POST" action="ABMUsuarios.php">
            <fieldset class="container-fluid" >
                <div class="row" style="float: none;margin-left: auto;margin-right: auto;width: 30%;">    
                    <div class="form-group col-lg-6"><label>Usuario:</label>
                        <input type="text" class="form-control" name="usuario" id="usuario">
                        <input type="hidden" name="tipo" value="4">
                    </div>
                    <div class="form-group col-lg-6"><label>Contraseña:</label>
                        <input type="password" class="form-control" name="pw" id="pw">
                    </div>  
                </div >
                <div class="row" style="float: none;margin-left: auto;margin-right: auto;width: 30%;">
                    <div class="form-group col-lg-12">
                        <input type=submit class="btn btn-success" style="width: 100%;" id="panLogin" value="Entrar"> 
                    </div> 
                </div>
                <div class="row" style="float: none;margin-left: auto;margin-right: auto;width: 30%;">
                    <?php if(isset($_GET['er'])){ ?> 
                        <div class="form-group col-lg-12"><div align=center class="alert alert-danger">
                        <?php switch($err){
                            case '-1':
                                echo 'Usuario inactivo';
                                break;
                            case '-2':
                                echo 'Contraseña incorrecta';
                                break;
                            case '-3':
                                echo 'Usuario no asignado a una agencia';
                                break;
                            case '-4':
                                echo 'Usuario inexistente';
                                break;
                        }?>
                            </div></div> 
                    <?php }?>
                </div>                
            </fieldset>
        </form>
    </body>
</html>



