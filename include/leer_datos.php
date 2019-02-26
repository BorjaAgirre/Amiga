<?php


//include "array_desplegable.php"; 

/* Esta función lee las columnas definidas por '$items' de la tabla '$tabla', dada una determinada condición y un orden. 
*
*/

function leer_datos($tabla, $items, $condicion, $orden) {
	global $campos_bd;
	global $poblaciones;

	$db = new Leer_Mysqli();
	$i=0;
	$query = "SELECT ";
	foreach ($items as $it) {
		if ($i++ != 0) $query .= ", ";
		$query .= $it;
	}
	$query .= " FROM ".$tabla;
//	if ($condicion != "") $query .= " WHERE ". $condicion[0]." = ".$condicion[1];
	if ($condicion != "") $query .= " WHERE ". $condicion;
	if ($orden != "") $query .= " ORDER BY ".$orden;
	echo "query: ".$query; 

	$result = $db->pregunta_query($query);    

	$k=0;
	while($row = $result->fetch_array(MYSQLI_BOTH)) {
		$j=0;
		foreach ($items as $it) {
	        	$contents[$j] = $row[$it];
			if ($it == "nacionalidad") {
				$contents[$j] = $_SESSION['paises'][$row[$it]]["pais"];
			}
			if ($it == "poblacion") {

				$contents[$j] = $poblaciones[$row[$it]]["poblacion"];
//				echo "<br>contents: ".$contents[$j];
			}
			$j++;
		}
	        $array[$k++]=$contents;
	}
/*	echo "imprimiendo<br><pre>";
	print_r($array);
	echo "</pre>"; 		*/	
	$db->cerrar_conexion(); 
	return $array;
}


?>
