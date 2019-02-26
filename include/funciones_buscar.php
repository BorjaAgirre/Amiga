<?php
//  	Previamente debe estar definido la variable $buscar con el id_unico del que se quiere saber el máximo id_pers

function maxid_de_idunico($id_unico) {
	$bd = new Leer_Mysqli();  
	$query = "SELECT MAX(id_pers) AS maxid FROM persona WHERE id_unico = '".$id_unico."'";
	$rowidunico = $bd->lista_query($query, true);
	echo "rowidunico".$rowidunico; 
	$bd->cerrar_conexion;
	$maxid = $rowidunico['maxid'];
	echo "maxxid: ".$maxid;
	return $maxid; 
}

?>
