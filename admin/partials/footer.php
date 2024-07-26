  <!-- Footer -->
  <footer class="page-footer pt-0 mt-5">

  </footer>



  <!-- SCRIPTS -->
  <!-- JQuery -->
  <script src="../js/jquery-3.4.1.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="../js/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="../js/bootstrap.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="../js/mdb.js"></script>
  <!-- DataTables  -->
  <script type="text/javascript" src="../js/addons/datatables.min.js"></script>
  <!-- DataTables Select  -->
  <script type="text/javascript" src="../js/addons/datatables-select.min.js"></script>
  <!-- Botones en datatables JS -->
  <script type="text/javascript" src="../js/addons/Buttons-2.2.3/dataTables.buttons.min.js"></script>
  <script type="text/javascript" src="../js/addons/JSZip-2.5.0/jszip.min.js"></script>
  <script type="text/javascript" src="../js/addons/pdfmake-0.1.36/pdfmake.min.js"></script>
  <script type="text/javascript" src="../js/addons/pdfmake-0.1.36/vfs_fonts.js"></script>
  <script type="text/javascript" src="../js/addons/Buttons-2.2.3/buttons.html5.min.js"></script>
  <script type="text/javascript" src="../js/addons/Buttons-2.2.3/buttons.print.min.js"></script>
  <!-- FullCalendar -->
  <script type="text/javascript" src='../js/fullcalendar-3.10.0/lib/moment.min.js'></script>
  <script type="text/javascript" src='../js/fullcalendar-3.10.0/fullcalendar.min.js'></script>
  <script type="text/javascript" src='../js/fullcalendar-3.10.0/locale/es.js'></script>
  <!--DateTime-->
  <script type="text/javascript" src="../js/addons/tempusdominus-bootstrap-4.min.js"></script>
  <!--DarkMode-->
  <script type="text/javascript" src="../js/dark_mode.js"></script>
  <!--Datatables Export-->
  <script type="text/javascript" src="../js/datatables_export.js"></script>
  <script>
    new WOW().init();
    // Data Picker Initialization
    const year = (new Date().getFullYear()) - 1;
    const year_max = (new Date().getFullYear());
    const year_min = (new Date().getFullYear())-25;
    $('.datepicker').pickadate({
      format: 'dd-mm-yyyy',
      monthsFull: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
      monthsShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
      weekdaysShort: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
      weekdaysFull: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sabado'],
      today: 'hoy',
      clear: 'limpiar',
      close: 'cerrar',
      max: true,
      min: [year, 1, 1]
    });
    $('.datepicker2').pickadate({
      format: 'yyyy-mm-dd',
      monthsFull: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
      monthsShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
      weekdaysShort: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
      weekdaysFull: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sabado'],
      today: 'hoy',
      clear: 'limpiar',
      close: 'cerrar',
      max: [year_max, 20, 30],
      min: true
    });
    $('.datepicker3').pickadate({
      format: 'yyyy-mm-dd',
      monthsFull: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
      monthsShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
      weekdaysShort: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
      weekdaysFull: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sabado'],
      today: 'hoy',
      clear: 'limpiar',
      close: 'cerrar',
      max: true,
      min: [year_min, 1, 1]
    });
    ///Verificar fechas
    function checkDate1() {
      if ($('#date1').val() == '') {
        $('#date1').addClass('invalid')
        return false;
      } else {
        $('#date1').removeClass('invalid')
        return true;
      }
    }

    function checkDate2() {
      var fecha_1 = $('#date1').val();
      fecha_1 = fecha_1.split("-").reverse().join("-");
      fecha_1 = new Date(fecha_1 + "T00:00:00");
      var fecha_2 = $('#date2').val();
      fecha_2 = fecha_2.split("-").reverse().join("-");
      fecha_2 = new Date(fecha_2 + "T00:00:00");
      if ($('#date2').val() == '') {
        $('#date2').addClass('invalid')
        return false;
      } else {
        $('#date2').removeClass('invalid')
        if (fecha_2 <= fecha_1) {
          $('#date3').addClass('invalid2')
          return false;
        } else {
          $('#date3').removeClass('invalid2')
          return true;
        }
      }
    }

    $('.form-date').submit(function() {
      checkDate1();
      checkDate2();
      if (checkDate1() == true && checkDate2() == true) {
        return true;
      } else {
        return false;
      }
    });

    $('#date1').change(function() {
      checkDate1();
      checkDate2();
    });
    $('#date2').change(function() {
      checkDate1();
      checkDate2();
    });


    // SideNav Initialization
    $(".button-collapse").sideNav();
    var container = document.querySelector('.custom-scrollbar');
    var ps = new PerfectScrollbar(container, {
      wheelSpeed: 2,
      wheelPropagation: true,
      minScrollbarLength: 20
    });
    // Material Select Initialization
    $(document).ready(function() {
      $('.mdb-select').materialSelect();
    });
    // Tooltips Initialization
    $(function() {
      $('[data-toggle="tooltip"]').tooltip()
    });
  </script>
  <script>
    $(document).ready(function() {
      if ($("#calendar").length > 0) {
        var date = new Date();
        var yyyy = date.getFullYear().toString();
        var mm = (date.getMonth() + 1).toString().length == 1 ? "0" + (date.getMonth() + 1).toString() : (date.getMonth() + 1).toString();
        var dd = (date.getDate()).toString().length == 1 ? "0" + (date.getDate()).toString() : (date.getDate()).toString();

        $('#calendar').fullCalendar({
          customButtons: {
            eventoDocente: {
              text: '+Evento Docente',
              click: function() {
                $('#ModalAddDocente').modal('show');
              }
            },
            eventoAlumno: {
              text: '+Evento Alumno',
              click: function() {
                $('#ModalAddAlumno').modal('show');
              }
            }
          },
          header: {
            language: 'es',
            left: 'prev,next today eventoDocente',
            center: 'title',
            right: 'eventoAlumno month,basicWeek,basicDay',
          },
          defaultDate: yyyy + "-" + mm + "-" + dd,
          editable: true,
          eventLimit: true, // allow "more" link when too many events
          selectable: true,
          selectHelper: true,
          Boolean,
          default: true,
          eventRender: function(event, element) {
            element.bind('dblclick', function() {
              $('#ModalEdit #id').val(event.id);
              $('#ModalEdit #title').val(event.title);
              $('#ModalEdit #start').val(event.start.format('YYYY-MM-DD'));
              $('#ModalEdit #time').val(event.start.format('HH:mm'));
              $('#ModalEdit #color').val(event.color);
              $('#ModalEdit').modal('show');
            });
          },
          eventDrop: function(event, delta, revertFunc) {

            edit(event);

          },
          eventResize: function(event, dayDelta, minuteDelta, revertFunc) {

            edit(event);

          },
          events: [
            <?php foreach ($events as $event) :

              $inicio = explode(" ", $event['inicio']);
              $fin = explode(" ", $event['fin']);
              if ($inicio[1] == '00:00:00') {
                $inicio = $inicio[0];
              } else {
                $inicio = $event['inicio'];
              }
              if ($fin[1] == '00:00:00') {
                $fin = $fin[0];
              } else {
                $fin = $event['fin'];
              }
            ?> {
                id: '<?php echo $event['id_evento']; ?>',
                title: '<?php echo $event['titulo']; ?>',
                start: '<?php echo $inicio; ?>',
                end: '<?php echo $fin; ?>',
                color: '<?php echo $event['color']; ?>'
              },
            <?php endforeach; ?>
          ]
        });

        function edit(event) {
          start = event.start.format('YYYY-MM-DD HH:mm:ss');
          if (event.end) {
            end = event.end.format('YYYY-MM-DD HH:mm:ss');
          } else {
            end = start;
          }

          id = event.id;

          Event = [];
          Event[0] = id;
          Event[1] = start;
          Event[2] = end;

          $.ajax({
            url: 'actualizar_fecha_evento.php',
            type: "POST",
            data: {
              Event: Event
            },
            success: function(rep) {
              if (rep == 'OK') {
                alert('Evento se ha guardado correctamente');
              } else {
                alert('No se pudo guardar. Inténtalo de nuevo.');
              }
            }
          });
        }
      }
    });
  </script>
  <!--DateTime-->
  <script type="text/javascript">
    $(function() {
      $('#datetimepicker1').datetimepicker({
        format: 'LT',
        autoclose: true
      });
    });
    $(function() {
      $('#datetimepicker2').datetimepicker({
        format: 'LT',
        autoclose: true
      });
    });
    $(function() {
      $('#datetimepicker3').datetimepicker({
        format: 'LT',
        autoclose: true
      });
    });
  </script>
  </body>

  </html>
  <?php ob_start(); ?>