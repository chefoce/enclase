<?php 
    include('../config/constants.php');
    $id = $_GET['id'];
    $sql = "UPDATE administrador SET
        activo = 0
        WHERE id_admin = '$id'";
    $res = mysqli_query($conn, $sql);
    if($res==true){
        $_SESSION['eliminar'] = "<div class='alert alert-success'>Admin eliminado correctamente</div>";
        header('location:'.SITEURL.'admin/consultar_admin.php');
    }else{
        $_SESSION['eliminar'] = "<div class='alert alert-danger'>Error al eliminar</div>";
        header('location:'.SITEURL.'admin/consultar_admin.php');
    }




?>