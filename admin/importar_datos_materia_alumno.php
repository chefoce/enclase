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
                    <div class="col-md-8">
                        <a href="consultar_materias_alumno.php"><i class="fas fa-arrow-circle-left verde-item" style="font-size: 35px;"></i></a>
                    </div>
                    <div class="col-md-4">
                        <a class="btn verde-conalep float-right waves-effect waves-light" href="exportar_datos_materia_alumno.php" role="button">
                            <i class="fas fa-file-download mr-2"></i>
                            Generar Archivo para Carga
                        </a>
                    </div>
                </div>
                <h1 class="text-center my-5 h1">Importar Datos Materia Alumno</h1>
                <?php
                if (isset($_SESSION['error'])) {
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                }
                ?>
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="row mb-4">
                        <div class="col">
                            <div class="form-outline">
                                <p class="lead">
                                    Selecciona el archivo (.csv/.xls/.xlsx)
                                </p>
                                <div class="custom-file">
                                    <input type="file" name="file" class="custom-file-input" id="customFile" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                                    <label class="custom-file-label" for="customFile">Ningún Archivo Seleccionado</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-6 mx-auto">
                            <a href="consultar_materias_alumno.php" class="btn btn-danger btn-block">Cancelar</a>
                        </div>
                        <div class="col-6 mx-auto">
                            <button type="submit" name="submit" class="btn verde-conalep btn-block">Cargar Archivo</button>
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
require_once '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

if (isset($_POST['submit'])) {

    $file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

    if (isset($_FILES['file']['name']) && in_array($_FILES['file']['type'], $file_mimes)) {

        $arr_file = explode('.', $_FILES['file']['name']);
        $extension = end($arr_file);

        if ('csv' == $extension) {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
        } else {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        }

        $spreadsheet = $reader->load($_FILES['file']['tmp_name']);

        $sheetData = $spreadsheet->getActiveSheet()->toArray();

        if (!empty($sheetData)) {
            $no_agregado = 0;
            $agregado = 0;
            for ($i = 2; $i < count($sheetData); $i++) { //skipping first row
                $alumno_id = $sheetData[$i][0];
                $dm_id = $sheetData[$i][1];
                $sql = ("SELECT * FROM alumno_docente WHERE alumno_id = '$alumno_id' AND dm_id = '$dm_id' AND activo = 1");
                $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                $count = mysqli_num_rows($res);
                if ($count > 0) {
                    $no_agregado = $count + $no_agregado;
                } else {
                    $sql2 = ("INSERT INTO alumno_docente(alumno_id, dm_id, activo)VALUES('$alumno_id', '$dm_id', 1)");
                    $res2 = mysqli_query($conn, $sql2);
                    if ($res2 == TRUE) {
                        $agregado++;
                    }
                }
            }
        }
        $_SESSION['exito'] = "<div class='alert alert-success'>Archivo Importado con Éxito ||<strong> Agregados: " . $agregado . " No Agregados: " . $no_agregado . "</strong></div>";
        header("location:" . SITEURL . 'admin/consultar_materias_alumno.php');
    } else {
        $_SESSION['error'] = "<div class='alert alert-danger'>Archivo Invalido</div>";
        header("location:" . SITEURL . 'admin/importar_datos_materia_alumno.php');
    }
}

?>