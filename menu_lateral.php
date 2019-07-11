
<span id="indice">
<center>
<font size="3">INDICE</font>
<div id="container">
	<form  autocomplete='off'>
		<div>

<?php 
	if (($pagina=="persona") || ($pagina == "persona_alta_baja")) {
		echo "<input type='text' size='10' id='inputString' onkeyup='lookup(this.value);' onblur='fill();' />";
	} else if (($pagina=="seguimiento") || ($pagina == "indicadores")) {
		echo "<input type='text' size='10' id='inputString' onkeyup='lookup2(this.value);' onblur='fill();' />";
	}
?>
		</div>
		<div class="suggestionsBox" id="suggestions" style="display: none;z-index:10;">
			<img src="upArrow.png" style="position: relative; top: -18px; left: 30px;" alt="upArrow" />
			<div class="suggestionList" id="autoSuggestionsList"></div>
		</div>
	</form>
</div>
</center>

<div id="iframe2up">
<center>
<table>
	<tr><td><a href="<?php echo $pagina; ?>.php?filter=todos">Todos</a></td>
	<td><a href="<?php echo $pagina; ?>.php?filter=activos">Activos</a></td>
	<td><a href="<?php echo $pagina; ?>.php?filter=mios">Míos</a></td></tr></table></div>
	<div id="iframe2">
		<br>
		
<?php
	$db = new Leer_Mysqli(); 
	$hoy = date("Y-m-d");
	if ((isset($_GET['filter'])) || (isset($_SESSION['filter']))) {
			$filter = (isset($_GET['filter'])) ? $_GET["filter"] : $_SESSION['filter'];
			$_SESSION['filter'] = $filter; 
			if ($filter=="todos")  {
				$query = "SELECT id_pers, id_unico, nombre, apellido1, apellido2, id_pers
					FROM persona WHERE historial='actual' ORDER BY nombre";
				$result = $db->lista_query($query);  
			} else {	
				$arg = array (
					'persona' => true, 
					'no_repite' => false
				);
				if ($filter == 'mios') $arg['tutor'] = $_SESSION['idusuario'];
				$result = $db->activos($arg);  
			}
	}
		
	echo"<table width=250 style='z-index:0'><tr></tr>";
	foreach ($result as $person) {
	  	echo "<tr><td><a href=".$pagina.".php?load=".$person["id_unico"]."&filter="
			.$filter.">".$person['nombre']." ".$person['apellido1']." ".$person['apellido2']."</a></td></tr>";
	}
	$db->cerrar_conexion(); 
?>
		
	</table>
	</div>
	</center>
	</span>




