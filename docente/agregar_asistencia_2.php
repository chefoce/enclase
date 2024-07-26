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
                        <a href="agregar_asistencia_1.php"><i class="my-4 fas fa-arrow-circle-left btn-atras"></i></a>
                    </div>
                    <div class="col-6 d-flex justify-content-center">
                        <h3 class="my-4 dark-grey-text font-weight-bold">Tomar Asistencia</h3>
                    </div>
                    <div class="col">

                    </div>
                </div>
                <form action="" method="POST">
                    <div class="row">
                        <?php
                        $id_dm = $_GET['id'];
                        $sql = "SELECT g.nombre AS grupo,
                                    m.nombre AS materia,
                                    p.nombre AS periodo
                            FROM docente_materia dm
                            JOIN grupo g ON dm.grupo_id = g.id_grupo
                            JOIN materia m ON dm.materia_id = m.id_materia
                            JOIN periodo p ON dm.periodo_id = p.id_periodo
                            WHERE dm.id_dm = $id_dm AND dm.activo = 1;";
                        $res = mysqli_query($conn, $sql);
                        if ($res == TRUE) {
                            $count = mysqli_num_rows($res);
                            if ($count == 1) {
                                $row = mysqli_fetch_assoc($res);
                                $grupo = $row['grupo'];
                                $materia = $row['materia'];
                                $periodo = $row['periodo'];
                                $hoy = date('d-m-Y');
                            } else {
                                header('location:' . SITEURL . 'docente/agregar_asistencia_1.php');
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
                            <input type="text" id="fecha" name="fecha" class="mb-2 form-control" value="<?php echo $hoy; ?>" disabled>
                        </div>
                    </div>
                    <div class="row">
                        <?php
                        if (isset($_SESSION['error'])) {
                            echo $_SESSION['error'];
                            unset($_SESSION['error']);
                        }
                        ?>
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
                                    $sql = "SELECT ad.alumno_id,
                                                a.nombre AS nombre_alumno,
                                                a.apellido AS apellido_alumno,
                                                a.matricula AS matricula
                                        FROM alumno_docente ad
                                        JOIN alumno a ON ad.alumno_id = a.id_alumno
                                        WHERE ad.dm_id = $id_dm AND ad.activo = 1 ORDER BY apellido_alumno ASC";
                                    $res = mysqli_query($conn, $sql);
                                    if ($res == TRUE) {
                                        $count = mysqli_num_rows($res);
                                        if ($count > 0) {;
                                            while ($rows = mysqli_fetch_array($res)) {
                                                $i++;
                                                $alumno_id = $rows['alumno_id'];
                                                $nombre_alumno = $rows['nombre_alumno'];
                                                $apellido_alumno = $rows['apellido_alumno'];

                                    ?>
                                                <tr>
                                                    <td><?php echo $i ?><input type="hidden" name="alumno_id[]" value="<?php echo $alumno_id; ?>" /></td>
                                                    <td><?php echo $apellido_alumno ?><input type="hidden" name="id_dm" value="<?php echo $id_dm; ?>" /></td>
                                                    <td><?php echo $nombre_alumno ?><input type="hidden" name="docente_id" value="<?php echo  $_SESSION['id_sesion']; ?>" /></td>
                                                    <td>
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" class="custom-control-input" id="presente<?php echo $radio; ?>" name="asistencia[<?php echo $radio; ?>]" value="Presente">
                                                            <label class="custom-control-label" for="presente<?php echo $radio; ?>">Presente</label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" class="custom-control-input" id="retardo<?php echo $radio; ?>" name="asistencia[<?php echo $radio; ?>]" value="Retardo">
                                                            <label class="custom-control-label" for="retardo<?php echo $radio; ?>">Retardo</label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" class="custom-control-input" id="ausente<?php echo $radio; ?>" name="asistencia[<?php echo $radio; ?>]" value="Ausente" checked>
                                                            <label class="custom-control-label" for="ausente<?php echo $radio; ?>">Ausente</label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" class="custom-control-input" id="justificante<?php echo $radio; ?>" name="asistencia[<?php echo $radio; ?>]" value="Justificante">
                                                            <label class="custom-control-label" for="justificante<?php echo $radio; ?>">Justificante</label>
                                                        </div>
                                                    </td>
                                                    <td><input type="text" name="observaciones[]" placeholder="Observaciones" style="width: 100%;" /></td>

                                                </tr>
                                    <?php
                                                $radio++;
                                            }
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <input type="hidden" name="materia" value="<?php echo $materia; ?>" />
                            <div class="row mb-1">
                                <div class="col-6 mx-auto">
                                    <a href="agregar_asistencia_1.php" class="btn btn-danger btn-block">Cancelar</a>
                                </div>
                                <div class="col-6 mx-auto">
                                    <button type="submit" name="submit" class="btn verde-conalep btn-block">Guardar Asistencia</button>
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
    $dm_id = $_POST['id_dm'];
    $docente_id = $_POST['docente_id'];
    $materia = $_POST['materia'];
    try {
        foreach ($_POST['asistencia'] as $i => $asistencia) {
            $alumno_id = $_POST['alumno_id'][$i];
            $observaciones = $_POST['observaciones'][$i];
            $fecha = $_POST['fecha'];
            $fecha = strtotime($fecha);
            $fecha = date('Y/m/d', $fecha);
            $hora = date("H:i:s");
            $sql = "INSERT INTO asistencia SET
            alumno_id = '$alumno_id',
            dm_id = '$dm_id',
            asistencia = '$asistencia',
            observaciones = '$observaciones',
            fecha = '$fecha',
            hora = '$hora'";

            if ($observaciones == "") {
                $msj_obs = "Sin Observaciones";
            } else {
                $msj_obs = $observaciones;
            }
            $mensaje = $asistencia . " en " . $materia;
            $mensaje2 = $asistencia . " en " . $materia . ", Docente: " . $_SESSION['nombre_sesion'] . " " . $_SESSION['apellido_sesion'] . " Observaciones: " . $msj_obs;
            $sql2 = "INSERT INTO notificaciones SET
            mensaje = '$mensaje',
            mensaje_2 = '$mensaje2',
            estado = 0,
            docente_id = $docente_id,
            alumno_id = $alumno_id,
            rol_notificacion = 2";

            $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
            $res2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));

            $_SESSION['exito'] = "<div class='alert alert-success'>Asistencia Guardada Correctamente</div>";
            header("location:" . SITEURL . 'docente/actualizar_asistencia_2.php?dm_id=' . $dm_id . '&fecha=' . $fecha . '');
        }
    } catch (Exception $e) {
        $error_msg = $e->$getMessage();
        $_SESSION['error'] = "<div class='alert alert-danger'>Error al Guardar Asistencia $error_msg</div>";
        header("location:" . SITEURL . 'docente/agregar_asistencia_2.php');
    }
}
?>