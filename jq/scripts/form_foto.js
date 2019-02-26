//	
//  Estas son las funciones para el formulario que aparece para cargar una foto. 
//  Se llama a estas funciones solamente en la página 'persona'.
//  

	$(function() {
		// Diálogo que se abre al pulsar el botón. 	
		$( "#dialog-form" ).dialog({
			autoOpen: false,
			height: 180,
			width: 470,
			modal: true,
			buttons: { 
				"Subir": function() {
					$( "#form-img" ).submit();
				},
				"Cancelar": function() {
					$( this ).dialog( "close" );
				}

			},
			close: function() {
				allFields.val( "" ).removeClass( "ui-state-error" );
			}
		});

		// Botón para abrir el diálogo
		$( "#boton-fotografia" )
			.button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
			});
	});
