<?php 
include('../config/constants.php');
$array=json_decode($_POST['todo']); 
foreach ($array as $key => $value) {
    $fila=$value;
    $nombre = $fila[1];
    $sql = ("INSERT INTO grupo (nombre, activo)VALUES('$nombre',1)");
    $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
}
?>