<!doctype html>
<html lang="en">
<head>
<title>Pisos</title>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css" />
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
<!-- <link rel="stylesheet" href="/resources/demos/style.css" />    -->

<style>
.piso ul { list-style-type: none; margin: 0; padding: 0 0 2.5em; float: left; margin-right: 10px; }
.piso ul li { margin: 0 5px 5px 5px; padding: 5px; font-size: 1.2em; width: 120px; border: 1px solid #888888; }
.piso {float: left;  }
#resultados {  }
.cabecera_piso p {margin-top: -10px;  }
</style>

<script type="text/javascript">
$(document).ready(function(){ 				   
	$(function() {
		$(".connectedSortable").sortable({  
			connectWith: ".connectedSortable", opacity: 0.6, cursor: 'move', 

			update: function(event,ui) {
					var item = $(ui.item);
					var orig = $(ui.sender);
					var order = $(this).sortable("serialize") 
						+ '&item=' + item.attr('id') + '&origen=' + orig.attr('id')
						+ '&destino=' + $(this).attr('id')+ '&action=updateRecordsListings'; 
					$.post("update_piso.php", order, function(theResponse){
						$("#resultados").html(theResponse);
					}); 															 
				}								  
		});
	});
});	
</script>

</head>
<body>


<?php

include_once "datos_pisos.php";

	for($num=0; $num<sizeof($piso); $num++) {
		$caract = $piso[$num]['caract']; 
		echo "\n<div class='piso'>";
		echo "\n<div class='cabecera_piso'>"; 
		echo "\n<h2>".$caract['nombre']."</h2>"; 
		echo "\n<p>Plazas: ".$caract['plazas']."</p>"; 
		echo "\n<p>Inserción: ".$caract['insercion']."</p>"; 
		echo "\n</div>"; 
		echo "\n<ul id='piso_".$num."' class='connectedSortable'>";
		foreach ($piso[$num]['gente'] as $id => $pers) {
			$css_fondo = ($pers[1] == 'no') ? "" : "background-color: red;"; 
			echo "\n<li class='".$caract['state']."' id='persona_".$id."' style='".$css_fondo."'>".$pers[0]."</li>";
		}
		echo "\n</ul>\n</div>\n"; 
	}
?>
	<div id="resultados">
	 <p>Aquí aparecen los resultados.</p>
	 <p>&nbsp; </p>
	</div>


</body>
</html>
