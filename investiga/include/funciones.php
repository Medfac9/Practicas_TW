<?php

require_once('config.php');
require_once(dirname(__FILE__).'/../class/bbdd.php');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

function mostrarErrores(){
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}

function debugArr($arr,$var = 0){
    echo ("<pre>");
    if($var == 1){
        var_dump($arr);
    } else {
        print_r($arr);
    }
    echo("</pre>");
}

function redirigir($url){
    header("Location:".$url);
    exit();
}

function checkPermiso($permiso,$tipo){
    $idPermiso = 0;
    $bbdd = new BBDD(_BD_HOST_,_BD_BBDD_,_BD_USER_,_BD_PASS_);
    $link = $bbdd->conectar();
    $stmt = $link->prepare("SELECT idPermiso FROM permisos WHERE codigo = ? AND tipo = ?");
    $stmt->bind_param("ss",$permiso,$tipo);
    $stmt->execute();
    $stmt->bind_result($idPermiso);
    $stmt->fetch();
    if(in_array($idPermiso,$_SESSION["user_permisos"])){
        return true;
    }
    return false;
}

function guardarLog($user_id, $accion){
    $bbdd = new BBDD(_BD_HOST_,_BD_BBDD_,_BD_USER_,_BD_PASS_);
    $link = $bbdd->conectar();
    $log = $link->prepare("INSERT INTO log (miembro,accion) VALUES (?,?)");
    $log->bind_param("is",$user_id,$accion);
    $log->execute();
}

function actualizarMiembrosAsociadosPublicaciones($id){
    $bbdd = new BBDD(_BD_HOST_,_BD_BBDD_,_BD_USER_,_BD_PASS_);
    $link = $bbdd->conectar();
    // Buscamos las publicaciones donde aparezca la id del autor.
    $idMiembro = $id;
    //$sql = "SELECT idPublicacion, autor, otro FROM publicacion WHERE autor LIKE ?";
    $sql = "SELECT mp.idPublicacion, p.otro FROM miembrosPublicaciones mp, publicacion p WHERE mp.idPublicacion = p.idPublicacion AND idMiembro = ?";
    $stmt = $link->prepare($sql);
    $stmt->bind_param("s",$idMiembro);
    $stmt->execute();
    $otros = '';
    $idPublicacion = '';
    $stmt->bind_result($idPublicacion, $otros);
    while($stmt->fetch()){
        
        // Borramos la relacion con Publicaciones.
        $link2 = $bbdd->conectar();
        $stmt2 = $link2->prepare("DELETE FROM miembrosPublicaciones WHERE idMiembro = ?");
        $stmt2->bind_param('i',$idMiembro);
        $stmt2->execute();
        $stmt2->close();
        
        // Buscamos el nombre y apellidos de este autor.
        $sql2 = "SELECT CONCAT(nombre,' ',apellidos) as nombreCompleto FROM miembro WHERE idMiembro = ?";
        $stmt2 = $link2->prepare($sql2);
        $stmt2->bind_param('i',$idMiembro);
        $nombre = '';
        $stmt2->execute();
        $stmt2->bind_result($nombre);
        $stmt2->fetch();
        
        // Lo concatenamos a la lista de nombres "Otros Autores"
        if(trim($otros) != "")
            $otros .= ", ".$nombre;
        
        // Salvo si esa lista estaba vacía, en cuyo caso simplemente la empezamos con este autor.
        else
            $otros = $nombre;
        
        // Actualizamos la publicación
        $stmt2->close();
        
        $sql3 = "UPDATE publicacion SET otro = ? WHERE idPublicacion = ?";
        $stmt2 = $link2->prepare($sql3);
        $stmt2->bind_param('si',$otros,$idPublicacion);
        $stmt2->execute();
    }
}

function actualizarMiembrosAsociadosProyectos($id){
    $bbdd = new BBDD(_BD_HOST_,_BD_BBDD_,_BD_USER_,_BD_PASS_);
    $link = $bbdd->conectar();
    // Buscamos las publicaciones donde aparezca la id del autor.
    $idMiembro = $id;
    //$sql = "SELECT idPublicacion, autor, otro FROM publicacion WHERE autor LIKE ?";
    $sql = "SELECT mp.idProyecto, p.principal, p.colaborador, mp.tipo FROM miembrosProyectos mp, proyecto p WHERE mp.idProyecto = p.idProyecto AND idMiembro = ?";
    $stmt = $link->prepare($sql);
    $stmt->bind_param("s",$idMiembro);
    $stmt->execute();
    $principal = '';
    $colaborador = '';
    $idProyecto = '';
    $tipo = '';
    $stmt->bind_result($idProyecto, $principal, $colaborador, $tipo);
    while($stmt->fetch()){
        
        // Borramos la relacion con Proyectos.
        $link2 = $bbdd->conectar();
        $stmt2 = $link2->prepare("DELETE FROM miembrosProyectos WHERE idMiembro = ?");
        $stmt2->bind_param('i',$idMiembro);
        $stmt2->execute();
        $stmt2->close();
        
        // Buscamos el nombre y apellidos de este autor.
        $sql2 = "SELECT CONCAT(nombre,' ',apellidos) as nombreCompleto FROM miembro WHERE idMiembro = ?";
        $stmt2 = $link2->prepare($sql2);
        $stmt2->bind_param('i',$idMiembro);
        $nombre = '';
        $stmt2->execute();
        $stmt2->bind_result($nombre);
        $stmt2->fetch();
        
        // Lo concatenamos a la lista de nombres "Otros Autores"
        if($tipo == "principal"){
            if(trim($principal) != "")
                $principal .= ", ".$nombre;

            // Salvo si esa lista estaba vacía, en cuyo caso simplemente la empezamos con este autor.
            else
                $principal = $nombre;
        } else {
            if(trim($colaborador) != "")
                $colaborador .= ", ".$nombre;

            // Salvo si esa lista estaba vacía, en cuyo caso simplemente la empezamos con este autor.
            else
                $colaborador = $nombre;
        }
        
        // Actualizamos la publicación
        $stmt2->close();
        
        $sql3 = "UPDATE proyecto SET principal = ?, colaborador = ? WHERE idProyecto = ?";
        $stmt2 = $link2->prepare($sql3);
        $stmt2->bind_param('ssi',$principal,$colaborador,$idProyecto);
        $stmt2->execute();
    }
}

?>