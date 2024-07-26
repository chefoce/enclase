<!-- Head -->
<?php include('partials/head1.php'); ?>
<title>ENCLASE - Inicio Docente</title>
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
    $sql = "SELECT e.id_evento,
                    e.titulo,
                    e.color,
                    e.inicio,
                    e.fin,
                    e.docente_id,
                    g.nombre AS grupo,
                    m.nombre AS materia
                FROM eventos e
                JOIN docente_materia dm ON e.dm_id = dm.id_dm
                JOIN grupo g ON dm.grupo_id = g.id_grupo
                JOIN materia m ON dm.materia_id = m.id_materia
                WHERE e.docente_id = $id_docente AND rol_autor = 'docente'";
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
                                <p class="text-muted note note-success mb-1">Selecciona un dia para agregar un evento nuevo, doble click sobre un evento para modificarlo, o arrastra el evento para cambiar la fecha</p>
                                <div id="calendar" class="col-centered">
                                </div>
                            </div>
                            <!-- Modal -->
                            <div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog modal-notify modal-info" role="document">
                                    <div class="modal-content">
                                        <form class="" method="POST" action="agregar_evento.php">

                                            <div class="modal-header verde-conalep">
                                                <h4 class="heading lead" id="myModalLabel">Agregar Evento</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="white-text">&times;</span></button>
                                            </div>
                                            <div class="modal-body mx-3">

                                                <div class="row mb-3">
                                                    <label for="title">Titulo</label>
                                                    <input type="text" id="title" name="title" class="form-control" placeholder="Ingresa el titulo del evento" required>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="grupo">Grupo</label>
                                                    <select name="grupo" class="browser-default custom-select" id="grupo" required>
                                                        <option value="" disabled selected>Selecciona el Grupo</option>
                                                        <?php
                                                        $sql = "SELECT dm.id_dm,
                                                                        dm.grupo_id,
                                                                        g.nombre AS grupo,
                                                                        m.nombre AS materia
                                                                FROM docente_materia dm
                                                                JOIN grupo g ON dm.grupo_id = g.id_grupo
                                                                JOIN materia m ON dm.materia_id = m.id_materia
                                                                WHERE dm.docente_id = $id_docente AND dm.activo = 1";
                                                        $res = mysqli_query($conn, $sql);
                                                        if ($res == TRUE) {
                                                            $count = mysqli_num_rows($res);
                                                            if ($count > 0) {
                                                                while ($rows = mysqli_fetch_assoc($res)) {
                                                                    $id_dm = $rows['id_dm'];
                                                                    $grupo_id = $rows['grupo_id'];
                                                                    $grupo = $rows['grupo'];
                                                                    $materia = $rows['materia'];
                                                        ?>          
                                                                    <option value="<?php echo $id_dm." ".$grupo_id; ?>">Grupo: "<?php echo $grupo ?>" | Materia: "<?php echo $materia ?>"</option>
                                                        <?php
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                    </select>
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
                                                    <input type="text" name="start" class="form-control" id="start" readonly required>
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
                                                    <label for="end">Fecha Final</label>
                                                    <input type="text" name="end" class="form-control" id="end" readonly required>
                                                </div>
                                            </div>
                                            <input type="hidden" value="<?php echo $id_docente ?>" name="id_docente" class="form-control" id="id_docente">
                                            <input type="hidden" value="<?php echo $materia ?>" name="materia" class="form-control" id="materia">
                                            <div class="modal-footer justify-content-center">
                                                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Cerrar</button>
                                                <button type="submit" class="btn verde-conalep">Guardar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>


                            <!-- Modal -->
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
                                                        <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                                                            <input type="text" name="time" id="time" class="form-control datetimepicker-input" data-target="#datetimepicker1" required />
                                                            <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
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