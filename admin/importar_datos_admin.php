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
                <div class="row">
                    <div class="col-md-8">
                        <a href="consultar_admin.php"><i class="fas fa-arrow-circle-left verde-item" style="font-size: 35px;"></i></a>
                    </div>
                    <div class="col-md-4">
                        <a class="btn verde-conalep float-right waves-effect waves-light" href="formatos/Administrador.xlsx" role="button">
                            <i class="fas fa-file-download mr-2"></i>
                            Generar Archivo para Carga
                        </a>
                    </div>
                </div>
                <h1 class="text-center my-5 h1">Importar Datos Administrador</h1>
                <?php
                if (isset($_SESSION['error'])) {
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                }
                ?>
                <form action="importar_datos_admin_2.php" method="POST" enctype="multipart/form-data">
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
                            <a href="consultar_admin.php" class="btn btn-danger btn-block">Cancelar</a>
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

