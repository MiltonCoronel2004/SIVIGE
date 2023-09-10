$(document).ready(function(){

	/*  Show/Hidden Submenus */
	$('.nav-btn-submenu').on('click', function(e){
		e.preventDefault();
		var SubMenu=$(this).next('ul');
		var iconBtn=$(this).children('.fa-chevron-down');
		if(SubMenu.hasClass('show-nav-lateral-submenu')){
			$(this).removeClass('active');
			iconBtn.removeClass('fa-rotate-180');
			SubMenu.removeClass('show-nav-lateral-submenu');
		}else{
			$(this).addClass('active');
			iconBtn.addClass('fa-rotate-180');
			SubMenu.addClass('show-nav-lateral-submenu');
		}
	});

	/*  Show/Hidden Nav Lateral */
	$('.show-nav-lateral').on('click', function(e){
		e.preventDefault();
		var NavLateral=$('.nav-lateral');
		var PageConten=$('.page-content');
		if(NavLateral.hasClass('active')){
			NavLateral.removeClass('active');
			PageConten.removeClass('active');
		}else{
			NavLateral.addClass('active');
			PageConten.addClass('active');
		}
	});

	/*  Exit system buttom */
	$('.btn-exit-system').on('click', function(e){
		e.preventDefault();



		Swal.fire({
			title: '¿Seguro que quiere cerrar sesión?',
			text: "Estas a punto de cerrar la sesión y salir del sistema",
			type: 'question',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Si, salir!',
			cancelButtonText: 'No, cancelar'
		}).then((result) => {
			if (result.value) {
				window.location="../php/logout.php";
			}
		});
	});

	

	$('.btn-show-info').on('click', function(e){
    e.preventDefault();

    Swal.fire({
        title: 'Información',
        icon: 'info',
        html: `1. Las acciones dependen del nivel de privilegio del usuario<br>
               2. Un Lector no podrá crear registros ni usuarios.<br>
               3. Un Editor no podrá crear usuarios.<br>
               4. Un Administrador tiene acceso total.<br>
               5. Solo los Administradores pueden cambiar contraseñas.<br>
               6. Si presionas una sección y no pasa nada, probablemente no tengas los privilegios necesarios.<br>
               7. Todos los archivos son guardados en una base de datos SQL.<br>
               8. La base de datos se encuentra en un hosting web.<br>
               9. No se puede eliminar los usuarios en uso.<br>
               10. El creador del software no se hace responsable del mal uso que se le pueda dar al software.<br>`,
        showCancelButton: false,
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'OK'
    });
});

	

});
(function($){
    $(window).on("load",function(){
        $(".nav-lateral-content").mCustomScrollbar({
        	theme:"light-thin",
        	scrollbarPosition: "inside",
        	autoHideScrollbar: true,
        	scrollButtons: {enable: true}
        });
        $(".page-content").mCustomScrollbar({
        	theme:"dark-thin",
        	scrollbarPosition: "inside",
        	autoHideScrollbar: true,
        	scrollButtons: {enable: true}
        });
    });
})(jQuery);


  


