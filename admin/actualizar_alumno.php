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
                <a href="consultar_alumno.php"><i class="fas fa-arrow-circle-left verde-item" style="font-size: 35px;"></i></a>
                <h1 class="text-center my-5 h1">Actualizar Alumno</h1>
                <?php
                if (isset($_SESSION['id'])) {
                    $id = $_SESSION['id'];
                } else {
                    $id = $_GET['id'];
                }
                $sql = "SELECT * FROM alumno WHERE id_alumno=$id";
                $res = mysqli_query($conn, $sql);
                if ($res == true) {
                    $count = mysqli_num_rows($res);
                    if ($count == 1) {
                        $row = mysqli_fetch_assoc($res);
                        $nombre = $row['nombre'];
                        $apellido = $row['apellido'];
                        $matricula = $row['matricula'];
                        $email = $row['email'];
                        $telefono = $row['telefono'];
                        $fecha_ingreso = $row['fecha_ingreso'];
                        $fecha_nacimiento = $row['fecha_nacimiento'];
                        $carrera = $row['carrera_id'];
                    } else {
                        header('location:' . SITEURL . 'admin/consultar_alumno.php');
                    }
                }
                ?>
                <?php
                if (isset($_SESSION['errorE'])) {
                    echo $_SESSION['errorE'];
                    unset($_SESSION['errorE']);
                }
                if (isset($_SESSION['actualizar'])) {
                    echo $_SESSION['actualizar'];
                    unset($_SESSION['actualizar']);
                }
                ?>
                <form class="register" action="" method="POST" onsubmit="return(validar());">
                <div class="row mb-4">
                        <div class="col">
                            <div class="form-outline">
                                <input type="text" id="nombre" name="nombre" onkeyup="soloLetras('nombre')" class="form-control" value="<?php echo $nombre; ?>" required />
                                <label class="form-label" data-error="    Ingresa solo letras" data-success="right" for="nombre">Nombre(s)</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-outline">
                                <input type="text" id="apellido" name="apellido" onkeyup="soloLetras2('apellido')" class="form-control" value="<?php echo $apellido;?>" required />
                                <label class="form-label" data-error="    Ingresa solo letras" data-success="right" for="apellido">Apellido(s)</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-outline">
                                <input type="text" id="matricula" name="matricula" onkeyup="soloNumeros('matricula')" class="form-control" value="<?php echo $matricula;?>" required />
                                <label class="form-label" for="matricula" data-error=" Matricula invalido" data-success="right">Matricula</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col">
                            <div class="form-outline">
                                <input type="email" id="email" name="email" onkeyup="soloEmail('email')" class="form-control" value="<?php echo $email;?>" required />
                                <label class="form-label" data-error="    Email no valido" data-success="right" for="email">Email</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-outline">
                                <input type="email" id="reEmail" name="reEmail" onkeyup="soloEmail('reEmail')" class="form-control" value="<?php echo $email;?>" required />
                                <label class="form-label" data-error="    Email no valido" data-success="right" for="reEmail">Repetir Email</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col">
                            <div class="form-outline">
                            <input type="tel" minlength="10" maxlength="10" id="telefono" name="telefono" onkeyup="soloTelefono('telefono')" class="form-control" value="<?php echo $telefono;?>" required />
                            <label class="form-label" for="telefono" data-error=" Telefono a 10 digitos" data-success="right">Teléfono (10 dígitos)</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-outline">
                                <input placeholder="Seleccionar Fecha" type="text" id="fecha_ingreso" name="fecha_ingreso" class="form-control datepicker" value="<?php echo $fecha_ingreso;?>" required>
                                <label for="fecha_ingreso" class="active">Fecha Ingreso</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-outline">
                                <input placeholder="Seleccionar Fecha" type="text" id="fecha_nacimiento" name="fecha_nacimiento" class="form-control datepicker3" value="<?php echo $fecha_nacimiento; ?>" required>
                                <label for="fecha_nacimiento" class="active">Fecha Nacimiento</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col">
                            <select name="carrera" required class="mdb-select colorful-select dropdown-primary md-form" searchable="Buscar..">
                                <?php
                                $sql = "SELECT * FROM carrera";
                                $res = mysqli_query($conn, $sql);
                                if ($res == TRUE) {
                                    $count = mysqli_num_rows($res);
                                    if ($count > 0) {
                                        while ($rows = mysqli_fetch_assoc($res)) {
                                            $id_c = $rows['id_carrera'];
                                            $carrera2 = $rows['carrera'];
                                ?>
                                            <option <?php if ($carrera == $id_c) {
                                                        echo "selected";
                                                    } ?> value="<?php echo $id_c; ?>"><?php echo $carrera2; ?></option>
                                <?php }
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <input type="hidden" name="id" value="<?php echo $id; ?>">´
                    <div class="row mb-1">
                        <div class="col-6 mx-auto">
                            <a href="consultar_alumno.php" class="btn btn-danger btn-block">Cancelar</a>
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
<script src="../js/validaciones.js"></script>

<?php if (isset($_POST['submit'])) {
     if (isset($_POST['id']) && isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['matricula']) && isset($_POST['email']) && isset($_POST['reEmail']) && isset($_POST['telefono']) && isset($_POST['fecha_ingreso']) && isset($_POST['fecha_nacimiento']) && isset($_POST['carrera'])) {
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $matricula = $_POST['matricula'];
        $email = $_POST['email'];
        $reEmail = $_POST['reEmail'];
        $telefono = $_POST['telefono'];
        $fecha_ingreso = $_POST['fecha_ingreso'];
        $fecha_nacimiento = $_POST['fecha_nacimiento'];
        $carrera = $_POST['carrera'];
        $soloLetras1 = preg_match('/[a-zA-Z áéíóúÁÉÍÓÚñÑ]/x', $nombre);
        $soloLetras2 = preg_match('/[a-zA-Z áéíóúÁÉÍÓÚñÑ]/x', $apellido);
        if (!$soloLetras1 || !$soloLetras2) {
            $_SESSION['errorE'] = "<div class='alert alert-danger'>Solo se permiten letras en los campos nombre y apellido</div>";
            $_SESSION['id'] = $id;
            header("location:" . SITEURL . 'admin/actualizar_alumno.php');
            die();
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['errorE'] = "<div class='alert alert-danger'>Ingresa un Email valido</div>";
            $_SESSION['id'] = $id;
            header("location:" . SITEURL . 'admin/actualizar_alumno.php');
            die();
        }
        if (strcmp($email, $reEmail) !== 0) {
            $_SESSION['errorE'] = "<div class='alert alert-danger'>Email no son Iguales</div>";
            $_SESSION['id'] = $id;
            header("location:" . SITEURL . 'admin/actualizar_alumno.php');
            die();
        }
        $sql = "SELECT * FROM alumno WHERE email = '$email' AND activo = 1 AND id_alumno != $id";
        $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        if (mysqli_num_rows($res) > 0) {
            $_SESSION['errorE'] = "<div class='alert alert-danger'>Ya existe un registro con ese Email</div>";
            $_SESSION['id'] = $id;
            header("location:" . SITEURL . 'admin/actualizar_alumno.php');
            die();
        }
        $sql = "SELECT * FROM alumno WHERE matricula = '$matricula' AND activo = 1 AND id_alumno != $id";
        $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        if (mysqli_num_rows($res) > 0) {
            $_SESSION['errorE'] = "<div class='alert alert-danger'>Ya existe un registro con esa Matricula</div>";
            $_SESSION['id'] = $id;
            header("location:" . SITEURL . 'admin/actualizar_alumno.php');
            die();
        }
        $sql = "UPDATE alumno SET
                nombre = '$nombre',
                apellido = '$apellido',
                matricula = '$matricula',
                email = '$email',
                telefono = '$telefono',
                fecha_ingreso = '$fecha_ingreso',
                fecha_nacimiento = '$fecha_nacimiento',
                carrera_id = '$carrera'
                WHERE id_alumno = '$id'";
        $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

        if ($res == TRUE) {
            unset($_SESSION['id']);
            $_SESSION['actualizar'] = "<div class='alert alert-success'>Alumno Actualizado Correctamente</div>";
            header("location:" . SITEURL . 'admin/consultar_alumno.php');
            die();
        } else {
            $_SESSION['id'] = $id;
            $_SESSION['actualizar'] = "<div class='alert alert-danger'>Error al Actualizar</div>";
            header("location:" . SITEURL . 'admin/actualizar_alumno.php');
            die();
        }
    } else {
        $_SESSION['actualizar'] = "<div class='alert alert-danger'>Todos los campos son requeridos</div>";
        header("location:" . SITEURL . 'admin/actualizar_alumno.php');
        die();
    }
}
?>
<?php ob_end_flush(); ?>