<!-- Head -->
<?php include('partials/head1.php'); ?>
<title>ENCLASE - Grupo</title>
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
            <a href="consultar_grupo.php"><i class="fas fa-arrow-circle-left verde-item" style="font-size: 35px;"></i></a>
                <h1 class="text-center my-5 h1">Actualizar Grupo</h1>
                <?php
                if(isset($_SESSION['id'])){
                    $id = $_SESSION['id'];
                }else{
                    $id = $_GET['id'];
                }
                $sql = "SELECT * FROM grupo WHERE id_grupo=$id";
                $res = mysqli_query($conn, $sql);
                if ($res == true) {
                    $count = mysqli_num_rows($res);
                    if ($count == 1) {
                        $row = mysqli_fetch_assoc($res);
                        $nombre = $row['nombre'];
                    } else {
                        header('location:' . SITEURL . 'admin/consultar_grupo.php');
                    }
                }
                ?>
                <?php
                if (isset($_SESSION['errorP'])) {
                    echo $_SESSION['errorP'];
                    unset($_SESSION['errorP']);
                }
                if (isset($_SESSION['actualizar'])) {
                    echo $_SESSION['actualizar'];
                    unset($_SESSION['actualizar']);
                }
                ?>
                <form class="register" action="" method="POST" onsubmit="return(validar());">
                    <div class="row mb-4">
                    <div class="col">
                            <div class="form-outline">
                                <input type="text" id="nombre" name="nombre" class="form-control" onkeyup="validarGrupo('nombre')" value="<?php echo $nombre;?>" required />
                                <label class="form-label" for="nombre" data-error=" Ingresa solo Numeros entre 101 y 699" data-success="right"></label>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="id" value="<?php echo $id ?>">
                    <div class="row mb-1">
                        <div class="col-6 mx-auto">
                            <a href="consultar_grupo.php" class="btn btn-danger btn-block">Cancelar</a>
                        </div>
                        <div class="col-6 mx-auto">
                            <button type="submit" name="submit" class="btn verde-conalep btn-block">Actualizar</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
</main>
<!-- Main -->

<?php include('partials/footer.php'); ?>
<script src="../js/validaciones.js"></script>

<?php
if (isset($_POST['submit'])) {
    if (isset($_POST['nombre']) && isset($_POST['id'])){ 
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $sql = "SELECT * FROM grupo WHERE nombre = '$nombre' AND activo = 1 AND id_grupo != $id";
        $res=mysqli_query($conn, $sql) or die(mysqli_error($conn));
        if (mysqli_num_rows($res)>0){
            $_SESSION['errorP'] = "<div class='alert alert-danger'>Ya existe un registro con ese Nombre</div>";
            $_SESSION['id'] = $id;
            header("location:" . SITEURL . 'admin/actualizar_grupo.php');
            die();
        }
        $sql = "UPDATE grupo SET
                nombre = '$nombre'
                WHERE id_grupo = '$id'";
        $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        if ($res == TRUE) {
            unset($_SESSION['id']);
            $_SESSION['actualizar'] = "<div class='alert alert-success'>Grupo Actualizado Correctamente</div>";
            header("location:" . SITEURL . 'admin/consultar_grupo.php');
            die();
        } else {
            $_SESSION['actualizar'] = "<div class='alert alert-danger'>Error al Actualizar</div>";
            header("location:" . SITEURL . 'admin/actualizar_grupo.php');
            die();
        }
    } else {
        $_SESSION['errorP'] = "<div class='alert alert-danger'>Todos los campos son requeridos</div>";
        $_SESSION['id'] = $id;
        header("location:" . SITEURL . 'admin/actualizar_grupo.php');
        die();
    }
}
?>

<?php ob_end_flush(); ?>