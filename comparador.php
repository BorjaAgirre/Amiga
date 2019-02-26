<?php
	
/*
*   Este bucle compara dos registros de un usuario
*/
function compara($comp, $debug=false) {

	$db = new Leer_Mysqli();
	$registros = $db->lista_id_pers($comp);
 	//$registros = array(5129, 5136, 5137);
 	if ($debug) {  echo "<br>Registros: <pre>"; print_r($registros); echo "</pre>";  }

	// Crea el query 
	$texto_query = "SELECT * FROM persona WHERE id_pers = '";
	$query = ""; 
	foreach ($registros as $cp) {
		$query .= $texto_query; 
		$query .= $cp;
		$texto_query = "' OR id_pers = '";
	}
	$query .= "' ORDER BY id_pers DESC;";
	if ($debug) {  echo "Se utilizará esta consulta: ".$query; }

	// Consulta a la base de datos

	$result = $db->pregunta_query($query);
	$i = 0;
	while($row = $result->fetch_array(MYSQLI_ASSOC)) { 			
		$array_pers[$i++] = $row; 
	}
	if ($debug) {  echo "<br>Array de los registros a comparar: <pre>"; print_r($array_pers); echo "</pre>"; }
	// Realiza la comparación de dos en dos, en el orden del array

	$cont = (sizeof($array_pers)-1);
	if ($debug) {  echo "<br>Número de registros: ".($cont + 1);   }

	$array_columnas = array(); 
	for ($k = 0; $k < $cont; $k++) {
		if ($debug) { echo "<br><h2>Comparación entre ".$k." y ".($k+1)."</h2>";}
		$array_result = array_diff_assoc($array_pers[$k], $array_pers[$k+1]); 
		$j= 0; 

		$array_columnas = array_merge($array_columnas, $array_result);
		if ($debug) { 
			echo "<br>Nueva array_columnas: ";
			echo "<pre>";print_r($array_columnas); echo "</pre>";
		}

		$array_gral[$k] = $array_result;
		if ($debug) {		
			echo "<br>Array general: ";
			echo "<pre>";print_r($array_gral); echo "</pre>";
		}
	}
	$i = 0;
	foreach ($array_columnas as $key => $columna) {
		$tabla[$i][0] = $key; 
		$tabla[$i][1] = $array_pers[0][$key];
		for($m=0; $m<$cont; $m++) {
			$tabla[$i][$m+2] = $array_gral[$m+1][$key];
		}
		$i++;
	}
	$db->cerrar_conexion();
	return array($tabla, $registros); 		
}
include_once "clases/class.leer_mysqli.php";
include_once "include/array_a_tabla.php"; 
$debug = true;
$id_unico = 2334;

$retorno = compara($id_unico,$debug);
$tabla = $retorno[0];
$registros = $retorno[1];

$atributos_tabla = array("width"=>100, "border"=>"1");
$atributos_titulo = array("bgcolor"=>"#336699");
$atributos_linea = array("bgcolor"=>"#COCOCO");
tabla(array_merge(array("campo"),$registros), $tabla, $atributos_tabla, $atributos_titulo, $atributos_linea)

?>
