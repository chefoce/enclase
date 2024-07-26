<?php 
    include('../config/constants.php');
    if (isset($_GET['id']) and isset($_GET['archivo_nombre'])) {
        $id = $_GET['id'];
        $archivo_nombre = $_GET['archivo_nombre'];
        if ($archivo_nombre != "") {
            $path = "../img/horario_docente/" . $archivo_nombre;
            $remove = unlink($path);
            if ($remove == false) {
                $_SESSION['eliminar'] = "<div class='alert alert-danger'>Error al eliminar el Horario</div>";
                header('location:' . SITEURL . 'admin/consultar_horario_docente.php');
                die();
            }
        }
        $sql = "UPDATE docente SET archivo_horario_nombre = '' WHERE id_docente = $id";
        $res = mysqli_query($conn, $sql);
        if ($res == true) {
            $_SESSION['eliminar'] = "<div class='alert alert-success'>Horario eliminado correctamente</div>";
            header('location:' . SITEURL . 'admin/consultar_horario_docente.php');
        } else {
            $_SESSION['eliminar'] = "<div class='alert alert-danger'>Error al eliminar Horario</div>";
            header('location:' . SITEURL . 'admin/consultar_horario_docente.php');
        }
    } else {
        header('location:' . SITEURL . 'admin/consultar_horario_docente.php');
    }

?>