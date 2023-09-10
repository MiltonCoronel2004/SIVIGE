
	$(document).ready(function() {
  // Manejador de eventos para las filas de la tabla
  $(document).on("dblclick", ".fila-tabla", function() {
    // Obtener el valor del atributo "data-dni" de la fila
    var dni = $(this).data("dni");

    // Realizar una solicitud AJAX para obtener los datos del registro
    $.ajax({
      url: "php/get_registro.php",
      method: "POST",
      data: { dni: dni },
      success: function(response) {
        // Mostrar los datos del registro en la ventana modal
        $("#modal-body").html(response);
        $("#modal").show();
      }
    });
  });

  // Manejador de eventos para cerrar la ventana modal
  $(".close").click(function() {
    $("#modal").hide();
  });

  // Manejador de eventos para hacer clic fuera de la ventana modal
  $(window).click(function(event) {
    if (event.target == $("#modal")[0]) {
      $("#modal").hide();
    }
  });
});
