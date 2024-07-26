<?php 
    include('../config/constants.php');
    $id = $_GET['id'];
    $sql = "UPDATE docente_materia SET
        activo = 0
        WHERE id_dm = '$id'";
    $res = mysqli_query($conn, $sql);
    if($res==true){
        $_SESSION['eliminar'] = "<div class='alert alert-success'>Materia Docente Eliminada correctamente</div>";
        header('location:'.SITEURL.'admin/consultar_materias_docente.php');
    }else{
        $_SESSION['eliminar'] = "<div class='alert alert-danger'>Error al Eliminar</div>";
        header('location:'.SITEURL.'admin/consultar_materias_docente.php');
    }




?>