$(document).ready(function() {
  // Manejador de eventos para hacer clic en el enlace de editar usuario
  $('.editar-usuario').click(function(e) {
    e.preventDefault(); // Evita que el enlace recargue la página

    var fila = $(this).closest('.fila-tabla'); // Obtén la fila de la tabla más cercana
    var idUsuario = fila.data('id'); // Obtén el ID del usuario de los datos de la fila

    // Obtén los valores actuales de los campos dni, nombre, user y rol
    var dni = fila.find('td:eq(0)').text();
    var nombre = fila.find('td:eq(1)').text();
    var user = fila.find('td:eq(2)').text();
    var rol = fila.find('td:eq(3)').text();

    // Crea los campos de edición con los valores actuales
    var formulario = '<td><input type="text" name="dni" value="' + dni + '"></td>';
    formulario += '<td><input type="text" name="nombre" value="' + nombre + '"></td>';
    formulario += '<td><input type="text" name="user" value="' + user + '"></td>';

    // Agrega el select del rol con las opciones correspondientes
    formulario += '<td><select name="rol">';
    formulario += '<option value="Administrador" ' + (rol === 'Administrador' ? 'selected' : '') + '>Administrador</option>';
    formulario += '<option value="Editor" ' + (rol === 'Editor' ? 'selected' : '') + '>Editor</option>';
    formulario += '<option value="Lector" ' + (rol === 'Lector' ? 'selected' : '') + '>Lector</option>';
    formulario += '</select></td>';

    formulario += '<td><input type="submit" class="guardar-edicion" name="save" value="Guardar"></td>';

    // Reemplaza los datos de la fila con los campos de edición
    fila.html(formulario);

    // Manejador de eventos para guardar la edición
    $('.guardar-edicion').click(function(e) {
      e.preventDefault(); // Evita que el formulario se envíe por defecto

      // Obtén los nuevos valores de los campos de edición
      var nuevoDni = fila.find('input[name=dni]').val();
      var nuevoNombre = fila.find('input[name=nombre]').val();
      var nuevoUser = fila.find('input[name=user]').val();
      var nuevoRol = fila.find('select[name=rol]').val();

      // Realiza una solicitud AJAX para actualizar los datos en el servidor
      $.ajax({
        url: '../php/update_data.php', // URL del script PHP que actualizará los datos en la base de datos
        method: 'POST',
        data: {
          save: true, // Agrega esta propiedad para indicar que se está guardando la edición
          id: idUsuario,
          dni: nuevoDni,
          nombre: nuevoNombre,
          user: nuevoUser,
          rol: nuevoRol
        },
        success: function(response) {
          // Recarga la página después de guardar la edición
          location.reload();
        },
        error: function() {
          alert('Error al actualizar los datos. Inténtalo de nuevo.');
        }
      });
    });
  });
});
