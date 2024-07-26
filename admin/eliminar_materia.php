<?php 
    include('../config/constants.php');
    $id = $_GET['id'];
    $sql = "UPDATE materia SET
        activo = 0
        WHERE id_materia = '$id'";
    $res = mysqli_query($conn, $sql);
    if($res==true){
        $_SESSION['eliminar'] = "<div class='alert alert-success'>Materia eliminada correctamente</div>";
        header('location:'.SITEURL.'admin/consultar_materia.php');
    }else{
        $_SESSION['eliminar'] = "<div class='alert alert-danger'>Error al eliminar</div>";
        header('location:'.SITEURL.'admin/consultar_materia.php');
    }




?>