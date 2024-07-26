<?php include('partials/head1.php'); ?>
<title>ENCLASE - Materia</title>
<?php include('partials/head2.php'); ?>
<!-- Sidebar -->
<?php include('partials/sidebar.php'); ?>
<!-- Navbar -->
<?php include('partials/navbar.php'); ?>
<?php
require_once '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

?>
<!-- Main -->
<main>
    <div class="container-fluid mb-5">
        <section>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-8">
                        <h5 class="my-4 dark-grey-text font-weight-bold">Importar Datos Materia</h5>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-bordered table-sm" id="tabla1">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Fila</th>
                                        <th>Nombre</th>
                                        <th>Semestre</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (isset($_POST['submit'])) {
                                        $err = 0;
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
                                            if ($sheetData[2][0] != "") {
                                                for ($i = 2; $i < count($sheetData); $i++) { //skipping first row
                                                    $nombre = $sheetData[$i][0];
                                                    $sql = ("SELECT * FROM materia WHERE nombre = '$nombre' AND activo = 1");
                                                    $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                                                    $count = mysqli_num_rows($res);
                                                    if ($count > 0) {
                                                        $nombre = "<div class='alert-s alert-danger'>El registro ya existe en la base de datos</div>";
                                                        $semestre = "";
                                                        $error[$i] = true;
                                                    } else {
                                                        $nombre = $sheetData[$i][0];
                                                        if ($nombre == "") {
                                                            $nombre = "<div class='alert-s alert-danger'>Error..Campo vacío</div>";
                                                            $error[$i] = true;
                                                        }
                                                        $soloLetras1 = preg_match('/^[a-zA-Z áéíóúÁÉÍÓÚñÑ]*$/', $nombre);
                                                        if (!$soloLetras1) {
                                                            $nombre = "<div class='alert-s alert-danger'>Error..Solo se permiten letras</div>";
                                                            $error[$i] = true;
                                                        }
                                                        $semestre = $sheetData[$i][1];
                                                        if ($semestre == "") {
                                                            $semestre = "<div class='alert-s alert-danger'>Error..Campo vacío</div>";
                                                            $error[$i] = true;
                                                        }
                                                        $soloNumeros = preg_match('/^[1-6]{1}$/', $semestre);
                                                        if (!$soloNumeros) {
                                                            $semestre = "<div class='alert-s alert-danger'>Error..Solo 1 dígito (1,2,3,4,5 o 6)</div>";
                                                            $error[$i] = true;
                                                        }   
                                                    }

                                    ?>
                                                    <tr>
                                                        <td><?php echo $i + 1 ?></td>
                                                        <td><?php echo $nombre ?></td>
                                                        <td><?php echo $semestre ?></td>
                                                    </tr>
                                    <?php
                                                }
                                            } else {
                                                $_SESSION['error'] = "<div class='alert alert-danger'>Archivo Vacío</div>";
                                                header("location:" . SITEURL . 'admin/importar_datos_materia.php');
                                                die();
                                            }
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <?php
                        if (isset($error)) {
                            foreach ($error as $e) {
                                if ($e == true) {
                                    $err++;
                                }
                            }
                        }
                        if ($err != 0) { ?><div class='alert alert-danger'>Para cargar el archivo resuelve los errores</div><?php } ?>
                        <div class="row">
                            <div class="col-6 mx-auto">
                                <a href="importar_datos_materia.php" class="btn btn-danger btn-block">Regresar</a>
                            </div>
                            <div class="col-6 mx-auto">
                                <button <?php if ($err != 0) {
                                            echo "disabled";
                                        } ?> id="btn_enviar" type="button" name="btn_enviar" class="btn verde-conalep btn-block">Guardar Datos</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <!-- Gird column -->
</main>
<!-- Main -->

<?php include('partials/footer.php'); ?>
<script src="../js/archivo_validado_materia.js"></script>