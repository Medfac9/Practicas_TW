<?php

include_once("config.php");
include_once(dirname(__FILE__).'/../class/bbdd.php');
include_once("funciones.php");

$accion = '';
if(isset($_POST["accion"]) && $_POST["accion"] != ''){
    $accion = $_POST["accion"];
}

if($accion == ''){
    exit;
}

call_user_func($accion);

/* Definicion de Funciones */

function borrar_miembro(){
    $idMiembro = $_POST["idMiembro"];
    if($idMiembro != ''){
        actualizarMiembrosAsociadosPublicaciones($idMiembro);
        $sql = "DELETE FROM miembro WHERE idMiembro = ?";
        $bbdd = new BBDD(_BD_HOST_,_BD_BBDD_,_BD_USER_,_BD_PASS_);
        $link = $bbdd->conectar();
        $stmt = $link->prepare($sql);
        $stmt->bind_param('i',$idMiembro);
        if($stmt->execute()){
            guardarLog($_SESSION["user_id"],"Miembro Borrado - ID: ".$idMiembro);
            echo "1";
        } else {
            echo "0";
        }
    }    
}

function borrar_publicacion(){
    $idPublicacion = $_POST["idPublicacion"];
    if($idPublicacion != ''){
        $sql = "DELETE FROM publicacion WHERE idPublicacion = ?";
        $bbdd = new BBDD(_BD_HOST_,_BD_BBDD_,_BD_USER_,_BD_PASS_);
        $link = $bbdd->conectar();
        $stmt = $link->prepare($sql);
        $stmt->bind_param('i',$idPublicacion);
        if($stmt->execute()){
            guardarLog($_SESSION["user_id"],"Publicación Borrada - ID: ".$idPublicacion);
            echo "1";
        } else {
            echo "0";
        }
    }    
}

function borrar_proyecto(){
    $idProyecto = $_POST["idProyecto"];
    if($idProyecto != ''){
        $sql = "DELETE FROM proyecto WHERE idProyecto = ?";
        $bbdd = new BBDD(_BD_HOST_,_BD_BBDD_,_BD_USER_,_BD_PASS_);
        $link = $bbdd->conectar();
        $stmt = $link->prepare($sql);
        $stmt->bind_param('i',$idProyecto);
        if($stmt->execute()){
            guardarLog($_SESSION["user_id"],"Proyecto Borrado - ID: ".$idProyecto);
            echo "1";
        } else {
            echo "0";
        }
    }    
}