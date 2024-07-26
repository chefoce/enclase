<?php
ob_start();
session_start();
date_default_timezone_set('America/Mazatlan');

//Crear las constantes que almacenan los valores de NO cambian
define('LOCALHOST','sql213.epizy.com');
define('DB_USERNAME','epiz_32288523');
define('DB_PASSWORD','U2DJvdsFrO');
define('DB_NAME','epiz_32288523_sistema_conalep');
define('SITEURL','http://enclaseconalep.epizy.com/');


$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

if (!$conn) {
    echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
    echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
    echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
