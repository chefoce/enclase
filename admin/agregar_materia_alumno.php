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
    <div class="container-fluid">
        <section class="section card mb-5">
            <div class="card-body">
            <div class="row">
                    <div class="col-4">
                        <a href="consultar_materias_alumno.php"><i class="fas fa-arrow-circle-left verde-item" style="font-size: 35px;"></i></a>
                    </div>
                    <div class="col-8">
                        <a class="btn verde-conalep float-right waves-effect waves-light" href="importar_datos_materia_alumno.php" role="button">
                            <i class="fas fa-file-excel mr-2"></i>
                            Importar
                        </a>
                    </div>
                </div>
                <h1 class="text-center my-5 h1">Asignar Materia Alumno</h1>
                <?php
                if (isset($_SESSION['error'])) {
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                }
                ?>
                <form action="" method="POST">
                    <div class="row">
                        <div class="col">
                            <select name="alumno" required class="mdb-select colorful-select dropdown-primary md-form" searchable="Buscar..">
                                <option value="" disabled selected>Seleccionar Alumno</option>
                                <?php
                                $sql = "SELECT id_alumno,nombre,apellido FROM alumno WHERE activo = 1 ORDER BY nombre ASC";
                                $res = mysqli_query($conn, $sql);
                                if ($res == TRUE) {
                                    $count = mysqli_num_rows($res);
                                    if ($count > 0) {
                                        while ($rows = mysqli_fetch_assoc($res)) {
                                            $id_alumno = $rows['id_alumno'];
                                            $nombre_alumno = $rows['nombre'];
                                            $apellido_alumno = $rows['apellido'];
                                ?>
                                            <option value="<?php echo $id_alumno; ?>"><?php echo $nombre_alumno . " " . $apellido_alumno; ?></option>
                                <?php
                                        }
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
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
                                            $id_dm = $rows['id_dm'];
                                            $materia = $rows['materia'];
                                            $grupo = $rows['grupo'];
                                            $nombre_docente = $rows['nombre_docente'];
                                            $apellido_docente = $rows['apellido_docente'];
                                            $periodo = $rows['periodo'];
                                ?>
                                            <option value="<?php echo $id_dm; ?>">Materia: <?php echo $materia . " | Grupo: " . $grupo. " | Docente: " . $nombre_docente . " " . $apellido_docente . " | Periodo: " . $periodo; ?></option>
                                <?php
                                        }
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-6 mx-auto">
                            <a href="consultar_materias_alumno.php" class="btn btn-danger btn-block">Cancelar</a>
                        </div>
                        <div class="col-6 mx-auto">
                            <button type="submit" name="submit" class="btn verde-conalep btn-block">Asignar</button>
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
    $id_alumno = $_POST['alumno'];
    $id_dm = $_POST['dm'];
    $sql = ("SELECT * FROM alumno_docente WHERE alumno_id = '$id_alumno' AND dm_id = '$id_dm' AND activo = 1");
    $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    $count = mysqli_num_rows($res);
    if ($count > 0) {
        $_SESSION['error'] = "<div class='alert alert-danger'>El Alumno ya tiene esa Materia Asignada</div>";
        header("location:" . SITEURL . 'admin/agregar_materia_alumno.php');
    } else {
        $sql2 = "INSERT INTO alumno_docente SET
                            alumno_id = $id_alumno,
                            dm_id = $id_dm,
                            activo = 1
                    ";
        $res2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));

        if ($res2 == TRUE) {
            $_SESSION['agregar'] = "<div class='alert alert-success'>Materia Asignada Correctamente</div>";
            header("location:" . SITEURL . 'admin/consultar_materias_alumno.php');
        } else {
            $_SESSION['error'] = "<div class='alert alert-danger'>Error al Agregar</div>";
            header("location:" . SITEURL . 'admin/agregar_materia_alumno.php');
        }
    }
}
?>

<?php
ob_end_flush();
?>