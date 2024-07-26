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
                <a href="consultar_docente.php"><i class="fas fa-arrow-circle-left verde-item" style="font-size: 35px;"></i></a>
                <h1 class="text-center my-5 h1">Cambiar Password</h1>
                <?php
                if (isset($_SESSION['id'])) {
                    $id = $_SESSION['id'];
                } else {
                    $id = $_GET['id'];
                }
                if (isset($_SESSION['errorP'])) {
                    echo $_SESSION['errorP'];
                    unset($_SESSION['errorP']);
                }
                ?>
                <form class="register" action="" method="POST" onsubmit="return(validar());">
                    <div class="row">
                        <div class="col">
                            <div class="form-outline">
                                <input type="password" id="passwordAdmin" name="passwordAdmin" class="form-control" required />
                                <span class="far fa-eye-slash" id="togglePassword"></span>
                                <label class="form-label" for="passwordAdmin">Password Admin</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-outline">
                                <input type="password" id="passwordNuevo" name="passwordNuevo" onkeyup="passFuerte('passwordNuevo')" class="form-control" required />
                                <span class="far fa-eye-slash" id="togglePassword2"></span>
                                <label class="form-label" for="passwordNuevo" data-error=" La contraseña debe tener una letra minúscula, una letra mayúscula, un número, un carácter especial y mínimo 8 dígitos." data-success="right">Nuevo Password</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-outline">
                                <input type="password" id="rePasswordNuevo" name="rePasswordNuevo" onkeyup="passFuerte2('rePasswordNuevo')" class="form-control" required />
                                <span class="far fa-eye-slash" id="togglePassword3"></span>
                                <label class="form-label" for="rePasswordNuevo" data-error=" La contraseña debe tener una letra minúscula, una letra mayúscula, un número, un carácter especial y mínimo 8 dígitos." data-success="right">Repetir Nuevo Password</label>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="id_admin" value="<?php echo $id_admin; ?>">
                    <div class="row mb-1">
                        <div class="col-6 mx-auto">
                            <a href="consultar_docente.php" class="btn btn-danger btn-block">Cancelar</a>
                        </div>
                        <div class="col-6 mx-auto">
                            <button type="submit" name="submit" class="btn verde-conalep btn-block">Actualizar Password</button>
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
<script src="../js/tooglePass2.js"></script>

<?php
if (isset($_POST['submit'])) {
    if (isset($_POST['id_admin']) && isset($_POST['id']) && isset($_POST['passwordAdmin']) && isset($_POST['passwordNuevo']) && isset($_POST['rePasswordNuevo'])) {
        $id_admin = $_POST['id_admin'];
        $id = $_POST['id'];
        $passwordAdmin = $_POST['passwordAdmin'];
        $password_nuevo = $_POST['passwordNuevo'];
        $password_confirmar = $_POST['rePasswordNuevo'];
        $uppercase = preg_match('@[A-Z]@', $password_nuevo);
        $lowercase = preg_match('@[a-z]@', $password_nuevo);
        $number    = preg_match('@[0-9]@', $password_nuevo);
        $specialChars = preg_match('@[^\w]@', $password_nuevo);
        if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password_nuevo) < 8) {
            $_SESSION['errorP'] = "<div class='alert alert-danger'>La contraseña debe tener al menos 8 caracteres, una letra mayúscula, un numero y un carácter especial</div>";
            $_SESSION['id'] = $id;
            header('location:' . SITEURL . 'admin/actualizar_pass_docente.php');
            die();
        }
        if (strcmp($password_nuevo, $password_confirmar) == 0) {
            $sql = "SELECT * FROM administrador WHERE id_admin = $id_admin";
            $res = mysqli_query($conn, $sql);
            if ($res == TRUE) {
                $count = mysqli_num_rows($res);
                $rows = mysqli_fetch_assoc($res);
                $pass = $rows['password'];
                if (($count == 1) && (password_verify($passwordAdmin, $pass))) {
                    $password_nuevo = password_hash($password_nuevo, PASSWORD_DEFAULT);
                    $sql2 = "UPDATE docente SET password = '$password_nuevo' WHERE id_docente = $id";
                    $res2 = mysqli_query($conn, $sql2);
                    if ($res2 == TRUE) {
                        $_SESSION['cambio_password'] = "<div class='alert alert-success'>Password Actualizado Correctamente</div>";
                        unset($_SESSION['id']);
                        header('location:' . SITEURL . 'admin/consultar_docente.php');
                        die();
                    } else {
                        $_SESSION['errorP'] = "<div class='alert alert-danger'>Error al Actualizar Password</div>";
                        unset($_SESSION['id']);
                        header('location:' . SITEURL . 'admin/consultar_docente.php');
                        die();
                    }
                } else {
                    $_SESSION['errorP'] = "<div class='alert alert-danger'>Password Admin Incorrecto</div>";
                    $_SESSION['id'] = $id;
                    header('location:' . SITEURL . 'admin/actualizar_pass_docente.php');
                    die();
                }
            }
        } else {
            $_SESSION['errorP'] = "<div class='alert alert-danger'>Passwords No Coinciden</div>";
            $_SESSION['id'] = $id;
            header('location:' . SITEURL . 'admin/actualizar_pass_docente.php');
            die();
        }
    } else {
        $_SESSION['errorP'] = "<div class='alert alert-danger'>Completa todos los campos</div>";
        $_SESSION['id'] = $id;
        header('location:' . SITEURL . 'admin/actualizar_pass_docente.php');
        die();
    }
}
?>

<?php
ob_end_flush();
?>