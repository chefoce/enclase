<!-- Head -->
<?php include('partials/head1.php'); ?>
<title>ENCLASE - Materia</title>
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
            <a href="consultar_materia.php"><i class="fas fa-arrow-circle-left verde-item" style="font-size: 35px;"></i></a>
                <h1 class="text-center my-5 h1">Actualizar Materia</h1>
                <?php
                if(isset($_SESSION['id'])){
                    $id = $_SESSION['id'];
                }else{
                    $id = $_GET['id'];
                }
                $sql = "SELECT * FROM materia WHERE id_materia=$id";
                $res = mysqli_query($conn, $sql);
                if ($res == true) {
                    $count = mysqli_num_rows($res);
                    if ($count == 1) {
                        $row = mysqli_fetch_assoc($res);
                        $nombre = $row['nombre'];
                        $semestre = $row['semestre'];
                    } else {
                        header('location:' . SITEURL . 'admin/consultar_materia.php');
                        die();
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
                                <input type="text" placeholder="Nombre Materia" id="nombre" name="nombre" class="form-control" onkeyup="soloLetras('nombre')" value="<?php echo $nombre;?>" required />
                                <label class="form-label" for="nombre" data-error=" Ingresa solo letras" data-success="right"></label>
                            </div>
                        </div>
                        <div class="col">
                        <div class="form-outline">
                                <select name="semestre" required class="mdb-select colorful-select dropdown-primary">
                                    <option value="" disabled selected>Seleccionar Semestre</option>
                                    <option <?php if ($semestre == 1) { echo "selected";} ?> value="1">1</option>
                                    <option <?php if ($semestre == 2) { echo "selected";} ?> value="2">2</option>
                                    <option <?php if ($semestre == 3) { echo "selected";} ?> value="3">3</option>
                                    <option <?php if ($semestre == 4) { echo "selected";} ?> value="4">4</option>
                                    <option <?php if ($semestre == 5) { echo "selected";} ?> value="5">5</option>
                                    <option <?php if ($semestre == 6) { echo "selected";} ?> value="6">6</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="id" value="<?php echo $id ?>">
                    <div class="row mb-1">
                        <div class="col-6 mx-auto">
                            <a href="consultar_materia.php" class="btn btn-danger btn-block">Cancelar</a>
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
    if (isset($_POST['nombre']) && isset($_POST['semestre'])){ 
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $semestre = $_POST['semestre'];
        $sql = "SELECT * FROM materia WHERE nombre = '$nombre' AND activo = 1 AND id_materia != $id";
        $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        if (mysqli_num_rows($res) > 0) {
            $_SESSION['errorP'] = "<div class='alert alert-danger'>Ya existe un registro con ese Nombre</div>";
            $_SESSION['id'] = $id;
            header("location:" . SITEURL . 'admin/actualizar_materia.php');
            die();
        }
        $sql = "UPDATE materia SET
                nombre = '$nombre',
                semestre = $semestre
                WHERE id_materia = '$id'";
        $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        if ($res == TRUE) {
            unset($_SESSION['id']);
            $_SESSION['actualizar'] = "<div class='alert alert-success'>Materia Actualizada Correctamente</div>";
            header("location:" . SITEURL . 'admin/consultar_materia.php');
        } else {
            $_SESSION['actualizar'] = "<div class='alert alert-danger'>Error al Actualizar</div>";
            header("location:" . SITEURL . 'admin/actualizar_materia.php');
        }
    } else {
        $_SESSION['errorP'] = "<div class='alert alert-danger'>Todos los campos son requeridos</div>";
        $_SESSION['id'] = $id;
        header("location:" . SITEURL . 'admin/actualizar_materia.php');
        die();
    }
}
?>

<?php
ob_end_flush();
?>