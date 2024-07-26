<!-- Head -->
<?php include('partials/head1.php'); ?>
<title>ENCLASE - Administrador</title>
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
                <a href="consultar_admin.php"><i class="fas fa-arrow-circle-left verde-item" style="font-size: 35px;"></i></a>
                <h1 class="text-center my-5 h1">Actualizar Administrador</h1>
                <?php
                if (isset($_SESSION['id'])) {
                    $id = $_SESSION['id'];
                } else {
                    $id = $_GET['id'];
                }
                $sql = "SELECT * FROM administrador WHERE id_admin=$id";
                $res = mysqli_query($conn, $sql);
                if ($res == true) {
                    $count = mysqli_num_rows($res);
                    if ($count == 1) {
                        $row = mysqli_fetch_assoc($res);
                        $nombre = $row['nombre'];
                        $apellido = $row['apellido'];
                        $email = $row['email'];
                    } else {
                        header('location:' . SITEURL . 'admin/consultar_admin.php');
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
                                <input type="text"  id="nombre" name="nombre" onkeyup="soloLetras('nombre')" class="form-control" value="<?php
                                                                                                                                                                if (isset($_SESSION['nombre'])) {
                                                                                                                                                                    echo $_SESSION['nombre'];
                                                                                                                                                                } else {
                                                                                                                                                                    echo $nombre;
                                                                                                                                                                } ?>" required />
                                <label class="form-label" data-error="    Ingresa solo letras" data-success="right" for="nombre">Nombre(s)</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-outline">
                                <input type="text" id="apellido" name="apellido" onkeyup="soloLetras2('apellido')" class="form-control" value="<?php
                                                                                                                                                                        if (isset($_SESSION['apellido'])) {
                                                                                                                                                                            echo $_SESSION['apellido'];
                                                                                                                                                                        } else {
                                                                                                                                                                            echo $apellido;
                                                                                                                                                                        } ?>" required />
                                <label class="form-label" data-error="    Ingresa solo letras" data-success="right" for="apellido">Apellido(s)</label>
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
                                                                                                                                                                echo $email;
                                                                                                                                                            } ?>" required />
                                <label class="form-label" data-error="    Email no valido" data-success="right" for="email">Email</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-outline">
                                <input type="email" id="reEmail" name="reEmail" onkeyup="soloEmail('reEmail')" class="form-control" value="<?php
                                                                                                                                                                        if (isset($_SESSION['reEmail'])) {
                                                                                                                                                                            echo $_SESSION['reEmail'];
                                                                                                                                                                        } else {
                                                                                                                                                                            echo $email;
                                                                                                                                                                        } ?>" required />
                                <label class="form-label" data-error="    Email no valido" data-success="right" for="reEmail">Repetir Email</label>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="id" value="<?php echo $id ?>">
                    <div class="row mb-1">
                        <div class="col-6 mx-auto">
                            <a href="consultar_admin.php" class="btn btn-danger btn-block">Cancelar</a>
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

<?php

if (isset($_POST['submit'])) {
    if (isset($_POST['id']) && isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['email']) && isset($_POST['reEmail'])) {
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $email = $_POST['email'];
        $reEmail = $_POST['reEmail'];
        $soloLetras1 = preg_match('/[a-zA-Z áéíóúÁÉÍÓÚñÑ]/x', $nombre);
        $soloLetras2 = preg_match('/[a-zA-Z áéíóúÁÉÍÓÚñÑ]/x', $apellido);
        if(!$soloLetras1 || !$soloLetras2){
            $_SESSION['errorE'] = "<div class='alert alert-danger'>Solo se permiten letras en los campos nombre y apellido</div>";
            $_SESSION['id'] = $id;
            header("location:" . SITEURL . 'admin/actualizar_admin.php');
            die();
        }
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['errorE'] = "<div class='alert alert-danger'>Ingresa un Email valido</div>";
            $_SESSION['id'] = $id;
            header("location:" . SITEURL . 'admin/actualizar_admin.php');
            die();
       }
        if (strcmp($email, $reEmail) !== 0) {
            $_SESSION['errorE'] = "<div class='alert alert-danger'>Email no son Iguales</div>";
            $_SESSION['id'] = $id;
            header("location:" . SITEURL . 'admin/actualizar_admin.php');
            die();
        }
        $sql = "SELECT * FROM administrador WHERE email = '$email' AND activo = 1 AND id_admin != $id";
        $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        if (mysqli_num_rows($res) > 0 ) {
            $_SESSION['errorE'] = "<div class='alert alert-danger'>Ya existe un registro con ese Email</div>";
            $_SESSION['id'] = $id;
            header("location:" . SITEURL . 'admin/actualizar_admin.php');
            die();
        }
        $sql = "UPDATE administrador SET
                nombre = '$nombre',
                apellido = '$apellido',
                email = '$email'
                WHERE id_admin = '$id'";
        $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        if ($res == TRUE) {
            unset($_SESSION['id']);
            $_SESSION['actualizar'] = "<div class='alert alert-success'>Administrador Actualizado Correctamente</div>";
            header("location:" . SITEURL . 'admin/consultar_admin.php');
            die();
        } else {
            $_SESSION['actualizar'] = "<div class='alert alert-danger'>Error al Actualizar</div>";
            header("location:" . SITEURL . 'admin/actualizar_admin.php');
            die();
        }
    } else {
        $_SESSION['errorE'] = "<div class='alert alert-danger'>Todos los campos son requeridos</div>";
        $_SESSION['id'] = $id;
        header("location:" . SITEURL . 'admin/actualizar_admin.php');
        die();
    }
}
?>

<?php
ob_end_flush();
?>