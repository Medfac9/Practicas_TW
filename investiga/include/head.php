<?php

require_once('config.php');
require_once(dirname(__FILE__).'/../class/bbdd.php');
require_once('funciones.php');
require_once('start.php');

?>
<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <?php
    $servidor = $_SERVER["HTTP_HOST"];
    $direccion = $_SERVER["REQUEST_URI"];
    $total = $servidor . $direccion;
    
    switch ($total) {
    case 'void.ugr.es/~ramefa1617sep/investiga/index.php':
        ?>
        <title>Inicio</title>
        <?php
        break;
    case 'void.ugr.es/~ramefa1617sep/investiga/':
        ?>
        <title>Inicio</title>
        <?php
        break;
    case 'void.ugr.es/~ramefa1617sep/investiga/miembros/':
        ?>
        <title>Miembros</title>
        <?php
        break;
    case 'void.ugr.es/~ramefa1617sep/investiga/miembros/formulario.php':
        ?>
        <title>Miembros</title>
        <?php
        break;
    case 'void.ugr.es/~ramefa1617sep/investiga/publicaciones/':
        ?>
        <title>Publicaciones</title>
        <?php
        break;
    case 'void.ugr.es/~ramefa1617sep/investiga/publicaciones/formulario.php':
        ?>
        <title>Publicaciones</title>
        <?php
        break;
    case 'void.ugr.es/~ramefa1617sep/investiga/proyectos/':
        ?>
        <title>Proyectos</title>
        <?php
        break;
    case 'void.ugr.es/~ramefa1617sep/investiga/proyectos/formulario.php':
        ?>
        <title>Proyectos</title>
        <?php
        break;
    case 'void.ugr.es/~ramefa1617sep/investiga/admin/log.php':
        ?>
        <title>Log del Sistema</title>
        <?php
        break;
    case 'void.ugr.es/~ramefa1617sep/investiga/admin/backup.php':
        ?>
        <title>Backup</title>
        <?php
        break;
    case 'void.ugr.es/~ramefa1617sep/investiga/documentacion/':
        ?>
        <title>Documentación</title>
        <?php
        break;
    case 'void.ugr.es/~ramefa1617sep/investiga/accesoDenegado.php':
        ?>
        <title>Acceso denegado</title>
        <?php
        break;
    default:
        ?>
        <title>Edición</title>
        <?php
    }
    ?>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo _URL_;?>/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo _URL_;?>/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo _URL_;?>/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="<?php echo _URL_;?>/vendor/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo _URL_;?>/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    
    <!-- jQuery UI -->
    <link href="<?php echo _URL_;?>/include/js/jqueryui/jquery-ui.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo _URL_;?>/include/js/jqueryui/jquery-ui.structure.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo _URL_;?>/include/js/jqueryui/jquery-ui.theme.min.css" rel="stylesheet" type="text/css">
    
    <!-- Archivo CSS Propio -->
    <link href="<?php echo _URL_;?>/include/css/style.css" rel="stylesheet" type="text/css">
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo _URL_;?>/index.php"><img style="width: 70px;" src='<?php echo _URL_;?>/fotos/logo.png' alt='Logo' /></a>
            </div>
            <!-- /.navbar-header -->
            
            

            <ul class="nav navbar-top-links navbar-right">
                <li>
                    <?php
                        if($_SESSION["user_name"] != 'invitado'){
                    ?>
                            <a href='<?php echo _URL_;?>/miembros/formulario.php?idMiembro=<?php echo $_SESSION["user_id"];?>'><?php echo $_SESSION["user_name"]; ?></a>
                        <?php
                        }
                        ?>
                    
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <?php
                        if($_SESSION["user_name"] != "invitado"){
                            ?>
                            <li><a href="<?php echo _URL_;?>/logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                            <?php
                        } else {
                            ?>
                            <li><a href="<?php echo _URL_;?>/login"><i class="fa fa-sign-in fa-fw"></i> Login</a>    
                            <?php
                        }
                        ?>
                        
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->
            <?php require_once('menuizq.php');?>
        </nav>