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
    <div class="container-fluid mb-5">

        <!-- Section: Basic examples -->
        <section>

            <!-- Gird column -->
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-8">
                        <h5 class="my-4 dark-grey-text font-weight-bold">Horarios Grupos</h5>
                        <?php
                        if (isset($_SESSION['upload'])) {
                            echo $_SESSION['upload'];
                            unset($_SESSION['upload']);
                        }
                        if (isset($_SESSION['errorH'])) {
                            echo $_SESSION['errorH'];
                            unset($_SESSION['errorH']);
                        }
                        if (isset($_SESSION['error-eliminar'])) {
                            echo $_SESSION['error-eliminar'];
                            unset($_SESSION['error-eliminar']);
                        }
                        if (isset($_SESSION['eliminar'])) {
                            echo $_SESSION['eliminar'];
                            unset($_SESSION['eliminar']);
                        }
                        ?>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body table-responsive">
                        <table id="dtMaterialDesignExample" class="table table-striped" cellspacing="0" width="100%">
                            <thead class="thead-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Grupo</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT * FROM grupo WHERE activo = 1";
                                $res = mysqli_query($conn, $sql);
                                if ($res == TRUE) {
                                    $count = mysqli_num_rows($res);
                                    if ($count > 0) {
                                        while ($rows = mysqli_fetch_assoc($res)) {
                                            $id = $rows['id_grupo'];
                                            $nombre = $rows['nombre'];
                                            $archivo_nombre = $rows['archivo_horario_nombre'];

                                ?>
                                            <tr>
                                                <td><?php echo $id ?></td>
                                                <td><?php echo $nombre ?></td>
                                                <td>
                                                    <button <?php if ($archivo_nombre !== "") {echo "disabled";} ?> class="btn btn-success btn-sm"><a href="<?php echo SITEURL; ?>admin/agregar_horario_grupo.php?id=<?php echo $id; ?>" style="color: #FFF;">Asignar Horario</a></button>
                                                    <button <?php if ($archivo_nombre == "") {echo "disabled";} ?> class="btn btn-primary btn-sm"><a target="_blank" href="<?php echo SITEURL; ?>admin/ver_horario_grupo.php?archivo_nombre=<?php echo $archivo_nombre; ?>" style="color: #FFF;">Ver Horario</a></button>
                                                    <button <?php if ($archivo_nombre == "") {echo "disabled";} ?> class="btn btn-info btn-sm"><a href="<?php echo SITEURL; ?>admin/actualizar_horario_grupo.php?id=<?php echo $id; ?>&archivo_nombre=<?php echo $archivo_nombre; ?>" style="color: #FFF;">Modificar</a></button>
                                                    <button <?php if ($archivo_nombre == "") {echo "disabled";} ?> class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalEliminar">Eliminar</button>
                                                    <div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                                                            <p>¿Estas seguro que deseas eliminar este horario?</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer justify-content-center">
                                                                    <a href="<?php echo SITEURL; ?>admin/eliminar_horario_grupo.php?id=<?php echo $id; ?>&archivo_nombre=<?php echo $archivo_nombre; ?>" type="button" class="btn btn-danger">Eliminar</a>
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