<?php include('partials/head1.php'); ?>
<title>ENCLASE - Alumno</title>
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

function validar_fecha($fecha)
{
    $valores = explode('-', $fecha);
    if (count($valores) == 3 && checkdate($valores[1], $valores[0], $valores[2])) {
        return true;
    }
    return false;
}
?>
<!-- Main -->
<main>
    <div class="container-fluid mb-5">
        <section>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-8">
                        <h5 class="my-4 dark-grey-text font-weight-bold">Importar Datos Alumno</h5>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-bordered table-sm" id="tabla1">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Fila</th>
                                        <th>Nombre(s)</th>
                                        <th>Apellido(s)</th>
                                        <th>Matricula</th>
                                        <th>Email</th>
                                        <th>Password</th>
                                        <th>Teléfono</th>
                                        <th>F.Ingreso</th>
                                        <th>F.Nacimiento</th>
                                        <th>Carrera</th>
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
                                                    $email = $sheetData[$i][3];
                                                    $sql = ("SELECT * FROM alumno WHERE email = '$email' AND activo = 1");
                                                    $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                                                    $count = mysqli_num_rows($res);
                                                    if ($count > 0) {
                                                        $nombre = "<div class='alert-s alert-danger'>El registro ya existe en la base de datos</div>";
                                                        $apellido = "";
                                                        $matricula = "";
                                                        $email = "";
                                                        $password = "";
                                                        $telefono = "";
                                                        $f_ingreso = "";
                                                        $f_nacimiento = "";
                                                        $carrera = "";
                                                        $error[$i] = true;
                                                    } else {
                                                        $nombre = $sheetData[$i][0];
                                                        if ($nombre == "") {
                                                            $nombre = "<div class='alert-s alert-danger'>Error..Campo vacío</div>";
                                                            $error[$i] = true;
                                                        }
                                                        $apellido = $sheetData[$i][1];
                                                        if ($apellido == "") {
                                                            $apellido = "<div class='alert-s alert-danger'>Error..Campo vacío</div>";
                                                            $error[$i] = true;
                                                        }
                                                        $soloLetras1 = preg_match('/^[a-zA-Z áéíóúÁÉÍÓÚñÑ]*$/', $nombre);
                                                        if (!$soloLetras1) {
                                                            $nombre = "<div class='alert-s alert-danger'>Error..Solo se permiten letras</div>";
                                                            $error[$i] = true;
                                                        }
                                                        $soloLetras2 = preg_match('/^[a-zA-Z áéíóúÁÉÍÓÚñÑ]*$/', $apellido);
                                                        if (!$soloLetras2) {
                                                            $apellido = "<div class='alert-s alert-danger'>Error..Solo se permiten letras</div>";
                                                            $error[$i] = true;
                                                        }
                                                        $matricula = $sheetData[$i][2];
                                                        if ($matricula == "") {
                                                            $matricula = "<div class='alert-s alert-danger'>Error..Campo vacío</div>";
                                                            $error[$i] = true;
                                                        }
                                                        $soloNumeros = preg_match('/^[0-9]{8}$/', $matricula);
                                                        if (!$soloNumeros) {
                                                            $matricula = "<div class='alert-s alert-danger'>Error..8 dígitos y solo números</div>";
                                                            $error[$i] = true;
                                                        }
                                                        $email = $sheetData[$i][3];
                                                        if ($email == "") {
                                                            $email = "<div class='alert-s alert-danger'>Error..Campo vacío</div>";
                                                            $error[$i] = true;
                                                        }
                                                        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                                                            $email = "<div class='alert-s alert-danger'>Error..email incorrecto</div>";
                                                            $error[$i] = true;
                                                        }
                                                        $password = $sheetData[$i][4];
                                                        if ($password == "") {
                                                            $password = "<div class='alert-s alert-danger'>Error..Campo vacío</div>";
                                                            $error[$i] = true;
                                                        }
                                                        $uppercase = preg_match('@[A-Z]@', $password);
                                                        $lowercase = preg_match('@[a-z]@', $password);
                                                        $number    = preg_match('@[0-9]@', $password);
                                                        $specialChars = preg_match('@[^\w]@', $password);
                                                        if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
                                                            $password = "<div class='alert-s alert-danger'>La contraseña debe tener al menos 8 caracteres, una letra mayúscula, un numero y un carácter especial</div>";
                                                            $error[$i] = true;
                                                        }
                                                        $telefono = $sheetData[$i][5];
                                                        if ($telefono == "") {
                                                            $telefono = "<div class='alert-s alert-danger'>Error..Campo vacío</div>";
                                                            $error[$i] = true;
                                                        }
                                                        $soloNumeros2 = preg_match('/^[0-9]{10}$/', $telefono);
                                                        if (!$soloNumeros2) {
                                                            $telefono = "<div class='alert-s alert-danger'>Error..10 dígitos y solo números</div>";
                                                            $error[$i] = true;
                                                        }
                                                        $f_ingreso = $sheetData[$i][6];
                                                        if ($f_ingreso == "") {
                                                            $f_ingreso = "<div class='alert-s alert-danger'>Error..Campo vacío</div>";
                                                            $error[$i] = true;
                                                        }
                                                        if (validar_fecha($f_ingreso) == false) {
                                                            $f_ingreso = "<div class='alert-s alert-danger'>Error..Formato de fecha incorrecto</div>";
                                                            $error[$i] = true;
                                                        } else {
                                                            $fecha_actual = strtotime(date("d-m-Y"));
                                                            $f_i = strtotime($f_ingreso);
                                                            if ($f_i > $fecha_actual) {
                                                                $f_ingreso = "<div class='alert-s alert-danger'>Error..La fecha es mayor a la fecha actual</div>";
                                                                $error[$i] = true;
                                                            } else {
                                                                $fecha_minima = strtotime("01-01-2012");
                                                                if ($f_i < $fecha_minima) {
                                                                    $f_ingreso = "<div class='alert-s alert-danger'>Error..La fecha de ingreso no puede ser menor a 10 años </div>";
                                                                    $error[$i] = true;
                                                                }
                                                            }
                                                        }
                                                        $f_nacimiento = $sheetData[$i][7];
                                                        if ($f_nacimiento == "") {
                                                            $f_nacimiento = "<div class='alert-s alert-danger'>Error..Campo vacío</div>";
                                                            $error[$i] = true;
                                                        }
                                                        if (validar_fecha($f_nacimiento) == false) {
                                                            $f_nacimiento = "<div class='alert-s alert-danger'>Error..Formato de fecha incorrecto</div>";
                                                            $error[$i] = true;
                                                        } else {
                                                            $fecha_actual = strtotime(date("d-m-Y"));
                                                            $f_n = strtotime($f_nacimiento);
                                                            if ($f_n > $fecha_actual) {
                                                                $f_nacimiento = "<div class='alert-s alert-danger'>Error..La fecha es mayor a la fecha actual</div>";
                                                                $error[$i] = true;
                                                            } else {
                                                                $fecha_minima2 = strtotime("01-01-2002");
                                                                if ($f_n < $fecha_minima2) {
                                                                    $f_nacimiento = "<div class='alert-s alert-danger'>Error..La fecha de nacimiento no puede ser menor a 20 años </div>";
                                                                    $error[$i] = true;
                                                                }
                                                            }
                                                        }
                                                        $carrera = $sheetData[$i][8];
                                                        echo $carrera;
                                                        if ($carrera != 1 && $carrera != 2 && $carrera != 3 && $carrera != 4) {
                                                            $carrera = "<div class='alert-s alert-danger'>Error..Solo se permite (1,2,3 o 4)</div>";
                                                            $error[$i] = true;
                                                        }
                                                    }

                                    ?>
                                                    <tr>
                                                        <td><?php echo $i + 1 ?></td>
                                                        <td><?php echo $nombre ?></td>
                                                        <td><?php echo $apellido ?></td>
                                                        <td><?php echo $matricula ?></td>
                                                        <td><?php echo $email ?></td>
                                                        <td><?php echo $password ?></td>
                                                        <td><?php echo $telefono ?></td>
                                                        <td><?php echo $f_ingreso ?></td>
                                                        <td><?php echo $f_nacimiento ?></td>
                                                        <td><?php echo $carrera ?></td>
                                                    </tr>
                                    <?php
                                                }
                                            } else {
                                                $_SESSION['error'] = "<div class='alert alert-danger'>Archivo Vacío</div>";
                                                header("location:" . SITEURL . 'admin/importar_datos_alumno.php');
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
                                <a href="importar_datos_alumno.php" class="btn btn-danger btn-block">Regresar</a>
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
<script src="../js/archivo_validado_alumno.js"></script>