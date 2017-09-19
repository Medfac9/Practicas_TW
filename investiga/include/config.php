<?php
$config = include_once('configbbdd.php');
// Definiciones de Variables
define("_DEBUG_", 1);
define("_URL_",$config["url"]);
//define("_URL_","https://void.ugr.es/~ramefa1617sep/investiga");
define("_ruta_","investiga");

// Configuración de BBDD
define("_BD_HOST_",$config["host"]);
define("_BD_USER_",$config["user"]);
define("_BD_PASS_",$config["pass"]);
define("_BD_BBDD_",$config["bbdd"]);