<!-- Head -->
<?php include('partials/head1.php'); ?>
<title>ENCLASE - Soporte</title>
<?php include('partials/head2.php'); ?>
<!-- Sidebar -->
<?php include('partials/sidebar.php'); ?>
<!-- Navbar -->
<?php include('partials/navbar.php'); ?>

<!-- Main -->
<main>
    <div class="container-fluid mb-5">
        <section>
            <div class="col-md-12">
                <div class="row">
                    <?php
                    if (isset($_SESSION['ok'])) {
                        echo $_SESSION['ok'];
                        unset($_SESSION['ok']);
                    }
                    ?>
                </div>
                <div class="card">
                    <div class="card-body">
                        <!--Section: Contact v.2-->
                        <section class="mb-4">

                            <!--Section heading-->
                            <h2 class="h1-responsive font-weight-bold text-center my-4">Soporte</h2>
                            <!--Section description-->
                            <p class="text-center w-responsive mx-auto mb-5">¿Tienes alguna pregunta o problema? Por favor no dudes en contactarnos directamente, escribe tu duda o problema y nos contactaremos lo más pronto posible.</p>

                            <div class="row">

                                <!--Grid column-->
                                <div class="col-md-12 mb-md-0 mb-5">
                                    <form id="contact-form" name="contact-form" action="contacto.php" method="POST">

                                        <!--Grid row-->
                                        <div class="row">

                                            <!--Grid column-->
                                            <div class="col-md-6">
                                                <div class="md-form mb-0">
                                                    <input type="text" id="nombre" name="nombre" class="form-control">
                                                    <label for="nombre" class="">Ingresa tu Nombre</label>
                                                </div>
                                            </div>
                                            <!--Grid column-->

                                            <!--Grid column-->
                                            <div class="col-md-6">
                                                <div class="md-form mb-0">
                                                    <input type="text" id="email" name="email" class="form-control">
                                                    <label for="email" class="">Ingresa tu Email</label>
                                                </div>
                                            </div>
                                            <!--Grid column-->

                                        </div>
                                        <!--Grid row-->

                                        <!--Grid row-->
                                        <div class="row">

                                            <!--Grid column-->
                                            <div class="col-md-12">

                                                <div class="md-form">
                                                    <textarea type="text" id="mensaje" name="mensaje" rows="2" class="form-control md-textarea"></textarea>
                                                    <label for="mensaje">Escribe tu mensaje</label>
                                                </div>

                                            </div>
                                        </div>
                                        <!--Grid row-->

                                    </form>

                                    <div class="text-center text-md-left">
                                        <div class="row mb-1">
                                            <div class="col-6 mx-auto">
                                                <a href="index.php" class="btn btn-danger btn-block">Cancelar</a>
                                            </div>
                                            <div class="col-6 mx-auto">
                                                <button type="submit" name="submit" class="btn verde-conalep btn-block">Enviar</button>
                                            </div>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>

                        </section>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>

<?php include('partials/footer.php'); ?>

<?php
if (isset($_POST['submit'])) {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $mensaje = $_POST['mensaje'];

    $contenido = "De: $nombre \n Email: $email \n Mensaje: $mensaje";
    $remitente = "coceguerah.acad317@sin.conalep.edu.mx";
    $encabezado = "De: $email \r\n";
    mail($remitente, $contenido, $encabezado) or die("Error!");
    $_SESSION['ok'] = "<div class='alert alert-success'>Mensaje Enviado</div>";
    header("location:" . SITEURL . 'tutor/soporte.php');
}

?>