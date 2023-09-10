$(document).ready(function() {
  // Manejador de eventos para hacer clic en el enlace de actualizar contraseña
  $('.update-pass').click(function(e) {
    e.preventDefault(); // Evita que el enlace recargue la página

    var fila = $(this).closest('.fila-tabla'); // Obtén la fila de la tabla más cercana
    var idUsuario = fila.data('id'); // Obtén el ID del usuario de los datos de la fila

    // Muestra un mensaje de alerta para ingresar la nueva contraseña
    var nuevaPass = prompt('Ingrese su nueva contraseña:');

    // Verifica si se ingresó una contraseña
    if (nuevaPass !== null) {
      // Realiza una solicitud AJAX para actualizar la contraseña en el servidor
      $.ajax({
        url: '../php/update_pass.php', // URL del script PHP que actualizará la contraseña en la base de datos
        method: 'POST',
        data: {
          id: idUsuario,
          password: nuevaPass
        },
        success: function(response) {
          // Si la actualización fue exitosa, muestra un mensaje de éxito
          if (response === 'success') {
            alert('Contraseña actualizada correctamente.');
          } else {
            // Si la actualización falló, muestra un mensaje de error
            alert('Error al actualizar la contraseña. Campo Vacio.');
          }
        },
        error: function() {
          alert('Error al actualizar la contraseña. Inténtalo de nuevo.');
        }
      });
    }
  });
});
