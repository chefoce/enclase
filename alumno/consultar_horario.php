<!-- Head -->
<?php include('partials/head1.php'); ?>
<title>ENCLASE - Horario</title>
<?php include('partials/head2.php'); ?>
<?php
$nombre = $_SESSION['nombre_sesion'];
$apellido = $_SESSION['apellido_sesion'];
$grupo = $_SESSION['grupo'];
$sql = "SELECT * FROM grupo WHERE id_grupo = $grupo";
$res = mysqli_query($conn, $sql);
if ($res == true) {
    $count = mysqli_num_rows($res);
    if ($count > 0) {
        $row = mysqli_fetch_assoc($res);
        $horario_nombre = $row['archivo_horario_nombre'];
        if ($horario_nombre == "") {
            $_SESSION['error'] = "<div class='alert alert-danger'>Sin Horario Asignado.</div>";
        }
    } else {
        $_SESSION['error'] = "<div class='alert alert-danger'>Sin Horario Asignado.</div>";
    }
} else {
    $_SESSION['error'] = "<div class='alert alert-danger'>Sin Horario Asignado.</div>";
}
?>
<!-- Sidebar -->
<?php include('partials/sidebar.php'); ?>
<!-- Navbar -->
<?php include('partials/navbar.php'); ?>

<!-- Main -->
<main>
    <div class="container-fluid mb-5">
        <?php
        if (isset($_SESSION['error'])) {
            echo $_SESSION['error'];
            unset($_SESSION['error']);
        }
        ?>
        <section>
            <?php
            if ($horario_nombre != "") {
            ?>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-8">
                            <h5 class="my-4 dark-grey-text font-weight-bold">Horario Alumno</h5>
                        </div>
                        <div class="col-md-4 d-flex justify-content-end">
                                <a href="<?php echo SITEURL; ?>img/horario_grupo/<?php echo $horario_nombre; ?>" download="Horario <?php echo $nombre; ?> <?php echo $apellido; ?>" class="btn btn-add">
                                    DESCARGAR <i class="fas fa-download"></i>
                                </a>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body text-center">
                            <div class="embed-responsive embed-responsive-16by9">
                                <embed class="embed-responsive-item" src="<?php echo SITEURL; ?>img/horario_grupo/<?php echo $horario_nombre; ?>" alt="pdf" pluginspage="http://www.adobe.com/products/acrobat/readstep2.html">
                            </div>
                        </div>

                    </div>
                </div>
            <?php
            }
            ?>
        </section>
    </div>
</main>
<!-- Main -->

<?php include('partials/footer.php'); ?>