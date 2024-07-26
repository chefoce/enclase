<?php 
include('../config/constants.php');
$array=json_decode($_POST['todo']); 
foreach ($array as $key => $value) {
    $fila=$value;
    $nombre = $fila[1];
    $apellido = $fila[2];
    $email = $fila[3];
    $password = $fila[4];
    $telefono = $fila[5];
    $alumno_id = $fila[6];
    $password = password_hash($password, PASSWORD_DEFAULT);
    $sql = ("INSERT INTO tutor (nombre, apellido, email, password, telefono, alumno_id, rol_id, activo)VALUES('$nombre', '$apellido', '$email','$password','$telefono','$alumno_id',4,1)");
    $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
}
?>