<?php
$usuario_nombre = "borja"; 

//	$db = new mysqli("localhost", "root", "zubietxe2010", "zubietxe");

	include "clases/class.leer_mysqli.php"; 
	$db = new Leer_Mysqli(); 
	$db->pregunta_query_seguro("password_DEPRECATED", "tutor", "nombre", $usuario_nombre); 
?>
