<?php 
include('../config/constants.php');
$array=json_decode($_POST['todo']); 
foreach ($array as $key => $value) {
    $fila=$value;
    $nombre = $fila[1];
    $apellido = $fila[2];
    $email = $fila[3];
    $password = $fila[4];
    $password = password_hash($password, PASSWORD_DEFAULT);
    $sql = ("INSERT INTO administrador (nombre, apellido, email, rol_id, password, activo)VALUES('$nombre', '$apellido', '$email', 1, '$password', 1)");
    $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
}
?>