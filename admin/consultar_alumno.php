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
                        <h5 class="my-4 dark-grey-text font-weight-bold">Tabla Alumno</h5>
                    </div>
                    <div class="col-md-4 d-flex justify-content-end">
                        <div class="btn-group">
                            <button type="button" class="btn btn-add" data-toggle="dropdown" aria-expanded="false">
                                AGREGAR <i class="fas fa-plus-circle"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="agregar_alumno.php">Nuevo Registro</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="importar_datos_alumno.php">Importar Datos</a>
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
                        <table id="tabla_0-7" class="table table-striped" cellspacing="0" width="100%">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Matricula</th>
                                    <th>Nombre(s)</th>
                                    <th>Apellido(s)</th>
                                    <th>Email</th>
                                    <th>Teléfono</th>
                                    <th>F.Ingreso</th>
                                    <th>F.Nacimiento</th>
                                    <th>Carrera</th>
                                    <th>Grupo</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT a.id_alumno,
                                                a.nombre, 
                                                a.apellido, 
                                                a.matricula, 
                                                a.email, 
                                                a.telefono,
                                                a.fecha_ingreso,
                                                a.fecha_nacimiento,
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
                                            $telefono = $rows['telefono'];
                                            $fecha_ingreso = $rows['fecha_ingreso'];
                                            $fecha_nacimiento = $rows['fecha_nacimiento'];
                                            $carrera = $rows['carrera'];
                                            $sql2 = "SELECT g.nombre AS grupo
                                                    FROM alumno a 
                                                    JOIN grupo g ON a.grupo_id = g.id_grupo
                                                    WHERE a.id_alumno = $id AND a.activo = 1";
                                            $res2 = mysqli_query($conn, $sql2);
                                            $count2 = mysqli_num_rows($res2);
                                            if ($count2 > 0) {
                                                $rows2 = mysqli_fetch_assoc($res2);      
                                                $grupo = $rows2['grupo'];
                                            }else{
                                                $grupo = "Sin Grupo Asignado";
                                            }

                                ?>
                                            <tr>
                                                <td><?php echo $matricula ?></td>
                                                <td><?php echo $nombre ?></td>
                                                <td><?php echo $apellido ?></td>
                                                <td><?php echo $email ?></td>
                                                <td><?php echo $telefono ?></td>
                                                <td><?php echo $fecha_ingreso ?></td>
                                                <td><?php echo $fecha_nacimiento ?></td>
                                                <td><?php echo $carrera ?></td>
                                                <td><?php echo $grupo ?></td>
                                                <td>
                                                    <a style="width: 9.5rem; margin-bottom: 5px;" class="btn btn-primary btn-sm text-nowrap" href="<?php echo SITEURL; ?>admin/actualizar_pass_alumno.php?id=<?php echo $id; ?>">Cambiar Password</a>
                                                    <a style="width: 9.5rem; margin-bottom: 5px;" class="btn btn-info btn-sm text-nowrap" href="<?php echo SITEURL; ?>admin/actualizar_alumno.php?id=<?php echo $id; ?>">Modificar</a>
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
                                                                            <p>¿Estas seguro que deseas eliminar este registro?</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer justify-content-center">
                                                                    <a href="<?php echo SITEURL; ?>admin/eliminar_alumno.php?id=<?php echo $id; ?>" type="button" class="btn btn-danger">Eliminar</a>
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

<?php include('partials/footer.php'); ?>