<?php

error_reporting(E_ALL & ~E_NOTICE);

require_once(dirname(__FILE__).'/../include/config.php');
require_once(dirname(__FILE__).'/../class/bbdd.php');
require_once(dirname(__FILE__).'/../include/funciones.php');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$encontrado = -1;

// Si el usuario ya se ha logueado antes, redirigimos al index.
if(isset($_SESSION["user_name"]) && $_SESSION["user_name"] != "invitado"){
    redirigir(_URL_);
}

if(isset($_POST["accion"]) && $_POST["accion"] == "login"){
    // Accion de Login
    
    // Si el usuario es válido, se loguea.
    $bbdd = new BBDD(_BD_HOST_,_BD_BBDD_,_BD_USER_,_BD_PASS_);
    $link = $bbdd->conectar();
    $stmt = $link->prepare('SELECT * FROM miembro WHERE email = ? AND clave = MD5(?)');
    $stmt->bind_param('ss', $_POST["email"], $_POST["password"]);

    $stmt->execute();

    $result = $stmt->get_result();
    
    $encontrado = 0;
    while ($row = $result->fetch_assoc()) {
        $encontrado = 1;
        $_SESSION["user_id"] = $row["idMiembro"];
        $_SESSION["user_name"] = $row["nombre"];
        $_SESSION["user_rol"] = $row["rol"];
        unset($_SESSION["user_permisos"]);
        unset($_SESSION["user_menu"]);
        redirigir(_URL_);
    }
    
    // Si no, se muestra un error y se permanece en esta página
    if($encontrado == 0){
        $mensaje = "Usuario o contraseña erróneos";
    }
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

    <title>Login</title>

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
                        <h3 class="panel-title">Login</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="post">
                            <input type='hidden' name='accion' value='login'>
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <input type="submit" class="btn btn-lg btn-success btn-block" value="Conectar">
                            </fieldset>
                        </form>
                    </div>
                </div>
                    <?php
                    if($encontrado == 0){
                        ?>
                    <div class="alert alert-danger">
                        <?php echo $mensaje;?>
                    </div>
                        <?php
                    }
                    ?>
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