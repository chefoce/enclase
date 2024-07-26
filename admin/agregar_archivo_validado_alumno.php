<?php 
include('../config/constants.php');
$array=json_decode($_POST['todo']); 
foreach ($array as $key => $value) {
    $fila=$value;
    $nombre = $fila[1];
    $apellido = $fila[2];
    $matricula = $fila[3];
    $email = $fila[4];
    $password = $fila[5];
    $telefono = $fila[6];
    $f_ingreso = $fila[7];
    $f_ingreso = date("d/m/Y", strtotime($f_ingreso));
    $f_nacimiento = $fila[8];
    $f_nacimiento = date("d/m/Y", strtotime($f_nacimiento));
    $carrera = $fila[9];
    $password = password_hash($password, PASSWORD_DEFAULT);
    $sql = ("INSERT INTO alumno (nombre, apellido, matricula, email, password, telefono, fecha_ingreso, fecha_nacimiento, carrera_id, rol_id, activo)VALUES('$nombre', '$apellido', $matricula, '$email','$password','$telefono','$f_ingreso','$f_nacimiento',$carrera,3,1)");
    $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
}
?>