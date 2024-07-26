<?php 
    include('../config/constants.php');
    $id = $_GET['id'];
    $sql = "UPDATE alumno_docente SET
        activo = 0
        WHERE id_ad = '$id'";
    $res = mysqli_query($conn, $sql);
    if($res==true){
        $_SESSION['eliminar'] = "<div class='alert alert-success'>Materia Alumno Eliminada correctamente</div>";
        header('location:'.SITEURL.'admin/consultar_materias_alumno.php');
    }else{
        $_SESSION['eliminar'] = "<div class='alert alert-danger'>Error al Eliminar</div>";
        header('location:'.SITEURL.'admin/consultar_materias_alumno.php');
    }
?>