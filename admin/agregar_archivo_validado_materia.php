<?php 
include('../config/constants.php');
$array=json_decode($_POST['todo']); 
foreach ($array as $key => $value) {
    $fila=$value;
    $nombre = $fila[1];
    $semestre = $fila[2];
    $sql = ("INSERT INTO materia (nombre, semestre, activo)VALUES('$nombre', '$semestre',1)");
    $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
}
?>