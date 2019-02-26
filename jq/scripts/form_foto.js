//	
//  Estas son las funciones para el formulario que aparece para cargar una foto. 
//  Se llama a estas funciones solamente en la p�gina 'persona'.
//  

	$(function() {
		// Di�logo que se abre al pulsar el bot�n. 	
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

		// Bot�n para abrir el di�logo
		$( "#boton-fotografia" )
			.button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
			});
	});
