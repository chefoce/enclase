<!-- Head -->
<?php include('partials/head1.php'); ?>
<title>ENCLASE - Alumno</title>
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
                        <h5 class="my-4 dark-grey-text font-weight-bold">Consultar Asistencia</h5>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body table-responsive">
                        <table id="dtMaterialDesignExample" class="table table-striped" cellspacing="0" width="100%">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Matricula</th>
                                    <th>Nombre(s)</th>
                                    <th>Apellido(s)</th>
                                    <th>Email</th>
                                    <th>Carrera</th>
                                    <th>Asistencia</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT a.id_alumno,
                                                a.nombre, 
                                                a.apellido, 
                                                a.matricula, 
                                                a.email, 
                                                c.carrera
                                            FROM alumno a 
                                            JOIN carrera c ON a.carrera_id = c.id_carrera
                                            WHERE a.activo = 1 ORDER BY a.matricula ASC";
                                $res = mysqli_query($conn, $sql);
                                if ($res == TRUE) {
                                    $count = mysqli_num_rows($res);
                                    if ($count > 0) {
                                        while ($rows = mysqli_fetch_assoc($res)) {
                                            $id = $rows['id_alumno'];
                                            $nombre = $rows['nombre'];
                                            $apellido = $rows['apellido'];
                                            $matricula = $rows['matricula'];
                                            $email = $rows['email'];
                                            $carrera = $rows['carrera'];
                                            $grupo = $rows['nombre'];

                                ?>
                                            <tr>
                                                <td><?php echo $matricula ?></td>
                                                <td><?php echo $nombre ?></td>
                                                <td><?php echo $apellido ?></td>
                                                <td><?php echo $email ?></td>
                                                <td><?php echo $carrera ?></td>
                                                <td>
                                                <a style="width: 9.5rem; margin-bottom: 5px;" class="btn verde-conalep btn-sm text-nowrap text-white" href="<?php echo SITEURL; ?>admin/consultar_asistencia_alumno.php?id=<?php echo $id; ?>">Ver Asistencia</a>
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