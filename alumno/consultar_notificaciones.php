<!-- Head -->
<?php include('partials/head1.php'); ?>
<title>ENCLASE - Notificaciones</title>
<?php include('partials/head2.php'); ?>
<!-- Sidebar -->
<?php include('partials/sidebar.php'); ?>
<!-- Navbar -->
<?php include('partials/navbar.php'); ?>

<!-- Main -->
<main>
    <div class="container-fluid mb-5">
        <section>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-8">
                        <h5 class="my-4 dark-grey-text font-weight-bold">Notificaciones</h5>
                    </div>
                </div>
                <div class="row">
                    <?php
                    if (isset($_SESSION['eliminar'])) {
                        echo $_SESSION['eliminar'];
                        unset($_SESSION['eliminar']);
                    }
                    ?>
                </div>
                <div class="card">
                    <div class="card-body table-responsive">
                        <table id="dtMaterialDesignExample" class="table table-striped" cellspacing="0" width="100%">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Fecha/Hora</th>
                                    <th>Mensaje</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT * FROM notificaciones WHERE alumno_id = $id_alumno AND rol_notificacion = 2 ORDER BY fecha DESC;";
                                $res = mysqli_query($conn, $sql);
                                if ($res == TRUE) {
                                    $count = mysqli_num_rows($res);
                                    if ($count > 0) {
                                        while ($rows = mysqli_fetch_assoc($res)) {
                                            $id_notificacion = $rows["id_notificacion"];
                                            $fechaOriginal = $rows["fecha"];
                                            $fechaFormateada = date("j/n/y-h:iA", strtotime($fechaOriginal));
                                            $mensaje = $rows["mensaje"];
                                            $mensaje_2 = $rows["mensaje_2"];


                                ?>
                                            <tr>
                                                <td><?php echo $fechaFormateada ?></td>
                                                <td><?php echo $mensaje_2 ?></td>
                                                <td>
                                                    <a class="btn-floating btn-sm btn-danger" href="<?php echo SITEURL; ?>alumno/eliminar_notificacion.php?id=<?php echo $id_notificacion; ?>"><i class="far fa-trash-alt"></i></a>
                                                </td>
                                            </tr>
                                <?php
                                        }
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
            <!-- Gird column -->
</main>
<!-- Main -->

<?php include('partials/footer.php'); ?>