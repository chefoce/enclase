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
        url: "agregar_archivo_validado_admin.php",
        data: {todo : JSON.stringify(todo) },
        success: function(data) { 
          alert("Registros guardados con éxito");
          success: window.location.href = "/enclase/admin/consultar_admin.php"
       }
      });
    });
  });
