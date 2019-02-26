<?php

$db_host 		= 'localhost';
$db_user 		= 'root';
$db_password 	= 'zubietxe2010';
$db_name 		= 'zubietxe';
	
	
$db = new mysqli($db_host , $db_user ,$db_password, $db_name);

if(!$db) {
	
	echo 'Error de conexion';
} else {

	if(isset($_POST['mysearchString'])) {
		$mysearchString = $db->real_escape_string($_POST['mysearchString']);

		if(strlen($mysearchString) >0) {

			$query = $db->query("SELECT * 
								 FROM persona 
								 WHERE nombre
								 LIKE '$mysearchString%' 
								 LIMIT 5");
			
			
			if($query) {

				
				while ($result = $query ->fetch_object()) {
				echo '<li onClick="fill(\''.$result->nombre.' '.$result->apellido1.'\');">'.$result->apellido1.' '.$result->apellido1.'</li>';
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
