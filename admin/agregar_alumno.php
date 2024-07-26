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
                        <a href="consultar_alumno.php"><i class="fas fa-arrow-circle-left verde-item" style="font-size: 35px;"></i></a>
                    </div>
                    <div class="col-8">
                        <a class="btn verde-conalep float-right waves-effect waves-light" href="importar_datos_alumno.php" role="button">
                            <i class="fas fa-file-excel mr-2"></i>
                            Importar
                        </a>
                    </div>
                </div>
                <h1 class="text-center my-5 h1">Nuevo Alumno</h1>
                <?php
                if (isset($_SESSION['errorE'])) {
                    echo $_SESSION['errorE'];
                    unset($_SESSION['errorE']);
                }
                if (isset($_SESSION['errorP'])) {
                    echo $_SESSION['errorP'];
                    unset($_SESSION['errorP']);
                }

                if (isset($_SESSION['error'])) {
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                }
                ?>
                <form class="register" action="" method="POST" onsubmit="return(validar());">
                    <div class="row">
                        <div class="col">
                            <div class="form-outline">
                                <input type="text" id="nombre" name="nombre" onkeyup="soloLetras('nombre')" class="form-control" value="<?php
                                                                                                                                        if (isset($_SESSION['nombre'])) {
                                                                                                                                            echo $_SESSION['nombre'];
                                                                                                                                        } else {
                                                                                                                                            echo '';
                                                                                                                                        } ?>" required />
                                <label class="form-label" for="nombre" data-error=" Ingresa solo letras" data-success="right">Nombre(s)</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-outline">
                                <input type="text" id="apellido" name="apellido" onkeyup="soloLetras2('apellido')" class="form-control" value="<?php
                                                                                                                                                if (isset($_SESSION['apellido'])) {
                                                                                                                                                    echo $_SESSION['apellido'];
                                                                                                                                                } else {
                                                                                                                                                    echo '';
                                                                                                                                                } ?>" required />
                                <label class="form-label" for="apellido" data-error=" Ingresa solo letras" data-success="right">Apellido(s)</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-outline">
                                <input type="text" id="matricula" name="matricula" onkeyup="soloNumeros('matricula')" class="form-control" value="<?php
                                                                                                                                                    if (isset($_SESSION['matricula'])) {
                                                                                                                                                        echo $_SESSION['matricula'];
                                                                                                                                                    } else {
                                                                                                                                                        echo '';
                                                                                                                                                    } ?>" required />
                                <label class="form-label" for="matricula" data-error=" Numero de matricula invalido" data-success="right">Matricula</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col">
                            <div class="form-outline">
                                <input type="email" id="email" name="email" onkeyup="soloEmail('email')" class="form-control" value="<?php
                                                                                                                                        if (isset($_SESSION['email'])) {
                                                                                                                                            echo $_SESSION['email'];
                                                                                                                                        } else {
                                                                                                                                            echo '';
                                                                                                                                        } ?>" required />
                                <label class="form-label" for="email" data-error=" Email no valido" data-success="right">Email</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-outline">
                                <input type="email" id="reEmail" name="reEmail" onkeyup="soloEmail2('reEmail')" class="form-control" value="<?php
                                                                                                                                            if (isset($_SESSION['reEmail'])) {
                                                                                                                                                echo $_SESSION['reEmail'];
                                                                                                                                            } else {
                                                                                                                                                echo '';
                                                                                                                                            } ?>" required />
                                <label class="form-label" for="reEmail" data-error=" Email no valido" data-success="right">Repetir Email</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col">
                            <div class="form-outline">
                                <input type="tel" minlength="10" maxlength="10" id="telefono" name="telefono" onkeyup="soloTelefono('telefono')" class="form-control" value="<?php
                                                                                                                                                                                if (isset($_SESSION['telefono'])) {
                                                                                                                                                                                    echo $_SESSION['telefono'];
                                                                                                                                                                                } else {
                                                                                                                                                                                    echo '';
                                                                                                                                                                                } ?>" required />
                                <label class="form-label" for="telefono" data-error=" Telefono a 10 digitos" data-success="right">Teléfono (10 dígitos)</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-outline">
                                <input placeholder="Seleccionar Fecha" type="text" id="fecha_ingreso" name="fecha_ingreso" class="form-control datepicker" value="<?php
                                                                                                                                                                    if (isset($_SESSION['fecha_ingreso'])) {
                                                                                                                                                                        echo $_SESSION['fecha_ingreso'];
                                                                                                                                                                    } else {
                                                                                                                                                                        echo '';
                                                                                                                                                                    } ?>" required>
                                <label for="fecha_ingreso" class="active">Fecha Ingreso</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-outline">
                                <input placeholder="Seleccionar Fecha" type="text" id="fecha_nacimiento" name="fecha_nacimiento" class="form-control datepicker3" value="<?php
                                                                                                                                                                            if (isset($_SESSION['fecha_nacimiento'])) {
                                                                                                                                                                                echo $_SESSION['fecha_nacimiento'];
                                                                                                                                                                            } else {
                                                                                                                                                                                echo '';
                                                                                                                                                                            } ?>" required>
                                <label for="fecha_nacimiento" class="active">Fecha Nacimiento</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col">
                            <select name="carrera" required class="mdb-select colorful-select dropdown-primary md-form" searchable="Buscar..">
                                <option value="" disabled selected>Selecciona la Carrera</option>
                                <?php
                                $sql = "SELECT * FROM carrera";
                                $res = mysqli_query($conn, $sql);
                                if ($res == TRUE) {
                                    $count = mysqli_num_rows($res);
                                    if ($count > 0) {
                                        while ($rows = mysqli_fetch_assoc($res)) {
                                            $id = $rows['id_carrera'];
                                            $nombre = $rows['carrera'];
                                ?>
                                            <option value="<?php echo $id; ?>"><?php echo $nombre; ?></option>
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
                            <div class="form-outline">
                                <input type="password" id="password" name="password" onkeyup="passFuerte('password')" class="form-control" required />
                                <span class="far fa-eye-slash" id="togglePassword"></span>
                                <label class="form-label" for="password" data-error=" La contraseña debe tener una letra minúscula, una letra mayúscula, un número, un carácter especial y mínimo 8 dígitos." data-success="right">Contraseña</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-outline">
                                <input type="password" id="rePassword" name="rePassword" onkeyup="passFuerte2('rePassword')" class="form-control" required />
                                <span class="far fa-eye-slash" id="togglePassword2"></span>
                                <label class="form-label" for="rePassword" data-error=" La contraseña debe tener una letra minúscula, una letra mayúscula, un número, un carácter especial y mínimo 8 dígitos." data-success="right">Repetir Contraseña</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-6 mx-auto">
                            <a href="consultar_alumno.php" class="btn btn-danger btn-block">Cancelar</a>
                        </div>
                        <div class="col-6 mx-auto">
                            <button type="submit" name="submit" class="btn verde-conalep btn-block">Registrar</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
</main>
<!-- Main -->

<?php include('partials/footer.php'); ?>
<script src="../js/validaciones.js"></script>
<script src="../js/tooglePass.js"></script>

<?php

if (isset($_POST['submit'])) {
    if (isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['matricula']) && isset($_POST['email']) && isset($_POST['reEmail']) && isset($_POST['telefono']) && isset($_POST['fecha_ingreso']) && isset($_POST['fecha_nacimiento']) && isset($_POST['carrera']) && isset($_POST['password']) && isset($_POST['rePassword'])) {
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $matricula = $_POST['matricula'];
        $email = $_POST['email'];
        $reEmail = $_POST['reEmail'];
        $telefono = $_POST['telefono'];
        $fecha_ingreso = $_POST['fecha_ingreso'];
        $fecha_nacimiento = $_POST['fecha_nacimiento'];
        $carrera = $_POST['carrera'];
        $password = $_POST['password'];
        $rePassword = $_POST['rePassword'];
        $soloLetras1 = preg_match('/[a-zA-Z áéíóúÁÉÍÓÚñÑ]/x', $nombre);
        $soloLetras2 = preg_match('/[a-zA-Z áéíóúÁÉÍÓÚñÑ]/x', $apellido);
        if(!$soloLetras1 || !$soloLetras2){
            $_SESSION['errorE'] = "<div class='alert alert-danger'>Solo se permiten letras en los campos nombre y apellido</div>";
            $_SESSION['nombre'] = $nombre;
            $_SESSION['apellido'] = $apellido;
            $_SESSION['matricula'] = $matricula;
            $_SESSION['email'] = $email;
            $_SESSION['reEmail'] = $reEmail;
            $_SESSION['telefono'] = $telefono;
            $_SESSION['fecha_ingreso'] = $fecha_ingreso;
            $_SESSION['fecha_nacimiento'] = $fecha_nacimiento;
            $_SESSION['carrera'] = $carrera;
            header("location:" . SITEURL . 'admin/agregar_alumno.php');
            die();
        }
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['errorE'] = "<div class='alert alert-danger'>Ingresa un Email valido</div>";
            $_SESSION['nombre'] = $nombre;
            $_SESSION['apellido'] = $apellido;
            $_SESSION['matricula'] = $matricula;
            $_SESSION['email'] = $email;
            $_SESSION['reEmail'] = $reEmail;
            $_SESSION['telefono'] = $telefono;
            $_SESSION['fecha_ingreso'] = $fecha_ingreso;
            $_SESSION['fecha_nacimiento'] = $fecha_nacimiento;
            $_SESSION['carrera'] = $carrera;
            header("location:" . SITEURL . 'admin/agregar_alumno.php');
            die();
       }
        if (strcmp($email, $reEmail) !== 0) {
            $_SESSION['errorE'] = "<div class='alert alert-danger'>Email no son Iguales</div>";
            $_SESSION['nombre'] = $nombre;
            $_SESSION['apellido'] = $apellido;
            $_SESSION['matricula'] = $matricula;
            $_SESSION['email'] = $email;
            $_SESSION['reEmail'] = $reEmail;
            $_SESSION['telefono'] = $telefono;
            $_SESSION['fecha_ingreso'] = $fecha_ingreso;
            $_SESSION['fecha_nacimiento'] = $fecha_nacimiento;
            $_SESSION['carrera'] = $carrera;
            header("location:" . SITEURL . 'admin/agregar_alumno.php');
            die();
        }
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number    = preg_match('@[0-9]@', $password);
        $specialChars = preg_match('@[^\w]@', $password);
        if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
            $_SESSION['errorP'] = "<div class='alert alert-danger'>La contraseña debe tener al menos 8 caracteres, una letra mayúscula, un numero y un carácter especial</div>";
            $_SESSION['nombre'] = $nombre;
            $_SESSION['apellido'] = $apellido;
            $_SESSION['matricula'] = $matricula;
            $_SESSION['email'] = $email;
            $_SESSION['reEmail'] = $reEmail;
            $_SESSION['telefono'] = $telefono;
            $_SESSION['fecha_ingreso'] = $fecha_ingreso;
            $_SESSION['fecha_nacimiento'] = $fecha_nacimiento;
            $_SESSION['carrera'] = $carrera;
            header("location:" . SITEURL . 'admin/agregar_alumno.php');
            die();
        }
        if (strcmp($password, $rePassword) !== 0) {
            $_SESSION['errorP'] = "<div class='alert alert-danger'>Password no son Iguales</div>";
            $_SESSION['nombre'] = $nombre;
            $_SESSION['apellido'] = $apellido;
            $_SESSION['matricula'] = $matricula;
            $_SESSION['email'] = $email;
            $_SESSION['reEmail'] = $reEmail;
            $_SESSION['telefono'] = $telefono;
            $_SESSION['fecha_ingreso'] = $fecha_ingreso;
            $_SESSION['fecha_nacimiento'] = $fecha_nacimiento;
            $_SESSION['carrera'] = $carrera;
            header("location:" . SITEURL . 'admin/agregar_alumno.php');
            die();
        }
        $password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "SELECT * FROM alumno WHERE email = '$email' AND activo = 1";
        $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        if (mysqli_num_rows($res) > 0) {
            $_SESSION['errorE'] = "<div class='alert alert-danger'>Ya existe un registro con el Email Ingresado</div>";
            $_SESSION['nombre'] = $nombre;
            $_SESSION['apellido'] = $apellido;
            $_SESSION['matricula'] = $matricula;
            $_SESSION['email'] = $email;
            $_SESSION['reEmail'] = $reEmail;
            $_SESSION['telefono'] = $telefono;
            $_SESSION['fecha_ingreso'] = $fecha_ingreso;
            $_SESSION['fecha_nacimiento'] = $fecha_nacimiento;
            $_SESSION['carrera'] = $carrera;
            header("location:" . SITEURL . 'admin/agregar_alumno.php');
            die();
        }
        $sql2 = "SELECT * FROM alumno WHERE matricula = '$matricula' AND activo = 1";
        $res = mysqli_query($conn, $sql2) or die(mysqli_error($conn));
        if (mysqli_num_rows($res) > 0) {
            $_SESSION['errorE'] = "<div class='alert alert-danger'>Ya existe un registro con la Matricula Ingresada</div>";
            $_SESSION['nombre'] = $nombre;
            $_SESSION['apellido'] = $apellido;
            $_SESSION['matricula'] = $matricula;
            $_SESSION['email'] = $email;
            $_SESSION['reEmail'] = $reEmail;
            $_SESSION['telefono'] = $telefono;
            $_SESSION['fecha_ingreso'] = $fecha_ingreso;
            $_SESSION['fecha_nacimiento'] = $fecha_nacimiento;
            $_SESSION['carrera'] = $carrera;
            header("location:" . SITEURL . 'admin/agregar_alumno.php');
            die();
        }
        $sql3 = "INSERT INTO alumno SET
                nombre = '$nombre',
                apellido = '$apellido',
                matricula = '$matricula',
                email = '$email',
                password = '$password',
                telefono = '$telefono',
                fecha_ingreso = '$fecha_ingreso',
                fecha_nacimiento = '$fecha_nacimiento',
                carrera_id = $carrera,
                rol_id = 3,
                activo = 1
        ";
        $res = mysqli_query($conn, $sql3) or die(mysqli_error($conn));

        if ($res == TRUE) {
            unset($_SESSION['nombre']);
            unset($_SESSION['apellido']);
            unset($_SESSION['matricula']);
            unset($_SESSION['email']);
            unset($_SESSION['reEmail']);
            unset($_SESSION['telefono']);
            unset($_SESSION['fecha_ingreso']);
            unset($_SESSION['fecha_nacimiento']);
            unset($_SESSION['carrera']);
            $_SESSION['agregar'] = "<div class='alert alert-success'>Alumno Agregado Correctamente</div>";
            header("location:" . SITEURL . 'admin/consultar_alumno.php');
        } else {
            $_SESSION['error'] = "<div class='alert alert-danger'>Error al Agregar</div>";
            header("location:" . SITEURL . 'admin/agregar_alumno.php');
        }
    } else {
        $_SESSION['error'] = "<div class='alert alert-danger'>Todos los campos son requeridos</div>";
        header("location:" . SITEURL . 'admin/agregar_alumno.php');
    }
}
?>

<?php
ob_end_flush();
?>