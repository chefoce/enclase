<?php 
    include('../config/constants.php');
    $id = $_GET['id'];
    $sql = "UPDATE grupo SET
        activo = 0
        WHERE id_grupo = '$id'";
    $res = mysqli_query($conn, $sql);
    if($res==true){
        $_SESSION['eliminar'] = "<div class='alert alert-success'>Grupo eliminado correctamente</div>";
        header('location:'.SITEURL.'admin/consultar_grupo.php');
    }else{
        $_SESSION['eliminar'] = "<div class='alert alert-danger'>Error al eliminar</div>";
        header('location:'.SITEURL.'admin/consultar_grupo.php');
    }




?>