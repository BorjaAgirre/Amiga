<meta charset="utf-8">
<script type="text/javascript" src="jq/jquery.min.js"></script> 
<script type="text/javascript" src="jq/jquery-ui.js"></script> 
<script type="text/javascript" src="jq/scripts/form_foto.js"></script> 
<link href="jq/css/styles.css" rel="stylesheet" type="text/css" />	
<link href="jq/css/humanity/jquery-ui.css" rel="stylesheet" type="text/css" />	

<!--	<style>
		body { font-size: 62.5%; }            
		label, input { display:block; }
		input.text { margin-bottom:12px; width:95%; padding: .4em; }
		fieldset { padding:0; border:0; margin-top:25px; }
		h1 { font-size: 1.2em; margin: .6em 0; }
		div#users-contain { width: 350px; margin: 20px 0; }
		div#users-contain table { margin: 1em 0; border-collapse: collapse; width: 100%; }
		div#users-contain table td, div#users-contain table th { border: 1px solid #eee; padding: .6em 10px; text-align: left; }
		.ui-dialog .ui-state-error { padding: .3em; }
		.validateTips { border: 1px solid transparent; padding: 0.3em; }
	</style>      
	<script>
	$(function() {
		// a workaround for a flaw in the demo system (http://dev.jqueryui.com/ticket/4375), ignore!
		//  $( "#dialog:ui-dialog" ).dialog( "destroy" );
		
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

		$( "#boton-fotografia" )
			.button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
			});
	});
	</script> -->

<div class="demo">

<div id="dialog-form" title="Subir fotografía">
	<form id='form-img' name='form-img' style= 'font-size: 110%;' enctype='multipart/form-data' method='post' action='include/upload.php' />
<!--	<fieldset>  -->
	<label for="name"><p>Nueva fotografía:</p></label>
	<input type='file' size='32' name='imagen' value='' />
	<input type='hidden' name='action' value='simple' />
<!-- 	</fieldset>  -->
	</form>
</div>


<button id="boton-fotografia">Subir fotografía</button>

</div><!-- End demo -->

<!-- End demo-description -->
