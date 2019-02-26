
<?php
// AQUI HABÍA UN SCRIPT COMO EL DE string_search2.php  (POR SI NO FUNCIONA). 

include_once "clases/class.leer_mysqli.php"; 
$db = new Leer_Mysqli();

	if(isset($_POST['mysearchString'])) {
//		$mysearchString = $db->real_escape_string($_POST['mysearchString']);
		$mysearchString = $_POST['mysearchString'];
		if(strlen($mysearchString) >0) {

			$query = $db->pregunta_query("SELECT id_unico, nombre, apellido1, apellido2, id_pers
FROM persona WHERE historial = 'actual' AND nombre LIKE '$mysearchString%' OR apellido1 LIKE '$mysearchString%' GROUP BY id_unico ORDER BY max(id_pers)  LIMIT 10");
			
			while ($result = $query->fetch_object()) {
			   	$idunico = $result->id_unico;

				// Modificación para obtener el último ID de cada nombre sin usar subqueries!
				$resultidunico = $db->pregunta_query("SELECT max(id_pers) FROM persona WHERE id_unico =".$idunico); 
				$rowmaxidpers = $resultidunico->fetch_row($resultidunico);
				$maxidpers = $rowmaxidpers[0];
				// Por fin :)
				
				echo '<li onClick="fill(\''.$result->nombre.' '.$result->apellido1.'\');
				hiddenField = document.getElementById(\'idunico\');
				hiddenField.value = '.$idunico.';
				">'.$result->nombre.' '.$result->apellido1.' '.$result->apellido2.'</li>';
			}
		} 
	} 
?>
