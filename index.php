<?php ob_start();
include('config/constants.php');
if (isset($_SESSION['rol'])) {
    switch ($_SESSION['rol']) {
        case 1:
            header('location:' . SITEURL . 'admin/');
            break;
        case 2:
            header('location:' . SITEURL . 'docente/');
            break;
        case 3:
            header('location:' . SITEURL . 'alumno/');
            break;
        case 4:
            header('location:' . SITEURL . 'tutor/');
            break;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />

    <title>ENCLASE - Iniciar Sesión</title>

    <!-- icon -->
    <link rel="icon" href="img/favicon.png" type="image/x-icon" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/login.css" />
</head>

<body>

    <div class="d-lg-flex half">
        <div class="contents order-1 order-md-2">
            <div class="container">
                <div class="carousel carousel-fade" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="view">
                                <img src="img/bg_1.jpg" class="w-100" />
                                <div class="mask flex-center rgba-indigo-light">
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="view">
                                <img src="img/bg_2.jpg" class="w-100" />
                                <div class="mask flex-center rgba-indigo-light">
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="view">
                                <img src="img/bg_3.jpg" class="w-100" />
                                <div class="mask flex-center rgba-indigo-light"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="contents order-2 order-md-1">

            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-md-7">
                        <div class="mb-4">
                            <div class="d-flex flex-row justify-content-center alig-items-center">
                                <img src="img/Logo-enclase_corto_icono.png" class="logo img-fluid">
                            </div>
                            <?php
                            if (isset($_SESSION['login'])) {
                                echo $_SESSION['login'];
                                unset($_SESSION['login']);
                            }
                            if (isset($_SESSION['no-login'])) {
                                echo $_SESSION['no-login'];
                                unset($_SESSION['no-login']);
                            }
                            ?>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h3>Iniciar Sesión</h3>
                                <p class="mb-4">Ingresa tu correo institucional y tu contraseña para iniciar sesión en el sistema.</p>
                                <form action="" method="POST">
                                    <div class="form-group first">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                    </div>
                                    <div class="form-group last">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" id="password" name="password" required>
                                    </div>
                                    <br>
                                    <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
                                    <button type="submit" name="submit" class="btn btn-primary btn-lg btn-block">Iniciar Sesión</button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- SCRIPTS -->
    <!-- JQuery -->
    <script src="js/jquery-3.4.1.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="js/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script type="text/javascript" src="js/mdb.min.js"></script>
    <!-- reCAPTCHA -->
    <script src='https://www.google.com/recaptcha/api.js?render=6LcHR0shAAAAAKH3GY0sMDJUDp1i65b4c0RJJ4c4'>
    </script>
    <script>
        grecaptcha.ready(function() {
            grecaptcha.execute('6LcHR0shAAAAAKH3GY0sMDJUDp1i65b4c0RJJ4c4', {
                    action: 'formulario'
                })
                .then(function(token) {
                    var recaptchaResponse = document.getElementById('recaptchaResponse');
                    recaptchaResponse.value = token;
                });
        });
    </script>
    <script>
        $(function() {
            'use strict';
            $('.form-control').on('input', function() {
                var $field = $(this).closest('.form-group');
                if (this.value) {
                    $field.addClass('field--not-empty');
                } else {
                    $field.removeClass('field--not-empty');
                }
            });
        });
    </script>
</body>

</html>
<?php
if (isset($_POST['submit'])) {
    /*$recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
    $recaptcha_secret = '6LcHR0shAAAAAHionQhwIYZZ_aBpP4Qn0AvKbvIl';
    $recaptcha_response = $_POST['recaptcha_response'];
    $recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
    $recaptcha = json_decode($recaptcha);
    if ($recaptcha->score >= 0.7) {*/
        $email = $_POST['email'];
        $password = $_POST['password'];
        $sql = "SELECT email,rol_id FROM administrador WHERE  email = '$email' AND activo = 1
                UNION ALL
                SELECT email,rol_id FROM docente WHERE  email = '$email' AND activo = 1
                UNION ALL
                SELECT email,rol_id FROM alumno WHERE  email = '$email' AND activo = 1
                UNION ALL
                SELECT email,rol_id FROM tutor WHERE  email = '$email' AND activo = 1";
        $res = mysqli_query($conn, $sql);
        if ($res == TRUE) {
            $count = mysqli_num_rows($res);
            if ($count > 0) {
                $rows = mysqli_fetch_assoc($res);
                $rol = $rows['rol_id'];
                if ($rol == 1) {
                    $sql = "SELECT * FROM administrador WHERE email = '$email' AND activo = 1";
                    $res = mysqli_query($conn, $sql);
                    if ($res == TRUE) {
                        $count = mysqli_num_rows($res);
                        if ($count > 0) {
                            $rows = mysqli_fetch_assoc($res);
                            $id = $rows['id_admin'];
                            $nombre = $rows['nombre'];
                            $apellido = $rows['apellido'];
                            $imagen_perfil = $rows['img_perfil_nombre'];
                            if (password_verify($password, $rows['password'])) {
                                $_SESSION['id_sesion'] = $id;
                                $_SESSION['nombre_sesion'] = $nombre;
                                $_SESSION['apellido_sesion'] = $apellido;
                                $_SESSION['rol'] = $rol;
                                $_SESSION['imagen_perfil'] = $imagen_perfil;
                                $_SESSION['login'] = "<div class='alert alert-success'>Bienvenido " . $_SESSION['nombre_sesion'] . "</div>";
                                header('location:' . SITEURL . 'admin/');
                            } else {
                                $_SESSION['no-login'] = "<div class='alert alert-danger'>Usuario o contraseña incorrectos.</div>";
                                header('location:' . SITEURL);
                            }
                        } else {
                            $_SESSION['no-login'] = "<div class='alert alert-danger'>Usuario o contraseña incorrectos.</div>";
                            header('location:' . SITEURL);
                        }
                    } else {
                        $_SESSION['no-login'] = "<div class='alert alert-danger'>Usuario o contraseña incorrectos.</div>";
                        header('location:' . SITEURL);
                    }
                } else if ($rol == 2) {
                    $sql = "SELECT * FROM docente WHERE email = '$email' AND activo = 1";
                    $res = mysqli_query($conn, $sql);
                    if ($res == TRUE) {
                        $count = mysqli_num_rows($res);
                        if ($count > 0) {
                            $rows = mysqli_fetch_assoc($res);
                            $id = $rows['id_docente'];
                            $nombre = $rows['nombre'];
                            $apellido = $rows['apellido'];
                            $imagen_perfil = $rows['img_perfil_nombre'];
                            if (password_verify($password, $rows['password'])) {
                                $_SESSION['id_sesion'] = $id;
                                $_SESSION['nombre_sesion'] = $nombre;
                                $_SESSION['apellido_sesion'] = $apellido;
                                $_SESSION['rol'] = $rol;
                                $_SESSION['imagen_perfil'] = $imagen_perfil;
                                $_SESSION['login'] = "<div class='alert alert-success'>Bienvenido " . $_SESSION['nombre_sesion'] . "</div>";
                                header('location:' . SITEURL . 'docente/');
                            } else {
                                $_SESSION['no-login'] = "<div class='alert alert-danger'>Usuario o contraseña incorrectos.</div>";
                                header('location:' . SITEURL);
                            }
                        } else {
                            $_SESSION['no-login'] = "<div class='alert alert-danger'>Usuario o contraseña incorrectos.</div>";
                            header('location:' . SITEURL);
                        }
                    } else {
                        $_SESSION['no-login'] = "<div class='alert alert-danger'>Usuario o contraseña incorrectos.</div>";
                        header('location:' . SITEURL);
                    }
                } else if ($rol == 3) {
                    $sql = "SELECT * FROM alumno WHERE email = '$email' AND activo = 1";
                    $res = mysqli_query($conn, $sql);
                    if ($res == TRUE) {
                        $count = mysqli_num_rows($res);
                        if ($count > 0) {
                            $rows = mysqli_fetch_assoc($res);
                            $id = $rows['id_alumno'];
                            $nombre = $rows['nombre'];
                            $apellido = $rows['apellido'];
                            if (password_verify($password, $rows['password'])) {
                                $_SESSION['id_sesion'] = $id;
                                $_SESSION['nombre_sesion'] = $nombre;
                                $_SESSION['apellido_sesion'] = $apellido;
                                $_SESSION['rol'] = $rol;
                                $_SESSION['imagen_perfil'] = $imagen_perfil;
                                $_SESSION['login'] = "<div class='alert alert-success'>Bienvenido " . $_SESSION['nombre_sesion'] . "</div>";
                                header('location:' . SITEURL . 'alumno/');
                            } else {
                                $_SESSION['no-login'] = "<div class='alert alert-danger'>Usuario o contraseña incorrectos.</div>";
                                header('location:' . SITEURL);
                            }
                        } else {
                            $_SESSION['no-login'] = "<div class='alert alert-danger'>Usuario o contraseña incorrectos.</div>";
                            header('location:' . SITEURL);
                        }
                    } else {
                        $_SESSION['no-login'] = "<div class='alert alert-danger'>Usuario o contraseña incorrectos.</div>";
                        header('location:' . SITEURL);
                    }
                } else if ($rol == 4) {
                    $sql = "SELECT * FROM tutor WHERE email = '$email' AND activo = 1";
                    $res = mysqli_query($conn, $sql);
                    if ($res == TRUE) {
                        $count = mysqli_num_rows($res);
                        if ($count > 0) {
                            $rows = mysqli_fetch_assoc($res);
                            $id = $rows['id_tutor'];
                            $nombre = $rows['nombre'];
                            $apellido = $rows['apellido'];
                            $alumno_id = $rows['alumno_id'];
                            if (password_verify($password, $rows['password'])) {
                                $_SESSION['id_sesion'] = $id;
                                $_SESSION['nombre_sesion'] = $nombre;
                                $_SESSION['apellido_sesion'] = $apellido;
                                $_SESSION['alumno_id'] = $alumno_id;
                                $_SESSION['rol'] = $rol;
                                $_SESSION['imagen_perfil'] = $imagen_perfil;
                                $_SESSION['login'] = "<div class='alert alert-success'>Bienvenido " . $_SESSION['nombre_sesion'] . "</div>";
                                header('location:' . SITEURL . 'tutor/');
                            } else {
                                $_SESSION['no-login'] = "<div class='alert alert-danger'>Usuario o contraseña incorrectos.</div>";
                                header('location:' . SITEURL);
                            }
                        } else {
                            $_SESSION['no-login'] = "<div class='alert alert-danger'>Usuario o contraseña incorrectos.</div>";
                            header('location:' . SITEURL);
                        }
                    } else {
                        $_SESSION['no-login'] = "<div class='alert alert-danger'>Usuario o contraseña incorrectos.</div>";
                        header('location:' . SITEURL);
                    }
                }
            }
            $_SESSION['no-login'] = "<div class='alert alert-danger'>Usuario o contraseña incorrectos.</div>";
            header('location:' . SITEURL);
        }
        header('location:' . SITEURL);
    //} //errror en catpcha
}
?>