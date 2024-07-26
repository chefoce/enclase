<!-- Head -->
<?php include('partials/head1.php'); ?>
<title>ENCLASE - Reporte Asistencia</title>
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
                        <h5 class="my-4 dark-grey-text font-weight-bold">Reporte Asistencia Alumno</h5>
                    </div>
                </div>
                <div class="row">
                </div>
                <div class="card">
                    <div class="card-body table-responsive">
                        <table id="tabla_alumnos" class="table table-striped " cellspacing="0" width="100%">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Nombre(s)</th>
                                    <th>Apellido(s)</th>
                                    <th>Grupo</th>
                                    <th>Materia</th>
                                    <th>Semestre</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT a.id_alumno,
                                                a.nombre AS nombre_alumno,
                                                a.apellido AS apellido_alumno,
                                                g.nombre AS grupo,
                                                m.nombre AS materia,
                                                m.semestre AS semestre
                                        FROM alumno_docente ad
                                        JOIN alumno a ON ad.alumno_id = a.id_alumno
                                        JOIN docente_materia dm ON ad.dm_id = dm.id_dm
                                        JOIN grupo g ON dm.grupo_id = g.id_grupo
                                        JOIN materia m ON dm.materia_id = m.id_materia
                                        WHERE dm.docente_id = 10 AND ad.activo = 1;";
                                $res = mysqli_query($conn, $sql);
                                if ($res == TRUE) {
                                    $count = mysqli_num_rows($res);
                                    if ($count > 0) {
                                        while ($rows = mysqli_fetch_assoc($res)) {
                                            $id = $rows['id_alumno'];
                                            $nombre_alumno = $rows['nombre_alumno'];
                                            $apellido_alumno = $rows['apellido_alumno'];
                                            $grupo = $rows['grupo'];
                                            $materia = $rows['materia'];
                                            $semestre = $rows['semestre'];

                                ?>
                                            <tr>
                                                <td><?php echo $nombre_alumno ?></td>
                                                <td><?php echo $apellido_alumno ?></td>
                                                <td><?php echo $grupo ?></td>
                                                <td><?php echo $materia ?></td>
                                                <td><?php echo $semestre ?></td>
                                                <td>
                                                    <a style="width: 9.5rem; margin-bottom: 5px;" class="btn btn-primary btn-sm text-nowrap" href="<?php echo SITEURL; ?>docente/consultar_asistencia_alumno.php?id=<?php echo $id; ?>">Consultar Asistencia</a>
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