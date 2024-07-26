<?php
include('../config/constants.php');

$archivo_nombre = $_GET['archivo_nombre'];

if ($archivo_nombre == "") {
    $_SESSION['errorH'] = "<div class='alert alert-danger'>El docente no tiene Horario Asignado</div>";
    header('location:' . SITEURL . 'admin/consultar_horario_docente.php');
}


$filename = "../img/horario_docente/" . $archivo_nombre;
header("Content-type: application/pdf");
header("Content-Length: " . filesize($filename));
readfile($filename);
