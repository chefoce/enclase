<?php 
    include('../config/constants.php');
    $id = $_GET['id'];
    $sql = "UPDATE docente SET
        activo = 0
        WHERE id_docente = '$id'";
    $res = mysqli_query($conn, $sql);
    if($res==true){
        $_SESSION['eliminar'] = "<div class='alert alert-success'>Docente eliminado correctamente</div>";
        header('location:'.SITEURL.'admin/consultar_docente.php');
    }else{
        $_SESSION['eliminar'] = "<div class='alert alert-danger'>Error al eliminar</div>";
        header('location:'.SITEURL.'admin/consultar_docente.php');
    }




?>