<?php ob_start();
include('../config/constants.php');
if (!isset($_SESSION['rol'])) {
  header('location:' . SITEURL);
} else {
  switch ($_SESSION['rol']) {
    case 1:
      header('location:' . SITEURL . 'admin/');
      break;
    case 2:
      header('location:' . SITEURL . 'docente/');
      break;
    case 3:
      header('location:' . SITEURL . 'alumno/');
      break;
  }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />