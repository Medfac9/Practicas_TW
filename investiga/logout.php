<?php

error_reporting(E_ALL & ~E_NOTICE);

require_once('include/config.php');
require_once('include/funciones.php');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
session_destroy();
redirigir(_URL_);

?>