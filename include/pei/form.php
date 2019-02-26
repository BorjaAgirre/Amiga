<?php

?>
<html>
<head>
<link href='form.css' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="../../jq/jquery.min.js"></script>
<script type="text/javascript" src="../../jq/jquery-ui.js"></script>

			<script type="text/javascript">
				$(document).ready(function(){
					$("#ob").click(function() {
						$("#meta").toggle();
					});
				});


	$(document).ready(function(){

		//Hide div w/id extra
	   $("#extra2").css("display","none");

		// Add onclick handler to checkbox w/id checkme
	   $("#checkme2").click(function(){

		// If checked
		if ($(this).is(":checked"))
		{
			//show the hidden div
			$("#extra2").show("fast");
//			$(this).css("background-color", "yellow");
		}
		else
		{
			//otherwise, hide it
			$("#extra2").hide("fast");
		}
	  });

	});
			</script>
</head>
<body>

<form name='pei' action = 'form.php' method='post'>
	<br>1. SITUACIÓN ECONÓMICA
	<div id='tabla'>
		<table>
			<tr id='primer_tr'>
				<td>OBJETIVO</td>
				<td>META</td></tr>
			<tr>
				<div id='extra'>
					<td><input type='checkbox' id='checkme' name='obj-1-0' value='obj-1-0'> 
						1. Garantizar la cobertura de necesidades básicas</td>
					<td><input type='text' style='display: none' id='meto' size=50 name='meta-1-0' value=''></td>
				</div></tr>
	<tr>
		<div id='capa'>
		<input type='checkbox' id='checkme2' name='obj-1-1' value='obj-1-1'> 2. Incrementar el nivel de ingresos económicos.
		<td><div id='extra2' style='display: none'><input type='text' id='meta' size=20 name='meta-1-1' value=''>
			<input type='text' id='meta7' size=20 name='meta-1-1' value=''></td></div></tr>
		</div>
	<tr>
				<td><input type='checkbox' id='ob' name='obj-1-2' value='obj-1-2'> 3. Lograr autonomía económica.</td>
				<td><input type='text' id='meta1' style='display: none' size=50 name='meta-1-2' value=''></td></tr>
			<tr>
				<td><input type='checkbox' id='ob' name='obj-1-3' value='obj-1-3'> 4. Conseguir ingresos económicos estables.</td>
				<td><input type='text' id='meta3' style='display: none'  size=50 name='meta-1-3' value=''></td></tr>
			<tr>
				<td><input type='checkbox' id='ob' name='obj-1-4' value='obj-1-4'> 5. Superar situación de endeudamiento.</td>
				<td><input type='text' id='meta' style='display: none'  size=50 name='meta-1-4' value=''></td></tr>
		</table>
		<input type = 'button' name='enviar' value='Enviar' >
	</div>
</form>


</body>
</html>


<?php

?>
