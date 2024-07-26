<!-- Head -->
<?php include('partials/head1.php'); ?>
<title>ENCLASE - Asistencia</title>
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
                    <div class="col">
                        <a href="actualizar_asistencia_1.php"><i class="my-4 fas fa-arrow-circle-left btn-atras"></i></a>
                    </div>
                    <div class="col-6 d-flex justify-content-center">
                        <h3 class="my-4 dark-grey-text font-weight-bold">Actualizar Asistencia</h3>
                    </div>
                    <div class="col">

                    </div>
                </div>
                <div class="row">
                    <?php
                    if (isset($_SESSION['error'])) {
                        echo $_SESSION['error'];
                        unset($_SESSION['error']);
                    }
                    if (isset($_SESSION['exito'])) {
                        echo $_SESSION['exito'];
                        unset($_SESSION['exito']);
                    }
                    ?>
                </div>
                <form action="" method="POST">
                    <div class="row">
                        <?php
                        $dm_id = $_GET['dm_id'];
                        $fecha = $_GET['fecha'];
                        $fecha = strtotime($fecha);
                        $fecha = date('Y/m/d', $fecha);
                        $sql = "SELECT g.nombre AS grupo,
                                    m.nombre AS materia,
                                    p.nombre AS periodo
                            FROM docente_materia dm
                            JOIN grupo g ON dm.grupo_id = g.id_grupo
                            JOIN materia m ON dm.materia_id = m.id_materia
                            JOIN periodo p ON dm.periodo_id = p.id_periodo
                            WHERE dm.id_dm = $dm_id AND dm.activo = 1";
                        $res = mysqli_query($conn, $sql);
                        if ($res == TRUE) {
                            $count = mysqli_num_rows($res);
                            if ($count == 1) {
                                $row = mysqli_fetch_assoc($res);
                                $grupo = $row['grupo'];
                                $materia = $row['materia'];
                                $periodo = $row['periodo'];
                                $fecha_formateada = strtotime($fecha);
                                $fecha_formateada  = date('d/m/Y', $fecha_formateada);
                            } else {
                                header('location:' . SITEURL . 'docente/consultar_asistencia_1.php');
                            }
                        }
                        ?>
                        <div class="col-md-1">
                            <p class="mb-1 dark-grey-text font-weight-bold">Grupo</p>
                            <input type="text" class="mb-2 form-control" value="<?php echo $grupo; ?>" disabled>
                        </div>
                        <div class="col-md-5">
                            <p class="mb-1 dark-grey-text font-weight-bold">Materia</p>
                            <input type="text" class="mb-2 form-control" value="<?php echo $materia; ?>" disabled>
                        </div>
                        <div class="col-md-3">
                            <p class="mb-1 dark-grey-text font-weight-bold">Periodo</p>
                            <input type="text" class="mb-2 form-control" value="<?php echo $periodo; ?>" disabled>
                        </div>
                        <div class="col-md-3">
                            <p class="mb-1 dark-grey-text font-weight-bold">Fecha</p>
                            <input type="text" class="mb-2 form-control" value="<?php echo $fecha_formateada; ?>" disabled>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body table-responsive">
                            <table class="table table-striped" cellspacing="0" width="100%">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>Apellido(s)</th>
                                        <th>Nombre(s)</th>
                                        <th class="text-center">PRESENTE</th>
                                        <th class="text-center">RETARDO</th>
                                        <th class="text-center">AUSENTE</th>
                                        <th class="text-center">JUSTIFICANTE</th>
                                        <th class="text-center">Observaciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    $radio = 0;
                                    $sql = "SELECT asi.id_asistencia,
                                                a.nombre,
                                                a.apellido,
                                                asi.asistencia,
                                                asi.observaciones,
                                                asi.fecha
                                        FROM asistencia asi
                                        JOIN alumno a ON asi.alumno_id = a.id_alumno
                                        WHERE asi.dm_id = $dm_id AND asi.fecha = '$fecha' ORDER BY a.apellido";
                                    $res = mysqli_query($conn, $sql);
                                    if ($res == TRUE) {
                                        $count = mysqli_num_rows($res);
                                        if ($count > 0) {
                                            while ($rows = mysqli_fetch_array($res)) {
                                                $i++;
                                                $id_asistencia = $rows['id_asistencia'];
                                                $nombre_alumno = $rows['nombre'];
                                                $apellido_alumno = $rows['apellido'];
                                                $asistencia = $rows['asistencia'];
                                                $observaciones = $rows['observaciones'];

                                    ?>
                                                <tr>
                                                    <td><?php echo $i ?><input type="hidden" name="id_asistencia[]" value="<?php echo $id_asistencia; ?>" /></td>
                                                    <td><?php echo $apellido_alumno ?></td>
                                                    <td><?php echo $nombre_alumno ?></td>
                                                    <td>
                                                        <div class="custom-control custom-radio">
                                                            <input <?php if ($asistencia == "Presente") {
                                                                        echo "checked";
                                                                    } ?> type="radio" class="custom-control-input" id="presente<?php echo $radio; ?>" name="asistencia[<?php echo $radio; ?>]" value="Presente">
                                                            <label class="custom-control-label" for="presente<?php echo $radio; ?>">Presente</label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="custom-control custom-radio">
                                                            <input <?php if ($asistencia == "Retardo") {
                                                                        echo "checked";
                                                                    } ?> type="radio" class="custom-control-input" id="retardo<?php echo $radio; ?>" name="asistencia[<?php echo $radio; ?>]" value="Retardo">
                                                            <label class="custom-control-label" for="retardo<?php echo $radio; ?>">Retardo</label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="custom-control custom-radio">
                                                            <input <?php if ($asistencia == "Ausente") {
                                                                        echo "checked";
                                                                    } ?> type="radio" class="custom-control-input" id="ausente<?php echo $radio; ?>" name="asistencia[<?php echo $radio; ?>]" value="Ausente">
                                                            <label class="custom-control-label" for="ausente<?php echo $radio; ?>">Ausente</label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="custom-control custom-radio">
                                                            <input <?php if ($asistencia == "Justificante") {
                                                                        echo "checked";
                                                                    } ?> type="radio" class="custom-control-input" id="justificante<?php echo $radio; ?>" name="asistencia[<?php echo $radio; ?>]" value="Justificante">
                                                            <label class="custom-control-label" for="justificante<?php echo $radio; ?>">Justificante</label>
                                                        </div>
                                                    </td>
                                                    <td><input type="text" name="observaciones[]" style="width: 100%;" placeholder="Sin Observaciones" value="<?php echo $observaciones; ?>" /></td>
                                                </tr>
                                            <?php
                                                $radio++;
                                            }
                                        } else {
                                            ?>
                                            <tr>
                                                <td colspan="12">
                                                    <h5 class="dark-grey-text font-weight-bold text-center">¡No existe registro de asistencia en el grupo y fecha seleccionada!</h5>
                                                </td>
                                            </tr>
                                    <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <div class="row mb-1">
                                <div class="col-6 mx-auto">
                                    <a href="actualizar_asistencia_1.php" class="btn btn-danger btn-block">Cancelar</a>
                                </div>
                                <div class="col-6 mx-auto">
                                    <button type="submit" name="submit" class="btn verde-conalep btn-block">Actualizar Asistencia</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
</main>

<?php include('partials/footer.php'); ?>
<?php
if (isset($_POST['submit'])) {
    try {
        foreach ($_POST['asistencia'] as $i => $asistencia) {
            $id_asistencia = $_POST['id_asistencia'][$i];
            $observaciones = $_POST['observaciones'][$i];
            $sql = "UPDATE asistencia SET 
                        asistencia = '$asistencia',
                        observaciones = '$observaciones' 
                    WHERE id_asistencia = $id_asistencia";

            $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

            $_SESSION['exito'] = "<div class='alert alert-success'>Asistencia Actualizada Correctamente</div>";
            header("location:" . SITEURL . 'docente/actualizar_asistencia_2.php?dm_id=' . $dm_id . '&fecha=' . $fecha . '');
        }
    } catch (Exception $e) {
        $error_msg = $e->$getMessage();
        $_SESSION['error'] = "<div class='alert alert-danger'>Error al Actualizar Asistencia $error_msg</div>";
        header("location:" . SITEURL . 'docente/actualizar_asistencia_2.php');
    }
}
?>