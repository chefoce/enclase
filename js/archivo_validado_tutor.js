$(document).ready(function(){
    $("#btn_enviar").click(function(){
      //Declaramos el array general
      var todo=[];
      //Recorremos cada tr dentro de #tabla1 tbody
      $("#tabla1 tbody tr").each(function(){
          //Declaramos el array de cada línea de la tabla
          var ele=[];
          //Buscamos en el elemento tr cada elemento td
          $(this).find("td").each(function(){
              //Añadimos al array de la tabla el contenido.
              //.text() cojera solo el texto aunque exista dentro html
              ele.push($(this).text());
          });
          //Añadimos el array de la linea al array general
          todo.push(ele);
      });
      console.log(todo);
      $.ajax({
        type: "POST",
        url: "agregar_archivo_validado_tutor.php",
        data: {todo : JSON.stringify(todo) },
        success: function(data) { 
          alert("Registros guardados con éxito");
          window.location.href = "/enclase/admin/consultar_tutor.php"
       },
       error: function (jqXHR, exception) {
        var error_msg = '';
        if (jqXHR.status === 0) {
        error_msg = 'Not connect.\n Verify Network.';
        } else if (jqXHR.status == 404) {
        // 404 page error
        error_msg = 'Requested page not found. [404]';
        } else if (jqXHR.status == 500) {
        // 500 Internal Server error
        error_msg = 'Internal Server Error [500].';
        } else if (exception === 'parsererror') {
        // Requested JSON parse
        error_msg = 'Requested JSON parse failed.';
        } else if (exception === 'timeout') {
        // Time out error
        error_msg = 'Time out error.';
        } else if (exception === 'abort') {
        // request aborte
        error_msg = 'Ajax request aborted.';
        } else {
        error_msg = 'Uncaught Error.\n' + jqXHR.responseText;
        }
        // error alert message
        alert('error :: ' + error_msg);
        },
      });
    });
  });
