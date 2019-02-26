<?php      
/*  Esta parte estaba antes del comienzo de php
    <script>
	function goto(idperson)
	{
	window.location="persona.php?load="+idperson;
	}
	</script>
*/

include_once "clases/class.leer_mysqli.php";
$db = new Leer_Mysqli;

if(!$db) {
	echo 'Error de conexion';
} else {
	if(isset($_POST['mysearchString'])) {
		$mysearchString = $db->escape($_POST['mysearchString']);

		if(strlen($mysearchString) >0) {

			$query = $db->pregunta_query("SELECT id_unico, nombre, apellido1, apellido2, id_pers
FROM persona WHERE nombre LIKE '$mysearchString%' OR apellido1 LIKE '$mysearchString%' GROUP BY id_unico ORDER BY max(id_pers)  LIMIT 10");
			
			if($query) {
				$texto = "";
				while ($result = $query->fetch_object()) {
			    		$idunico = $result->id_unico;
					// Modificación para obtener el último ID de cada nombre sin usar subqueries!
					//$resultidunico = $db->pregunta_query("SELECT max(id_pers) FROM persona WHERE id_unico =".$idunico); 
					//$rowmaxidpers = $resultidunico->fetch_row();
					//$maxidpers = $rowmaxidpers[0];

				
	//				echo '<li onClick="fill(\''.$result->nombre.' '.$result->apellido1.' '.$result->apellido2.'\');
	//					goto('.$idunico.');">'.$result->nombre.' '.$result->apellido1.' '.$result->apellido2.'</li>';
					$texto .= "<li><a href= seguimiento.php?load=".$idunico." style='text-decoration:none; color:white;'>
						".$result->nombre.' '.$result->apellido1.' '.$result->apellido2."</li>";
				}
				echo " ".$texto; 
			} else {
				echo 'ERROR con el query en string_search2.php';
			}
		} else {
		} 
	} else {
		echo 'Access denied.';
	}
}
?>
