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
                    <div class="col-12 d-flex justify-content-center">
                        <h3 class="my-4 dark-grey-text font-weight-bold">Reporte Asistencia Alumno</h3>
                    </div>
                </div>
                <div class="row">
                    <?php
                    $sql = "SELECT * FROM alumno WHERE id_alumno = $id_alumno";
                    $res = mysqli_query($conn, $sql);
                    if ($res == TRUE) {
                        $count = mysqli_num_rows($res);
                        if ($count == 1) {
                            $row = mysqli_fetch_assoc($res);
                            $nombre = $row['nombre'];
                            $apellido = $row['apellido'];
                            $matricula = $row['matricula'];
                            $email = $row['email'];
                        } 
                    }
                    ?>
                    <div class="col-md-4">
                        <p class="mb-1 dark-grey-text font-weight-bold">Nombre</p>
                        <input type="text" class="mb-2 form-control" value="<?php echo $nombre . " " . $apellido; ?>" disabled>
                    </div>
                    <div class="col-md-4">
                        <p class="mb-1 dark-grey-text font-weight-bold">Matricula</p>
                        <input type="text" class="mb-2 form-control" value="<?php echo $matricula; ?>" disabled>
                    </div>
                    <div class="col-md-4">
                        <p class="mb-1 dark-grey-text font-weight-bold">Email</p>
                        <input type="text" class="mb-2 form-control" value="<?php echo $email; ?>" disabled>
                    </div>
                </div>
                <div class="row">
                    <?php
                    if (isset($_SESSION['error'])) {
                        echo $_SESSION['error'];
                        unset($_SESSION['error']);
                    }
                    ?>
                </div>
                <label class="mb-0 mt-2 dark-grey-text font-weight-bold" for="materia">Consulta Personalizada</label>
                <form class="form-date" action="" method="POST">
                    <div class="row">
                        <div class="col-md-4">
                            <select name="materia" required class="mdb-select colorful-select dropdown-primary md-form">
                                <?php
                                $sql = "SELECT dm.id_dm,
                                                g.nombre AS grupo,
                                                m.semestre AS semestre,
                                                m.nombre AS materia
                                        FROM docente_materia dm
                                        JOIN grupo g ON dm.grupo_id = g.id_grupo
                                        JOIN materia m ON dm.materia_id = m.id_materia
                                        JOIN alumno_docente ad ON dm.id_dm = ad.dm_id
                                        WHERE ad.alumno_id = $id_alumno AND dm.activo = 1";
                                $res = mysqli_query($conn, $sql);
                                if ($res == TRUE) {
                                    $count = mysqli_num_rows($res);
                                    if ($count > 0) {
                                        ?> <option value="" disabled selected>Seleccionar Materia</option> <?php
                                        while ($rows = mysqli_fetch_assoc($res)) {
                                            $id_dm = $rows['id_dm'];
                                            $grupo = $rows['grupo'];
                                            $semestre = $rows['semestre'];
                                            $materia = $rows['materia'];
                                ?>
                                            <option value="<?php echo $id_dm ?>">Materia: "<?php echo $materia ?>"</option>
                                <?php
                                        }
                                    }else{
                                        ?> <option value="" disabled selected>Sin grupos asignados</option> <?php
                                     }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <div class="md-form">
                                <input name="fecha_inicial" type="text" id="date1" class="form-control datepicker">
                                <label for="fecha_inicial" data-error="Ingresa la fecha" data-success="right" class="active">Fecha Inicial</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="md-form" style="margin-bottom: 0;">
                                <input name="fecha_final" type="text" id="date2" class="form-control datepicker">
                                <label for="fecha_final" data-error="Ingresa la fecha" data-error2="La fecha final no puede ser menor a la fecha inicial" data-success="right" class="active">Fecha Final</label>
                            </div>
                            <input type="hidden" id="date3" name="error">
                            <label for="error" data-error="La fecha final no puede ser menor a la fecha inicial" data-success="right" class="active"></label>
                        </div>
                        <div class="col-md-2">
                            <div class="md-form">
                                <input type="hidden" name="id_alumno" value="<?php echo $id_alumno; ?>" />
                                <button type="submit" name="submit" class="btn btn-success btn-block">Consultar Asistencia</button>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="card">
                    <div class="card-body table-responsive">
                        <table id="exportarDatos" class="table table-striped" cellspacing="0" width="100%">
                            <thead class="thead-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Fecha</th>
                                    <th>Modulo</th>
                                    <th>Semestre</th>
                                    <th>Asistencia</th>
                                    <th>Observaciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 0;
                                if (isset($_POST['submit'])) {
                                    $id_alumno = $_POST['id_alumno'];
                                    $dm_id = $_POST['materia'];
                                    $fecha_inicial = $_POST['fecha_inicial'];
                                    $fecha_final = $_POST['fecha_final'];
                                    $sql = "SELECT  m.nombre AS materia,
                                                    m.semestre,
                                                    a.asistencia,
                                                    a.observaciones,
                                                    a.fecha
                                            FROM asistencia a
                                            JOIN docente_materia dm ON a.dm_id = dm.id_dm
                                            JOIN materia m ON dm.materia_id = m.id_materia
                                            WHERE a.alumno_id = $id_alumno AND a.dm_id = $dm_id AND a.fecha BETWEEN '$fecha_inicial' AND '$fecha_final' ORDER BY a.fecha DESC";
                                } else {
                                    $sql = "SELECT  m.nombre AS materia,
                                                m.semestre,
                                                a.asistencia,
                                                a.observaciones,
                                                a.fecha
                                        FROM asistencia a
                                        JOIN docente_materia dm ON a.dm_id = dm.id_dm
                                        JOIN materia m ON dm.materia_id = m.id_materia
                                        WHERE alumno_id = $id_alumno ORDER BY fecha DESC";
                                }

                                $res = mysqli_query($conn, $sql);
                                if ($res == TRUE) {
                                    $count = mysqli_num_rows($res);
                                    if ($count > 0) {
                                        while ($rows = mysqli_fetch_array($res)) {
                                            $i++;
                                            $fecha = $rows['fecha'];
                                            $materia = $rows['materia'];
                                            $semestre = $rows['semestre'];
                                            $asistencia = $rows['asistencia'];
                                            $observaciones = $rows['observaciones'];

                                ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $fecha; ?></td>
                                                <td><?php echo $materia; ?></td>
                                                <td><?php echo $semestre; ?></td>
                                                <td><?php echo $asistencia; ?></td>
                                                <td><?php echo $observaciones; ?></td>
                                            </tr>
                                        <?php
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <td colspan="6">
                                                <h5 class="dark-grey-text font-weight-bold text-center">¡No existe registro de asistencia para el alumno seleccionado!</h5>
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

<?php include('partials/footer.php');?>
<script>
  $('#exportarDatos').DataTable({
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
        messageTop: 'Nombre: <?php echo $nombre . " " . $apellido; ?> -- Matricula: <?php echo $matricula; ?>',
        messageBottom: 'Fecha: <?php echo date('d-m-Y'); ?> -- Hora: <?php echo date("H:i:s"); ?> '
      },
      {
        extend: 'pdfHtml5',
        text: '<i class="fas fa-file-pdf"></i> ',
        titleAttr: 'Exportar a PDF',
        className: 'btn btn-danger',
        messageTop: 'Nombre: <?php echo $nombre . " " . $apellido; ?> -- Matricula: <?php echo $matricula; ?>',
        messageBottom: 'Fecha: <?php echo date('d-m-Y'); ?> -- Hora: <?php echo date("H:i:s"); ?> '
      },
      {
        extend: 'print',
        text: '<i class="fa fa-print"></i> ',
        titleAttr: 'Imprimir',
        className: 'btn btn-info',
        messageTop: 'Nombre: <?php echo $nombre . " " . $apellido; ?> -- Matricula: <?php echo $matricula; ?>',
        messageBottom: 'Fecha: <?php echo date('d-m-Y'); ?> -- Hora: <?php echo date("H:i:s"); ?> '
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

  $('#exportarDatos_wrapper, #dt-material-checkbox_wrapper').find('label').each(function() {
    $(this).parent().append($(this).children());
  });
  $('#exportarDatos_filter input').attr("placeholder", "Buscar").removeClass('form-control-sm');
  $('#exportarDatos_wrapper .dataTables_length, #dt-material-checkbox_wrapper .dataTables_length').addClass(
    'd-flex flex-row');
  $('#exportarDatos_wrapper .dataTables_filter, #dt-material-checkbox_wrapper .dataTables_filter').addClass(
    'md-form');
  $('#exportarDatos_wrapper .dataTables_filter, #dt-material-checkbox_wrapper .dataTables_filter').removeClass(
    'dataTables_filter');
  $('#exportarDatos_wrapper select, #dt-material-checkbox_wrapper select').removeClass(
    'custom-select custom-select-sm form-control form-control-sm');
  $('#exportarDatos_wrapper select, #dt-material-checkbox_wrapper select').addClass('mdb-select');
  $('#exportarDatos_wrapper .mdb-select, #dt-material-checkbox_wrapper .mdb-select').materialSelect;
</script>