<!-- Head -->
<?php include('partials/head1.php'); ?>
<title>ENCLASE - Tutor</title>
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
                        <h5 class="my-4 dark-grey-text font-weight-bold">Tabla Tutor</h5>
                    </div>
                    <div class="col-md-4 d-flex justify-content-end">
                        <div class="btn-group">
                            <button type="button" class="btn btn-add" data-toggle="dropdown" aria-expanded="false">
                                AGREGAR <i class="fas fa-plus-circle"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="agregar_tutor.php">Nuevo Registro</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="importar_datos_tutor.php">Importar Datos</a>
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
                    if (isset($_SESSION['cambio_password'])) {
                        echo $_SESSION['cambio_password'];
                        unset($_SESSION['cambio_password']);
                    }
                    if (isset($_SESSION['errorP'])) {
                        echo $_SESSION['errorP'];
                        unset($_SESSION['errorP']);
                    }
                    if (isset($_SESSION['exito'])) {
                        echo $_SESSION['exito'];
                        unset($_SESSION['exito']);
                    }
                    if (isset($_SESSION['error'])) {
                        echo $_SESSION['error'];
                        unset($_SESSION['error']);
                    }
                    ?>
                </div>
                <div class="card">
                    <div class="card-body table-responsive">
                        <table id="tabla_1-6" class="table table-striped" cellspacing="0" width="100%">
                            <thead class="thead-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre(s)</th>
                                    <th>Apellido(s)</th>
                                    <th>Email</th>
                                    <th>Teléfono</th>
                                    <th>Nombre Alumno</th>
                                    <th>Apellido Alumno</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT t.id_tutor,
                                            t.nombre,
                                            t.apellido,
                                            t.email,
                                            t.telefono,
                                            a.nombre AS nombre_alumno,
                                            a.apellido AS apellido_alumno
                                    FROM tutor t
                                    JOIN alumno a ON t.alumno_id = a.id_alumno
                                    WHERE t.activo = 1";
                                $res = mysqli_query($conn, $sql);
                                if ($res == TRUE) {
                                    $count = mysqli_num_rows($res);
                                    if ($count > 0) {
                                        while ($rows = mysqli_fetch_assoc($res)) {
                                            $id = $rows['id_tutor'];
                                            $nombre = $rows['nombre'];
                                            $apellido = $rows['apellido'];
                                            $email = $rows['email'];
                                            $telefono = $rows['telefono'];
                                            $nombre_alumno = $rows['nombre_alumno'];
                                            $apellido_alumno = $rows['apellido_alumno'];
                                ?>
                                            <tr>
                                                <td><?php echo $id; ?></td>
                                                <td><?php echo $nombre; ?></td>
                                                <td><?php echo $apellido; ?></td>
                                                <td><?php echo $email; ?></td>
                                                <td><?php echo $telefono; ?></td>
                                                <td><?php echo $nombre_alumno; ?></td>
                                                <td><?php echo $apellido_alumno; ?></td>
                                                <td>
                                                    <a style="width: 9.5rem; margin-bottom: 5px;" class="btn btn-primary btn-sm" href="<?php echo SITEURL; ?>admin/actualizar_pass_tutor.php?id=<?php echo $id; ?>">Cambiar Password</a>
                                                    <a style="width: 9.5rem; margin-bottom: 5px;" class="btn btn-info btn-sm" href="<?php echo SITEURL; ?>admin/actualizar_tutor.php?id=<?php echo $id; ?>">Modificar</a>
                                                    <a style="width: 9.5rem; margin-bottom: 5px;" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalEliminar<?php echo $id; ?>">Eliminar</a>
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
                                                                            <p>¿Estas seguro que deseas eliminar este registro?</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer justify-content-center">
                                                                    <a href="<?php echo SITEURL; ?>admin/eliminar_tutor.php?id=<?php echo $id; ?>" type="button" class="btn btn-danger">Eliminar</a>
                                                                    <a type="button" class="btn btn-outline-danger waves-effect" data-dismiss="modal">Cancelar</a>
                                                                </div>
                                                            </div>
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
</main>

<?php include('partials/footer.php'); ?>