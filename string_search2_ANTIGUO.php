        <script>
	function goto(idperson)
	{
	window.location="seguimiento.php?load="+idperson;
	}
	</script>

<?php
/*  
*  	ESTE CÓDIGO ES EL QUE SE UTILIZA EN EL BUSCADOR DEL 'INDICE'. 
*/

$db_host 		= 'localhost';
$db_user 		= 'root';
$db_password 		= 'zubietxe20100';
$db_name 		= 'zubietxe';
	
	
$db = new mysqli($db_host , $db_user ,$db_password, $db_name);

if(!$db) {
	
	echo 'Error de conexion';
} else {

	if(isset($_POST['mysearchString'])) {
		$mysearchString = $db->real_escape_string($_POST['mysearchString']);

		if(strlen($mysearchString) >0) {

			$query = $db->query("SELECT id_unico, nombre, apellido1, apellido2, id_pers
FROM persona WHERE nombre LIKE '$mysearchString%' OR apellido1 LIKE '$mysearchString%' GROUP BY id_unico ORDER BY max(id_pers)  LIMIT 10");
			
			
			if($query) {

				
				while ($result = $query ->fetch_object()) {
			    $idunico=$result->id_unico;
				// Modificación para obtener el último ID de cada nombre sin usar subqueries!
				include "conexion.php";
				$resultidunico=mysql_query("SELECT max(id_pers) FROM persona WHERE id_unico =".$idunico,$conexion); 
				$rowmaxidpers=mysql_fetch_row($resultidunico);
				$maxidpers=$rowmaxidpers[0];
				// Por fin :)
				
				echo '<li onClick="fill(\''.$result->nombre.' '.$result->apellido1.' '.$result->apellido2.'\');
					goto('.$idunico.');">'.$result->nombre.' '.$result->apellido1.' '.$result->apellido2.'</li>';
				}
			} else {
				echo 'ERROR: There was a problem with the query.';
			}
		} else {
		} 
	} else {
		echo 'Access denied.';
	}
}
?>
