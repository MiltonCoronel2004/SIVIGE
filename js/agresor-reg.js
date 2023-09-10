<script>
$(document).ready(function() {
  $('#formulario').submit(function(e) {
    e.preventDefault(); // Evitar envío normal del formulario
    
    // Obtener los datos del formulario
    var formData = $(this).serialize();
    
    // Enviar la solicitud AJAX
    $.ajax({
      url: $(this).attr('action'),
      type: 'POST',
      data: formData,
      success: function(response) {


        
      }
    });
  });
});
</script>
