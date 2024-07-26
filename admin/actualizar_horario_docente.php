<!-- Head -->
<?php include('partials/head1.php'); ?>
<title>ENCLASE - Docente</title>
<?php include('partials/head2.php'); ?>
<!-- Sidebar -->
<?php include('partials/sidebar.php'); ?>
<!-- Navbar -->
<?php include('partials/navbar.php'); ?>

<!-- Main -->
<main>
    <div class="container-fluid">
        <section class="section card mb-5">
            <div class="card-body">
                <a href="consultar_horario_docente.php"><i class="fas fa-arrow-circle-left verde-item" style="font-size: 35px;"></i></a>
                <h1 class="text-center my-5 h1">Modificar Horario</h1>
                <?php
                if (isset($_SESSION['id'])) {
                    $id = $_SESSION['id'];
                    $archivo_actual = $_SESSION['archivo_actual'];
                } else {
                    $id = $_GET['id'];
                    $archivo_actual = $_GET['archivo_nombre'];
                }
                if (isset($_SESSION['upload'])) {
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);
                }
                ?>
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="row mb-4">
                        <div class="col">
                            <div class="form-outline">
                                <p class="lead">
                                    Selecciona el Horario (Solo se permite en formato PDF)
                                </p>
                                <div class="custom-file">
                                    <input type="file" name="archivo" class="custom-file-input" id="customFile" accept=".pdf">
                                    <label class="custom-file-label" for="customFile">Ningún Archivo Seleccionado</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="id" value="<?php echo $id ?>">
                    <input type="hidden" name="archivo_actual" value="<?php echo $archivo_actual ?>">
                    <div class="row mb-1">
                        <div class="col-6 mx-auto">
                            <a href="consultar_horario_docente.php" class="btn btn-danger btn-block">Cancelar</a>
                        </div>
                        <div class="col-6 mx-auto">
                            <button type="submit" name="submit" class="btn verde-conalep btn-block">Actualizar Horario</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
</main>
<!-- Main -->

<?php include('partials/footer.php'); ?>

<?php

if (isset($_POST['submit'])) {

    $id = $_GET['id'];
    $archivo_actual = $_GET['archivo_actual'];


    if (isset($_FILES['archivo']['name'])) {
        $archivo_nombre = $_FILES['archivo']['name'];
        if ($archivo_nombre != "") {
            $ext = end(explode('.', $archivo_nombre));
            $archivo_nombre = "Horario_Docente_" . $id . '.' . $ext;
            $source_path = $_FILES['archivo']['tmp_name'];
            $destination_path = "../img/horario_docente/" . $archivo_nombre;
            $upload = move_uploaded_file($source_path, $destination_path);
            if ($upload == false) {
                $_SESSION['upload'] = "<div class='alert alert-danger'>Error al Actualizar el Horario</div>";
                $_SESSION['id'] = $id;
                $_SESSION['archivo_actual'] = $archivo_actual;
                header('location:' . SITEURL . 'admin/actualizar_horario_docente.php');
                die();
            }
            if ($archivo_actual != "") {
                $remove_path = "../img/horario_docente/" . $archivo_actual;
                $remove = unlink($remove_path);
                if ($remove == false) {
                    $_SESSION['error-eliminar'] = "<div class='alert alert-danger'>Error al Eliminar Horario Actual</div>";
                    header('location:' . SITEURL . 'admin/consultar_horario_docente.php');
                    die();
                }
            }
        } else {
            $archivo_nombre = $archivo_actual;
        }
    } else {
        $archivo_nombre = $archivo_actual;
    }


    $sql = "UPDATE docente SET
            archivo_horario_nombre = '$archivo_nombre'
            WHERE id_docente = '$id'";

    $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    if ($res == TRUE) {
        $_SESSION['upload'] = "<div class='alert alert-success'>Horario Actualizado Correctamente</div>";
        unset($_SESSION['id']);
        unset($_SESSION['archivo_actual']);
        header("location:" . SITEURL . '/admin/consultar_horario_docente.php');
    } else {
        $_SESSION['upload'] = "<div class='alert alert-danger'>Error al Actualizar Horario</div>";
        $_SESSION['id'] = $id;
        $_SESSION['archivo_actual'] = $archivo_actual;
        header("location:" . SITEURL . '/admin/agregar_horario_docente.php');
    }
}

?>