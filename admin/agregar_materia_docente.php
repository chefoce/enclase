<!-- Head -->
<?php include('partials/head1.php'); ?>
<title>ENCLASE - Docente</title>
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
                        <a href="consultar_materias_docente.php"><i class="fas fa-arrow-circle-left verde-item" style="font-size: 35px;"></i></a>
                    </div>
                    <div class="col-8">
                        <a class="btn verde-conalep float-right waves-effect waves-light" href="importar_datos_materia_docente.php" role="button">
                            <i class="fas fa-file-excel mr-2"></i>
                            Importar
                        </a>
                    </div>
                </div>
                <h1 class="text-center my-5 h1">Asignar Materia Docente</h1>
                <?php
                if (isset($_SESSION['error'])) {
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                }
                ?>
                <form action="" method="POST">
                    <div class="row mb-4">
                        <div class="col">
                            <select name="docente" required class="mdb-select colorful-select dropdown-primary md-form" searchable="Buscar..">
                                <option value="" disabled selected>Seleccionar Docente</option>
                                <?php
                                $sql = "SELECT id_docente,nombre,apellido FROM docente WHERE activo = 1 ORDER BY nombre ASC";
                                $res = mysqli_query($conn, $sql);
                                if ($res == TRUE) {
                                    $count = mysqli_num_rows($res);
                                    if ($count > 0) {
                                        while ($rows = mysqli_fetch_assoc($res)) {
                                            $id_docente = $rows['id_docente'];
                                            $nombre_docente = $rows['nombre'];
                                            $apellido_docente = $rows['apellido'];
                                ?>
                                            <option value="<?php echo $id_docente; ?>"><?php echo $nombre_docente . " " . $apellido_docente; ?></option>
                                <?php
                                        }
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col">
                            <select name="grupo" required class="mdb-select colorful-select dropdown-primary md-form" searchable="Buscar..">
                                <option value="" disabled selected>Seleccionar Grupo</option>
                                <?php
                                $sql = "SELECT id_grupo,nombre FROM grupo WHERE activo = 1 ORDER BY nombre ASC";
                                $res = mysqli_query($conn, $sql);
                                if ($res == TRUE) {
                                    $count = mysqli_num_rows($res);
                                    if ($count > 0) {
                                        while ($rows = mysqli_fetch_assoc($res)) {
                                            $id_grupo = $rows['id_grupo'];
                                            $nombre_grupo = $rows['nombre'];
                                ?>
                                            <option value="<?php echo $id_grupo; ?>"><?php echo $nombre_grupo; ?></option>
                                <?php
                                        }
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col">
                            <select name="materia" required class="mdb-select colorful-select dropdown-primary md-form" searchable="Buscar..">
                                <option value="" disabled selected>Seleccionar Materia</option>
                                <?php
                                $sql = "SELECT id_materia,nombre FROM materia WHERE activo = 1 ORDER BY nombre ASC";
                                $res = mysqli_query($conn, $sql);
                                if ($res == TRUE) {
                                    $count = mysqli_num_rows($res);
                                    if ($count > 0) {
                                        while ($rows = mysqli_fetch_assoc($res)) {
                                            $id_materia = $rows['id_materia'];
                                            $nombre_materia = $rows['nombre'];
                                ?>
                                            <option value="<?php echo $id_materia; ?>"><?php echo $nombre_materia; ?></option>
                                <?php
                                        }
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col">
                            <select name="periodo" required class="mdb-select colorful-select dropdown-primary md-form" searchable="Buscar..">
                                <option value="" disabled selected>Seleccionar Periodo</option>
                                <?php
                                $sql = "SELECT id_periodo,nombre FROM periodo WHERE activo = 1 ORDER BY nombre ASC";
                                $res = mysqli_query($conn, $sql);
                                if ($res == TRUE) {
                                    $count = mysqli_num_rows($res);
                                    if ($count > 0) {
                                        while ($rows = mysqli_fetch_assoc($res)) {
                                            $id_periodo = $rows['id_periodo'];
                                            $nombre_periodo = $rows['nombre'];
                                ?>
                                            <option value="<?php echo $id_periodo; ?>"><?php echo $nombre_periodo; ?></option>
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
                            <a href="consultar_materias_docente.php" class="btn btn-danger btn-block">Cancelar</a>
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
    $docente = $_POST['docente'];
    $grupo = $_POST['grupo'];
    $materia = $_POST['materia'];
    $periodo = $_POST['periodo'];
    $sql = ("SELECT * FROM docente_materia WHERE docente_id = '$docente' AND grupo_id = '$grupo' AND materia_id = '$materia' AND periodo_id = '$periodo' AND activo = 1");
    $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    $count = mysqli_num_rows($res);
    if ($count > 0) {
        $_SESSION['error'] = "<div class='alert alert-danger'>La Materia ya se Encuentra Asignada</div>";
        header("location:" . SITEURL . 'admin/agregar_materia_docente.php');
    } else {
        $sql2 = "INSERT INTO docente_materia SET
                            docente_id = $docente,
                            grupo_id = $grupo,
                            materia_id = $materia,
                            periodo_id = $periodo,
                            activo = 1
                    ";
        $res2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));

        if ($res2 == TRUE) {
            $_SESSION['agregar'] = "<div class='alert alert-success'>Materia Asignada Correctamente</div>";
            header("location:" . SITEURL . 'admin/consultar_materias_docente.php');
        } else {
            $_SESSION['error'] = "<div class='alert alert-danger'>Error al Agregar</div>";
            header("location:" . SITEURL . 'admin/agregar_materia_docente.php');
        }
    }
}
?>

<?php
ob_end_flush();
?>