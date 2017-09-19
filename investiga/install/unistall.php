<?php

error_reporting(E_ALL & ~E_NOTICE);

require_once(dirname(__FILE__).'/../include/config.php');
require_once(dirname(__FILE__).'/../class/bbdd.php');
require_once(dirname(__FILE__).'/../include/funciones.php');

if($_POST["desinstalar"] && $_POST["desinstalar"] == "ok"){
    
    session_destroy();

    $bbdd = new BBDD(_BD_HOST_,_BD_BBDD_,_BD_USER_,_BD_PASS_);

    $query = "DROP TABLE log";
    $bbdd->query($query);

    $query = "DROP TABLE publicacion";
    $bbdd->query($query);

    $query = "DROP TABLE proyecto";
    $bbdd->query($query);

    $query = "DROP TABLE miembro";
    $bbdd->query($query);
    
    $query = "DROP TABLE menu";
    $bbdd->query($query);

    $query = "DROP TABLE permisosRoles";
    $bbdd->query($query);
    
    $query = "DROP TABLE permisos";
    $bbdd->query($query);
    
    $query = "DROP TABLE roles";
    $bbdd->query($query); 
    
    unlink(dirname(__FILE__).'/../include/configbbdd.php');

    header("Location: ./index.php");
}     

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Desinstalación</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo _URL_;?>/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo _URL_;?>/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo _URL_;?>/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo _URL_;?>/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                
                <div class="login-panel panel panel-default">
                    
                    <div class="panel-heading">
                        <h3 class="panel-title">Desinstalar</h3>
                    </div>
                    <div class="panel-body">
                        <form id="borrar" role="form" method="post">
                            <input type='hidden' name='desinstalar' value='ok'>
                            <fieldset>
                                <input type="hidden" name="accion" value="guardar">
                                ¿Está seguro que quiere desinstalar el sistema?
                                <a href="<?php echo _URL_;?>" class="btn btn-lg btn-success btn-block">Regresar</a>
                                <input type="button" class="btn btn-lg btn-danger btn-block" onclick="borrarSistema()" value="Desinstalar" />
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="<?php echo _URL_;?>/vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo _URL_;?>/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo _URL_;?>/vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo _URL_;?>/dist/js/sb-admin-2.js"></script>

</body>

</html>

<script type="text/javascript">
    function borrarSistema(){
        var mensaje = confirm("¿Seguro que quieres desinstalar el sistema?");
        if(mensaje){
            alert("¡Se ha borrado el sistema!");
            $("#borrar").submit();
        }
        else{
            return;
        }
    }
</script>
