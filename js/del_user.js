$(document).ready(function() {
  // Manejador de eventos para hacer clic en el enlace de eliminar usuario
  $('.del-user').click(function(e) {
    e.preventDefault(); // Evita que el enlace recargue la página

    var fila = $(this).closest('.fila-tabla'); // Obtén la fila de la tabla más cercana
    var idUsuario = fila.data('id'); // Obtén el ID del usuario de los datos de la fila

    // Muestra un mensaje de confirmación antes de eliminar el usuario
    if (confirm('¿Estás seguro de que deseas eliminar este usuario?')) {
      // Realiza una solicitud AJAX para eliminar el usuario en el servidor
      $.ajax({
        url: '../php/del_user.php', // URL del script PHP que eliminará el usuario de la base de datos
        method: 'POST',
        data: {
          id: idUsuario
        },
        success: function() {
          window.location.href = '../php/del_user.php'
          fila.remove();
        },
        error: function() {
          // Si hay un error en la solicitud AJAX, muestra un mensaje de error
          alert('Error al eliminar el usuario. Inténtalo de nuevo.');
        }
      });
    }
  });
});
