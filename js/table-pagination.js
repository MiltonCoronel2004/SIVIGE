
	$(document).ready(function() {
    cargarTabla(1); // Cargar la primera página al cargar la página

    // Función para cargar la tabla con los datos paginados
    function cargarTabla(pagina) {
        $.ajax({
            url: "php/paginacion.php", // Ruta al archivo PHP que se encargará de obtener los datos paginados
            type: "GET",
            data: { pagina: pagina },
            success: function(data) {
                $("#tabla-victimas").html(data); // Actualizar el contenido del div con los datos paginados
            },
            error: function() {
                alert("Error al cargar los datos de la paginación.");
            }
        });
    }

    // Manejar el evento de hacer clic en los números de página
    $(document).on("click", ".page-link", function(e) {
        e.preventDefault();
        var pagina = $(this).attr("href").split("=")[1]; // Obtener el número de página desde el atributo href del enlace
        cargarTabla(pagina);
    });
});

