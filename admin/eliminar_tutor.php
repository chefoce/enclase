<?php 
    include('../config/constants.php');
    $id = $_GET['id'];
    $sql = "UPDATE tutor SET
        activo = 0
        WHERE id_tutor = '$id'";
    $res = mysqli_query($conn, $sql);
    if($res==true){
        $_SESSION['eliminar'] = "<div class='alert alert-success'>Tutor eliminado correctamente</div>";
        header('location:'.SITEURL.'admin/consultar_tutor.php');
    }else{
        $_SESSION['eliminar'] = "<div class='alert alert-danger'>Error al eliminar</div>";
        header('location:'.SITEURL.'admin/consultar_tutor.php');
    }
?>