<?php

error_reporting(E_ALL & ~E_NOTICE);

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$bbdd = new BBDD(_BD_HOST_,_BD_BBDD_,_BD_USER_,_BD_PASS_);

  

if(!isset($_SESSION["user_id"])){
    // Usuario invitado
    $_SESSION["user_id"] = 0;
    $_SESSION["user_name"] = "invitado";
    $_SESSION["user_rol"] = "1";
}

if(!isset($_SESSION["user_permisos"])){
    $sql = "SELECT idPermiso FROM permisosRoles WHERE idRol = ".$_SESSION["user_rol"];
    $result = $bbdd->query($sql);
    $permisos = array();
    foreach($result as $res){
        $permisos[] = $res["idPermiso"];
    }
    $_SESSION["user_permisos"] = $permisos;
}

if(!isset($_SESSION["user_menu"])){
    $sql = "SELECT m.idMenu, m.nombre, m.url, m.icono, m.orden, p.idPermiso "
            . " FROM menu m, permisos p WHERE m.codigo = p.codigo AND m.idPadre IS NULL "
            . " AND p.idPermiso IN (".implode(",",$_SESSION["user_permisos"]).") AND p.tipo = 'lectura' "
            . " ORDER BY m.orden";
    $results = $bbdd->query($sql);
    $menuCompleto = array();
    foreach($results as $res){
        if(in_array($res["idPermiso"],$_SESSION["user_permisos"])){
            $menu = array("nombre"=>$res["nombre"],"url"=>$res["url"],"icono"=>$res["icono"]);
            $sql = "SELECT m.nombre, m.url, m.icono, m.orden, p.idPermiso "
            . " FROM menu m, permisos p WHERE m.codigo = p.codigo AND m.idPadre = ".$res["idMenu"]
            . " AND p.idPermiso IN (".implode(",",$_SESSION["user_permisos"]).") "
            . " ORDER BY m.orden";
            $resultsChild = $bbdd->query($sql);
            $childs = array();
            $i = 0;
            foreach($resultsChild as $resCh){
                $i++;
                $childs[] = array("nombre"=>$resCh["nombre"],"url"=>$resCh["url"],"icono"=>$resCh["icono"]);
            }
            if($i > 0){
                $menu["childs"] = $childs;
            } else {
                $menu["childs"] = "0";
            }
        }
        $menuCompleto[] = $menu;
    }
    $_SESSION["user_menu"] = $menuCompleto;
}