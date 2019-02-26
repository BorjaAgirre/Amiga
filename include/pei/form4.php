<!DOCTYPE html>
<html>
<head>
<link href='form.css' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="../../jq/jquery.min.js"></script>
<script type="text/javascript" src="../../jq/jquery-ui.js"></script>
</head>
<body>

<script>
$(document).ready(function () {
	$("input#ob").click(function() {
		if ($(this).is(":checked"))
        {
          $("div#esconder").show("fast");
        } else {
          $("div#esconder").hide("fast");
        }
    });
//  });
});

</script>



<div class='tabla_ob'>
<!--
	<div class='linea'><input type='checkbox' id='ob' name='obj-1-0'  checked = 'checked'  value='obj-1-0'> 1. Garantizar la cobertura de necesidades .
		<div id='esconder'>
			<input type='text' id='meta' size=50 name='meta-1-0'  style = 'display: none'  value=''>
		</div>
	</div>
	<div class='linea'><input type='checkbox' id='ob' name='obj-1-1'   value='obj-1-1'> 2. Incrementar el nivel de ingresos económicos.
		<div id='esconder'>
			<input type='text' id='meta' size=50 name='meta-1-1'  value='Niveles económicos, etc. '>
		</div>
	</div>
-->
	<div class='linea'><input type='checkbox' id='ob' name='obj-1-2' checked = 'checked' value='obj-1-2'> 3. Lograr autonomía económica.
		<div id='esconder'>
			<input type='text' id='meta' size=50 name='meta-1-2'  style = 'display: none'  value=''>
		</div>
	</div>
</div>

</body>
</html>
