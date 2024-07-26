//Tabla No Exportar
$('#dtMaterialDesignExample').DataTable({
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
    }
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

  $('#dtMaterialDesignExample_wrapper, #dt-material-checkbox_wrapper').find('label').each(function() {
    $(this).parent().append($(this).children());
  });
  $('#dtMaterialDesignExample_filter input').attr("placeholder", "Buscar").removeClass('form-control-sm');
  $('#dtMaterialDesignExample_wrapper .dataTables_length, #dt-material-checkbox_wrapper .dataTables_length').addClass(
    'd-flex flex-row');
  $('#dtMaterialDesignExample_wrapper .dataTables_filter, #dt-material-checkbox_wrapper .dataTables_filter').addClass(
    'md-form');
  $('#dtMaterialDesignExample_wrapper .dataTables_filter, #dt-material-checkbox_wrapper .dataTables_filter').removeClass(
    'dataTables_filter');
  $('#dtMaterialDesignExample_wrapper select, #dt-material-checkbox_wrapper select').removeClass(
    'custom-select custom-select-sm form-control form-control-sm');
  $('#dtMaterialDesignExample_wrapper select, #dt-material-checkbox_wrapper select').addClass('mdb-select');
  $('#dtMaterialDesignExample_wrapper .mdb-select, #dt-material-checkbox_wrapper .mdb-select').materialSelect;
//Tabla Alumnos
$('#tabla_alumnos').DataTable({
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
        exportOptions: {
                  columns: [ 0, 1, 2, 3, 4 ]
              }
      },
      {
        extend: 'pdfHtml5',
        text: '<i class="fas fa-file-pdf"></i> ',
        titleAttr: 'Exportar a PDF',
        className: 'btn btn-danger',
        exportOptions: {
                  columns: [ 0, 1, 2, 3, 4 ]
              }
      },
      {
        extend: 'print',
        text: '<i class="fa fa-print"></i> ',
        titleAttr: 'Imprimir',
        className: 'btn btn-info',
        exportOptions: {
                  columns: [ 0, 1, 2, 3, 4 ]
              }
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

  $('#tabla_alumnos_wrapper, #dt-material-checkbox_wrapper').find('label').each(function() {
    $(this).parent().append($(this).children());
  });
  $('#tabla_alumnos_filter input').attr("placeholder", "Buscar").removeClass('form-control-sm');
  $('#tabla_alumnos_wrapper .dataTables_length, #dt-material-checkbox_wrapper .dataTables_length').addClass(
    'd-flex flex-row');
  $('#tabla_alumnos_wrapper .dataTables_filter, #dt-material-checkbox_wrapper .dataTables_filter').addClass(
    'md-form');
  $('#tabla_alumnos_wrapper .dataTables_filter, #dt-material-checkbox_wrapper .dataTables_filter').removeClass(
    'dataTables_filter');
  $('#tabla_alumnos_wrapper select, #dt-material-checkbox_wrapper select').removeClass(
    'custom-select custom-select-sm form-control form-control-sm');
  $('#tabla_alumnos_wrapper select, #dt-material-checkbox_wrapper select').addClass('mdb-select');
  $('#tabla_alumnos_wrapper .mdb-select, #dt-material-checkbox_wrapper .mdb-select').materialSelect;
  //Tabla Docentes Admin
$('#tabla_docentes').DataTable({
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
      exportOptions: {
                columns: [ 0, 1, 2, 3, 4 ]
            }
    },
    {
      extend: 'pdfHtml5',
      text: '<i class="fas fa-file-pdf"></i> ',
      titleAttr: 'Exportar a PDF',
      className: 'btn btn-danger',
      exportOptions: {
                columns: [ 0, 1, 2, 3, 4 ]
            }
    },
    {
      extend: 'print',
      text: '<i class="fa fa-print"></i> ',
      titleAttr: 'Imprimir',
      className: 'btn btn-info',
      exportOptions: {
                columns: [ 0, 1, 2, 3, 4 ]
            }
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

$('#tabla_docentes_wrapper, #dt-material-checkbox_wrapper').find('label').each(function() {
  $(this).parent().append($(this).children());
});
$('#tabla_docentes_filter input').attr("placeholder", "Buscar").removeClass('form-control-sm');
$('#tabla_docentes_wrapper .dataTables_length, #dt-material-checkbox_wrapper .dataTables_length').addClass(
  'd-flex flex-row');
$('#tabla_docentes_wrapper .dataTables_filter, #dt-material-checkbox_wrapper .dataTables_filter').addClass(
  'md-form');
$('#tabla_docentes_wrapper .dataTables_filter, #dt-material-checkbox_wrapper .dataTables_filter').removeClass(
  'dataTables_filter');
$('#tabla_docentes_wrapper select, #dt-material-checkbox_wrapper select').removeClass(
  'custom-select custom-select-sm form-control form-control-sm');
$('#tabla_docentes_wrapper select, #dt-material-checkbox_wrapper select').addClass('mdb-select');
$('#tabla_docentes_wrapper .mdb-select, #dt-material-checkbox_wrapper .mdb-select').materialSelect;

//Tabla 0-4
$('#tabla_0-4').DataTable({
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
      exportOptions: {
                columns: [ 0, 1, 2, 3, 4 ]
            }
    },
    {
      extend: 'pdfHtml5',
      text: '<i class="fas fa-file-pdf"></i> ',
      titleAttr: 'Exportar a PDF',
      className: 'btn btn-danger',
      exportOptions: {
                columns: [ 0, 1, 2, 3, 4 ]
            }
    },
    {
      extend: 'print',
      text: '<i class="fa fa-print"></i> ',
      titleAttr: 'Imprimir',
      className: 'btn btn-info',
      exportOptions: {
                columns: [ 0, 1, 2, 3, 4 ]
            }
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

$('#tabla_0-4_wrapper, #dt-material-checkbox_wrapper').find('label').each(function() {
  $(this).parent().append($(this).children());
});
$('#tabla_0-4_filter input').attr("placeholder", "Buscar").removeClass('form-control-sm');
$('#tabla_0-4_wrapper .dataTables_length, #dt-material-checkbox_wrapper .dataTables_length').addClass(
  'd-flex flex-row');
$('#tabla_0-4_wrapper .dataTables_filter, #dt-material-checkbox_wrapper .dataTables_filter').addClass(
  'md-form');
$('#tabla_0-4_wrapper .dataTables_filter, #dt-material-checkbox_wrapper .dataTables_filter').removeClass(
  'dataTables_filter');
$('#tabla_0-4_wrapper select, #dt-material-checkbox_wrapper select').removeClass(
  'custom-select custom-select-sm form-control form-control-sm');
$('#tabla_0-4_wrapper select, #dt-material-checkbox_wrapper select').addClass('mdb-select');
$('#tabla_0-4_wrapper .mdb-select, #dt-material-checkbox_wrapper .mdb-select').materialSelect;
//Tabla 0-7
$('#tabla_0-7').DataTable({
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
      exportOptions: {
                columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
            }
    },
    {
      extend: 'pdfHtml5',
      text: '<i class="fas fa-file-pdf"></i> ',
      titleAttr: 'Exportar a PDF',
      className: 'btn btn-danger',
      exportOptions: {
                columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
            }
    },
    {
      extend: 'print',
      text: '<i class="fa fa-print"></i> ',
      titleAttr: 'Imprimir',
      className: 'btn btn-info',
      exportOptions: {
                columns: [ 0, 1, 2, 3, 4, 5, 6, 7  ]
            }
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

$('#tabla_0-7_wrapper, #dt-material-checkbox_wrapper').find('label').each(function() {
  $(this).parent().append($(this).children());
});
$('#tabla_0-7_filter input').attr("placeholder", "Buscar").removeClass('form-control-sm');
$('#tabla_0-7_wrapper .dataTables_length, #dt-material-checkbox_wrapper .dataTables_length').addClass(
  'd-flex flex-row');
$('#tabla_0-7_wrapper .dataTables_filter, #dt-material-checkbox_wrapper .dataTables_filter').addClass(
  'md-form');
$('#tabla_0-7_wrapper .dataTables_filter, #dt-material-checkbox_wrapper .dataTables_filter').removeClass(
  'dataTables_filter');
$('#tabla_0-7_wrapper select, #dt-material-checkbox_wrapper select').removeClass(
  'custom-select custom-select-sm form-control form-control-sm');
$('#tabla_0-7_wrapper select, #dt-material-checkbox_wrapper select').addClass('mdb-select');
$('#tabla_0-7_wrapper .mdb-select, #dt-material-checkbox_wrapper .mdb-select').materialSelect;
//Tabla 1-5
$('#tabla_1-6').DataTable({
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
      exportOptions: {
                columns: [ 1, 2, 3, 4 ,5, 6]
            }
    },
    {
      extend: 'pdfHtml5',
      text: '<i class="fas fa-file-pdf"></i> ',
      titleAttr: 'Exportar a PDF',
      className: 'btn btn-danger',
      exportOptions: {
                columns: [ 1, 2, 3, 4 ,5, 6 ]
            }
    },
    {
      extend: 'print',
      text: '<i class="fa fa-print"></i> ',
      titleAttr: 'Imprimir',
      className: 'btn btn-info',
      exportOptions: {
                columns: [ 1, 2, 3, 4 ,5, 6 ]
            }
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

$('#tabla_1-6_wrapper, #dt-material-checkbox_wrapper').find('label').each(function() {
  $(this).parent().append($(this).children());
});
$('#tabla_1-6_filter input').attr("placeholder", "Buscar").removeClass('form-control-sm');
$('#tabla_1-6_wrapper .dataTables_length, #dt-material-checkbox_wrapper .dataTables_length').addClass(
  'd-flex flex-row');
$('#tabla_1-6_wrapper .dataTables_filter, #dt-material-checkbox_wrapper .dataTables_filter').addClass(
  'md-form');
$('#tabla_1-6_wrapper .dataTables_filter, #dt-material-checkbox_wrapper .dataTables_filter').removeClass(
  'dataTables_filter');
$('#tabla_1-6_wrapper select, #dt-material-checkbox_wrapper select').removeClass(
  'custom-select custom-select-sm form-control form-control-sm');
$('#tabla_1-6_wrapper select, #dt-material-checkbox_wrapper select').addClass('mdb-select');
$('#tabla_1-6_wrapper .mdb-select, #dt-material-checkbox_wrapper .mdb-select').materialSelect;

//Tabla 0-3
$('#tabla_0-3').DataTable({
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
      exportOptions: {
                columns: [ 0, 1, 2, 3 ]
            }
    },
    {
      extend: 'pdfHtml5',
      text: '<i class="fas fa-file-pdf"></i> ',
      titleAttr: 'Exportar a PDF',
      className: 'btn btn-danger',
      exportOptions: {
                columns: [ 0, 1, 2, 3 ]
            }
    },
    {
      extend: 'print',
      text: '<i class="fa fa-print"></i> ',
      titleAttr: 'Imprimir',
      className: 'btn btn-info',
      exportOptions: {
                columns: [ 0, 1, 2, 3 ]
            }
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

$('#tabla_0-3_wrapper, #dt-material-checkbox_wrapper').find('label').each(function() {
  $(this).parent().append($(this).children());
});
$('#tabla_0-3_filter input').attr("placeholder", "Buscar").removeClass('form-control-sm');
$('#tabla_0-3_wrapper .dataTables_length, #dt-material-checkbox_wrapper .dataTables_length').addClass(
  'd-flex flex-row');
$('#tabla_0-3_wrapper .dataTables_filter, #dt-material-checkbox_wrapper .dataTables_filter').addClass(
  'md-form');
$('#tabla_0-3_wrapper .dataTables_filter, #dt-material-checkbox_wrapper .dataTables_filter').removeClass(
  'dataTables_filter');
$('#tabla_0-3_wrapper select, #dt-material-checkbox_wrapper select').removeClass(
  'custom-select custom-select-sm form-control form-control-sm');
$('#tabla_0-3_wrapper select, #dt-material-checkbox_wrapper select').addClass('mdb-select');
$('#tabla_0-3_wrapper .mdb-select, #dt-material-checkbox_wrapper .mdb-select').materialSelect;

//Tabla 0-2
$('#tabla_0-2').DataTable({
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
      exportOptions: {
                columns: [ 0, 1, 2 ]
            }
    },
    {
      extend: 'pdfHtml5',
      text: '<i class="fas fa-file-pdf"></i> ',
      titleAttr: 'Exportar a PDF',
      className: 'btn btn-danger',
      exportOptions: {
                columns: [ 0, 1, 2 ]
            }
    },
    {
      extend: 'print',
      text: '<i class="fa fa-print"></i> ',
      titleAttr: 'Imprimir',
      className: 'btn btn-info',
      exportOptions: {
                columns: [ 0, 1, 2 ]
            }
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

$('#tabla_0-2_wrapper, #dt-material-checkbox_wrapper').find('label').each(function() {
  $(this).parent().append($(this).children());
});
$('#tabla_0-2_filter input').attr("placeholder", "Buscar").removeClass('form-control-sm');
$('#tabla_0-2_wrapper .dataTables_length, #dt-material-checkbox_wrapper .dataTables_length').addClass(
  'd-flex flex-row');
$('#tabla_0-2_wrapper .dataTables_filter, #dt-material-checkbox_wrapper .dataTables_filter').addClass(
  'md-form');
$('#tabla_0-2_wrapper .dataTables_filter, #dt-material-checkbox_wrapper .dataTables_filter').removeClass(
  'dataTables_filter');
$('#tabla_0-2_wrapper select, #dt-material-checkbox_wrapper select').removeClass(
  'custom-select custom-select-sm form-control form-control-sm');
$('#tabla_0-2_wrapper select, #dt-material-checkbox_wrapper select').addClass('mdb-select');
$('#tabla_0-2_wrapper .mdb-select, #dt-material-checkbox_wrapper .mdb-select').materialSelect;

//Tabla 0-1
$('#tabla_0-1').DataTable({
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
      exportOptions: {
                columns: [ 0, 1 ]
            }
    },
    {
      extend: 'pdfHtml5',
      text: '<i class="fas fa-file-pdf"></i> ',
      titleAttr: 'Exportar a PDF',
      className: 'btn btn-danger',
      exportOptions: {
                columns: [ 0, 1 ]
            }
    },
    {
      extend: 'print',
      text: '<i class="fa fa-print"></i> ',
      titleAttr: 'Imprimir',
      className: 'btn btn-info',
      exportOptions: {
                columns: [ 0, 1 ]
            }
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

$('#tabla_0-1_wrapper, #dt-material-checkbox_wrapper').find('label').each(function() {
  $(this).parent().append($(this).children());
});
$('#tabla_0-1_filter input').attr("placeholder", "Buscar").removeClass('form-control-sm');
$('#tabla_0-1_wrapper .dataTables_length, #dt-material-checkbox_wrapper .dataTables_length').addClass(
  'd-flex flex-row');
$('#tabla_0-1_wrapper .dataTables_filter, #dt-material-checkbox_wrapper .dataTables_filter').addClass(
  'md-form');
$('#tabla_0-1_wrapper .dataTables_filter, #dt-material-checkbox_wrapper .dataTables_filter').removeClass(
  'dataTables_filter');
$('#tabla_0-1_wrapper select, #dt-material-checkbox_wrapper select').removeClass(
  'custom-select custom-select-sm form-control form-control-sm');
$('#tabla_0-1_wrapper select, #dt-material-checkbox_wrapper select').addClass('mdb-select');
$('#tabla_0-1_wrapper .mdb-select, #dt-material-checkbox_wrapper .mdb-select').materialSelect;

//Tabla 0-5
$('#tabla_0-5').DataTable({
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
      exportOptions: {
                columns: [ 0, 1, 2, 3, 4, 5 ]
            }
    },
    {
      extend: 'pdfHtml5',
      text: '<i class="fas fa-file-pdf"></i> ',
      titleAttr: 'Exportar a PDF',
      className: 'btn btn-danger',
      exportOptions: {
                columns: [ 0, 1, 2, 3, 4, 5 ]
            }
    },
    {
      extend: 'print',
      text: '<i class="fa fa-print"></i> ',
      titleAttr: 'Imprimir',
      className: 'btn btn-info',
      exportOptions: {
                columns: [ 0, 1, 2, 3, 4, 5 ]
            }
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

$('#tabla_0-5_wrapper, #dt-material-checkbox_wrapper').find('label').each(function() {
  $(this).parent().append($(this).children());
});
$('#tabla_0-5_filter input').attr("placeholder", "Buscar").removeClass('form-control-sm');
$('#tabla_0-5_wrapper .dataTables_length, #dt-material-checkbox_wrapper .dataTables_length').addClass(
  'd-flex flex-row');
$('#tabla_0-5_wrapper .dataTables_filter, #dt-material-checkbox_wrapper .dataTables_filter').addClass(
  'md-form');
$('#tabla_0-5_wrapper .dataTables_filter, #dt-material-checkbox_wrapper .dataTables_filter').removeClass(
  'dataTables_filter');
$('#tabla_0-5_wrapper select, #dt-material-checkbox_wrapper select').removeClass(
  'custom-select custom-select-sm form-control form-control-sm');
$('#tabla_0-5_wrapper select, #dt-material-checkbox_wrapper select').addClass('mdb-select');
$('#tabla_0-5_wrapper .mdb-select, #dt-material-checkbox_wrapper .mdb-select').materialSelect;