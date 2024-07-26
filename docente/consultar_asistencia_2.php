<!-- Head -->
<?php include('partials/head1.php'); ?>
<title>ENCLASE - Reporte Asistencia</title>
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
                    <div class="col">
                        <a href="consultar_asistencia_1.php"><i class="my-4 fas fa-arrow-circle-left btn-atras"></i></a>
                    </div>
                    <div class="col-6 d-flex justify-content-center">
                        <h3 class="my-4 dark-grey-text font-weight-bold">Reporte Asistencia Grupal</h3>
                    </div>
                    <div class="col">

                    </div>
                </div>
                <div class="row">
                    <?php
                    if (isset($_SESSION['error'])) {
                        echo $_SESSION['error'];
                        unset($_SESSION['error']);
                    }
                    if (isset($_SESSION['exito'])) {
                        echo $_SESSION['exito'];
                        unset($_SESSION['exito']);
                    }
                    ?>
                </div>
                <div class="row">
                    <?php
                    $dm_id = $_GET['dm_id'];
                    $fecha = $_GET['fecha'];
                    $fecha_i = $fecha;
                    $fecha_f = $fecha;
                    $sql = "SELECT g.nombre AS grupo,
                                    m.nombre AS materia,
                                    p.nombre AS periodo
                            FROM docente_materia dm
                            JOIN grupo g ON dm.grupo_id = g.id_grupo
                            JOIN materia m ON dm.materia_id = m.id_materia
                            JOIN periodo p ON dm.periodo_id = p.id_periodo
                            WHERE dm.id_dm = $dm_id AND dm.activo = 1";
                    $res = mysqli_query($conn, $sql);
                    if ($res == TRUE) {
                        $count = mysqli_num_rows($res);
                        if ($count == 1) {
                            $row = mysqli_fetch_assoc($res);
                            $grupo = $row['grupo'];
                            $materia = $row['materia'];
                            $periodo = $row['periodo'];;
                        } else {
                            header('location:' . SITEURL . 'docente/consultar_asistencia_1.php');
                        }
                    }
                    ?>
                    <div class="col-md-1">
                        <p class="mb-1 dark-grey-text font-weight-bold">Grupo</p>
                        <input type="text" class="mb-2 form-control" value="<?php echo $grupo; ?>" disabled>
                    </div>
                    <div class="col-md-5">
                        <p class="mb-1 dark-grey-text font-weight-bold">Materia</p>
                        <input type="text" class="mb-2 form-control" value="<?php echo $materia; ?>" disabled>
                    </div>
                    <div class="col-md-3">
                        <p class="mb-1 dark-grey-text font-weight-bold">Periodo</p>
                        <input type="text" class="mb-2 form-control" value="<?php echo $periodo; ?>" disabled>
                    </div>
                    <div class="col-md-3">
                        <p class="mb-1 dark-grey-text font-weight-bold">Fecha</p>
                        <input type="text" class="mb-2 form-control" value="<?php echo $fecha; ?>" disabled>
                    </div>
                </div>
                <label class="mb-0 mt-2 dark-grey-text font-weight-bold" for="materia">Consulta Personalizada</label>
                <form class="form-date" action="" method="POST">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="md-form">
                                <input name="fecha_inicial" type="text" id="date1" class="form-control datepicker">
                                <label for="fecha_inicial" data-error="Ingresa la fecha" data-success="right" class="active">Fecha Inicial</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="md-form" style="margin-bottom: 0;">
                                <input name="fecha_final" type="text" id="date2" class="form-control datepicker">
                                <label for="fecha_final" data-error="Ingresa la fecha" data-error2="La fecha final no puede ser menor a la fecha inicial" data-success="right" class="active">Fecha Final</label>
                            </div>
                            <input type="hidden" id="date3" name="error">
                            <label for="error" data-error="La fecha final no puede ser menor a la fecha inicial" data-success="right" class="active"></label>
                        </div>
                        <div class="col-md-4">
                            <div class="md-form">
                                <button type="submit" name="submit" class="btn btn-success btn-block">Consultar Asistencia</button>
                            </div>

                        </div>
                    </div>
                </form>
                <div class="card">
                    <div class="card-body table-responsive">
                        <table id="exportarDatos2" class="table table-striped" cellspacing="0" width="100%">
                            <thead class="thead-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Fecha</th>
                                    <th>Apellido(s)</th>
                                    <th>Nombre(s)</th>
                                    <th class="text-center">PRESENTE</th>
                                    <th class="text-center">RETARDO</th>
                                    <th class="text-center">AUSENTE</th>
                                    <th class="text-center">JUSTIFICANTE</th>
                                    <th class="text-center">Observaciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 0;
                                $radio = 0;
                                if (isset($_POST['submit'])) {
                                    $fecha_inicial = $_POST['fecha_inicial'];
                                    $fecha_final = $_POST['fecha_final'];
                                    $fecha_i = $_POST['fecha_inicial'];
                                    $fecha_inicial = strtotime($fecha_inicial);
                                    $fecha_inicial = date('Y-m-d', $fecha_inicial);
                                    $fecha_f = $_POST['fecha_final'];
                                    $fecha_final = strtotime($fecha_final);
                                    $fecha_final = date('Y-m-d', $fecha_final);
                                    $sql = "SELECT asi.id_asistencia,
                                                    asi.alumno_id,
                                                    a.nombre,
                                                    a.apellido,
                                                    asi.asistencia,
                                                    asi.observaciones,
                                                    asi.fecha
                                        FROM asistencia asi
                                        JOIN alumno a ON asi.alumno_id = a.id_alumno
                                        WHERE asi.dm_id = $dm_id AND asi.fecha BETWEEN '$fecha_inicial' AND '$fecha_final' ORDER BY asi.fecha, a.apellido ASC";
                                } else {
                                    $fecha = strtotime($fecha);
                                    $fecha = date('Y-m-d', $fecha);
                                    $sql = "SELECT asi.id_asistencia,
                                                    asi.alumno_id,
                                                    a.nombre,
                                                    a.apellido,
                                                    asi.asistencia,
                                                    asi.observaciones,
                                                    asi.fecha
                                        FROM asistencia asi
                                        JOIN alumno a ON asi.alumno_id = a.id_alumno
                                        WHERE asi.dm_id = $dm_id AND asi.fecha = '$fecha' ORDER BY a.apellido";
                                }
                                $res = mysqli_query($conn, $sql);
                                if ($res == TRUE) {
                                    $count = mysqli_num_rows($res);
                                    if ($count > 0) {
                                        while ($rows = mysqli_fetch_array($res)) {
                                            $i++;
                                            $presente = 0;
                                            $fecha = $rows['fecha'];
                                            $fecha = strtotime($fecha);
                                            $fecha_formateada = date('d-m-Y', $fecha);
                                            $alumno_id = $rows['alumno_id'];
                                            $nombre_alumno = $rows['nombre'];
                                            $apellido_alumno = $rows['apellido'];
                                            $asistencia = $rows['asistencia'];
                                            $observaciones = $rows['observaciones'];
                                ?>
                                            <tr>
                                                <td><?php echo $i ?></td>
                                                <td><?php echo $fecha_formateada ?></td>
                                                <td><?php echo $apellido_alumno ?></td>
                                                <td><?php echo $nombre_alumno ?></td>
                                                <td>
                                                    <?php if ($asistencia == "Presente") { ?>
                                                        <div class="custom-control custom-radio">
                                                            <input <?php if ($asistencia == "Presente") {
                                                                        echo "checked";
                                                                    } ?> disabled type="radio" class="custom-control-input" id="presente<?php echo $radio; ?>" name="asistencia[<?php echo $radio; ?>]" value="Presente">
                                                            <label class="custom-control-label" for="presente<?php echo $radio; ?>">Presente</label>
                                                        </div>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <?php if ($asistencia == "Retardo") { ?>
                                                        <div class="custom-control custom-radio">
                                                            <input <?php if ($asistencia == "Retardo") {
                                                                        echo "checked";
                                                                    } ?> disabled type="radio" class="custom-control-input" id="retardo<?php echo $radio; ?>" name="asistencia[<?php echo $radio; ?>]" value="Retardo">
                                                            <label class="custom-control-label" for="retardo<?php echo $radio; ?>">Retardo</label>
                                                        </div>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <?php if ($asistencia == "Ausente") { ?>
                                                        <div class="custom-control custom-radio">
                                                            <input <?php if ($asistencia == "Ausente") {
                                                                        echo "checked";
                                                                    } ?> disabled type="radio" class="custom-control-input" id="ausente<?php echo $radio; ?>" name="asistencia[<?php echo $radio; ?>]" value="Ausente">
                                                            <label class="custom-control-label" for="ausente<?php echo $radio; ?>">Ausente</label>
                                                        </div>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <?php if ($asistencia == "Justificante") { ?>
                                                        <div class="custom-control custom-radio">
                                                            <input <?php if ($asistencia == "Justificante") {
                                                                        echo "checked";
                                                                    } ?> disabled type="radio" class="custom-control-input" id="justificante<?php echo $radio; ?>" name="asistencia[<?php echo $radio; ?>]" value="Justificante">
                                                            <label class="custom-control-label" for="justificante<?php echo $radio; ?>">Justificante</label>
                                                        </div>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <p><?php echo $observaciones; ?></p>
                                                </td>
                                            </tr>
                                        <?php
                                            $radio++;
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <td colspan="12">
                                                <h5 class="dark-grey-text font-weight-bold text-center">¡No existe registro de asistencia en el grupo y fecha seleccionada!</h5>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>

<?php include('partials/footer.php'); ?>
<script>
    $('#exportarDatos2').DataTable({
        scrollY: true,
        scrollX: true,
        language: {
            "processing": "Procesando...",
            "lengthMenu": "Registros _MENU_ por pagina",
            "zeroRecords": "No se encontraron resultados",
            "emptyTable": "Ningún dato disponible en esta tabla",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
            "search": "",
            "infoThousands": ",",
            "loadingRecords": "Cargando...",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            },
            "aria": {
                "sortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        },
        dom: '<"row align-items-center"<"col-sm-12 col-md-4"l><"col-sm-12 col-md-4 text-center"f><"col-sm-12 col-md-4 text-right"B>>t<"row"r<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
        buttons: [{
                extend: 'excelHtml5',
                text: '<i class="fas fa-file-excel"></i> ',
                titleAttr: 'Exportar a Excel',
                className: 'btn btn-success',
                messageTop: 'Grupo: <?php echo $grupo . "     Materia: " . $materia . "     Fecha: "; ?><?php if ($fecha_i != $fecha_formateada) {
                                                                                                            echo $fecha_i;
                                                                                                        } else {
                                                                                                            echo $fecha_formateada;
                                                                                                        } ?> / <?php if ($fecha_f != $fecha_formateada) {
                                                                                                                    echo $fecha_f;
                                                                                                                } else {
                                                                                                                    echo $fecha_formateada;
                                                                                                                } ?> ',
                messageBottom: 'Fecha: <?php if ($fecha_i != $fecha_formateada) {
                                            echo $fecha_i;
                                        } else {
                                            echo $fecha_formateada;
                                        } ?> / <?php if ($fecha_f != $fecha_formateada) {
                                                    echo $fecha_f;
                                                } else {
                                                    echo $fecha_formateada;
                                                } ?> '
            },
            {
                extend: 'pdfHtml5',
                text: '<i class="fas fa-file-pdf"></i> ',
                titleAttr: 'Exportar a PDF',
                className: 'btn btn-danger',
                messageTop: 'Grupo: <?php echo $grupo . "     Materia: " . $materia . "     Fecha: "; ?><?php if ($fecha_i != $fecha_formateada) {
                                                                                                            echo $fecha_i;
                                                                                                        } else {
                                                                                                            echo $fecha_formateada;
                                                                                                        } ?> / <?php if ($fecha_f != $fecha_formateada) {
                                                                                                                    echo $fecha_f;
                                                                                                                } else {
                                                                                                                    echo $fecha_formateada;
                                                                                                                } ?> ',
                messageBottom: 'Fecha: <?php if ($fecha_i != $fecha_formateada) {
                                            echo $fecha_i;
                                        } else {
                                            echo $fecha_formateada;
                                        } ?> / <?php if ($fecha_f != $fecha_formateada) {
                                                    echo $fecha_f;
                                                } else {
                                                    echo $fecha_formateada;
                                                } ?> '
            },
            {
                extend: 'print',
                text: '<i class="fa fa-print"></i> ',
                titleAttr: 'Imprimir',
                className: 'btn btn-info',
                messageTop: 'Grupo: <?php echo $grupo . "     Materia: " . $materia . "     Fecha: "; ?><?php if ($fecha_i != $fecha_formateada) {
                                                                                                            echo $fecha_i;
                                                                                                        } else {
                                                                                                            echo $fecha_formateada;
                                                                                                        } ?> / <?php if ($fecha_f != $fecha_formateada) {
                                                                                                                    echo $fecha_f;
                                                                                                                } else {
                                                                                                                    echo $fecha_formateada;
                                                                                                                } ?> ',
                messageBottom: 'Fecha: <?php if ($fecha_i != $fecha_formateada) {
                                            echo $fecha_i;
                                        } else {
                                            echo $fecha_formateada;
                                        } ?> / <?php if ($fecha_f != $fecha_formateada) {
                                                    echo $fecha_f;
                                                } else {
                                                    echo $fecha_formateada;
                                                } ?> '
            },
        ]
    });

    $('#dt-material-checkbox').dataTable({

        columnDefs: [{
            orderable: false,
            className: 'select-checkbox',
            targets: 0
        }],
        select: {
            style: 'os',
            selector: 'td:first-child'
        }
    });

    $('#exportarDatos2_wrapper, #dt-material-checkbox_wrapper').find('label').each(function() {
        $(this).parent().append($(this).children());
    });
    $('#exportarDatos2_filter input').attr("placeholder", "Buscar").removeClass('form-control-sm');
    $('#exportarDatos2_wrapper .dataTables_length, #dt-material-checkbox_wrapper .dataTables_length').addClass(
        'd-flex flex-row');
    $('#exportarDatos2_wrapper .dataTables_filter, #dt-material-checkbox_wrapper .dataTables_filter').addClass(
        'md-form');
    $('#exportarDatos2_wrapper .dataTables_filter, #dt-material-checkbox_wrapper .dataTables_filter').removeClass(
        'dataTables_filter');
    $('#exportarDatos2_wrapper select, #dt-material-checkbox_wrapper select').removeClass(
        'custom-select custom-select-sm form-control form-control-sm');
    $('#exportarDatos2_wrapper select, #dt-material-checkbox_wrapper select').addClass('mdb-select');
    $('#exportarDatos2_wrapper .mdb-select, #dt-material-checkbox_wrapper .mdb-select').materialSelect;
</script>