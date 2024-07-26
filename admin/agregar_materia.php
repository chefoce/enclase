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
                <div class="row">
                    <div class="col-4">
                        <a href="consultar_materia.php"><i class="fas fa-arrow-circle-left verde-item" style="font-size: 35px;"></i></a>
                    </div>
                    <div class="col-8">
                        <a class="btn verde-conalep float-right waves-effect waves-light" href="importar_datos_materia.php" role="button">
                            <i class="fas fa-file-excel mr-2"></i>
                            Importar
                        </a>
                    </div>
                </div>
                <h1 class="text-center my-5 h1">Nueva Materia</h1>
                <?php
                if (isset($_SESSION['errorE'])) {
                    echo $_SESSION['errorE'];
                    unset($_SESSION['errorE']);
                }
                if (isset($_SESSION['errorP'])) {
                    echo $_SESSION['errorP'];
                    unset($_SESSION['errorP']);
                }
                ?>
                <form class="register" action="" method="POST" onsubmit="return(validar());">
                    <div class="row mb-4">
                        <div class="col">
                            <div class="form-outline">
                                <input type="text" id="nombre" placeholder="Nombre Materia" name="nombre" onkeyup="soloLetras('nombre')" class="form-control" value="<?php
                                                                                                                                        if (isset($_SESSION['nombre'])) {
                                                                                                                                            echo $_SESSION['nombre'];
                                                                                                                                        } else {
                                                                                                                                            echo '';
                                                                                                                                        } ?>" required />
                                <label class="form-label" for="nombre" data-error=" Ingresa solo letras" data-success="right"></label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-outline">
                                <select name="semestre" required class="mdb-select colorful-select dropdown-primary">
                                    <option value="" disabled selected>Seleccionar Semestre</option>
                                    <option <?php if (isset($_SESSION['semestre'])){if ($_SESSION['semestre'] == 1) { echo "selected";} } ?> value="1">1</option>
                                    <option <?php if (isset($_SESSION['semestre'])){if ($_SESSION['semestre'] == 2) { echo "selected";} } ?> value="2">2</option>
                                    <option <?php if (isset($_SESSION['semestre'])){if ($_SESSION['semestre'] == 3) { echo "selected";} } ?> value="3">3</option>
                                    <option <?php if (isset($_SESSION['semestre'])){if ($_SESSION['semestre'] == 4) { echo "selected";} } ?> value="4">4</option>
                                    <option <?php if (isset($_SESSION['semestre'])){if ($_SESSION['semestre'] == 5) { echo "selected";} } ?> value="5">5</option>
                                    <option <?php if (isset($_SESSION['semestre'])){if ($_SESSION['semestre'] == 6) { echo "selected";} } ?> value="6">6</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-6 mx-auto">
                            <a href="consultar_materia.php" class="btn btn-danger btn-block">Cancelar</a>
                        </div>
                        <div class="col-6 mx-auto">
                            <button type="submit" name="submit" class="btn verde-conalep btn-block">Registrar</button>
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
        $nombre = $_POST['nombre'];
        $semestre = $_POST['semestre']; 
        $sql = "SELECT * FROM materia WHERE nombre = '$nombre' AND activo = 1";
        $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        if (mysqli_num_rows($res) > 0) {
            $_SESSION['errorP'] = "<div class='alert alert-danger'>Ya existe un registro con ese Nombre</div>";
            $_SESSION['nombre'] = $nombre;
            $_SESSION['semestre'] = $semestre;
            header("location:" . SITEURL . 'admin/agregar_materia.php');
            die();
        }
        $sql2 = "INSERT INTO materia SET
                nombre = '$nombre',
                semestre = $semestre,
                activo = 1";
        $res = mysqli_query($conn, $sql2) or die(mysqli_error($conn));
        if ($res == TRUE) {
            unset($_SESSION['nombre']);
            unset($_SESSION['semestre']);
            $_SESSION['agregar'] = "<div class='alert alert-success'>Materia Agregada Correctamente</div>";
            header("location:" . SITEURL . 'admin/consultar_materia.php');
            die();
        } else {
            $_SESSION['agregar'] = "<div class='alert alert-danger'>Error al Agregar</div>";
            $_SESSION['nombre'] = $nombre;
            $_SESSION['semestre'] = $semestre;
            header("location:" . SITEURL . 'admin/agregar_materia.php');
            die();
        }
    } else {
        $_SESSION['errorP'] = "<div class='alert alert-danger'>Todos los campos son requeridos</div>";
        $_SESSION['nombre'] = $nombre;
        $_SESSION['semestre'] = $semestre;
        header("location:" . SITEURL . 'admin/agregar_materia.php');
        die();
    }
}
?>

<?php
ob_end_flush();
?>