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
    <div class="container-fluid">
        <section class="section card mb-5">
            <div class="card-body">
            <a href="index.php"><i class="fas fa-arrow-circle-left verde-item" style="font-size: 35px;"></i></a>
                <h1 class="text-center my-5 h1">Actualizar Asistencia</h1>
                <?php
                if (isset($_SESSION['exito'])) {
                    echo $_SESSION['exito'];
                    unset($_SESSION['exito']);
                }
                if (isset($_SESSION['error'])) {
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                }
                ?>
                <form action="" method="POST">
                    <div class="row">
                        <div class="col-md-6">
                            <select name="grupo" required class="mdb-select colorful-select dropdown-primary md-form">
                                <?php
                                $sql = "SELECT dm.id_dm,
                                                g.nombre AS grupo,
                                                m.semestre AS semestre,
                                                m.nombre AS materia
                                        FROM docente_materia dm
                                        JOIN grupo g ON dm.grupo_id = g.id_grupo
                                        JOIN materia m ON dm.materia_id = m.id_materia
                                        WHERE dm.docente_id = $id_docente AND dm.activo = 1";
                                $res = mysqli_query($conn, $sql);
                                if ($res == TRUE) {
                                    $count = mysqli_num_rows($res);
                                    if ($count > 0) {
                                        ?> <option value="" disabled selected>Selecciona el Grupo</option> <?php
                                        while ($rows = mysqli_fetch_assoc($res)) {
                                            $id_dm = $rows['id_dm'];
                                            $grupo = $rows['grupo'];
                                            $semestre = $rows['semestre'];
                                            $materia = $rows['materia'];
                                ?>
                                            <option value="<?php echo $id_dm ?>">Grupo: "<?php echo $grupo ?>" | Semestre: "<?php echo $semestre ?>" | Materia: "<?php echo $materia ?>"</option>
                                <?php
                                        }
                                    }else{
                                        ?> <option value="" disabled selected>Sin grupos asignados</option> <?php
                                     }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <div class="md-form">
                                <input placeholder="Selecciona la Fecha" name="fecha" type="text" id="date-picker" class="form-control datepicker">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-6 mx-auto">
                            <a href="index.php" class="btn btn-danger btn-block">Cancelar</a>
                        </div>
                        <div class="col-6 mx-auto">
                            <button type="submit" name="submit" class="btn verde-conalep btn-block">Siguiente</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
</main>
<!-- Main -->

<?php include('partials/footer.php'); ?>

<?php
if (isset($_POST['submit'])) {
    $dm_id = $_POST['grupo'];
    $fecha = $_POST['fecha'];
    if($fecha == ""){
       $fecha = date('d-m-Y');
       header("location:" . SITEURL . 'docente/actualizar_asistencia_2.php?dm_id=' . $dm_id.'&fecha='.$fecha);
    }
    header("location:" . SITEURL . 'docente/actualizar_asistencia_2.php?dm_id=' . $dm_id.'&fecha='.$fecha);
}
?>
<?php
ob_end_flush();
?>