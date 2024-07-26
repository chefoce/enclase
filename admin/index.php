<!-- Head -->
<?php include('partials/head1.php'); ?>
<title>ENCLASE - Inicio Administrador</title>
<?php include('partials/head2.php'); ?>
<!-- Sidebar -->
<?php include('partials/sidebar.php'); ?>
<!-- Navbar -->
<?php include('partials/navbar.php'); ?>

<!-- Main -->
<main>
    <?php
    if (isset($_SESSION['login'])) {
        echo $_SESSION['login'];
        unset($_SESSION['login']);
    }
    ?>
    <?php
    $sql = "SELECT * FROM eventos WHERE admin_id = $id_admin AND rol_autor = 'admin'";
    $req = $conn->prepare($sql);
    $req->execute();
    $resultSet = $req->get_result();
    $events = $resultSet->fetch_all(MYSQLI_ASSOC);
    ?>
    <div class="container-fluid mb-5">
        <section>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12 text-center">
                                <h2 class="display-4 verde-conalep text-white mb-1">Mis Eventos</h2>
                                <p class="text-muted note note-success mb-1">Selecciona Evento Docente o Evento Alumno, doble click sobre un evento para modificarlo, o arrastra el evento para cambiar la fecha</p>
                                <div id="calendar" class="col-centered">
                                </div>
                            </div>
                            <!-- Modal Evento Alumno -->
                            <div class="modal fade" id="ModalAddAlumno" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog modal-notify modal-info" role="document">
                                    <div class="modal-content">
                                        <form class="" method="POST" action="agregar_evento_alumno.php">

                                            <div class="modal-header verde-conalep">
                                                <h4 class="heading lead" id="myModalLabel">Agregar Evento Alumno</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="white-text">&times;</span></button>
                                            </div>
                                            <div class="modal-body mx-3">

                                                <div class="row mb-3">
                                                    <label for="title">Titulo</label>
                                                    <input type="text" id="title" name="title" class="form-control" placeholder="Ingresa el titulo del evento" required>
                                                </div>
                                                <div style="margin-top: 2rem !important;" class="row d-block">
                                                    <select name="grupo" class="mdb-select md-form" searchable="Buscar.." id="grupo" required>
                                                        <?php
                                                        $sql = "SELECT * FROM grupo WHERE activo = 1";
                                                        $res = mysqli_query($conn, $sql);
                                                        if ($res == TRUE) {
                                                            $count = mysqli_num_rows($res);
                                                            if ($count > 0) {
                                                                while ($rows = mysqli_fetch_assoc($res)) {
                                                                    $id_grupo = $rows['id_grupo'];
                                                                    $nombre = $rows['nombre'];
                                                        ?>
                                                                    <option value="<?php echo $id_grupo ?>">Grupo: <?php echo $nombre ?></option>
                                                        <?php
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                    <label class="label-select mdb-main-label">Selecciona el Grupo</label>
                                                </div>

                                                <div class="row mb-1">
                                                    <label for="color">Tipo</label>
                                                    <select name="color" class="browser-default custom-select" id="color" required>
                                                        <option value="" disabled selected>Selecciona el tipo de evento</option>
                                                        <option style="color:#0071c5;" value="#0071c5">&#9724; Azul oscuro</option>
                                                        <option style="color:#40E0D0;" value="#40E0D0">&#9724; Turquesa</option>
                                                        <option style="color:#008000;" value="#008000">&#9724; Verde</option>
                                                        <option style="color:#FFD700;" value="#FFD700">&#9724; Amarillo</option>
                                                        <option style="color:#FF8C00;" value="#FF8C00">&#9724; Naranja</option>
                                                        <option style="color:#FF0000;" value="#FF0000">&#9724; Rojo</option>
                                                        <option style="color:#000;" value="#000">&#9724; Negro</option>
                                                    </select>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="start">Fecha Inicial</label>
                                                    <input placeholder="Selecciona la Fecha" name="start" type="text" id="date-picker" class="form-control datepicker2" required>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group">
                                                        <label for="time">Hora</label>
                                                        <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                                                            <input type="text" name="time" id="time" class="form-control datetimepicker-input" data-target="#datetimepicker1" required />
                                                            <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
                                                                <div class="input-group-text"><i class="far fa-clock verde-item"></i></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label for="end">Fecha Final</label>
                                                    <input placeholder="Selecciona la Fecha" name="end" type="text" id="date-picker" class="form-control datepicker2" required>
                                                </div>
                                            </div>
                                            <input type="hidden" value="<?php echo $id_admin ?>" name="id_admin" class="form-control" id="id_admin">
                                            <div class="modal-footer justify-content-center">
                                                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Cerrar</button>
                                                <button type="submit" class="btn verde-conalep">Guardar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal Evento Docente -->
                            <div class="modal fade" id="ModalAddDocente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog modal-notify modal-info" role="document">
                                    <div class="modal-content">
                                        <form class="" method="POST" action="agregar_evento_docente.php">

                                            <div class="modal-header verde-conalep">
                                                <h4 class="heading lead" id="myModalLabel">Agregar Evento Docente</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="white-text">&times;</span></button>
                                            </div>
                                            <div class="modal-body mx-3">

                                                <div class="row mb-4">
                                                    <label for="title">Titulo</label>
                                                    <input type="text" id="title" name="title" class="form-control" placeholder="Ingresa el titulo del evento" required>
                                                </div>
                                                <div style="margin-top: 2rem !important;" class="row d-block">
                                                    <select name="docente[]" class="mdb-select md-form" multiple searchable="Buscar.." id="docente" required>
                                                        <?php
                                                        $sql = "SELECT * FROM docente WHERE activo = 1";
                                                        $res = mysqli_query($conn, $sql);
                                                        if ($res == TRUE) {
                                                            $count = mysqli_num_rows($res);
                                                            if ($count > 0) {
                                                                while ($rows = mysqli_fetch_assoc($res)) {
                                                                    $id_docente = $rows['id_docente'];
                                                                    $nombre = $rows['nombre'];
                                                                    $apellido = $rows['apellido'];
                                                        ?>
                                                                    <option value="<?php echo $id_docente ?>"><?php echo $nombre." ".$apellido ?></option>
                                                        <?php
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                    <label class="label-select mdb-main-label">Selecciona Docente(s)</label>
                                                </div>

                                                <div class="row mb-3">
                                                    <label for="color">Tipo</label>
                                                    <select name="color" class="browser-default custom-select" id="color" required>
                                                        <option value="" disabled selected>Selecciona el tipo de evento</option>
                                                        <option style="color:#0071c5;" value="#0071c5">&#9724; Azul oscuro</option>
                                                        <option style="color:#40E0D0;" value="#40E0D0">&#9724; Turquesa</option>
                                                        <option style="color:#008000;" value="#008000">&#9724; Verde</option>
                                                        <option style="color:#FFD700;" value="#FFD700">&#9724; Amarillo</option>
                                                        <option style="color:#FF8C00;" value="#FF8C00">&#9724; Naranja</option>
                                                        <option style="color:#FF0000;" value="#FF0000">&#9724; Rojo</option>
                                                        <option style="color:#000;" value="#000">&#9724; Negro</option>
                                                    </select>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="start">Fecha Inicial</label>
                                                    <input placeholder="Selecciona la Fecha" name="start" type="text" id="date-picker" class="form-control datepicker2" required>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group">
                                                        <label for="time">Hora</label>
                                                        <div class="input-group date" id="datetimepicker2" data-target-input="nearest">
                                                            <input type="text" name="time" id="time" class="form-control datetimepicker-input" data-target="#datetimepicker2" required />
                                                            <div class="input-group-append" data-target="#datetimepicker2" data-toggle="datetimepicker">
                                                                <div class="input-group-text"><i class="far fa-clock verde-item"></i></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label for="end">Fecha Final</label>
                                                    <input placeholder="Selecciona la Fecha" name="end" type="text" id="date-picker" class="form-control datepicker2" required>
                                                </div>
                                            </div>
                                            <input type="hidden" value="<?php echo $id_admin ?>" name="id_admin" class="form-control" id="id_admin">
                                            <div class="modal-footer justify-content-center">
                                                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Cerrar</button>
                                                <button type="submit" class="btn verde-conalep">Guardar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal Editar -->
                            <div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog modal-notify modal-info" role="document">
                                    <div class="modal-content">
                                        <form class="" method="POST" action="actualizar_titulo_evento.php">
                                            <div class="modal-header verde-conalep">
                                                <h4 class="heading lead" id="myModalLabel">Modificar Evento</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="white-text">&times;</span></button>
                                            </div>
                                            <div class="modal-body mx-3">
                                                <div class="row mb-3">
                                                    <label for="title">Titulo</label>
                                                    <input type="text" id="title" name="title" class="form-control" placeholder="Ingresa el titulo del evento" required>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="color">Tipo</label>
                                                    <select name="color" class="browser-default custom-select" id="color" required>
                                                        <option value="" disabled selected>Selecciona el tipo de evento</option>
                                                        <option style="color:#0071c5;" value="#0071c5">&#9724; Azul oscuro</option>
                                                        <option style="color:#40E0D0;" value="#40E0D0">&#9724; Turquesa</option>
                                                        <option style="color:#008000;" value="#008000">&#9724; Verde</option>
                                                        <option style="color:#FFD700;" value="#FFD700">&#9724; Amarillo</option>
                                                        <option style="color:#FF8C00;" value="#FF8C00">&#9724; Naranja</option>
                                                        <option style="color:#FF0000;" value="#FF0000">&#9724; Rojo</option>
                                                        <option style="color:#000;" value="#000">&#9724; Negro</option>
                                                    </select>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group">
                                                        <label for="time">Hora</label>
                                                        <div class="input-group date" id="datetimepicker3" data-target-input="nearest">
                                                            <input type="text" name="time" id="time" class="form-control datetimepicker-input" data-target="#datetimepicker3" required />
                                                            <div class="input-group-append" data-target="#datetimepicker3" data-toggle="datetimepicker">
                                                                <div class="input-group-text"><i class="far fa-clock verde-item"></i></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="defaultUnchecked" name="delete">
                                                        <label class="custom-control-label text-danger" for="defaultUnchecked">Eliminar Evento</label>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="id" class="form-control" id="id">
                                                <input type="hidden" name="start" class="form-control" id="start">
                                            </div>
                                            <div class="modal-footer justify-content-center">
                                                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Cerrar</button>
                                                <button type="submit" class="btn verde-conalep">Guardar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>
<!-- Main -->

<?php include('partials/footer.php'); ?>