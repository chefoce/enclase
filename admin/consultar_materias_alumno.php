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

        <!-- Section: Basic examples -->
        <section>

            <!-- Gird column -->
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-8">
                        <h5 class="my-4 dark-grey-text font-weight-bold">Tabla Alumno Materias</h5>
                    </div>
                    <div class="col-md-4 d-flex justify-content-end">
                        <div class="btn-group">
                            <button type="button" class="btn btn-add" data-toggle="dropdown" aria-expanded="false">
                                AGREGAR <i class="fas fa-plus-circle"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="agregar_materia_alumno.php">Nuevo Registro</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="importar_datos_materia_alumno.php">Importar Datos</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php
                    if (isset($_SESSION['agregar'])) {
                        echo $_SESSION['agregar'];
                        unset($_SESSION['agregar']);
                    }
                    if (isset($_SESSION['actualizar'])) {
                        echo $_SESSION['actualizar'];
                        unset($_SESSION['actualizar']);
                    }
                    if (isset($_SESSION['eliminar'])) {
                        echo $_SESSION['eliminar'];
                        unset($_SESSION['eliminar']);
                    }
                    if (isset($_SESSION['exito'])) {
                        echo $_SESSION['exito'];
                        unset($_SESSION['exito']);
                    }
                    ?>
                </div>
                <div class="card">
                    <div class="card-body table-responsive">
                        <table id="tabla_0-7" class="table table-striped" cellspacing="0" width="100%">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Nombre Alumno</th>
                                    <th>Apellido Alumno</th>
                                    <th>Nombre Docente</th>
                                    <th>Apellido Docente</th>
                                    <th>Grupo</th>
                                    <th>Materia</th>
                                    <th>Semestre</th>
                                    <th>Periodo</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT ad.id_ad,
                                                a.nombre AS nombre_alumno,
                                                a.apellido AS apellido_alumno,
                                                d.nombre AS nombre_docente,
                                                d.apellido AS apellido_docente,
                                                g.nombre AS grupo,
                                                m.nombre AS materia,
                                                m.semestre AS semestre,
                                                p.nombre as periodo
                                        FROM alumno_docente ad 
                                        JOIN alumno a ON ad.alumno_id = a.id_alumno
                                        JOIN docente_materia dm ON ad.dm_id = dm.id_dm
                                        JOIN docente d ON dm.docente_id = d.id_docente
                                        JOIN grupo g ON dm.grupo_id = g.id_grupo
                                        JOIN materia m ON dm.materia_id = m.id_materia
                                        JOIN periodo p ON dm.periodo_id = p.id_periodo
                                        WHERE ad.activo = 1;";
                                $res = mysqli_query($conn, $sql);
                                if ($res == TRUE) {
                                    $count = mysqli_num_rows($res);
                                    if ($count > 0) {
                                        while ($rows = mysqli_fetch_assoc($res)) {
                                            $id = $rows['id_ad'];
                                            $nombre_alumno = $rows['nombre_alumno'];
                                            $apellido_alumno = $rows['apellido_alumno'];
                                            $nombre_docente = $rows['nombre_docente'];
                                            $apellido_docente = $rows['apellido_docente'];
                                            $grupo = $rows['grupo'];
                                            $materia = $rows['materia'];
                                            $semestre = $rows['semestre'];
                                            $periodo = $rows['periodo'];

                                ?>
                                            <tr>
                                                <td><?php echo $nombre_alumno ?></td>
                                                <td><?php echo $apellido_alumno ?></td>
                                                <td><?php echo $nombre_docente ?></td>
                                                <td><?php echo $apellido_docente ?></td>
                                                <td><?php echo $grupo ?></td>
                                                <td><?php echo $materia ?></td>
                                                <td><?php echo $semestre ?></td>
                                                <td><?php echo $periodo ?></td>
                                                <td>
                                                    <a style="width: 9.5rem; margin-bottom: 5px;" class="btn btn-info btn-sm text-nowrap" href="<?php echo SITEURL; ?>admin/actualizar_materia_alumno.php?id=<?php echo $id; ?>">Modificar</a>
                                                    <a style="width: 9.5rem; margin-bottom: 5px;" class="btn btn-danger btn-sm text-nowrap" data-toggle="modal" data-target="#modalEliminar<?php echo $id; ?>">Eliminar</a>
                                                    <div class="modal fade" id="modalEliminar<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-notify modal-danger" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <p class="heading">Cuidado</p>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true" class="white-text">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-9">
                                                                            <p>¿Estas seguro que deseas eliminar este registro? </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer justify-content-center">
                                                                    <a href="<?php echo SITEURL; ?>admin/eliminar_materia_alumno.php?id=<?php echo $id; ?>" type="button" class="btn btn-danger">Eliminar</a>
                                                                    <a type="button" class="btn btn-outline-danger waves-effect" data-dismiss="modal">Cancelar</a>
                                                                </div>
                                                            </div>
                                                            <!-- Content -->
                                                        </div>
                                                    </div>
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

<?php include('partials/footer.php');
