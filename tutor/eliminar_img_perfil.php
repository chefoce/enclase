<?php 
    include('../config/constants.php');
    if(isset($_GET['id']) AND isset($_GET['img_perfil'])) {
        $id = $_GET['id'];
        $img_perfil = $_GET['img_perfil'];
        if($img_perfil != "")
        {
            $path = "../img/img_perfil/".$img_perfil;
            $remove = unlink($path);
            if($remove==false)
            {
                $_SESSION['error'] = "<div class='alert alert-danger'>Error al eliminar la Imagen de perfil.</div>";
                header('location:' . SITEURL . 'tutor/perfil.php');
                die();
            }
        }
        $sql = "UPDATE tutor SET img_perfil_nombre = '' WHERE id_tutor = $id";
        $res = mysqli_query($conn, $sql);
        if($res==true)
        {
            $_SESSION['imagen_perfil'] = "";
            $_SESSION['delete'] = "<div class='alert alert-success'>Imagen de perfil eliminada.</div>";
            header('location:' . SITEURL . 'tutor/perfil.php');
        }
        else
        {
            $_SESSION['delete'] = "<div class='alert alert-danger'>Error al eliminar la Imagen de perfil.</div>";
            header('location:' . SITEURL . 'tutor/perfil.php');
        }

    }
    else
    {
        header('location:' . SITEURL . 'tutor/perfil.php');
    }
?>