<!-- Head -->
<?php include('partials/head1.php'); ?>
<title>ENCLASE - Mi Perfil</title>
<?php include('partials/head2.php'); ?>
<!-- Sidebar -->
<?php include('partials/sidebar.php'); ?>
<!-- Navbar -->
<?php include('partials/navbar.php'); ?>
<main>
    <?php
    $sql = "SELECT * FROM alumno WHERE activo = 1 AND id_alumno = $id_alumno";
    $res = mysqli_query($conn, $sql);
    if ($res == TRUE) {
        $count = mysqli_num_rows($res);
        if ($count > 0) {
            while ($rows = mysqli_fetch_assoc($res)) {
                $nombre = $rows['nombre'];
                $apellido = $rows['apellido'];
                $matricula = $rows['matricula'];
                $email = $rows['email'];
                $imagen_perfil = $rows['img_perfil_nombre'];
            }
        }
    }
    ?>
    <div class="container-fluid mb-5">
        <section class="section">
            <div class="row">
                <?php
                if (isset($_SESSION['upload'])) {
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);
                }
                ?>
            </div>
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <div class="card card-cascade narrower">
                        <div class="view view-cascade gradient-card-header verde-conalep">
                            <h5 class="mb-0 font-weight-bold">Foto de Perfil</h5>
                        </div>
                        <div class="card-body card-body-cascade text-center">
                            <?php
                            if ($imagen_perfil != "") {
                            ?><img src="../img/img_perfil/<?php echo $imagen_perfil; ?>" alt="User Photo" class="rounded-circle z-depth-1 mb-3 mx-auto" /></i><?php
                                                                                                                                                            } else {
                                                                                                                                                                ?><i class="fas fa-user-circle mb-3 mx-auto" style="font-size: 6rem;"></i><?php
                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                            if (isset($_SESSION['upload'])) {
                                                                                                                                                                                                                                                echo $_SESSION['upload'];
                                                                                                                                                                                                                                                unset($_SESSION['upload']);
                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                                ?>
                            <div class="row flex-center">
                                <a href="" class="btn verde-conalep btn-rounded btn-sm white-text" data-toggle="modal" data-target="#modalSubirFoto">Subir Nueva Foto</i></a>
                                <a href="<?php echo SITEURL; ?>alumno/eliminar_img_perfil.php?id=<?php echo $id_alumno; ?>&img_perfil=<?php echo $imagen_perfil; ?>" class="btn btn-danger btn-rounded btn-sm">Eliminar</a>
                            </div>
                        </div>
                        <div class="modal fade" id="modalSubirFoto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog cascading-modal" role="document">
                                <div class="modal-content">
                                    <div class="modal-header verde-conalep white-text">
                                        <h4 class=""><i class="far fa-image"></i> Foto de Perfil</h4>
                                        <button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="" method="POST" enctype="multipart/form-data">
                                        <div class="modal-body mb-0">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroupFileAddon01"><i class="far fa-folder-open prefix"></i></span>
                                                </div>
                                                <div class="custom-file">
                                                    <input required type="file" name="image" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" accept="image/*">
                                                    <label class="custom-file-label" for="inputGroupFile01">Seleccionar archivo</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center mt-1-half">
                                            <input type="hidden" name="id" value="<?php echo $id_alumno ?>">
                                            <div class="row mb-1">
                                                <div class="col-6 mx-auto">
                                                    <button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-danger">Cancelar</a></button>
                                                </div>
                                                <div class="col-6 mx-auto">
                                                    <button type="submit" name="submit" class="btn verde-conalep">Subir <i class="fas fa-upload ml-1"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal: Contact form -->
                </div>
                <div class="col-lg-8 mb-4">
                    <div class="card card-cascade narrower">
                        <div class="view view-cascade gradient-card-header verde-conalep">
                            <h5 class="mb-0 font-weight-bold">Datos de la Cuenta</h5>
                        </div>
                        <div class="card-body card-body-cascade text-center">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="md-form mb-0">
                                        <input type="text" id="form1" class="form-control validate" value="<?php echo $nombre ?>" disabled>
                                        <label for="form1" data-error="wrong" data-success="right">Nombre(s)</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="md-form mb-0">
                                        <input type="text" id="form2" class="form-control validate" value="<?php echo $apellido ?>" disabled>
                                        <label for="form2" data-error="wrong" data-success="right">Apellido(s)</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="md-form mb-0">
                                        <input type="text" id="form81" class="form-control validate" value="<?php echo $matricula ?>" disabled>
                                        <label for="form81" data-error="wrong" data-success="right">Matricula</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="md-form mb-0">
                                        <input type="text" id="form82" class="form-control validate" value="<?php echo $email ?>" disabled>
                                        <label for="form82" data-error="wrong" data-success="right">Email</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>
<?php include('partials/footer.php'); ?>
<?php
function resizeImage($resourceType, $image_width, $image_height)
{
    $resizeWidth = 200;
    $resizeHeight = 200;
    $imageLayer = imagecreatetruecolor($resizeWidth, $resizeHeight);
    imagecopyresampled($imageLayer, $resourceType, 0, 0, 0, 0, $resizeWidth, $resizeHeight, $image_width, $image_height);
    return $imageLayer;
}
if (isset($_POST['submit'])) {
    $upload = false;
    $id = $_POST['id'];
    $image_name = $_FILES['image']['tmp_name'];
    $sourceProperties = getimagesize($image_name);
    $resizeFileName = "Imagen_perfil_" . $id;
    $uploadPath = "../img/img_perfil/";
    $fileExt = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
    $uploadImageType = $sourceProperties[2];
    $sourceImageWidth = $sourceProperties[0];
    $sourceImageHeight = $sourceProperties[1];
    switch ($uploadImageType) {
        case IMAGETYPE_JPEG:
            $resourceType = imagecreatefromjpeg($image_name);
            $imageLayer = resizeImage($resourceType, $sourceImageWidth, $sourceImageHeight);
            imagejpeg($imageLayer, $uploadPath . $resizeFileName . '.' . $fileExt);
            $image_name = $resizeFileName . '.' . $fileExt;
            $_SESSION['imagen_perfil'] = $image_name;
            break;

        case IMAGETYPE_GIF:
            $resourceType = imagecreatefromgif($image_name);
            $imageLayer = resizeImage($resourceType, $sourceImageWidth, $sourceImageHeight);
            imagegif($imageLayer, $uploadPath . $resizeFileName . '.' . $fileExt);
            $image_name = $resizeFileName . '.' . $fileExt;
            $_SESSION['imagen_perfil'] = $image_name;
            break;

        case IMAGETYPE_PNG:
            $resourceType = imagecreatefrompng($image_name);
            $imageLayer = resizeImage($resourceType, $sourceImageWidth, $sourceImageHeight);
            imagepng($imageLayer, $uploadPath . $resizeFileName . '.' . $fileExt);
            $image_name = $resizeFileName . '.' . $fileExt;
            $_SESSION['imagen_perfil'] = $image_name;
            break;

        default:
            $upload = false;
            break;
    }
    move_uploaded_file($file, $uploadPath . $resizeFileName . "." . $fileExt);
    $upload = true;
    if ($upload == false) {
        $_SESSION['upload'] = "<div class='alert alert-danger'>Error al subir la imagen. </div>";
        header('location:' . SITEURL . 'alumno/perfil.php');
        die();
    }

    $sql = "UPDATE alumno SET img_perfil_nombre = '$image_name' WHERE id_alumno = $id";
    $res = mysqli_query($conn, $sql);
    if ($res == true) {
        $_SESSION['upload'] = "<div class='alert alert-success'>Foto de perfil actualizada</div>";
        header('location:' . SITEURL . 'alumno/perfil.php');
    } else {
        $_SESSION['upload'] = "<div class='alert alert-danger'>Error al actualizar imagen.</div>";
        header('location:' . SITEURL . 'alumno/perfil.php');
    }
}
?>