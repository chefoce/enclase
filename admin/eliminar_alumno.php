<?php 
    include('../config/constants.php');
    $id = $_GET['id'];
    $sql = "UPDATE alumno SET
        activo = 0
        WHERE id_alumno = '$id'";
    $res = mysqli_query($conn, $sql);
    if($res==true){
        $_SESSION['eliminar'] = "<div class='alert alert-success'>Alumno eliminado correctamente</div>";
        header('location:'.SITEURL.'admin/consultar_alumno.php');
    }else{
        $_SESSION['eliminar'] = "<div class='alert alert-danger'>Error al eliminar</div>";
        header('location:'.SITEURL.'admin/consultar_alumno.php');
    }




?>