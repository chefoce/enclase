<!-- Head -->
<?php include('partials/head1.php'); ?>
<title>ENCLASE - Panel Alumno</title>
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
                <a href="consultar_materias_alumno.php"><i class="fas fa-arrow-circle-left verde-item" style="font-size: 35px;"></i></a>
                <h1 class="text-center my-5 h1">Actualizar Materia Alumno</h1>
                <?php
                if (isset($_SESSION['id'])) {
                    $id = $_SESSION['id'];
                } else {
                    $id = $_GET['id'];
                }
                $sql1 = "SELECT * FROM alumno_docente WHERE id_ad=$id";
                $res1 = mysqli_query($conn, $sql1);
                if ($res1 == true) {
                    $count = mysqli_num_rows($res1);
                    if ($count == 1) {
                        $row = mysqli_fetch_assoc($res1);
                        $alumno_id = $row['alumno_id'];
                        $id_dm = $row['dm_id'];
                    } else {
                        header('location:' . SITEURL . 'admin/consultar_materias_alumno.php');
                        unset($_SESSION['id']);
                        die();
                    }
                }
                if (isset($_SESSION['error'])) {
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                }
                ?>
                <form action="" method="POST">
                    <div class="row">
                        <div class="col">
                            <select name="dm" required class="mdb-select colorful-select dropdown-primary md-form" searchable="Buscar..">
                                <option value="" disabled selected>Seleccionar Materia</option>
                                <?php
                                $sql = "SELECT dm.id_dm,
                                                m.nombre AS materia,
                                                g.nombre AS grupo,
                                                d.nombre AS nombre_docente,
                                                d.apellido AS apellido_docente,
                                                p.nombre as periodo
                                        FROM docente_materia dm 
                                        JOIN docente d ON dm.docente_id = d.id_docente
                                        JOIN grupo g ON dm.grupo_id = g.id_grupo
                                        JOIN materia m ON dm.materia_id = m.id_materia
                                        JOIN periodo p ON dm.periodo_id = p.id_periodo
                                        WHERE dm.activo = 1 ORDER BY materia ASC";
                                $res = mysqli_query($conn, $sql);
                                if ($res == TRUE) {
                                    $count = mysqli_num_rows($res);
                                    if ($count > 0) {
                                        while ($rows = mysqli_fetch_assoc($res)) {
                                            $id_dm2 = $rows['id_dm'];
                                            $materia = $rows['materia'];
                                            $grupo = $rows['grupo'];
                                            $nombre_docente = $rows['nombre_docente'];
                                            $apellido_docente = $rows['apellido_docente'];
                                            $periodo = $rows['periodo'];
                                ?>
                                            <option <?php if ($id_dm == $id_dm2) {
                                                        echo "selected";
                                                    } ?> value="<?php echo $id_dm2; ?>">Materia: <?php echo $materia . " | Grupo: " . $grupo . " | Docente: " . $nombre_docente . " " . $apellido_docente . " | Periodo: " . $periodo; ?></option>
                                <?php
                                        }
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="alumno" value="<?php echo $alumno_id;  ?>">
                    <div class="row mb-1">
                        <div class="col-6 mx-auto">
                            <a href="consultar_materias_alumno.php" class="btn btn-danger btn-block">Cancelar</a>
                        </div>
                        <div class="col-6 mx-auto">
                            <button type="submit" name="submit" class="btn verde-conalep btn-block">Actualizar</button>
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
    $id = $_POST['id'];
    $id_dm3 = $_POST['dm'];
    $id_alumno = $_POST['alumno'];
    $sql = ("SELECT * FROM alumno_docente WHERE alumno_id = '$id_alumno' AND dm_id = '$id_dm3' AND activo = 1");
    $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    $count = mysqli_num_rows($res);
    if ($count > 0) {
        $_SESSION['id'] = $id;
        $_SESSION['error'] = "<div class='alert alert-danger'>El Alumno ya tiene esa Materia Asignada</div>";
        header("location:" . SITEURL . 'admin/actualizar_materia_alumno.php');
    } else {
        $sql4 = "UPDATE alumno_docente SET
            dm_id = $id_dm3
            WHERE id_ad = $id
    ";
        $res4 = mysqli_query($conn, $sql4) or die(mysqli_error($conn));

        if ($res4 == TRUE) {
            $_SESSION['actualizar'] = "<div class='alert alert-success'>Materia Actualizada Correctamente</div>";
            header("location:" . SITEURL . 'admin/consultar_materias_alumno.php');
        } else {
            $_SESSION['id'] = $id;
            $_SESSION['error'] = "<div class='alert alert-danger'>Error al Agregar</div>";
            header("location:" . SITEURL . 'admin/actualizar_materia_alumno.php');
        }
    }
}
?>

<?php ob_end_flush(); ?>