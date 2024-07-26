<?php 
    include('../config/constants.php');
    $id = $_GET['id'];
    $sql = "DELETE FROM notificaciones WHERE id_notificacion = $id";
    $res = mysqli_query($conn, $sql);
    if($res==true){
        $_SESSION['eliminar'] = "<div class='alert alert-success'>Notificación eliminada</div>";
        header('location:'.SITEURL.'docente/consultar_notificaciones.php');
    }else{
        $_SESSION['eliminar'] = "<div class='alert alert-danger'>Error al eliminar</div>";
        header('location:'.SITEURL.'docente/consultar_notificaciones.php');
    }




?>