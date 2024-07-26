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
  $('#exportarDatos_wrapper .mdb-select, #dt-material-checkbox_wrapper .mdb-select').materialSelect();
</script>
</body>

</html>